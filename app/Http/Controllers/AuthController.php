<?php

namespace App\Http\Controllers;

use App\Models\User; // Correction du chemin du modèle User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        // Vérifie si l'utilisateur est déjà connecté
        if (Auth::check()) {
            // Si l'utilisateur est déjà connecté, redirige vers la page d'accueil
            return redirect()->route('accueil');
        }

        /*
         * Si l'utilisateur n'est pas connecté et que la requête est de type POST,
         * on peut procéder à la création d'un utilisateur par défaut.
         */

        // Vérifie si la requête est de type POST pour créer un utilisateur
        if (!$request->isMethod('post')) {
            // Si la requête n'est pas de type POST, affiche le formulaire d'inscription
            return Inertia::render('auth/connexion');
        } elseif ($request->isMethod('post')) {
            // Créer un utilisateur 
            $request->validate([
                'nom' => 'required|string|max:255',
                'agence' => 'required|string|max:255',
                'email' => 'required|email', // Assurez-vous que l'email est unique
                'password' => 'required|string|min:5', // Mot de passe
            ]);

            /*
             * Note: Vous pouvez personnaliser les règles de validation selon vos besoins.
             * Par exemple, vous pouvez ajouter d'autres règles pour le champ 'code' si nécessaire.
             */
            // Si la validation réussit, créer l'utilisateur
            User::create([
                'name' => $request->input('nom'),
                'agence' => $request->input('agence'),
                'email' => $request->input('email'),
                'code' => $request->input('password'), // Code utilisateur
                'password' => Hash::make($request->input('password')), // Hachage du mot de passe
            ]);
            // Après la création de l'utilisateur, vous pouvez le connecter automatiquement
            // Auth::login($user); // Connecte l'utilisateur immédiatement après la création
            // Regénérer la session pour éviter les attaques CSRF
            $request->session()->regenerate();
            
            // Redirige vers la page de connexion ou une autre page souhaitée
            // Vous pouvez rediriger vers la page de connexion ou d'accueil après l'inscription
            return redirect()->route('auth.connexion'); // Redirige vers la page de connexion
            // Redirige vers la page d'accueil après l'inscription réussie
            // if (Auth::attempt([
            //     'email' => $request->input('email'),
            //     'password' => $request->input('password'),
            // ])) {
            //     $request->session()->regenerate(); // Régénérer la session après la connexion
            //     return Inertia::location(session('url.intended', route('accueil'))); // Redirige vers la page d'accueil
            // }
            /*
             * Note: Vous pouvez également choisir de connecter l'utilisateur immédiatement après la création
             * en utilisant Auth::attempt() ou Auth::login() comme indiqué ci-dessus.
             * Cela permettra à l'utilisateur d'être connecté automatiquement après l'inscription.
             */
            // Si la connexion automatique échoue, vous pouvez choisir de rediriger vers la page de connexion
            // ou afficher un message d'erreur. Cependant, dans la plupart des cas, la création de l'utilisateur
            // devrait réussir, et la connexion devrait être automatique si les informations fournies sont correctes.
            /*
             * Note: Si vous souhaitez laisser l'utilisateur se connecter manuellement après la création du compte,
             * vous pouvez décommenter la ligne suivante pour le rediriger vers la page de connexion.
             */
            // Si la tentative de connexion échoue après la création, vous pouvez choisir de rediriger ou afficher un message d'erreur
            // Note: Il est important de vérifier si l'utilisateur a été créé avec succès avant de tenter de le connecter
            // Si la connexion échoue, vous pouvez choisir de rediriger vers la page de connexion
            // return redirect()->route('auth.connexion')->withErrors(['email' => 'La connexion a échoué après la création de l\'utilisateur.']);
            // Note: Vous pouvez également choisir de laisser l'utilisateur se connecter manuellement après la création du compte
            /*
             * Note: Vous pouvez également choisir de laisser l'utilisateur se connecter manuellement après la création du compte
             * en redirigeant vers la page de connexion avec un message de succès.
             */
            // Si tout est réussi, redirige vers la page d'accueil
            // return redirect()->route('accueil'); // Redirige vers la page d'accueil après la création de l'utilisateur
            /*
             * Si vous souhaitez laisser l'utilisateur se connecter manuellement après la création du compte,
             * vous pouvez décommenter la ligne suivante pour le rediriger vers la page de connexion.
             */
            // return redirect()->route('auth.connexion')->with('success', 'Inscription réussie, veuillez vous connecter.');
        } else {
            // Si la requête n'est pas de type POST, affiche le formulaire d'inscription
            /*
             * Si la requête n'est pas de type POST, affiche le formulaire d'inscription.
             * Cela peut être le cas lors de l'accès initial à la page d'inscription.
             */
            // Vous pouvez choisir de rediriger vers la page de connexion ou afficher le formulaire d'inscription
            // return Inertia::render('auth/inscription'); // Affiche le formulaire d'inscription
            // Pour des raisons de sécurité, si la requête n'est pas de type POST, redirigez vers la page de connexion
            // Cela évite les accès non autorisés à la création de compte
            // return redirect()->route('auth.connexion')->with('error', 'Accès non autorisé à la création de compte.');
            return redirect()->route('auth.connexion')->with('error', 'Accès non autorisé à la création de compte.');
        }
        /*
         * Note: Vous pouvez également choisir de laisser l'utilisateur se connecter manuellement après la création du compte,
         * en redirigeant vers la page de connexion avec un message de succès.
         * Cela permet à l'utilisateur de se connecter immédiatement après la création du compte sans être redirigé automatiquement.
         * Par exemple, vous pouvez décommenter la ligne suivante pour rediriger vers la page de connexion après la création réussie de l'utilisateur.
         * return redirect()->route('auth.connexion')->with('success', 'Inscription réussie, veuillez vous connecter.');
         */
        // // Si aucune des conditions ci-dessus n'est remplie, redirigez vers la page de connexion par défaut
        // if (!Auth::check()) {
        //     // Si l'utilisateur n'est pas connecté après la création, redirigez vers la page de connexion
        //     return redirect()->route('auth.connexion')->with('error', 'Vous devez être connecté pour accéder à cette page.');
        // }
        // // Si l'utilisateur est connecté, redirigez vers la page d'accueil
        // if (Auth::check()) {
        //     // Si l'utilisateur est connecté, redirigez vers la page d'accueil
        //     return Inertia::location(session('url.intended', route('accueil'))); // Redirige vers la page d'accueil
        // } else {
        //     // Si l'utilisateur n'est pas connecté après la création, redirigez vers la page de connexion
        //     // Cela garantit que l'utilisateur est redirigé vers la page de connexion s'il n'est pas connecté
        //     return redirect()->route('auth.connexion')->with('error', 'Vous devez être connecté pour accéder à cette page.');
        // }
        
            // User::create([
            //     'name' => 'JOSEPH CHAMI',
            //     'agence' => 'YAOUNDE',
            //     'email' => 'josephchami@semem',
            //     'code' => 'Josep7',
            //     'password' => Hash::make('Josep7') // Hachage du mot de passe
            // ]);
            // return redirect()->route('auth.connexion');
        

    }

    public function index()
    {
        return Inertia::render('auth/inscription', [
            // Vous pouvez passer des données supplémentaires à la vue si nécessaire
            // 'sessionData' => session()->all(), // Passe toutes les données de la session
        ]);
    }

    

    public function connexion()
    {
        return Inertia::render('auth/connexion');
    }

    public function Goconnexion(Request $request){
        // dd($request->input('_token'), csrf_token()); // Vérifie si les tokens correspondent

        $credentials = $request -> validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(array_merge($credentials, ['agence' => $request->input('agence')]))) {
            $request->session()->regenerate();
            return Inertia::location(session('url.intended', route('accueil'))); // Redirige avec Inertia
            // return redirect()->intended(route('accueil')); // Redirige avec Laravel elle bloque sur le loading de la page
        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect.',
        ])->onlyInput('email');
    }

    public function deconnexion(){
        Auth::logout();
            return Inertia::location(route('auth.connexion')); // Redirige avec Inertia
    }


}

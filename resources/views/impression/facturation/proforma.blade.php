<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <style>
        @media print {
            body {
                width: 210mm; /* Largeur maximale pour A4 */
                height: 297mm; /* Hauteur maximale pour A4 */
                margin: 0;
                padding: 0;
                font-size: 12pt;
            }
            .header, .footer {
                display: none;
            }
        }
    </style>
</head>
<body>
{{-- <body style="padding: 0rem 0rem;"> --}}

    <header>
        <section class="mb-1">
            <div>
                <div class="row">
                        <img src="{{ public_path('build/assets/logo.jpg') }}" alt="Image de la Proforma" style="width: 150px; height: 115px; float: left;">
                        {{-- <img src="{{ asset('build/assets/logo.jpg') }}" alt="Image de la Proforma" style="width: 200px; height: 160px; float: left;"> --}}

                    <div class="" style="margin-top: -2rem; margin-left: 0px;">
                        <div class="row" style="color: red;
                                    font-size: 34px;
                                    font-family: ui-rounded;
                                    font-weight: bold;">
                            <p class="" style="text-align: center;">
                                <span>SEMEM DISTRIBUTORS</span>
                                <span style="color: blue">Sarl</span>
                            </p>
                        </div>
                        <div class="row" style="color: blue; text-align: center; font-size: 12px; margin-left: 0rem; margin-top: -2rem">
                            CAPITAL 200 220 000 F CFA (DEUX CENT MILLIONS DEUX CENT VINGT MILLE FRANCS CFA) <br>
                            B.P : 5585 Douala-Cameroun Situé Rue Galliéni Akwa <br>
                            Tél : (237) 233 42 25 24 / 233 43 26 94 Fax : (237) 233 42 85 42 <br>
                            www.sememdistributors.com E-mail : contact@sememdistributors.com <br>
                            RC/DLA/1995/B/014998 Statistique N° 8057701 L Contribuable N° M079500007393 / D Régime du Réel
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <hr style="border: 0.5px solid red;">
        <hr style="border: 0.5px solid red;">

        <section class="header" style="box-shadow: 0px 0px 10px #000; border-radius: 10px; padding: 2px; background-color: #fff;">
            <div class="text- row  m-2" style="background-color: #add8e6; padding: 20px; border-radius: 10px;">

                {{-- resources/views/impression/facturation/proforma.blade.php --}}

                {{-- Affichage des détails de la proforma --}}
                <h1 class="text-center" style="color: #000; font-weight: bold; font-size: 1rem;">Détails de la Proforma</h1>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="color: #000; font-weight: bold; font-size: 0.8rem;">N°Proforma : {{ $proforma->numProforma }}</td>
                        <td style="color: #000; font-weight: bold; font-size: 0.8rem;">DATE : {{ $proforma->date }}</td>
                        <td style="color: #000; font-weight: bold; font-size: 0.8rem;">COMMERCIAL : {{ $proforma->commercial }}</td>
                    </tr>
                    <tr>
                        <td style="color: #000; font-weight: bold; font-size: 0.8rem;">TYPE PROFORMA : {{ $proforma->typeProforma }}</td>
                        <td style="color: #000; font-weight: bold; font-size: 0.8rem;">CLIENT : {{ $proforma->client }}</td>
                        <td style="color: #000; font-weight: bold; font-size: 0.8rem;">ACHETEUR : {{ $proforma->acheteur }}</td>
                    </tr>
                    <!-- <tr>
                        <td style="color: #000; font-weight: bold; font-size: 0.8rem;">CLIENT : {{ $proforma->client }}</td>
                        <td style="color: #000; font-weight: bold; font-size: 0.8rem;">ACHETEUR : {{ $proforma->acheteur }}</td>
                    </tr> -->
                </table>

                {{-- Ajoutez d'autres champs selon votre modèle Proforma --}}
            </div>
        </section>
    </header>




    {{-- Affichage des articles de la proforma dans un tableau --}}
    <div class="text-center m-2">
        <table class="table text-center mx-auto" style="border: 1px solid #000; margin: 5px; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="border: 1px solid #000;">DESIGNATION</th>
                    <th style="border: 1px solid #000;">PRIX UNITAIRE</th>
                    <th style="border: 1px solid #000;">REMISE</th>
                    <th style="border: 1px solid #000;">Quantité</th>
                    <th style="border: 1px solid #000;">PRIX TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proformaArticles as $article)
                    <tr>
                        <td style="border: 1px solid #000; text-align: center;">{{ $article->designation }}</td>
                        <td style="border: 1px solid #000; text-align: center;">{{ $article->pu }}</td>
                        <td style="border: 1px solid #000; text-align: center;">{{ $article->remise }} %</td>
                        <td style="border: 1px solid #000; text-align: center;">{{ $article->qte }}</td>
                        <td style="border: 1px solid #000; text-align: center;">{{ ($article->pu * $article->qte) * (100 - $article->remise) / 100 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <footer style="background-color: #F7F7F7; box-shadow: 0px 0px 10px #000;">
        <div class="text-center m-4">
            {{-- Calcul et affichage des sommes --}}
            @php
                $totalHT = 0;
                foreach($proformaArticles as $article) {
                    $totalHT += ($article->pu * $article->qte) * (100 - $article->remise) / 100;
                }
                $tva = 19.25;
                $totalTVA = $totalHT * ($tva / 100);
                $totalTTC = $totalHT + $totalTVA;
            @endphp
            <div class=" justify-content-center">
                <label class="m-3" style="color: #34C759; font-size: 1em; font-weight: bold;">Total HT : {{ $totalHT }} €</label>
                <label class="m-3" style="color: #8BC34A; font-size: 1em; font-weight: bold;">|</label>
                <label class="m-3" style="color: #3E8E41; font-size: 1rem; font-weight: bold;">TVA ({{ $tva }}%) : {{ $totalTVA }} €</label>
                <br>
                <label class="m-3" style="color: #228B22; font-size: 1rem; font-weight: bold;">Total TTC : {{ $totalTTC }} €</label>
                <label class="m-3" style="color: #008000; font-size: 1rem; font-weight: bold;">|</label>
                <label class="m-3" style="color: #006400; font-size: 1rem; font-weight: bold;">Precompte : {{ $proforma->precompte }}</label>
            </div>


        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>

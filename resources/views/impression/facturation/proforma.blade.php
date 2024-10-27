<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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

    <header class="header" style="box-shadow: 0px 0px 10px #000; border-radius: 10px; padding: 20px; background-color: #fff;">
        <div class="text-center m-2" style="background-color: #add8e6; padding: 20px; border-radius: 10px;">

            {{-- resources/views/impression/facturation/proforma.blade.php --}}

            {{-- Affichage des détails de la proforma --}}
            <h1 class="text-center" style="color: #000; font-weight: bold; font-size: 1rem;">Détails de la Proforma</h1>
            <div class="d-flex justify-content-center gap-1">
                <label  style="color: #000; font-weight: bold; font-size: 0.8rem; margin-right:30px">N°Proforma : {{ $proforma->numProforma }}</label>
                <label style="color: #000; font-weight: bold; font-size: 0.8rem; margin-right:30px">DATE : {{ $proforma->date }}</label>
                <label style="color: #000; font-weight: bold; font-size: 0.8rem;">HEURE : {{ $proforma->heure }}</label>
            </div>

            <div class="d-flex justify-content-center gap-4">
                <label style="color: #000; font-weight: bold; font-size: 0.8rem; margin-right:30px">TYPE PROFORMA : {{ $proforma->typeProforma }}</label>
                <label style="color: #000; font-weight: bold; font-size: 0.8rem; margin-right:30px">TYPE FISCALE : {{ $proforma->typeFiscal }}</label>
                <label style="color: #000; font-weight: bold; font-size: 0.8rem;">DEPOT : AKWA</label>
            </div>

            <div class="d-flex justify-content-center gap-4">
                <label style="color: #000; font-weight: bold; font-size: 0.8rem; margin-right:30px">COMMERCIAL : {{ $proforma->commercial }}</label>
                <label style="color: #000; font-weight: bold; font-size: 0.8rem; margin-right:30px">VENDEUR : {{ $proforma->vendeur }}</label>
                <label style="color: #000; font-weight: bold; font-size: 0.8rem;">D.A : {{ $proforma->da }}</label>
            </div>
            <div class="d-flex justify-content-center gap-4">
                <label style="color: #000; font-weight: bold; font-size: 0.8rem; margin-right:30px">CLIENT : {{ $proforma->client }}</label>
                <label style="color: #000; font-weight: bold; font-size: 0.8rem; margin-right:30px">ACHETEUR : {{ $proforma->acheteur }}</label>
                <label style="color: #000; font-weight: bold; font-size: 0.8rem;">D.A : {{ $proforma->da }}</label>
            </div>

            {{-- Ajoutez d'autres champs selon votre modèle Proforma --}}
        </div>
    </header>

    {{-- Affichage des articles de la proforma dans un tableau --}}
    <div class="text-center m-2">
        <table class="table text-center mx-auto" style="border: 1px solid #000; margin: 5px;">
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
            <div class="d-flex justify-content-center">
                <label class="m-3" style="color: #34C759; font-size: 1em; font-weight: bold; margin-right:30px">Total HT : {{ $totalHT }} €</label>
                <label class="m-3" style="color: #8BC34A; font-size: 1em; font-weight: bold; margin-right:30px">|</label>
                <label class="m-3" style="color: #3E8E41; font-size: 1rem; font-weight: bold;">TVA ({{ $tva }}%) : {{ $totalTVA }} €</label>
                <br>
                <label class="m-3" style="color: #228B22; font-size: 1rem; font-weight: bold; margin-right:30px">Total TTC : {{ $totalTTC }} €</label>
                <label class="m-3" style="color: #008000; font-size: 1rem; font-weight: bold; margin-right:30px">|</label>
                <label class="m-3" style="color: #006400; font-size: 1rem; font-weight: bold;">Precompte : {{ $proforma->precompte }}</label>
            </div>


        </div>
    </footer>

</body>
</html>

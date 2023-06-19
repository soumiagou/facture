@extends('layout')
@section('title', 'facture')
@section('content')

<head>
    <link rel="stylesheet" href="css/facture.css">
</head>

<div>
    <div class="container">
        <button id='printFacture' class="telecharger">Télécharger</button>
        <div class="contenu" id="facture">
            <div class="header">
                <img src="/pictures/logo.png" class="logo">
                <div class="facture-number">
                    <p class="facture">FACTURE</p>
                    N° : {{ isset($nuFacture) ? $nuFacture : ""  }}
                </div>
            </div>

            <p class="yool">
                14, Rue Maurice Ravel <br> Ang Rue Verdi Belvedere,<br> Casablanca, Maroc<br>yooly0664@gmail.com<br>05
                56 72 10 61
            </p>

            <div class="facture-info">
                <div class="date">
                    Date de facturation: {{ $date1 }}<br>
                    Échéance: {{ $date2 }}<br>
                    Mode de règlement: {{ $mode_reglement ?? '' }}
                </div>
                <div class="entreprise">
                    <p>
                        {{ $nom }}<br>
                        {{ $adresse }}<br>
                        {{ $telephone }}
                    </p>
                </div>
            </div>

            <div>
                <table>
                    <tr>
                        <th class="designation">
                            <label>Désignation</label>
                        </th>
                        <th>
                            <label>Quantité</label>
                        </th>
                        <th>
                            <label>Prix</label>
                        </th>
                        <th>
                            <label>Total</label>
                        </th>
                    </tr>

                    @php
                    $tva = 0.2;
                    $total_ht = 0;
                    $total_ttc = 0;
                    @endphp

                    @for ($i = 0; $i < count($designation); $i++)
                    @php
                    $total = $quantite[$i] * $prix[$i];
                    $total_ht += $total;
                    $total_ttc += $total + $total * $tva;
                    @endphp

                    <tr>
                        <td>{{ $designation[$i] }}</td>
                        <td>{{ $quantite[$i] }}</td>
                        <td>{{ $prix[$i] }}</td>
                        <td>{{ $total }} DH</td>
                    </tr>
                    @endfor

                    <tr>
                        <td colspan="2" class="t"></td>
                        <td class="p">Total (HT)</td>
                        <td class="p">{{ $total_ht }} DH</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="t"></td>
                        <td class="p2">Total (TVA)</td>
                        <td class="p2">{{ $total_ht * $tva }} DH</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="t"></td>
                        <td class="p">Total (TTC)</td>
                        <td class="p">{{ $total_ttc }} DH</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function generatePDF() {
            // Choose the element that our invoice is rendered in.
            const element = document.getElementById("facture");
            // Choose the element and save the PDF for our user.
            html2pdf()
                .set({
                    html2canvas: {
                        scale: 4
                    },
                })
                .from(element)
                .save();
        }
        document.getElementById('printFacture').addEventListener('click', (e) => {
            generatePDF()
        })
    </script>
</div>

@endsection('content')

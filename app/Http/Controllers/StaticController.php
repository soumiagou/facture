<?php

namespace App\Http\Controllers;
use App\Models\Facture;
use App\Models\Produit;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StaticController extends Controller
{
    public function index() {
        return view('welcome');
        
    }

   public function facture(Request $request) {
    $date1 = $request->date1;
    $date2 = $request->date2;
    $nom = $request->nom;
    $telephone = $request->telephone;
    $adresse = $request->adresse;
    $designation = $request->designation;
    $quantite = $request->quantite;
    $prix = $request->prix;

    //Create the client
    $client = new Client();
    $client->id_client = Str::uuid()->toString();
    $client->nom = $nom;
    $client->adresse = $adresse;
    $client->telephone = $telephone;
    $client->save();

    // Create the Facture
    $facture = new Facture();
    $facture->numero_facture = Str::uuid()->toString();
    $facture->date_facture = $date1;
    $facture->echeance = $date2;
    $facture->mode_reglement = $request->radio;
    $facture->id_client = $client->id;
    $facture->save();

    // Create and attach the produits to the facture
    for ($i = 0; $i < count($designation); $i++) {
        $produit = new Produit();
        $facture->numero_produit = Str::uuid()->toString();
        $produit->designation = $designation[$i];
        $produit->prix_unitaire = $prix[$i];
        $produit->save();

        // Attach the produit to the facture with quantity
        $facture->produits()->attach($produit->id, ['quantite' => $quantite[$i]]);
    }

    return view('facture');
}

}

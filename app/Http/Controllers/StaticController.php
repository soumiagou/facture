<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Produit;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


class StaticController extends Controller
{
    public function index()
    {
        return view('welcome');
    }


    public function facture(Request $request)
    {
        $date1 = $request->date1;
        $date2 = $request->date2;
        $nom = $request->nom;
        $telephone = $request->telephone;
        $adresse = $request->adresse;
        $designation = $request->designation;
        $quantite = $request->quantite;
        $prix = $request->prix;

        // Create the client
        $client = new Client();
        $max_id_client = DB::table('client')->max('id_client');
        $client->id_client = $max_id_client +1; // Auto-increment the id_client
        $client->nom = $nom;
        $client->adresse = $adresse;
        $client->telephone = $telephone;
        $client->save();

        // Create the Facture
        $facture = new Facture();
        $max_numero_facture = DB::table('facture')->max('numero_facture');
        // dd($max_numero_facture);
        $facture->numero_facture  = $max_numero_facture + 1; // Auto-increment the numero_facture
        $facture->date_facture = $date1;
        $facture->echeance = $date2;
        $facture->mode_reglement = $request->mode_reglement;
        $facture->id_client = $max_id_client +1;
        $facture->save();
        Log::debug($facture->toArray());


        // Create and attach the produits to the facture
        for ($i = 0; $i < count($designation); $i++) {
            $produit = new Produit();
            $max_numero_produit = DB::table('produit')->max('numero_produit');
            $produit->numero_produit =  $max_numero_produit + 1; // Auto-increment the numero_produit
            $produit->designation = $designation[$i];
            $produit->prix_unitaire = $prix[$i];
            $produit->save();


            // Insert the produit-facture relationship into the pivot table
            DB::table('facture_produit')->insert([
                'numero_facture' => $max_numero_facture +1,
                'numero_produit' => $max_numero_produit + 1,
                'quantite' => $quantite[$i],
            ]);
        }

        return view('facture')->with([
            'nuFacture' => $max_numero_facture +1,
            'date1' => $request->date1,
            'date2' => $request->date2,
            'mode_reglement' => $request->mode_reglement,
            'nom' => $request->nom,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'designation' => $request->designation,
            'quantite' => $request->quantite,
            'prix' => $request->prix
        ]);
    }
}

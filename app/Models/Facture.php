<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;
    protected $table = 'facture';
    protected $primaryKey = 'numero_facture';
    public $timestamps = false;
    protected $fillable = [
        'numero_facture',
        'date_facture',
        'echeance',
        'mode_reglement',
        'id_client'
    ];

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'facture_produit', 'numero_facture', 'numero_produit')
                    ->withPivot('quantite');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client');
        
    }
}

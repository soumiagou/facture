<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $primaryKey = 'numero_produit';
    public $timestamps = false;
    protected $fillable = [
        'numero_produit',
        'designation',
        'prix_unitaire'
    ];
    protected $table = 'produit';

    public function factures()
    {
        return $this->belongsToMany(Facture::class, 'facture_produit', 'numero_produit', 'numero_facture');
                    ->withPivot('quantite');
    }
}

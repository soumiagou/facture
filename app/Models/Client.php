<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_client';
    public $timestamps = false;
    protected $fillable = [
        'id_client',
        'nom',
        'prenom',
        'adresse',
        'ville',
        'telephone',
    ];

    protected $table = 'client';

    public function factures()
    {
        return $this->hasMany(Facture::class , 'numero_facture');
    }
    
}

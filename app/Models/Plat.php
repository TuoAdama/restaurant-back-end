<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plat extends Model
{
    use HasFactory;

    protected $garded = ['id']; 

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function plat_commandes()
    {
        return $this->hasMany(PlatCommande::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

}

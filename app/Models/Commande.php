<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function table_client()
    {
        return $this->belongsTo(TableClient::class);
    }

    public function personnel()
    {
        return $this->belongsTo(Personnel::class);
    }

    public function plat_commandes()
    {
        return $this->hasMany(PlatCommande::class);
    }

    public function etat()
    {
        return $this->belongsTo(Etat::class);
    }

}

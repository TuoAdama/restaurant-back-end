<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getCheminAttribute($value)
    {
        return asset('/storage/'.$value);
    }

    public function plat()
    {
        return $this->belongsTo(Plat::class);
    }

}

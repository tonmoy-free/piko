<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    function rel_to_inventory(){
       return $this->hasMany(Inventory::class, 'color_id');
    }

    protected $fillable = [
        "color_name",
        "color_code",
    ];
}

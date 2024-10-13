<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    function rel_to_inventory(){
        return $this->hasMany(Inventory::class, 'size_id');
    }

    protected $fillable = [
        "size_name",

    ];
}

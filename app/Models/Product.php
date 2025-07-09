<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'kode';
    public $timestamps = false;
    protected $fillable = ['nama', 'harga', 'stock'];
}

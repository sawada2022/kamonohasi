<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;
    public function rental_books(){
        return $this->belongsToMany(Bok::class, 'rentals');
    }
}

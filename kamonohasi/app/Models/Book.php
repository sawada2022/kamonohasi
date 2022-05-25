<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['isbn','category_id','title','author','publisher','comment','published_on','deleted_on'];
    
    protected $casts = [
        'published_on' => 'date',
        'deleted_on' => 'date'
    ];
    
    public function rental_users(){
        return $this->belongsToMany(User::class, 'rentals');
       }

}

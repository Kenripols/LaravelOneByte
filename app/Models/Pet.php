<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto', 'nombre', 'tipo', 'fechaNac', 'idRaza', 'titular_id'
    ];

    public function Breeds()
    {
        return $this->hasMany(Breed::class);
        
    }


}
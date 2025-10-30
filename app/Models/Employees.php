<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birth_place',
        'birth_date',
        'age',
        'nis',
        'address',
        'photo',
        'photo_uploaded_at',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'photo_uploaded_at' => 'datetime',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recets extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'descripcion', 'user_id'];

    protected $guarded = [];
}

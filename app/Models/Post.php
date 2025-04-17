<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'CodeArticle',
        'NomArticle',
        'quantite',
        'puht'
    ]; // to solve security issues

    // public $timestamps = false;  //to disallow the created_at and updated_at dislay
}

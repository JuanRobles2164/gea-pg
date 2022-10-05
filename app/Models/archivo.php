<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;
    protected $table = 'archivo';
    protected $fillable = ["nombre", "path_file", "data_file", "data_json"];
}

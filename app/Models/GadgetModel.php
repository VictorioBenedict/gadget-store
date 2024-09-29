<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GadgetModel extends Model
{
    use HasFactory;
    protected $table = 'shop';
    protected $fillable = ['image','category','name','description','price'];


}

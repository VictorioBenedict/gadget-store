<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $fillable = ['user_id','product_id','user_name','name','quantity','price','status'];
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'id');
    }
}

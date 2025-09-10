<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;


class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'quantity', 'image'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

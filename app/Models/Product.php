<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'name',
        'stock',
        'image',
        'sell_points',
        'status',
        'category_id',
        'provider_id',
    ];

    public function add_stock($quantity)
    {
        $this->increment('stock', $quantity);
    }

    public function subtrack_stock($quantity)
    {
        $this->decrement('stock', $quantity);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

}

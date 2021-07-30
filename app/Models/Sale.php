<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Client;
use App\Models\SaleDetail;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'user_id',
        'sale_date',
        'total',
        'status',
    ];

    public function my_store($request)
    {
        $sale = Sale::create($request ->all()+[
            'user_id' => Auth::user()->id,
            'sale_date' => Carbon::now('America/Guayaquil'),
        ]);

        $sale->add_sale_details($request);
    }
    
    public function update_stock($id, $quantity)
    {
        $product = Product::find($id);
        $product->subtrack_stock($quantity);
    }

    public function add_sale_details($request)
    {
        foreach($request->product_id as $key => $id)
        {
            $this->update_stock($request->product_id[$key], $request->quantity[$key]);
            $results[] = array("product_id" => $request->product_id[$key], 
                "quantity" => $request->quantity[$key],
                "price" => $request->price[$key]);
        }

        $this->saleDetails()->createMany($results);
    }

    //public function 

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }
}

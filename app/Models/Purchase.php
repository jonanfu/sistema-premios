<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Provider;
use App\Models\Product;
use App\Models\PurchaseDetail;


class Purchase extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'provider_id',
        'user_id',
        'purchase_date',
        'total',
        'status',
        'picture',
    ];

    public function update_stock($id, $quantity)
    {
        $product = Product::find($id);
        $product-add_stock($quantity); 
    }

    public function my_store($request)
    {
        $purchase = Purchase::create($request->all() + [
            'user_id' => Auth::user()->id,
            'purchase_date' => Carbon::now('America/Guayaquil')
        ]);

        $purchase->add_purchase_details($request);
    }

    public function add_purchase_details($request)
    {
        foreach($request->product_id as $key => $id)
        {
            $this->update_stock($request->product_id[$key], $request->quantity[$key]);
            $results[] = array("product_id" => $request->product_id[$key], 
                "quantity" => $request->quantity[$key],
                "price" => $request->price[$key]);
        }

        $this->purchaseDetails()->createMany($results);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetail::class);
    }

}

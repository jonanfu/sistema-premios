<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class SaleController extends Controller
{
    public function __contruct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = sale::get();
        return view('admin.sale.index',compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::get();
        $products = Product::where('status', 'ACTIVE')->get();
        return view('admin.sale.create', compact('clients', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Sale $sale)
    {
        //dd($sale);
        $client = Client::find($request->client_id);

        if($client->points >= $request->total ) {  

            $client->subtrack_points((int)$request->total);
            $sale->my_store($request);
            
            return redirect()->route('sales.index');
        } else {
            return redirect()->route('sales.index');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        $subtotal = 0;
        $saleDetails = $sale->SaleDetails;
        
        foreach($saleDetails as $saleDetail){
            $subtotal += $saleDetail->quantity * $saleDetail->price;
        }
        return view('admin.sale.show', compact('sale', 'saleDetails', 'subtotal'));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //$clients = Client::get();
        //$return view('admin.sale.edit', compact('sale));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //$sale->update($request->all());
        //return redirect()->route('sale.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //$sale->delete();
        //return redirect()->route('sales.index');
    }

    public function pdf(Sale $sale)
    {
        $subtotal = 0;
        $saleDetails = $sale->saleDetails;

        //dd($saleDetails);

        foreach($saleDetails as $saleDetail){
            $subtotal += $saleDetail->quantity * $saleDetail->price;
        }
      
        $pdf = PDF::loadview('admin.sale.pdf', compact('sale', 'subtotal', 'saleDetails'));
        return $pdf->download('reporte_de_venta_'.$sale->id.'.pdf');
    }

    public function print(Sale $sale)
    {
        try {
            $subtotal = 0;
            $saleDetails = $sale->saleDetails;
            foreach($saleDetails as $saleDetail){
                $subtotal += $saleDetail-> quantity * $saleDetail->price - $saleDetail->quantity * $saleDetail->price * $saleDetail -> discount /100;
            }

            $printer_name = 'TM20';
            $connector = new windowsPrintConnector($printer_name);
            $printer = new Printer($connector);

            $printer->text("9,95\n");

            $printer->cut();
            $printer->close();

            return redirect()->back();
        } catch (\Throwable $tn) {
            return redirect()->back();
        }
    }

    public function change_status(Sale $sale)
    {
        if($sale -> status == 'VALID'){
            $sale->update(['status' => 'CANCELED']);
            return redirect()->back();
        } else {
            $sale->update(['status' => 'CANCELED']);
            return redirect()->back();
        }
    }
}

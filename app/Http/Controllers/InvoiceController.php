<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(){

        $invoices = Invoice::with('customer')->orderBy('id', "DESC")->get();

        return response()->json([
            'invoices' => $invoices
        ], 200);
    }

    public function search_invoice(Request $request){

        $search_input = $request->get('s');

        if($search_input != null){
            $invoices = Invoice::with('customer')->where('id', 'LIKE', "%$search_input%")->get();

            return response()->json([
                'invoices' => $invoices
            ], 200);
        }else{

            return $this->index();
        }
    }


    public function create(){

        $counter = Counter::where('key', 'invoice')->first();

        $invoice = Invoice::orderBy('id', 'DESC')->first();

        if($invoice){
            $invoice = $invoice->id+1;
            $counters = $counter->value + $invoice;
        }else{
            $counters = $counter->value;
        }



        $formData = [
            'number' => $counter->prefix.$counters,
            'customer_id' => null,
            'customer' => null,
            'date' => date('Y-m-d'),
            'due_date' => null,
            'reference' => null,
            'discount' => 0,
            'terms_and_conditions' => "Default Terms and Conditions",
            'items' => [
                'product_id' => null,
                'profuct' => null,
                'unit_price' => 0,
                'qantity' => 0,
            ]
        ];


        return response()->json($formData);
    }


    public function store(Request $request){

        $invoice_items = $request->invoice_items;

        $invoice_data['sub_total']= $request->sub_total;
        $invoice_data['total']= $request->total;
        $invoice_data['customer_id']= $request->customer_id;
        $invoice_data['number']= $request->number;
        $invoice_data['date']= $request->date;
        $invoice_data['due_date']= $request->due_date;
        $invoice_data['discount']= $request->discount;
        $invoice_data['reference']= $request->reference;
        $invoice_data['terms_and_conditions']= $request->terms_and_conditions;



        $invoice = Invoice::create($invoice_data);


        foreach(json_decode($invoice_items) as $item){
            $itemData['product_id'] = $item->id;
            $itemData['invoice_id'] = $invoice->id;
            $itemData['quantity'] = $item->quantity;
            $itemData['unit_price'] = $item->unit_price;



            InvoiceItem::create($itemData);

        }

    }
}

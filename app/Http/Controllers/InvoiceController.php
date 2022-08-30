<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
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
}

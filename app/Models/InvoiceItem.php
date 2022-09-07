<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{


    protected $fillable = [
        'product_id', 'invoice_id', 'unit_price', 'quantity'
    ];



    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    use HasFactory;
}

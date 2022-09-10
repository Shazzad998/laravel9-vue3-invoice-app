<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceEditResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'customer' => new CustomerResource($this->customer),
            'date' => $this->date,
            'due_date' => $this->due_date,
            'total' => $this->total,
            'sub_total' => $this->sub_total,
            'discount' => $this->discount,
            'invoice_items' =>  InvoiceItemResource::collection($this->invoice_items),
            'created_at' => $this->created_at->toFormattedDateString(),
            'terms_and_conditions' => $this->terms_and_conditions,
            'reference' => $this->reference

        ];
    }
}

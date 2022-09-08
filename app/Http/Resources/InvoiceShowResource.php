<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceShowResource extends JsonResource
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
            'due_date' => Carbon::parse($this->due_date)->toFormattedDateString(),
            'total' => $this->total,
            'sub_total' => $this->sub_total,
            'discount' => $this->discount,
            'invoice_items' =>  InvoiceItemResource::collection($this->invoice_items),
            'created_at' => $this->created_at->toFormattedDateString()

        ];
    }
}

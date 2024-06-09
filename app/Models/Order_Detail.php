<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Detail extends Model
{
    use HasFactory;

    protected $table = 'order_details';

    protected $fillable = [
        'corder_id', 
        'product_id', 
        'unitprice', 
        'quantity', 
        'amount',
        'discount'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Products');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
}

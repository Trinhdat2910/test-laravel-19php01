<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';
    protected $fillable = ['quantity', 'price', 'order_id', 'product_detail_id', 'created_at', 'updated_at'];
    /**
     * Relation with model Orders
     *
     * @retun mix
     */
    public function order() {
        return $this->belongsTo('App\Models\Orders', 'order_id', 'id');
    }
    /**
     * Relation with model Status
     *
     * @retun mix
     */
    public function productdetail() {
        return $this->belongsTo('App\Models\ProductDetails', 'product_detail_id', 'id');
    }
}

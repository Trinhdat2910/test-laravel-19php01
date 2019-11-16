<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';
    protected $fillable = ['recipient', 'address', 'phone', 'tracking_number', 'status_id', 'user_id', 'payment_type', 'created_at', 'updated_at'];
    /**
     * Relation with model User
     *
     * @retun mix
     */
    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    /**
     * Relation with model Status
     *
     * @retun mix
     */
    public function status() {
        return $this->belongsTo('App\Models\Status', 'status_id', 'id');
    }
    /**
     * Relation with model transaction
     *
     * @retun mix
     */
    public function transaction() {
        return $this->hasMany('App\Models\Transaction', 'order_id', 'id');
    }
    /**
     * Relation with model orderdetails
     *
     * @retun mix
     */
    public function orderdetails() {
        return $this->hasMany('App\Models\OrderDetails', 'order_id', 'id');
    }
}

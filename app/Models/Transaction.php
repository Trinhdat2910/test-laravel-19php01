<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';
    protected $fillable = ['tittle', 'amount', 'warehousing_id', 'note', 'order_id', 'created_at', 'updated_at'];
    /**
     * Relation with model Orders
     *
     * @retun mix
     */
    public function order() {
        return $this->belongsTo('App\Models\Orders', 'order_id', 'id');
    }
    /**
     * Relation with model warehousing
     *
     * @retun mix
     */
    public function warehousing() {
        return $this->belongsTo('App\Models\Warehousing', 'warehousing_id', 'id');
    }
}

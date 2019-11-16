<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Warehousing extends Model
{
    protected $table = 'warehousing';
    protected const RETURN_NUM_ZERO = 0;
    protected const RETURN_NUM_ONE = 1;
    protected const RETURN_STR_ZERO = "0";
    protected const RETURN_STR_ONE = "1";
    protected const FALSE = "0";
    protected const TRUE = "1";
    
    protected $fillable = ['products_id', 'price', 'quantity', 'total', 'user_id', 'supplier_id', 'created_at', 'updated_at'];
    /**
     * Relation with model products
     *
     * @retun mix
     */
    public function products() {
        return $this->belongsTo('App\Models\Products', 'products_id', 'id');
    }
    /**
     * Relation with model users
     *
     * @retun mix
     */
    public function users() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    /**
     * Relation with model supplier
     *
     * @retun mix
     */
    public function supplier() {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id', 'id');
    }
    /**
     * Relation with model transaction
     *
     * @retun mix
     */
    public function transaction() {
        return $this->hasMany('App\Models\Transaction', 'warehousing_id', 'id');
    }
    public function getAllWarehouse() {
        $listWarehouse = $this->all();
        return $listWarehouse;
    }
    public function addNewWarehouse($request) {
        $newWarehouse = new Warehousing();
        $newWarehouse->size = $request->size;
        $newWarehouse->quantity = $request->quantity;
        $newWarehouse->price = $request->price;
        $newWarehouse->total = $request->price * $request->quantity;
        $newWarehouse->user_id = Auth::user()->id;
        $newWarehouse->products_id = $request->products;
        $newWarehouse->supplier_id = $request->supplier;
        $newWarehouse->approved = self::FALSE;
        $newWarehouse->created_at = Carbon::now();
        if(! $newWarehouse->save()){
            return self::RETURN_STR_ZERO;
        }
        return $newWarehouse;
    }
    public function getWarehouseById($id) {
        $listWarehouse = $this->find($id);
        return $listWarehouse;
    }
    public function updateWarehouse($request, $id) {
        $oWarehouse = $this->find($id);
        $oWarehouse->size = $request->size;
        $oWarehouse->quantity = $request->quantity;
        $oWarehouse->price = $request->price;
        $oWarehouse->total = $request->price * $request->quantity;
        $oWarehouse->user_id = Auth::user()->id;
        $oWarehouse->products_id = $request->products;
        $oWarehouse->supplier_id = $request->supplier;
        $oWarehouse->approved = self::FALSE;
        $oWarehouse->updated_at = Carbon::now();
        if(! $oWarehouse->save()){
            return self::RETURN_STR_ZERO;
        }
        return $oWarehouse;
    }
    public function deleteWarehouse($id) {
        $oWarehouse = $this->find($id);
        if(! $oWarehouse->destroy($id)){
            return self::RETURN_STR_ZERO;
        }
        return $oWarehouse;
    }
}

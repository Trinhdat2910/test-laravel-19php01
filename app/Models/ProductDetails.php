<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    protected $table = 'product_details';
    protected $fillable = ['quantity', 'size', 'product_id', 'created_at', 'updated_at'];
    protected const RETURN_STR_ZERO = "0";
    protected const RETURN_STR_ONE = "1";
    /**
     * Relation with model Orders
     *
     * @retun mix
     */
    public function orderdetail() {
        return $this->hasMany('App\Models\Orders', 'product_detail_id', 'id');
    }
    /**
     * Relation with model Status
     *
     * @retun mix
     */
    public function product() {
        return $this->belongsTo('App\Models\Products', 'product_id', 'id');
    }
    public function getProductDetailById($id) {
        $listProductDetail = $this->where('products_id', $id)->get();
        if(empty($listProductDetail)){
            return self::RETURN_STR_ZERO;
        }
        return $listProductDetail;
    }
    public function addNewProductDetails($request) {
        $newProductDetails = new ProductDetails();
        $newProductDetails->size = $request->size;
        $newProductDetails->quantity = $request->quantity;
        $newProductDetails->products_id = $request->products_id;
        if(! $newProductDetails->save()){
            return self::RETURN_STR_ZERO;
        }
        return $newProductDetails;
    }
}

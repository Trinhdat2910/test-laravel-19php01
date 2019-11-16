<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Products extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'image', 'product_type_id', 'description', 'status', 'price', 'created_at', 'updated_at'];
    protected const RETURN_NUM_ZERO = 0;
    protected const RETURN_NUM_ONE = 1;
    protected const DEFAULT_STATUS = "0";
    protected const RETURN_STR_ZERO = "0";
    protected const RETURN_STR_ONE = "1";
    /**
     * Relation with model producttype
     *
     * @retun mix
     */
    public function producttype() {
        return $this->belongsTo('App\Models\ProductType', 'product_type_id', 'id');
    }
    /**
     * Relation with model warehousing
     *
     * @retun mix
     */
    public function warehousing() {
        return $this->hasMany('App\Models\Warehousing', 'product_id', 'id');
    }
    /**
     * Relation with model productdetails
     *
     * @retun mix
     */
    public function productdetails() {
        return $this->hasMany('App\Models\ProductDetails', 'product_id', 'id');
    }
    /**
     * Add a new product
     * @param $name
     *
     * @return  collection
     */
    public function addNewProduct($request) {
        $newProduct = new Products();
        $newProduct->name = $request->name;
        $newProduct->description = $request->description;
        $newProduct->price = $request->price;
        $newProduct->product_type_id = $request->products_type;
        $newProduct->status = self::DEFAULT_STATUS;
        $newProduct->created_at = Carbon::now();
        if($request -> hasFile('image'))
            {
                $file = $request->file('image');
                $name = $file -> getClientOriginalName();
                $Hinh = str_random(4)."_".$name;
                while(file_exists('upload/products'.$Hinh))
                {
                    $Hinh = str_random(4)."_".$name;
                }
                $file->move("upload/products", $Hinh);
                $newProduct ->image= "upload/products/".$Hinh;
            }
            else
            {
                $newProduct ->image="";
            }
        if(!$newProduct->save()){
            return self::RETURN_STR_ZERO;
        }
        return $newProduct;
    }
    public function getAllProducts() {
        $listProducts = $this->all();
        return $listProducts;
    }
    public function deleteProducts($id) {
        $oProduct = $this->find($id);
        if(! $oProduct->destroy($id)){
            return self::RETURN_STR_ZERO;
        }
        return $oProduct;
    }
    public function getProductById($id) {
        $oProduct = $this->find($id);
        return $oProduct;
    }
    public function updateProduct($request, $id) {
        $oProduct = $this->find($id);
        $oProduct->name = $request->name;
        $oProduct->description = $request->description;
        $oProduct->price = $request->price;
        $oProduct->product_type_id = $request->products_type;
        $oProduct->status = $request->status;
        if($request -> hasFile('image'))
        {
            $file = $request->file('image');
            $name = $file -> getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while(file_exists('upload/products'.$Hinh))
            {
                $Hinh = str_random(4)."_".$name;
            }
            $file->move("upload/products", $Hinh);
            $oProduct ->image= "upload/products/".$Hinh;
        }
        $oProduct->updated_at = Carbon::now();
        if(! $oProduct->save()){
            return self::RETURN_STR_ZERO;
        }
        return $oProduct;
    }
}

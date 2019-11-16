<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = 'products_type';
    protected $fillable = ['name', 'created_at', 'updated_at'];
    /**
     * Relation with model producttype
     *
     * @retun mix
     */
    public function producttype() {
        return $this->hasMany('App\Models\ProductType', 'product_type_id', 'id');
    }
    public function getAllProductsType() {
        $listProductsType = $this->all();
        return $listProductsType;
    }
}

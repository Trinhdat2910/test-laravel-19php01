<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Supplier extends Model
{
    protected $table = 'supplier';
    protected $fillable = ['name', 'phone', 'address', 'created_at', 'updated_at'];
    protected const RETURN_NUM_ZERO = 0;
    protected const RETURN_NUM_ONE = 1;
    protected const RETURN_STR_ZERO = "0";
    protected const RETURN_STR_ONE = "1";
    /**
     * Relation with model warehousing
     *
     * @retun mix
     */
    public function warehousing() {
        return $this->hasMany('App\Models\Warehousing', 'supplier_id', 'id');
    }

    public function getAllSupplier() {
        $listSupplier = $this->all();
        return $listSupplier;
    }

    public function addNewSupplier($request) {
        $newSupplier = new Supplier();
        $newSupplier->name = $request->name;
        $newSupplier->phone_number = $request->phone;
        $newSupplier->address = $request->address;
        $newSupplier->created_at = Carbon::now();
        if(! $newSupplier->save()){
            return self::RETURN_STR_ZERO;
        }
        return $newSupplier;
    }
    public function getSupplierById($id) {
        $oSupplier = $this->find($id);
        return $oSupplier;
    }
    public function updateSupplier($request, $id) {
        $oSupplier = $this->find($id);
        $oSupplier->name = $request->name;
        $oSupplier->phone_number = $request->phone;
        $oSupplier->address = $request->address;
        $oSupplier->updated_at = Carbon::now();
        if(! $oSupplier->save()){
            return self::RETURN_STR_ZERO;
        }
        return $oSupplier;
    }
    public function deleteSupplier($id) {
        $oSupplier = $this->find($id);
        if(! $oSupplier->destroy($id)){
            return self::RETURN_STR_ZERO;
        }
        return $oSupplier;
    }
    
}

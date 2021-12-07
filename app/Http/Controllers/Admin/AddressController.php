<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AddressServices;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function getProvinceAction(AddressServices $addressServices){
        $provinces = $addressServices->getAllState();
        return $provinces;
    }

    public function getCityAction(AddressServices $addressServices, $code){
        $exCode = explode('-', $code);
        $cities = [];
        if(count($exCode) === 2){
            $cities = $addressServices->getCityByState(['NP',$exCode[1]]);
        }
        return $cities;
    }
}

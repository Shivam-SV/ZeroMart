<?php

use Illuminate\Contracts\Encryption\DecryptException;

function normalizeId($id){
    if(is_null($id) || is_numeric($id)) return $id;

    try{
        if(is_string($id)) $id = decrypt($id);
    }catch(DecryptException $th){}

    return $id;
}

function generateOtp(){
    return random_int(111111, 999999);
}

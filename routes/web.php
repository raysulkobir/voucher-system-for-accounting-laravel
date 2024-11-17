<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {

    $result = DB::table('enquiry_sources')->get();


    foreach($result as $data){
        DB::table('enquiry_sources')->insert([
            'name' => $data->name,
            'parent_id' => $data->parent_id,
            'status' => $data->status,
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    return "ok";
});




<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Department extends model {


    public static function Add($data){

            $departments =  DB::table('departments')->insert(
                ["department_name"=> $data['department_name'],
                "status"=> $data['status']]
            );

      return $departments; 

    }


    public static function list(){

        $departments = DB::table('departments')->paginate(15);

        return $departments; 

   }

   public static function getDepartmentNameById($id){

        $dpet = DB::table('departments')
            ->select('department_name')
            ->where('department_id', '=', $id)
            ->get()
            ->toArray();
            
        return $dpet[0]->department_name;
   }

}

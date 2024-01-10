<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;



class EmployeesController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function list()
    {
         $data = array();
         
         $data['employees'] = User::all();

         return view('admin.employee_list',$data);
    }


}

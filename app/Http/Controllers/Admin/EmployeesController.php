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

    public function delete(Request $request) {

        $request->validate([
            'user_id' => ['required']
        ]);
    
         $projects =  User::deleteUserById($request->user_id);
  
         if($projects) {
         return redirect('/listemployees')->with('message', 'Successfully Deleted');
         } else {
         return redirect('/listemployees')->with('message', 'Employee Cannot be Deleted !');   
         }
        
    }


}

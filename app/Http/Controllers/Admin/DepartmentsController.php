<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;



class DepartmentsController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
         $data = array();
         return view('admin.department',$data);
    }

    public function list()
    {


        $data = array();
        $data['departments'] =  Department::list($data);
        return view('admin.department_list',$data);

        
    }

    public function save(Request $request)
    {
        $data = array();
        $request->validate([
            'department_name' => ['required', 'string', 'max:255'],
            'status' => ['required']
        ]);
        
         $data = [
            'department_name' => $request->department_name,
            'status' => $request->status
         ];

         $departments =  Department::Add($data);

         return redirect('/listdepartment')->with('message', 'Successfully inserted');

    }
   

    public function delete(Request $request) {

        $request->validate([
            'department_id' => ['required']
        ]);
    
         $departments =  Department::deleteDepartmentNameById($request->department_id);

         if($departments) {
         return redirect('/listdepartment')->with('message', 'Successfully Deleted');
         } else {
         return redirect('/listdepartment')->with('message', 'Department is Mapped with Project Cannot be Deleted !');   
         }
        
    }



}

?>
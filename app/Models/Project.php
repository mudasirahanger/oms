<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Project extends model
{


    public static function Add($data)
    {

        //  dd($data);

        $client_data = [
            'client_name' => $data['client_name'],
            'client_mobile' => $data['client_mobile'],
            'client_email' => $data['client_email'],
            'client_address' => $data['client_address']
        ];
        if(!empty($data['client_mobile'])) {
          $client_id =  Project::addClient($client_data);
        } else {
          $client_id = '0';
        }

        $projectId = DB::table('projects')->insertGetId([
            'project_name' => $data['project_name'],
            'project_status' => $data['project_status'],
            'project_desc' => $data['project_desc'],
            'task_id' => $data['task_id'],
            'client_id' => $client_id,
            'user_id' =>  $data['user_id'],
            'project_file' => '',
            'project_cost' => $data['project_cost'],
            'project_priority' => $data['project_priority'],
            'project_start_date' => $data['project_start_date'],
            'project_end_date' => $data['project_end_date'],
            'created_at' => now(),
            'updated_at' => now()
        ]);
        if ($projectId) {
            return array('task_id' => $data['task_id'], 'project_id' => $projectId);
        }
    }

    public static function AddProjectTypeToProjects($project_types,$projects_id)
    {

        foreach($project_types as $project_type) {
            DB::table('project_type_to_projects')->insert([
                'project_type_id' => $project_type,
                'projects_id' => $projects_id,
            ]);
        }
    
    }

    public static function AddDepartmentsToProjects($department_ids,$projects_id)
    {

        foreach($department_ids as $department_id) {
            DB::table('departments_to_projects')->insert([
                'department_ids' => $department_id,
                'projects_id' => $projects_id,
            ]);
        }
    
    }

    public static function AddEmployeesToProjects($employee_ids,$projects_id)
    {

        foreach($employee_ids as $employee_id) {
            DB::table('employees_to_projects')->insert([
                'employee_ids' => $employee_id,
                'projects_id' => $projects_id,
            ]);
        }
    
    }
    

    public static function UpdateProject($data) {

        // DB::table('projects')
        //     ->where('project_id', $data['project_id'])  // find your user by their email
        //     ->limit(1)  // optional - to ensure only one record is updated.
        //     ->update(array('project_status' => $data['project_status']));

        DB::table('projects_history')->insert([
                'comments' => $data['comments'],
                'project_id' => $data['project_id'],
                'task_id' => $data['task_id'],
                'user_id' => $data['user_id'],
                'project_status' => $data['project_status'],
                'updated_at' => now(),
            ]);
       return true;
    } 

    public static function addClient($data)
    {

        $client_id = DB::table('client')->insertGetId($data);

        return $client_id;
    }


    public static function getdepartments()
    {

        $departments = DB::table('departments')
            ->where('status', '=', 1)
            ->get()
            ->toArray();

        return $departments;
    }


    public static function getProjectsType()
    {

        $project_type = DB::table('project_type')
            ->where('status', '=', 1)
            ->get()
            ->toArray();

        return $project_type;
    }


    public static function getEmployess()
    {

        $employee = DB::table('users')
            ->where('role_id', '!=', '1')
            ->get()
            ->toArray();

        return $employee;
    }


    public static function getProjectStatus()
    {
        $status = DB::table('project_status')
            ->get()
            ->toArray();
        return $status;
    }

    public static function getProjectStatusById($id)
    {
        $status = DB::table('project_status')
            ->where('status_id', '=', $id)
            ->get()
            ->toArray();
            if(!empty($status[0]->status_name)){
                return $status[0]->status_name;
                }
                    return false;
    }

    public static function getProjects()
    {
        $projects = DB::table('projects')
            ->orderByDesc('project_id')
            ->paginate(15);

        return $projects;
    }


    public static function getProjectsByID($id)
    {
        $projects = DB::table('projects')
                ->where('task_id', '=', $id)
                ->get()
                ->toArray();
            if(!empty($projects[0])){
            return $projects[0];
            }
                return false;
    }
   

    public static function getProjectsByEmpID($id)
    {
       $empid = (int)$id;
       $emp_id = DB::table('employees_to_projects')
                            ->select('projects_id')
                            ->where('employee_ids', '=', $empid)
                            ->get()
                            ->toArray();

        for($i=0;$i<count($emp_id);$i++) {
            $projects = DB::table('projects')
                ->where('project_id', '=', $emp_id[$i]->projects_id)
                ->paginate(15); 
        }
        return $projects ?? '';
    }



    public static function getClientsByID($id)
    {
        $client = DB::table('client')
                ->where('client_id', '=', $id)
                ->get()
                ->toArray();
                if(!empty($client[0])){
                    return $client[0];
                    }
                return false;
    }


    public static function getEmployeeByProjectID($project_id)
    {
        $emp_id = DB::table('employees_to_projects')
                            ->select('employee_ids')
                            ->where('projects_id', '=', $project_id)
                            ->get()
                            ->toArray();
        for($i=0;$i<count($emp_id);$i++) {
            $users = DB::table('users')
                ->select('name')
                ->where('id', '=', $emp_id[$i]->employee_ids)
                ->get()
                ->toArray();
                
            if ($i == 1) {
                echo  $emps = '<span class="label label-info">' .  $users[0]->name . ' </span>';
            } else {
                echo  $emps = '<span class="label label-default">' .  $users[0]->name . ' </span>';
            }
         }

    }

    public static function getDepartmentsByProjectID($project_id)
    {
        $dept_id = DB::table('departments_to_projects')
                            ->select('department_ids')
                            ->where('projects_id', '=', $project_id)
                            ->get()
                            ->toArray();

        for($i=0;$i<count($dept_id);$i++) {
            $users = DB::table('departments')
                ->select('department_name')
                ->where('department_id', '=', $dept_id[$i]->department_ids)
                ->get()
                ->toArray();
                
            if ($i == 1) {
                echo  $emps = '<span class="label label-info">' .  $users[0]->department_name . ' </span>';
            } else {
                echo  $emps = '<span class="label label-default">' .  $users[0]->department_name . ' </span>';
            }
         }

    }

    public static function getProjectTypeByProjectID($project_id)
    {
        $projt_id = DB::table('project_type_to_projects')
                            ->select('project_type_id')
                            ->where('projects_id', '=', $project_id)
                            ->get()
                            ->toArray();

        for($i=0;$i<count($projt_id);$i++) {
            $users = DB::table('project_type')
                ->select('name')
                ->where('project_type_id', '=', $projt_id[$i]->project_type_id)
                ->get()
                ->toArray();
                
            if ($i == 1) {
                echo  $emps = '<span class="label label-info">' .  $users[0]->name . ' </span>';
            } else {
                echo  $emps = '<span class="label label-default">' .  $users[0]->name . ' </span>';
            }
         }

    }
   

    public static function getEmployeeByEmpID($id)
    {
            $emp = DB::table('users')
                ->where('id', '=', $id)
                ->get()
                ->toArray();     
           
                if(!empty($emp[0])){
                    return $emp[0];
                    }
                return false;
    }

    public static function getEmployeeNameByEmpID($id)
    {
            $emp = DB::table('users')
                ->where('id', '=', $id)
                ->get()
                ->toArray();     
                if(!empty($emp[0]->name)){
                    return $emp[0]->name;
                    }
                return false;
    }

    public static function getTotalCounts($table) {

      return $projectCount = DB::table($table)->count();

    }

    public static function getHistory($project_id) {
   
         $histry =  DB::table('projects_history')
                 ->where('project_id', '=', $project_id)
                 ->orderByDesc('updated_at')
                 ->get()
                 ->toArray();
        if(!empty($histry)) {
            return $histry;
        } else {
            return false;
        }
    }
    
    public static function getHistoryLatestStatus($project_id) {
        $histry =  DB::table('projects_history')
                ->where('project_id', '=', $project_id)
                ->orderByDesc('updated_at')
                ->get()
                ->toArray();
       if(!empty($histry[0])) {
           return !empty(Project::getProjectStatusById($histry[0]->project_status)) ? Project::getProjectStatusById($histry[0]->project_status) : '';
       } else {
           return false;
       }
   }

   public static function getHistoryLatestEmployee($project_id) {
   
    $histry =  DB::table('projects_history')
            ->where('project_id', '=', $project_id)
            ->orderByDesc('updated_at')
            ->get()
            ->toArray();
   if(!empty($histry[0])) {
       return !empty(Project::getEmployeeNameByEmpID($histry[0]->user_id)) ? Project::getEmployeeNameByEmpID($histry[0]->user_id) : '';
   } else {
       return false;
   }
}


    public static function getClients()
    {
                $client = DB::table('client')
                ->orderByDesc('client_id')
                ->paginate(15);

        return $client;
    }


    public static function deleteClientById($id) {

        $client = DB::table('client')->where('client_id', $id)->delete();

        if($client){
            return true;
            } else {
            return false;
            }
    }

    public static function deleteProjectById($id){
        $project = DB::table('projects')->where('project_id', $id)->delete();
        $projecttotype = DB::table('project_type_to_projects')->where('projects_id', $id)->delete();
        $projecttohist = DB::table('projects_history')->where('project_id', $id)->delete();
       //  $projecttolog = DB::table('project_log')->where('project_id', $id)->delete();
        $projecttodept = DB::table('departments_to_projects')->where('projects_id', $id)->delete();
        $projecttoemp = DB::table('employees_to_projects')->where('projects_id', $id)->delete();

        if($project){
          return true;
        } else {
          return false;
        }
    }

}

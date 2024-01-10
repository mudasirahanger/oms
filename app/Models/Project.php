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

        $client_id =  Project::addClient($client_data);

        $project = DB::table('projects')->insertGetId([
            'project_name' => $data['project_name'],
            'project_status' => $data['project_status'],
            'project_desc' => $data['project_desc'],
            'task_id' => $data['task_id'],
            'client_id' => $client_id,
            'user_id' =>  $data['user_id'],
            'project_file' => '',
            'project_cost' => $data['project_cost'],
            'project_type' => $data['project_type'],
            'department_ids' => $data['department_ids'],
            'employee_ids' => $data['employee_ids'],
            'project_start_date' => $data['project_start_date'],
            'project_end_date' => $data['project_end_date'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        if ($project) {
            return $data['task_id'];
        }
    }


    public static function UpdateProject($data) {

        DB::table('projects')
            ->where('project_id', $data['project_id'])  // find your user by their email
            ->limit(1)  // optional - to ensure only one record is updated.
            ->update(array('project_status' => $data['project_status']));

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
            ->where('role_id', '!=', 1)
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
        return $status[0]->status_name;
    }

    public static function getProjects()
    {
        $projects = DB::table('projects')
            ->paginate(15);

        return $projects;
    }


    public static function getProjectsByID($id)
    {
        $projects = DB::table('projects')
                ->where('task_id', '=', $id)
                ->get()
                ->toArray();
        return $projects[0];
    }
   

    public static function getProjectsByEmpID($id)
    {
       $jsonid = (string)$id;
        $projects = DB::table('projects')     
           ->whereJsonContains('employee_ids',[$jsonid])
           ->paginate(15); 
        return $projects;
    }



    public static function getClientsByID($id)
    {
        $client = DB::table('client')
                ->where('client_id', '=', $id)
                ->get()
                ->toArray();
        return $client[0];
    }


    public static function getEmployeeByID($ids)
    {

        $emp_id = json_decode($ids, true);
        $emps = '';
        $i = 1;
        foreach ($emp_id as $id) {
            $status = DB::table('users')
                ->select('name')
                ->where('id', '=', $id)
                ->get()
                ->toArray();
                
            if ($i == 1) {
                echo  $emps = '<span class="label label-info">' .  $status[0]->name . ' </span>';
            } else {
                echo  $emps = '<span class="label label-default">' .  $status[0]->name . ' </span>';
            }
            $i++;
        }
        //   return $emps;
    }

    public static function getEmployeeByEmpID($id)
    {
            $emp = DB::table('users')
                ->where('id', '=', $id)
                ->get()
                ->toArray();     
         return $emp[0];
    }

    public static function getTotalCounts($table) {

      return $projectCount = DB::table($table)->count();

    }

    public static function getHistory($project_id) {
   
         return DB::table('projects_history')
                 ->where('project_id', '=', $project_id)
                 ->get()
                 ->toArray();

    }



    public static function getClients()
    {
                $client = DB::table('client')
                ->paginate(15);

        return $client;
    }
}

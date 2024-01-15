<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
     
         $data = [];
         $data['departments'] =  Project::getdepartments();
         $data['projectstypes'] = Project::getProjectsType();
         $data['employees'] = Project::getEmployess();
         $data['status_ids'] = Project::getProjectStatus();
  
        return view('pages.project',$data);
    }

    public function list()
    {
        $data = [];
        $data['projects'] = Project::getProjects();
        return view('pages.projectlist',$data);
    }

    public function save(Request $request)
    {
        $taskId = random_int(1000000000, 9999999999);
       
         $request->validate([
            'project_name' => ['required', 'string', 'max:255'],
            'client_email' => ['required', 'string', 'email', 'max:255'],
            'client_mobile' => ['required', 'string'],
            'client_name' => ['required', 'string'],
            'client_address' => ['required', 'string'],
            'project_end_date' => ['required'],
            'project_start_date' => ['required'],
            'project_status' => ['required'],
            'project_priority' => ['required']
        ]);
        
          $data = [
            'project_name' => $request->project_name,
            'project_status' => $request->project_status,
            'project_desc' => $request->project_desc,
            'project_file' => '',
            'client_mobile' => $request->client_mobile,
            'client_email' => $request->project_name,
            'client_name' => $request->client_name,
            'client_address' => $request->client_address,
            'project_cost' => $request->project_cost,
            'task_id' => $taskId,
            'user_id' =>  Auth::user()->id,
           // 'project_type' => $request->project_type,
           // 'department_ids' => $request->department_ids,
           // 'employee_ids' => $request->employee_ids,
            'project_desc' => $request->project_desc,
            'project_priority' => $request->project_priority,
            'project_end_date' => Carbon::parse($request->project_end_date)->format('Y-m-d'),
            'project_start_date' => Carbon::parse($request->project_start_date)->format('Y-m-d'),
         ];

          $projects =  Project::Add($data);
          
          Project::AddProjectTypeToProjects($request->project_types,$projects['project_id']);
          Project::AddDepartmentsToProjects($request->department_ids,$projects['project_id']);
          Project::AddEmployeesToProjects($request->employee_ids,$projects['project_id']);

          $this->notify($data,'add');
          return redirect('/addproject')->with('message', 'Project Added Successfully ! #'.$projects['task_id']);

    }
    

    public function update(Request $request) {

      $request->validate([
        'project_id' => ['required', 'string'],
        'task_id' => ['required', 'string',],
        'project_status' => ['required'],
        'project_comment' => ['required']
       ]);

       $data = [
         'comments' => $request->project_comment,
         'project_id' => $request->project_id,
         'task_id' => $request->task_id,
         'project_status' => $request->project_status,
         'user_id' => $request->user_id,
        ];


       Project::UpdateProject($data);
       $project_path = '/viewproject/' . $data['task_id'];
       $this->notify($data,'update');
       return redirect($project_path)->with('message', 'Project Updated Successfully ! #'. $data['task_id']);


    }

    
    public function view(Request $request) {
        $data = [];
      if(isset($request->id)  && !empty($request->id)) {
        $taskId = $request->id;
        $project = Project::getProjectsByID($taskId);   
        $client = Project::getClientsByID($project->client_id);
        $data['status_ids'] = Project::getProjectStatus();
        $data['project'] = $project;
        $data['client'] = $client;
        $data['user_id'] = Auth::user()->id;
        return view('pages.projectview',$data);
      } else {
        abort('404');
      }


    }


    public function adminCounts() {

        $data = [];
        $data['projects_count'] = '0'; //(int)Project::getTotalCounts('projects');
        $data['employee_count'] = '0';//(int)Project::getTotalCounts('users');
        $data['clients_count'] = '0';//(int)Project::getTotalCounts('client');
        return view('admin.counts',$data);
    }

   
    public function history($project_id) {
      $data = [];
      $data['project_history'] = Project::getHistory($project_id);
      return view('pages.projecthistory',$data);
    }

    public function employeeProjectList() {

      $data = [];       
      $data['user_id'] = Auth::user()->id;
      $data['projects'] = Project::getProjectsByEmpID($data['user_id']);
      return view('employee.projectlist',$data);
    }


    public function clientList() {

      $data = [];
      $data['clients'] = Project::getClients();
      return view('pages.clientlist',$data);

    }


    private function notify($data,$type) {
        $textmsg = array();
  		$curl = curl_init();

  		$textmsg['chat_id'] = '-1002092007860';

       
      if($type == 'add') {
        $msgFull = "<b> Hello Update !!</b> \n";
        $msgFull .= "Project Added Successfully ! #Task ID ". $data['task_id'] ." \n";
        $msgFull .= "Project Name : ". $data['project_name'] ." \n";
        $msgFull .= "Client Name : ". $data['client_name'] ." \n";
        $msgFull .= "Employee IDs:  \n";
        $msgFull .= "End Date ". $data['project_end_date'] ." \n";
      } else {
        $msgFull = "<b> Hello Update !!</b> \n";
        $msgFull .= "Project Update Successfully ! #Task ID ". $data['task_id'] ." \n";
        $msgFull .= "Employee IDs:  \n";
      }  


        $textmsg['text'] = $msgFull;
        $textmsg['parse_mode'] = 'HTML';


		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://api.telegram.org/bot6226955931:AAHlsbGXPGWyEik3pUG_QgR54lnZJg7M6NU/sendMessage',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => json_encode($textmsg),
		  CURLOPT_HTTPHEADER => array(
		     'Content-Type: application/json'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		//echo $response['ok'];

  }





}

?>
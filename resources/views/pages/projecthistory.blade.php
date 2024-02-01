@if(!empty($project_history))
<h2 class="card-inside-title">Project History</h2>
<table class="table table-striped">
  <tr>
   <th>Dated</th> 
   <th>Comments</th>
   <th>Status</th>
   <th>Employee</th> 
  </tr>
<tbody>
    @foreach($project_history as $history)
    <tr>
      <td>{{ $history->updated_at  }}</td>
      <td>{{ $history->comments  }}</td> 
      <td> {{ \App\Models\Project::getProjectStatusById($history->project_status)  }}  </td>
      <td> {{ \App\Models\Project::getEmployeeNameByEmpID($history->user_id)  }} </td>
    </tr>
    @endforeach
</tbody>
</table>
@endif
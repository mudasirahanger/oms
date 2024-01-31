@include('components/header')
@include('components/topmenu')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>/Project List</h2>
        </div>


 
        <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>PROJECTS</h2>
                        </div>
                        <div class="body">
                            @if (session('message'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                {{ session('message') }}</div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#Task ID</th>
                                            <th>Project Name</th>
                                            <th>Status</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @if($projects)
                                      @foreach($projects as $project)
                                        <tr>
                                            <td>{{ $project->task_id }}</td>
                                            <td>{{ $project->project_name }}</td>
                                            <td><span class="label bg-green"> {{ \App\Models\Project::getProjectStatusById($project->project_status)  }}  </span></td>
                                            <td>{{ \Carbon\Carbon::parse($project->project_start_date)->format('d/m/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($project->project_end_date)->format('d/m/Y') }}</td>
                                            <td><a href="{{ url('/viewproject') }}/{{ $project->task_id }}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                    <i class="material-icons">search</i>
                                    </button> </a></td>
                                    <td>
                                        @if(Auth::user()->role_id == 1)
                                    <form action="{{ url('/delproject') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="project_id" value="{{ $project->project_id }}">
                                       <button type="submit" class="btn btn-danger"><i class="material-icons">delete</i> </button>
                                        </form>
                                        @endif
                                        </td>
                                        </tr>
                                        @endforeach
                                        @else 
                                        <tr>
                                            <td></td>
                                            <td>/td>
                                            <td></td>
                                            <td>No Records</td>
                                            <td></td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                
                                {{ $projects->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
               
                          
              
              </div>

    </div>
</section>

@include('components/footer')

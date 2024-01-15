 
        <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>PROJECTS</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#Task ID</th>
                                            <th>Project Name</th>
                                            <th>Status</th>
                                            <th>End Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @if($projects)
                                      @foreach($projects as $project)
                                        <tr>
                                            <td>{{ $project->task_id }}</td>
                                            <td>{{ $project->project_name }}</td>
                                            <td><span class="label bg-green"> {{ \App\Models\Project::getProjectStatusById($project->project_status)  }}  </span></td>
                                            <td>{{ \Carbon\Carbon::parse($project->project_end_date)->format('d/m/Y') }}</td>
                                            <td><a href="{{ url('/viewproject') }}/{{ $project->task_id }}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                    <i class="material-icons">search</i>
                                </button></td>
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
                                @if($projects)
                                        {{ $projects->links() }}
                                        @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
               
                          
              
              </div>

    </div>

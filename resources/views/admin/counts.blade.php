
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="{{ url('/listproject') }}">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">NEW PROJECTS</div>
                            <div class="number count-to" data-from="0" data-to="{{ $projects_count }}" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">help</i>
                        </div>
                        <div class="content">
                            <div class="text">COMPLTED PROJECTS</div>
                            <div class="number count-to" data-from="0" data-to="0" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="{{ url('/listemployees') }}">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL EMPLOYEES</div>
                            <div class="number count-to" data-from="0" data-to="{{ $employee_count }}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                  </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="{{ url('/listclients') }}">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL CLIENTS</div>
                            <div class="number count-to" data-from="0" data-to="{{ $clients_count }}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            <!-- #END# Widgets -->
            

            <div class="row clearfix">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>TASK INFOS</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Task</th>
                                            <th>Main Project Status</th>
                                            <th>Employee Status</th>
                                            <th>Employee Working</th>
                                            <th>Progress</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($projects)
                                    @foreach($projects as $project)
                                        <tr>
                                            <td> <a href="{{ url('/viewproject') }}/{{ $project->task_id }}"> #{{ $project->task_id }} </a></td>
                                            <td>{{ $project->project_name }} </td>
                                            <td><span class="label bg-green"> {{ \App\Models\Project::getProjectStatusById($project->project_status)  }}  </span></td>
                                            <td><span class="label bg-yellow">{{ \App\Models\Project::getHistoryLatestStatus($project->project_id)  }} </span>  </td>
                                            <td><span class="label bg-blue">{{ \App\Models\Project::getHistoryLatestEmployee($project->project_id)  }} </span></td>
                                          
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    {{ $projects->links() }}
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
</div>

 

        </div>
    </section>
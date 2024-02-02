@include('components/header')
@include('components/topmenu')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>/Add Project</h2>
        </div>

        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            PROJECT
                            <small>Enter Complete Project Details </small>
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('updateproject') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                            @endforeach
                            @endif
                            @if (session('message'))
                            <div class="alert alert-success">{{ session('message') }}</div>
                            @endif
                            <h2 class="card-inside-title">Project Name</h2>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line disabled">
                                            <input type="text" name="project_name"  placeholder="{{ $project->project_name }}"  class="form-control" disabled/>
                                            <input type="hidden" name="project_id"  value="{{ $project->project_id  }}" />
                                            <input type="hidden" name="task_id"  value="{{ $project->task_id  }}" />
                                            <input type="hidden" name="user_id"  value="{{ $user_id  }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2 class="card-inside-title">Project Details</h2>
                            <div class="row clearfix">
                            <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line disabled">
                                            <textarea rows="4"  name="project_desc" class="form-control no-resize" placeholder="{{ $project->project_desc }}" disabled></textarea>
                                        </div>
                                    </div>
                            </div>
                            </div>
                            @if($user_id == 1) 
                            @if(!empty($client))
                            <h2 class="card-inside-title">Client Details</h2>
                            <div class="row clearfix">
                                <div class="col-sm-12">

                                    <div class="form-group">
                                        <div class="form-line disabled">
                                            <input class="form-control" type="text" name="client_mobile"  placeholder="{{ $client->client_mobile }}"  disabled>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-line disabled">
                                            <input class="form-control" type="text" name="client_email" placeholder="{{ $client->client_email }}"  disabled>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-line disabled">
                                            <input class="form-control" type="text" name="client_name" placeholder="{{ $client->client_name }}"    disabled>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-line disabled">
                                            <input class="form-control" type="text" name="client_address" placeholder="{{ $client->client_address }}"    disabled>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line disabled">
                                            <input type="text" class="form-control" name="project_cost" placeholder="{{ $project->project_cost }}"    disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             @endif
                             @endif
                             <h2 class="card-inside-title">Team Details</h2>
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <p>
                                        Select Work Type
                                    </p>
                                    {{ \App\Models\Project::getProjectTypeByProjectID($project->project_id); }}
                                </div>
                                <div class="col-md-3">
                                    <p>
                                        Select Departments
                                    </p>
                                    {{ \App\Models\Project::getDepartmentsByProjectID($project->project_id); }}
                                </div>
                                <div class="col-md-3">
                                    <p>
                                        Select Employees
                                    </p>                                   
                                    {{ \App\Models\Project::getEmployeeByProjectID($project->project_id); }}
                                </div>
                            </div>                            
                            <div class="row clearfix">
                            <div class="col-xs-3">
                                    <h2 class="card-inside-title">Project Start Date</h2>
                                    <div class="form-group">
                                        <div class="form-line disabled">
                                            <input type="text" class="form-control" name="project_start_date" placeholder="{{ $project->project_start_date }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <h2 class="card-inside-title">Project Delivery Date</h2>
                                    <div class="form-group">
                                        <div class="form-line disabled">
                                            <input type="text" class="form-control" name="project_end_date" placeholder="{{ $project->project_end_date }}" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-3">
                                    <h2 class="card-inside-title">Project Priority </h2>
                                    <div class="form-group">
                                        <div class="form-line disabled">
                                            <input type="text" class="form-control" name="project_priority" placeholder="{{ $project->project_priority }}" disabled>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            {{ App\Http\Controllers\Pages\ProjectsController::history($project->project_id); }}

                            <div class="row clearfix">
                            <div class="col-xs-3">
                            <p>
                                <b>Main Project Status</b>
                                    </p>
                                    @foreach($status_ids as $status)
                                    @if($status->status_id  == $project->project_status)
                                    <p>
                                    <span class="label label-success">{{ $status->status_name }}  </span> </p>
                                    @endif
                                   @endforeach
                                </div>
                                <div class="col-xs-3">
                                    <p>
                                        <b>Your Project Status</b>
                                            </p>
                                            <select name="project_status" class="form-control show-tick">
                                                @foreach($status_ids as $status)
                                                @if($status->status_id  == $project->project_status)
                                                <option value="{{ $status->status_id }}" selected>{{ $status->status_name }}</option>
                                                @else
                                                <option value="{{ $status->status_id }}">{{ $status->status_name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                            </div>


                            <h2 class="card-inside-title">Project Histroy</h2>
                            <div class="row clearfix">
                            <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="4"  name="project_comment" class="form-control no-resize" placeholder="Enter Project Comments"></textarea>
                                        </div>
                                    </div>
                            </div>
                            </div>
                          

                            
                            <button class="btn btn-primary waves-effect" type="submit"><i class="material-icons">save</i> UPDATE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>








    </div>
</section>
@include('components/footer')
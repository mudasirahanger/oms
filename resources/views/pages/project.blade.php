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
                        <form action="{{ route('saveproject') }}" method="post" enctype="multipart/form-data">
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
                                        <div class="form-line">
                                            <input type="text" name="project_name" class="form-control"  placeholder="Name" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h2 class="card-inside-title">Client Details</h2>
                            <div class="row clearfix">
                                <div class="col-sm-12">

                                    <div class="form-group">
                                        <div class="form-line">
                                            <input class="form-control" type="text" name="client_mobile" placeholder="Mobile" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-line">
                                            <input class="form-control" type="text" name="client_email" placeholder="EMail" required>
                                            
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-line">
                                            <input class="form-control" type="text" name="client_name" placeholder="Full Name"    required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-line">
                                            <input class="form-control" type="text" name="client_address" placeholder="Address" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="project_cost" placeholder="Project Cost" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h2 class="card-inside-title">Team Details</h2>
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <p>
                                        Select Work Types
                                    </p>
                                    <select name="project_types[]" class="form-control show-tick" multiple>
                                        @foreach($projectstypes as $projectstype)
                                        <option value="{{ $projectstype->project_type_id }}">{{ $projectstype->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <p>
                                        Select Departments
                                    </p>
                                    <select name="department_ids[]" class="form-control show-tick" multiple>
                                        @foreach($departments as $department)
                                        <option value="{{ $department->department_id }}">{{ $department->department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <p>
                                        Select Employees
                                    </p>
                                    <select name="employee_ids[]" class="form-control show-tick" multiple>
                                        @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            
                            <h2 class="card-inside-title">Project Details</h2>
                            <div class="row clearfix">
                            <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="4"  name="project_desc" class="form-control no-resize" placeholder="Enter Project Details..."></textarea>
                                        </div>
                                    </div>
                            </div>
                            </div>
                            <div class="row clearfix">
                            <div class="col-xs-3">
                                    <h2 class="card-inside-title">Project Start Date</h2>
                                    <div class="form-group">
                                        <div class="form-line" id="bs_datepicker_container">
                                            <input type="date" class="form-control" name="project_start_date" placeholder="Please choose a date...">
                                        </div>
                                    </div>
                                </div>
                           
                            <div class="col-xs-3">
                                    <h2 class="card-inside-title">Project Delivery Date</h2>
                                    <div class="form-group">
                                        <div class="form-line" id="bs_datepicker_container">
                                            <input type="date" class="form-control" name="project_end_date" placeholder="Please choose a date...">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <h2 class="card-inside-title">Project Priority </h2>
                                    <div class="form-group">
                                        <div class="form-line" id="bs_datepicker_container">
                                    <select name="project_priority" class="form-control show-tick">
                                        <option value="1"> 1 - Low </option>
                                        <option value="2"> 2 - Medium </option>
                                        <option value="3"> 3 - High </option>
                                    </select>
                                    </div>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="row clearfix">
                            <div class="col-xs-3">
                                    <p>
                                        <b>Select Project Status</b>
                                    </p>
                                    <select name="project_status" class="form-control show-tick">
                                        @foreach($status_ids as $status)
                                        <option value="{{ $status->status_id }}">{{ $status->status_name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-sm-3">
                                        <div class="demo-switch-title">Telegram BOT Notification</div>
                                        <div class="switch">
                                            <label><input type="checkbox" checked><span class="lever switch-col-purple"></span></label>
                                        </div>
                                    </div>
                                </div>
                            
                            <button class="btn btn-primary waves-effect" type="submit"><i class="material-icons">save</i> ADD PROJECT</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>








    </div>
</section>
@include('components/footer')
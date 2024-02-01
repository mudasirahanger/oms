@include('components/header')
@include('components/topmenu')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>/Employees List</h2>
        </div>



        <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>EMPLOYEES</h2>
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
                                        <th align="left">Employee ID</th>
                                        <th align="left">Full Name </th>
                                        <th align="left"> Phone</th>
                                        <th align="left"> Email</th>
                                        <th align="left"> Department</th>
                                        <th align="left">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($employees) && $employees->count())
                                    @foreach($employees as $employee)
                                      <tr>
                                        <td>#{{ $employee->emp_id }} </td>
                                        <td> {{ $employee->name }} {{ $employee->lname }} </td>
                                        <td> {{ $employee->mobile }} </td>
                                        <td> {{ $employee->email }} </td>
                                        <td> @if(!empty($employee->department_id))
                                          <span class="label bg-blue"> {{ \App\Models\Department::getDepartmentNameById($employee->department_id)  }}  </span></td>
                                          @endif
                                          <td>
                                          @if(Auth::user()->role_id == 1 && $employee->id != 1)
                                          <form action="{{ url('/deleteEmployee') }}" method="POST">
                                              @csrf
                                              <input type="hidden" name="user_id" value="{{ $employee->id }}">
                                             <button type="submit" class="btn btn-danger"><i class="material-icons">delete</i> </button>
                                              </form>
                                              @endif
                                            </td>
                                      </tr>
                                      @endforeach
                                      @endif
                                    </tbody>
                                  </table>


@include('components/footer')

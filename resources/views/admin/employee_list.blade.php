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
                            <div class="alert alert-success">{{ session('message') }}</div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                      <tr>
                                        <th align="left">Employee ID</th>
                                        <th align="left"> Name</th>
                                        <th align="left"> Phone</th>
                                        <th align="left"> Email</th>
                                        <th align="left">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($employees) && $employees->count())
                                    @foreach($employees as $employee)
                                      <tr>
                                        <td> {{ $employee->emp_id }} </td>
                                        <td> {{ $employee->name }} {{ $employee->lname }} </td>
                                        <td> {{ $employee->email }} </td>
                                        <td> {{ $employee->mobile }} </td>
                                        <td><i class="material-icons">delete</i></td>
                                      </tr>
                                      @endforeach
                                      @endif
                                    </tbody>
                                  </table>


@include('components/footer')

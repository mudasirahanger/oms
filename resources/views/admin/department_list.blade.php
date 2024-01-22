@include('components/header')
@include('components/topmenu')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>/Department List</h2>
        </div>



        <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>DEPARTMENTS</h2>
                        </div>
                        <div class="body">
                        @if (session('message'))
                            <div class="alert alert-success">{{ session('message') }}</div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                      <tr>
                                        <th align="left">Department ID</th>
                                        <th align="left"> Name</th>
                                        <th align="left">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($departments) && $departments->count())
                                    @foreach($departments as $department)
                                      <tr>
                                        <td> {{ $department->department_id }} </td>
                                        <td> {{ $department->department_name }} </td>
                                        <form action="{{ url('/deldepartment') }}" method="POST">
                                          @csrf
                                          <input type="hidden" name="department_id" value="{{ $department->department_id }}">
                                        <td> <button type="submit" class="btn btn-danger"><i class="material-icons">delete</i> </button></td>
                                          </form>
                                      </tr>
                                      @endforeach
                                      @endif
                                    </tbody>
                                  </table>

{!! $departments->links() !!}

@include('components/footer')

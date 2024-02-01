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
                                            <th>#Client ID</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @if($clients)
                                      @foreach($clients as $client)
                                        <tr>
                                            <td>{{ $client->client_id }}</td>
                                            <td>{{ $client->client_name }}</td>
                                            <td>{{ $client->client_mobile }}</td>
                                            <td>{{ $client->client_email }}</td>
                                            <td>{{ $client->client_address }}</td>
                                            <td>@if(Auth::user()->role_id == 1)
                                                <form action="{{ url('/deleteClient') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="client_id" value="{{ $client->client_id }}">
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
                                
                                {{ $clients->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
               
                          
              
              </div>

    </div>
</section>

@include('components/footer')

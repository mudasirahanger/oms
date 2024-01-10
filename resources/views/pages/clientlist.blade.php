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
                                            <td><a href="#" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
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

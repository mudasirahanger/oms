@include('components/header')
@include('components/topmenu')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>/Add Department</h2>
        </div>

        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            DEPARTMENT
                            <small>Enter Details </small>
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('savedepartment') }}" method="post" enctype="multipart/form-data">
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
                            <h2 class="card-inside-title">Department Name</h2>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="department_name" placeholder="Enter a name" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <select name="status">
                                        <option value="">Select Status</option>
                                        <option value="1">Enable</option>
                                        <option value="0">Disbale</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary waves-effect" type="submit"><i class="material-icons">save</i> ADD </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('components/footer')
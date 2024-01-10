@include('components/head')
<body class="login-page">
  <div class="login-box">
    <div class="logo">
      <a href="javascript:void(0);">OMS<b></b></a>
      <small>Office Management System - Associated Media</small>
    </div>
        <div class="card">
            <div class="body">
                <form id="sign_up" method="POST" action="{{ route('register') }}">
                @csrf
                    <div class="msg">Register as a employee</div>
                    @csrf
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                        {{ $error }}
                        </div>
                        @endforeach
                        @endif
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="name" placeholder="First Name" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="lname" placeholder="Last Name" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">call</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="mobile" placeholder="Mobile No" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">apartment</i>
                        </span>
                        <select class="form-control show-tick" name="department_id">
                                <option>Select Department</option>
                                @foreach($departments as $department)
                                <option  value="{{ $department->department_id }}">{{ $department->department_name }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" minlength="8" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password_confirmation" minlength="8" placeholder="Confirm Password" required>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                        <label for="terms">I read and agree to the <a href="javascript:void(0);">terms of usage</a>.</label>
                    </div> -->

                    <button class="btn btn-block btn-lg bg-black waves-effect" type="submit">CREATE</button>

                    <div class="m-t-25 m-b--5 align-center">
                        <a href="{{ route('login') }}">I am already employee?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>




@include('components/footer')
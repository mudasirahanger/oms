@include('components/head')
<body class="login-page">
  <div class="login-box">
    <div class="logo">
      <a href="javascript:void(0);">OMS<b></b></a>
      <small>Office Management System - Associated Media</small>
    </div>
    <div class="card">
      <div class="body">
        <form id="sign_in" method="POST" action="{{ route('login') }}">
        @csrf
          <div class="msg">start your work</div>
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
              <input type="text" class="form-control" type="email" name="email" placeholder="Enter email id" required autofocus>
            </div>
          </div>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="material-icons">lock</i>
            </span>
            <div class="form-line">
              <input type="password" class="form-control" type="password" name="password" placeholder="Enter a password" required>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-8 p-t-5">
              <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
              <label for="rememberme">Remember Me</label>
            </div>
            <div class="col-xs-4">
              <button class="btn btn-block bg-black waves-effect" type="submit">LOGIN IN</button>
            </div>
          </div>
          <div class="row m-t-15 m-b--20">
            <div class="col-xs-6">
              <a href="{{ route('register') }}">Create account</a>
            </div>
            <!-- <div class="col-xs-6 align-right">
              <a href="forgot-password.html">Forgot Password?</a>
            </div> -->
          </div>
        </form>
      </div>
    </div>
  </div>

  @include('components/footer')
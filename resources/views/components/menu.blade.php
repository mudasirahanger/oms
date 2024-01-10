<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="{{ asset('public/images/user.png') }}" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{  Auth::user()->name  }} / {{ Auth::user()->emp_id }}  </div>
                <div class="email">{{ Auth::user()->email }}</div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ url('/logout') }}"><i class="material-icons">input</i>Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MENU</li>
                <li class="@if (Route::currentRouteName() == 'dashboard') active @endif">
                    <a href="{{ url('/dashboard') }}">
                        <i class="material-icons">home</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="@if (Route::currentRouteName() == 'addproject') active @endif">
                    <a href="{{ url('/addproject') }}">
                        <i class="material-icons">control_point</i>
                        <span>Add Project</span>
                    </a>
                </li>
                
                @if(Auth::user()->role_id == 1)
                <li class="@if (Route::currentRouteName() == 'listproject') active @endif">
                    <a href="{{ url('/listproject') }}">
                        <i class="material-icons">event_note</i>
                        <span>Project List</span>
                    </a>
                </li>
            
                <li class="@if (Route::currentRouteName() == 'listemployees') active @endif">
                    <a href="{{ url('/listemployees') }}">
                       <i class="material-icons">supervisor_account</i>
                        <span>Employees</span>
                    </a>
                </li>
                <li class="@if (Route::currentRouteName() == 'listclients') active @endif">
                    <a href="{{ url('/listclients') }}">
                       <i class="material-icons">assignment_ind</i>
                        <span>Clients</span>
                    </a>
                </li>
                
                <li class="@if (Route::currentRouteName() == 'adddepartment') active @endif">
                    <a href="{{ url('/adddepartment') }}">
                     <i class="material-icons">domain</i>
                        <span>Add Department</span>
                    </a>
                </li>
                <li class="@if (Route::currentRouteName() == 'listdepartment') active @endif">
                    <a href="{{ url('/listdepartment') }}">
                    <i class="material-icons">event_note</i>
                        <span>Department List</span>
                    </a>
                </li>
               @endif
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <!-- <div class="copyright">
                &copy; 2024 <a href="javascript:void(0);">Office Management System - OMS </a>.
            </div> -->
            <div class="version">
                <b>Version: </b> 1.0.5
            </div>
        </div>
        <!-- #Footer -->
    </aside>
@include('components/header')
@include('components/topmenu')


@if(Auth::user()->role_id == 1)
    {{ App\Http\Controllers\Pages\ProjectsController::adminCounts(); }}
@else
    @include('employee/dashboard')
@endif



@include('components/footer')
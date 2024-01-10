<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Department;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data = [];
        $data['departments'] =  Department::list($data);
        return view('auth.register',$data);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'mobile' => ['required', 'string', 'max:255'],
            'department_id' => ['required','string'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile' => $request->mobile,
            'department_id' => $request->department_id,
            'emp_id' => rand(200,5000),
            'role_id'  => env('DEFAULT_ROLEID')
        ]);

        event(new Registered($user));

         // sending mail
        // $mailData = [
        //     "name" => "Test NAME",
        //     "dob" => "12/12/1990"
        // ];
    
       // Mail::to("mudasirahanger@gmail.com")->send(new SendMail($mailData));
       
        Auth::login($user);
           
        return redirect(RouteServiceProvider::HOME);
    }




    
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lname',
        'email',
        'password',
        'mobile',
        'department_id',
        'emp_id',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getUsername($userId) {
        return \DB::table('users')->where('id', $userId)->first()->name;
       }

    public static function deleteUserById($id) {     
        $empProjects = \DB::table('employees_to_projects')
                        ->where('employee_ids', $id)
                        ->exists();
            // If related projects exist, return false to prevent deletion
        if ($empProjects) {
            return false;
        }
        $emp = \DB::table('users')->where('id', $id)->delete();
        if($emp){
        return true;
        } else {
        return false;
        }
    }   
}

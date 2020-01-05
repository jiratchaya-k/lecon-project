<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
//    protected function validator(array $data)
//    {
//        if (view('auth.register')) {
//            return Validator::make($data, [
//                'firstname' => ['required', 'string', 'max:255'],
//                'lastname' => ['required', 'string', 'max:255'],
//                'student_id' => ['required', 'string', 'max:255'],
//                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//                'password' => ['required', 'string', 'min:8', 'confirmed'],
//            ]);
//        }elseif (view('auth.registerTeacher')) {
//            return Validator::make($data, [
//                'firstname' => ['required', 'string', 'max:255'],
//                'lastname' => ['required', 'string', 'max:255'],
//                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//                'password' => ['required', 'string', 'min:8', 'confirmed'],
//            ]);
//        }
//
//    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
//    protected function create(array $data)
//    {
//        if (view('auth.register')) {
//            return User::create([
//                'firstname' => $data['firstname'],
//                'lastname' => $data['lastname'],
//                'student_id' => $data['student_id'],
//                'email' => $data['email'],
//                'role' => User::role_student,
//                'password' => Hash::make($data['password']),
//            ]);
//        }elseif (view('auth.registerTeacher')) {
//            return User::create([
//                'firstname' => $data['firstname'],
//                'lastname' => $data['lastname'],
//                'email' => $data['email'],
//                'role' => User::role_teacher,
//                'password' => Hash::make($data['password']),
//            ]);
//        }
//
//    }

    protected function createStudent(Request $request){
        $this->validate($request,[
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'student_id' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = new User;
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->student_id = $request->input('student_id');
        $user->role = User::role_student;
        $user->password = Hash::make($request->input(['password']));
        $user->save();

        return redirect('/');

//        dd($request->all());
    }

    protected function createTeacher(Request $request){
        $this->validate($request,[
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = new User;
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->role = User::role_teacher;
        $user->password = Hash::make($request->input(['password']));
        $user->save();

        return redirect('/teacher');

//        dd($request->all());
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->except(['getLogout']);
    }

    public function getLogin()
    {
        return view('contents.login');
    }

    public function getRerister()
    {
        return view ('contents.register');
    }

    public function postregister(Request $request)
    {

        //  Reglas de validacion
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'cpassword' => 'required|same:password'
        ];

        $messages = [
            'name.required' => 'Nombre es necesario.',
            'lastname.required' => 'Apellido es necesario.',
            'email.required' => 'Correo electrónico es necesario.',
            'email.email' => 'Formato de correo electrónico incorrecto.',
            'email.unique' => 'Ya existe un usuario registrado con este correo electrónico.',
            'password.required' => 'Contraseña es necesaria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'cpassword.required' => 'Es necesario confirmar la contraseña.',
            'cpassword.min' => 'La Confirmación contraseña debe tener al menos 8 caracteres.',
            'required.same' => 'Las contraseñas no coindicen.'
        ];

        //Validacion del formulario
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Por favor verifica los campos!!')->with('typealert', 'danger');
        else:
            $user = new User;
            $user->name = e($request->input('name'));
            $user->lastname = e($request->input('lastname'));
            $user->email = e($request->input('email'));
            $user->password = Hash::make($request->input('password'));


        if($user->save()):
            return redirect('/login')->with('message', 'Registro exitoso. ¡Bienvenido!')->with('typealert', 'success');
        endif;

        endif;

    }

    public function postLogin(Request $request)
    {
        ///  Reglas de validacion
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];

        $messages = [
            'email.required' => 'Correo electrónico es necesario.',
            'email.email' => 'Formato de correo electrónico incorrecto.',
            'password.required' => 'Contraseña es necesaria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ];

        //Validacion del formulario
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Por favor verifica los campos!!')->with('typealert', 'danger');
        else:

            if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], true)):
                return redirect('/');
            else:
                return back()->with('message', 'Correo electrónico o contraseña incorrecto.')->with('typealert', 'danger');
            endif;

        endif;

    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('/');
    }




}

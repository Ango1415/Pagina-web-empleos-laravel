<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //Common Resource Routes:
    // index    -   Show all listings
    // show     -   Show single listening
    // create   -   Show form to create new listing
    // store    -   Store new listing
    // edit     -   Show form to edit listing
    // update   -   Update listing
    // destroy  -   Delete listing


    //Show register/create form
    public function create(){
        return view('users.register');
    }

    //Create new user
    public function store(Request $request){
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],    //Significa que requiere de mínimo 3 caracteres
            'email' => ['required', 'email', Rule::unique('users', 'email')],   //email da validaciones adicionales al email, y en Rule unique pide el nombre de la tabla y el campo
            'password' => ['required', 'confirmed', 'min:6']     // Con el confirmed hace que busque otro campo en el form con el mismo nombre pero con la terminación '_confirmation' y las compara, deben ser iguales para pasar la validación.
        ]);

        //Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        //Create User (This User is the model)
        $user = User::create($formFields);

        //Login
        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in');
    }

    //Log User Out
    public function logout(Request $request){
        auth()->logout();

        //Debemos invalidar la sesión y obtener un token csfr (sgún explica el tutor en el video)
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Session has been successfully logged out');
    }

    //Show Log User In Form
    public function login(){
        return view('users.login');
    }

    //Log User In
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();
            return redirect('/')->with('message', 'You have been successfully logged in');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}

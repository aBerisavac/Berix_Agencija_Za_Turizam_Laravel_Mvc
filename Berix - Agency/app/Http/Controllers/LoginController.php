<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends BasicController
{
    public function login(Request $request){
        $errors = [];
        $userExists = User::all()->where("email", $request->get('login-email'))->first();
        if(!$userExists) {
            array_push($errors, "User with given email does not exist. ");
        }
        $reEmail = "/(?:[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*|\"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*\")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/";
        $rePassword = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

        if(!preg_match($rePassword, $request->get('login-password'))) array_push($errors, "Password must be at least 8 characters long, with at least 1 number, 1 upper, 1 lower letter and 1 special character.");
        if(!preg_match($reEmail, $request->get('login-email'))) array_push($errors, "Email format is not valid");
        if(!Hash::check($request->get('login-password'), $userExists->password)) array_push($errors, "Password is not correct.");

        if(count($errors)==0){
            $user=$userExists;
            session()->put('user', $user);
        } else{
            $this->data['loginErrors']=$errors;
        }

        return redirect()->route('index')->with($this->data);
    }

    public function logout(Request $request){
        session()->forget('user');
        return redirect()->route('index')->with($this->data);
    }

    public function register(Request $request){
        $errors = [];
        $userExists = User::all()->where("email", $request->get('register-email'))->first();
        if($userExists) {
            array_push($errors, "User with given email already exists. ");
        }


        $reFirstName = "/^[a-z ,.'-]{2,30}$/";
        $reLastName = "/^[a-z ,.'-]{2,30}$/";
        $rePassword = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!#%*?&]{8,}$/";
        $rePhoneNumber = "/(^\+[\d]{10,13})|(^\+[\d]{3,5}(\s\d{2,4}){1,4})/";
        $reEmail = "/(?:[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*|\"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*\")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/";

        if(!preg_match($reFirstName, strtolower($request->get('register-first-name')))) array_push($errors, "First name must be between 2 and 30 letters long.");
        if(!preg_match($reLastName, strtolower($request->get('register-last-name')))) array_push($errors, "Last name must be between 2 and 30 letters long.");
        if(!preg_match($rePassword, $request->get('register-password'))) array_push($errors, "Password must be at least 8 characters long, with at least 1 number, 1 upper, 1 lower letter and 1 special character.");
        if(!preg_match($rePhoneNumber, $request->get('register-phone-number'))) array_push($errors, "Number must be in +<country code> format.");
        if(!preg_match($reEmail, $request->get('register-email'))) array_push($errors, "Email format is not valid");

        if(count($errors)==0){

            $user = new User();
            $user->first_name = strtolower($request->get('register-first-name'));
            $user->last_name = strtolower($request->get('register-last-name'));
            $user->email = $request->get('register-email');
            $user->phone_number = $request->get('register-phone-number');
            $user->password =  Hash::make($request->get('register-password'));
            $user->role_id = 2;

            $user->save();

            return redirect()->route('index')->with('registerIsSuccessfull', true);

        } else{

            return redirect()->route('index')->with('registerErrors', $errors);

        }

    }
}

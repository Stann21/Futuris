<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\User;

class ActivateAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $title = 'Activeren';
        return view('pages.activate.activate')->with('title', $title);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $password = $request->password;
        $password_repeat = $request->password_repeat;
        $userid = $request->userid;

        if ($password !== $password_repeat) {
            return redirect('/activate')->with('error', 'Wachtwoorden komen niet overeen');
        }else {
            //Check length
            $length_password =  strlen($password);
            if ($length_password < '8') {
                return redirect('/activate')->with('error', 'Wachtwoorden is niet lang genoeg');
            }else {
                //Hash password
                $hashPassword = bcrypt($password);
                $user = User::find($userid);
                $user->password = $hashPassword;
                $user->user_activated = '1';
                $user->save();

                return redirect ('/login')->with('success', 'Je wachtwoord is veranderd');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request) {
        $title = 'Wachtwoord invoeren';
        $userid = $request->route()->getParameter('activate');

        return view('pages.activate.activateChangePassword')->with('title', $title)->with('userid', $userid);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function activateCheck(Request $request) {
        $this->validate($request, [
            'username' => 'required',
            'code' => 'required'
        ]);

        $username = $request->input('username');
        $code = $request->input('code');

        //Find the person with the username
        $user = DB::table('users')->where('username', $username)->first();
        $userid = $user->id;

        //Check if is activated
        if ($user->user_activated == '0') {
            //Check if code is correct with giving code
            if ($user->user_activationcode == $code) {
                // Send to new page to change ww
                return view ('pages.activate.activateChangePassword')->with('userid', $userid);
            }else {
                return redirect('/activate')->with('error', 'De opgegeven code is niet correct');
            }
        }else {
            return redirect('/activate')->with('error', 'Gebruiker is al geactiveerd');
        }
    }

    public function activatePasswordCheck (){
        //        $user = User::find($id);
//        $user->username = $request->input('username');
//        $user->save();
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\users;
use Illuminate\Support\Facades\DB;

class UserController extends Controller {
   public function index(){
      //$usersClients = DB::select("SELECT * FROM users WHERE user_role='client'");
      $usersMentor = DB::select("SELECT * FROM users WHERE user_role='mentor'");
      //$feedback = DB::select("SELECT * FROM feedback");


       $mentorid = Auth()->id();
       $usersClient = DB::table('users')->where('user_mentor', $mentorid)->get();
       $feedback = DB::table('feedback')->where('feedback_mentor', $mentorid)->orderBy('feedback_date', 'desc')->take('10')->get();


       $learningOnUser = DB::table('users')->join('learning_goals','users.id','=','learning_id')->select('users.*','learning_goals.*')->get();


         return view('backendpages.indexbackend')
         ->with('usersClient',$usersClient)
         ->with('usersMentor',$usersMentor)
         ->with('feedback',$feedback)
         ->with('learningOnUser',$learningOnUser);
  
      }
  
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class users extends Model {
     protected $table = 'users';

     function scopeGetAllMentorClients($query, $mentorid) {
        return $query->where('user_mentor', $mentorid)->get();
     }

    function scopeGenerateActivationCode($query) {
        $length = '8';
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }

    function scopeCountPercentage($query, $goals, $subgoals){
        //Setup variables
        $done = '0';
        $total = '0';
        $array = array();

        //Get every goal and subgoal in a loop. Based on if they finished or not add ++
        foreach ($goals as $goal) {
            foreach ($subgoals as $subgoal) {
                if ($goal->learning_id == $subgoal->learning_category) {
                    if ($subgoal->learning_finished == '1') {
                        $done ++;
                    }
                    $total ++;
                    //Put it in a array
                    $counter = $name = array($done, $total);
                };
            } // End foreach subgoals
            //If there isnt a subgoal, insert done an total as 0.
            if ($total >= '1') {
                array_push($array, $counter);
            }else {
                $counter = $name = array('0', '0');
                //Put it in a array
                array_push($array, $counter);
            }
            //Reset counters
            $done = '0';
            $total =  '0';
        } //End foreach goals

        return $array;
    }

    function scopeCountPercentageUser($query, $goalid, $userid) {
        $subgoals = DB::table('learning_goals')->where('learning_category', $goalid)->get();

        $done = '0';
        $total = '0';

        foreach ($subgoals as $subgoal) {
            if ($subgoal->learning_finished == '1') {
                $done ++;
            }
            $total ++;
        }


         return $done . '/' . $total;
    }

    function scopeCountMaingoalsPercentage($query, $users) {
        $array = [];
        $array1 = [];
        $done = '0';
        $total = '0';

        //Count the done and total goals
        foreach ($users as $user) {
            $maingoals = DB::table('learning_goals')->where('learning_role', 'Hoofdleerdoel')->where('user_id', $user->id)->get();
            foreach ($maingoals as $maingoal) {
                if ($user->id == $maingoal->user_id) {
                    if ($maingoal->learning_finished == '1') {
                        $done++;
                    }
                    $total++;
                }
            }
            $counter = $done . '/' . $total;
            $array[$user->id] = $counter;
            //Put it in a array
            array_push($array1, $user->id);
            array_push($array1, $done, $total);
            //Reset Counters
            $done = '0';
            $total = '0';
        }

        return $array;
    }

    function scopeGetUserPassword ($query, $id) {
         return $query->where('id', $id)->first('password');
    }

    function scopeGetUser ($query, $id) {
         return $query->where('id', $id)->first();
    }
}

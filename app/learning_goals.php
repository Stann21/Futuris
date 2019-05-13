<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class learning_goals extends Model {
    public $timestamps = false;
    protected $table = 'learning_goals';

    public function scopeGetSingleGoal($query, $id) {
        return $query->where('learning_id', $id)->first();
    }

    public function scopeGetSubgoals($query, $maingoalid, $clientid) {
        return $query->where('learning_category', $maingoalid)->where('user_id', $clientid)->get();
    }

    public function scopeGetFeedbackGoal($query, $onid) {
        if ($onid == '0') {
            $name = 'Gebruiker feedback';
            return $name;
        }else {
            $feedbackGoal = $query->where('learning_id', $onid)->get();
            foreach ($feedbackGoal as $feedback) {
                $name = 'Subdoel ' . $feedback->learning_name;
            }
            
            return $name;
        }
    }

    function scopeGoalsOverviewMentor ($query, $userid) {
        $goal = $query->where('user_id', $userid)->where('learning_role', 'Hoofdleerdoel')->get();
        $counter = $query->where('user_id', $userid)->where('learning_role', 'Hoofdleerdoel')->count();

            echo '<div class="col-sm-1"></div>';
            echo '<div class="col-sm-6">Leerdoel</div>';
            echo '<div class="col-sm-2">Percentage</div>';
            echo '<div class="col-sm-3"></div>';

        echo '<div class="row">';
        for ($i = '0'; $i < $counter; $i++) {
            echo '<div class="col-sm-1"><i class="fa">&#x' . $goal[$i]['learning_icon'] . ';</i></div>';
            echo '<div class="col-sm-6">' . $goal[$i]['learning_name'] . '</div>';
            echo '<div class="col-sm-2">' . users::CountPercentageUser($goal[$i]['learning_id'], $userid) . '</div>';
            echo '<div class="col-sm-3"><a href="/admin/goals/' . $goal[$i]['learning_id'] . '/'. $userid . '">Bekijk details</a></div>';
        }
        echo '</div>';
        return '';
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class template_goals extends Model {
    public $timestamps = false;
    protected $table = 'template_goals';

    public function scopeAllLearningGoals($query, $learningGoal) {
        return $query->where('template_role', $learningGoal);
    }

    public function scopeCountTemplateGoals($query, $mainGoalid) {
        return $query->where('template_category', $mainGoalid)->count();
    }

    public function scopeGetSingleGoal($query, $id) {
        return $query->where('template_id', $id)->first();
    }

    public function scopeGetSubgoals($query, $maingoalid) {
        return $query->where('template_category', $maingoalid)->get();
    }

    public function scopeTemplateEnd($query, $mainGoalid) {
        $mainGoal = $query->where('template_id', $mainGoalid)->get('template_finish');

        foreach ($mainGoal as $goal) {
            if ($goal->template_finish == '0') {
                $end = 'Nee';
            }
            if ($goal->template_finish == '1') {
                $end = 'Ja';
            }
        }

        return $end;
    }

    public function scopeCreateUserTemplates($query, $templateid) {
        $subgoals = $query->where('template_category', $templateid)->get();

            foreach ($subgoals as $subgoal) {
                echo  '<div class="row">';
                    echo '<input name="template[]" type="checkbox" value="';
                        echo $subgoal->template_name;
                    echo '">'; echo '<label>' . $subgoal->template_name . '</label>';
                echo '</div>';
            }

        return '';
    }
}

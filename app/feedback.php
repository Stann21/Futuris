<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Feedback extends Model {
    protected $table = 'feedback';
    public $timestamps = false;

    public function scopeFeedbackTag($query, $feedbackid) {
        $feedback = $query->where('feedback_id', $feedbackid)->get();

        foreach ($feedback as $item) {
            switch ($item->feedback_role) {
                case ('0'):
                    $tag = 'Algemeen';
                    break;
                case ('1'):
                    $learninggoal = DB::table('learning_goals')->where('learning_id', $item->feedback_onid)->first();
                    $tag = 'Subdoel ' . $learninggoal->learning_name;
                    break;
                case ('2'):
                    $achievements = DB::table('achievments_user')->where('id', $item->feedback_onid)->first();
                    $tag = 'Achievement ' . $achievements->learning_name;
                    break;
            }
        }

        return $tag;
    }

    public function scopeGetSpecificFeedback($query, $feedbackid) {
        return $query->where('feedback_id', $feedbackid)->first();
    }

    public function scopeFeedbackMentor($query, $mentorid) {
        return $query->where('feedback_mentor', $mentorid)
            ->OrderBy('feedback_date', 'desc')
            ->paginate(10);
    }

    public function scopeFeedbackClient($query, $clientid) {
        return $query->where('feedback_client', $clientid)->get();
    }
}

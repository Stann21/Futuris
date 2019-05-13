<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Icon extends Model {
    public $timestamps = false;
    protected $table = 'icons';

    public function scopeIconByName($query) {
        return $query->orderBy('icon_name', 'ASC')->get();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Janso extends Model
{
    protected $guarded = ['id'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';

    public function scores()
    {
        return $this->hasOne('App\Scores');
    }

    public function game_history()
    {
        return $this->hasMany('App\GameHistory');
    }
    
}

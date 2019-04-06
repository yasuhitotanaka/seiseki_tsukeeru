<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameHistory extends Model
{
    protected $table       = 'game_history';
    protected $fillable = [
                            'user_id', 
                            'janso_id',
                            'first_number',
                            'second_number',
                            'third_number',
                            'first_number',
                            'fourth_number',
                            'income',
                            'created_at',
                            'modified_at',
                          ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';

    public function janso()
    {
        return $this->belongsTo('App\Janso');
    }
}

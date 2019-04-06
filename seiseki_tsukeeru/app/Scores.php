<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scores extends Model
{
    protected $fillable = [
        'user_id', 
        'janso_id',
        'total_first_number',
        'total_second_number', 
        'total_third_number',
        'total_fourth_number',
        'all_number', 
        'total_income',
        'average_score',
        'savings',
        'average_savings', 
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

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Janso extends Model
{
    protected $guarded = ['id'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';
}

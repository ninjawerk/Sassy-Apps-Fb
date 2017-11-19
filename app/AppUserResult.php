<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppUserResult extends Model
{
    public function FbApp()
    {
        return $this->belongsTo('App\FbApp');
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }
}

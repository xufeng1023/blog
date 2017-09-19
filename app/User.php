<?php

namespace App;

use Carbon\Carbon;
use Laravel\Cashier\Billable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, Billable, HasApiTokens;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $visible = ['api_token', 'email', 'id', 'name', 'text_token'];

    public function saveApiToken()
    {
    	$token = $this->createToken('video')->accessToken;
        $this->text_token = $token;
        $this->save();
    }
}

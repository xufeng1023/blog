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

    protected $fillable = ['email', 'password'];

    protected $appends = ['plan'];

    protected $visible = ['api_token', 'email', 'id', 'plan', 'card_last_four'];

    public function saveApiToken()
    {
        $this->api_token = $this->createToken('video')->accessToken;
        $this->save();
    }

    public function ppvs()
    {
        return $this->hasMany(Ppv::class);
    }

    public function getPlanAttribute()
    {
        if($sub = $this->subscription('main')) {
            return $sub->stripe_plan;
        }
    }

    public function getEndsAtAttribute()
    {
        if($sub = $this->subscription('main')) {
            return $sub->ends_at;
        }
    }
}

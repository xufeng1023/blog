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

    protected $appends = ['plan'];

    protected $visible = ['api_token', 'email', 'id', 'name', 'plan'];

    public function saveApiToken()
    {
        $this->api_token = str_random(60);
        $this->save();
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }

    public function getPlanAttribute()
    {
        if($this->subscription) {
            return $this->subscription->stripe_plan;
        }
    }
}

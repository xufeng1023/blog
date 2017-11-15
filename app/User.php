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

    protected $appends = ['plan','ends_at','next_bill_at','is_member'];

    protected $fillable = ['email', 'password'];

    protected $with = ['subscriptions'];

    protected $visible = ['api_token','card_brand','card_last_four','email','plan','ends_at','next_bill_at','is_member'];

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
        $sub = $this->subscription('main');
        return $sub? $sub->stripe_plan : null;
    }

    public function getEndsAtAttribute()
    {
        $sub = $this->subscription('main');
        return $sub && $sub->ends_at? $sub->ends_at->format('Y-m-d') : null;
    }

    public function getNextBillAtAttribute()
    {
        $sub = $this->subscription('main');
        return $sub? $sub->updated_at->addMonth()->format('Y-m-d') : null;
    }

    public function getIsMemberAttribute()
    {
        return $this->subscribed('main');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\CustomPasswordRest($token));
    }
}

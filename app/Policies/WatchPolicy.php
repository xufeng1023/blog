<?php

namespace App\Policies;

use Carbon\Carbon;
use App\{User, Ppv, Post};
use Illuminate\Auth\Access\HandlesAuthorization;

class WatchPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function watch(User $user, Post $post)
    {
        if($user->subscribed('main')) return true;

        $ppv = Ppv::where(['user_id'=>$user->id,'post_id'=>$post->id])->where('ends_at', '>', Carbon::now())->first();

        return $ppv? true : false;
    }
}

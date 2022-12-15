<?php

namespace App\Policies;

use App\Models\Music;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class MusicPolicy
{
    use HandlesAuthorization;


    public function watch(User $user, Music $music) //watch
    {
        $musicSub = $user->musicsSubscribed()->where('music_id', $music->id)->first();
        $nowTime = Carbon::now()->addHours(6);
        return $musicSub != null && $musicSub->pivot->created_at->addMinutes($musicSub->pivot->months)->gte($nowTime);
        // >=gte() greater or equal // lte
    }

    public function viewAny(User $user) //index
    {
        //
    }

    public function view(User $user, Music $music) //show
    {
        //
    }


    public function create(User $user) //store,create
    {
        return $user->role->name == 'user';
    }


    public function update(User $user, Music $music)
    {
        //
    }


    public function delete(User $user, Music $music)
    {
        return ($user->id == $music->user_id) || ($user->role->name == 'admin');
    }


    public function restore(User $user, Music $music)
    {
        //
    }


    public function forceDelete(User $user, Music $music)
    {
        //
    }
}

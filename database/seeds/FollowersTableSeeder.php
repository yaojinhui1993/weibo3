<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $user = $users->first();
        $userId = $user->id;

        $followers = $users->slice(1); // 去掉第一个数据
        $followerIds = $followers->pluck('id')->toArray();

        // 关注除了 1 号用户以外的所有用户
        $user->follow($followerIds);

        // 除了 1 号以外的所有用户都来关注 1 号用户
        foreach ($followers as $follower) {
            $follower->follow($userId);
        }
    }
}

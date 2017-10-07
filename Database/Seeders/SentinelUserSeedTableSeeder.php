<?php

namespace Modules\User\Database\Seeders;

use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class SentinelUserSeedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Create an admin user
        $user = Sentinel::create(
            [
                'EMAIL' => 'n.widart@gmail.com',
                'PASSWORD' => 'test',
                'FIRST_NAME' => 'Nicolas',
                'LAST_NAME' => 'Widart',
            ]
        );
        // Activate the admin directly
        $activation = Activation::create($user);
        Activation::complete($user, $activation->CODE);

        // Find the group using the group id
        $adminGroup = Sentinel::findRoleBySlug('admin');

        // Assign the group to the user
        $adminGroup->users()->attach($user);
    }
}

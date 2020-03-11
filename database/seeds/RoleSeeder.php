<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['staff', 'sales', 'hr'];

        foreach ($roles as $name)

        {
            $role = new \App\Role();
            $role->name = $name;
            $role->save();

        }

        $roles = \App\Role::get();
        $staffRole =  \App\Role::where('name','staff')->first();

        $users = \App\User::get();

        foreach($users as $user){
            $role = $roles->random();
            $user->roles()->sync($role);
        }
    }
}

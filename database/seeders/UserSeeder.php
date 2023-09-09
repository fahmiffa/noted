<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Setting;
use App\Models\Server;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'root',
            'password'=>bcrypt('jalan'),            
            'role'=>'admin',
            'email'=>'admin@admin.com'
        ]);

        User::create([
            'name'=>'user',
            'password'=>bcrypt('jalan'),            
            'role'=>'operator',
            'email'=>'user@user.com'
        ]);      
    }
}

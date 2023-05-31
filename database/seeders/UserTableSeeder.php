<?php

namespace Database\Seeders;

use App\Models\Blogs;
use App\Models\Comments;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $password=Hash::make('test1234');
        // Insert the initial role users
        User::create(['name' => 'admin','email'=>'admin@admin.com','password'=>$password,'roles_id'=> Role::where('name', 'admin')->pluck('id')->first()]);
        User::create(['name' => 'editor','email'=>'editor@blog.com','password'=>$password,'roles_id'=> Role::where('name', 'editor')->pluck('id')->first()]);
    }
}

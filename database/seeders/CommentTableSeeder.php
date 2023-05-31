<?php

namespace Database\Seeders;

use App\Models\Blogs;
use App\Models\Comments;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comments::create(['user_id' => User::where('roles_id', Role::where('name','!=', 'admin')->pluck('id')->first())->pluck('id')->first(),'blog_id'=>Blogs::where('user_id', User::where('roles_id', Role::where('name','editor')->pluck('id')->first())->pluck('id')->first())->pluck('id')->first(),'content'=>'Sample Comment']);
    }
}

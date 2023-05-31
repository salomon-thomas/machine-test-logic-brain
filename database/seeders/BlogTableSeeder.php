<?php

namespace Database\Seeders;

use App\Models\Blogs;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Blogs::create(['user_id' => User::where('roles_id', Role::where('name', 'editor')->pluck('id')->first())->pluck('id')->first(),'title'=>'Blog Post 1','content'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tincidunt tortor aliquam nulla facilisi cras fermentum odio eu feugiat. Id aliquet lectus proin nibh nisl condimentum id venenatis. Integer quis auctor elit sed. Nunc mattis enim ut tellus elementum sagittis vitae et. Aliquam id diam maecenas ultricies mi eget mauris pharetra. Bibendum at varius vel pharetra vel turpis nunc. Nunc consequat interdum varius sit amet mattis vulputate enim. Purus gravida quis blandit turpis cursus in. Est placerat in egestas erat imperdiet. Aliquam ut porttitor leo a diam sollicitudin. Interdum varius sit amet mattis vulputate enim nulla aliquet porttitor. Id venenatis a condimentum vitae sapien. Integer vitae justo eget magna fermentum iaculis eu. Sapien faucibus et molestie ac feugiat. Velit scelerisque in dictum non. Nascetur ridiculus mus mauris vitae ultricies. Sed velit dignissim sodales ut eu sem integer vitae. Id eu nisl nunc mi ipsum faucibus vitae aliquet.

        Id nibh tortor id aliquet lectus. Bibendum arcu vitae elementum curabitur vitae. Et ultrices neque ornare aenean euismod elementum nisi quis. Sapien eget mi proin sed libero enim sed faucibus. At urna condimentum mattis pellentesque id nibh. Malesuada pellentesque elit eget gravida cum sociis. Luctus accumsan tortor posuere ac ut consequat. Nibh sit amet commodo nulla facilisi. Faucibus scelerisque eleifend donec pretium vulputate sapien nec. Consectetur lorem donec massa sapien faucibus et molestie ac feugiat. Pellentesque habitant morbi tristique senectus et netus et. Dolor magna eget est lorem ipsum dolor sit amet consectetur. Varius duis at consectetur lorem donec massa sapien faucibus et. Lobortis feugiat vivamus at augue eget arcu dictum varius duis. Imperdiet massa tincidunt nunc pulvinar.']);
        Blogs::create(['user_id' => User::where('roles_id',Role::where('name', 'editor')->pluck('id')->first())->pluck('id')->first(),'title'=>'Blog Post 2','content'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Tincidunt tortor aliquam nulla facilisi cras fermentum odio eu feugiat. Id aliquet lectus proin nibh nisl condimentum id venenatis. Integer quis auctor elit sed. Nunc mattis enim ut tellus elementum sagittis vitae et. Aliquam id diam maecenas ultricies mi eget mauris pharetra. Bibendum at varius vel pharetra vel turpis nunc. Nunc consequat interdum varius sit amet mattis vulputate enim. Purus gravida quis blandit turpis cursus in. Est placerat in egestas erat imperdiet. Aliquam ut porttitor leo a diam sollicitudin. Interdum varius sit amet mattis vulputate enim nulla aliquet porttitor. Id venenatis a condimentum vitae sapien. Integer vitae justo eget magna fermentum iaculis eu. Sapien faucibus et molestie ac feugiat. Velit scelerisque in dictum non. Nascetur ridiculus mus mauris vitae ultricies. Sed velit dignissim sodales ut eu sem integer vitae. Id eu nisl nunc mi ipsum faucibus vitae aliquet.

        Id nibh tortor id aliquet lectus. Bibendum arcu vitae elementum curabitur vitae. Et ultrices neque ornare aenean euismod elementum nisi quis. Sapien eget mi proin sed libero enim sed faucibus. At urna condimentum mattis pellentesque id nibh. Malesuada pellentesque elit eget gravida cum sociis. Luctus accumsan tortor posuere ac ut consequat. Nibh sit amet commodo nulla facilisi. Faucibus scelerisque eleifend donec pretium vulputate sapien nec. Consectetur lorem donec massa sapien faucibus et molestie ac feugiat. Pellentesque habitant morbi tristique senectus et netus et. Dolor magna eget est lorem ipsum dolor sit amet consectetur. Varius duis at consectetur lorem donec massa sapien faucibus et. Lobortis feugiat vivamus at augue eget arcu dictum varius duis. Imperdiet massa tincidunt nunc pulvinar.']);
    }
}

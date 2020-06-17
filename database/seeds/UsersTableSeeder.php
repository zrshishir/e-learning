<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        User::insert([
            ['name'=>'admin', 'email'=>'admin@gmail.com', 'password'=>'$2y$10$pyR/M3g.73pfMSkYYUjxP.eUc.A9ceLJkj0hrrh4JbazS5F./832e', 'user_type_id'=>1, 'active'=>1]
        ]);
    }
}

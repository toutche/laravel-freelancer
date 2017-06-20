<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         User::create([
            'name' => 'Toutchê',
            'email' => 'toutche@toutche.com.br',
            'password' => bcrypt('2017123'),
        ]);
    }
}

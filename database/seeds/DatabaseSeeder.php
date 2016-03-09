<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call('UserTableSeeder');
    }
}
class UserTableSeeder extends Seeder{
	public function run(){
		DB::table('User')->insert([
			array('idAccount' => '1',
				  'Username' => 'astro',
				  'Password' => Hash::make('astro'),
				  'idRole' => '2',
				),
			array('idAccount' => '2',
				  'Username' => 'hampton',
				  'Password' => Hash::make('hampton'),
				  'idRole' => '3',
				),
			array('idAccount' => '3',
				  'Username' => 'missy',
				  'Password' => Hash::make('missy'),
				  'idRole' => '4',
				),
			array('idAccount' => '4',
				  'Username' => 'talor',
				  'Password' => Hash::make('talor'),
				  'idRole' => '5',
				),
			array('idAccount' => '5',
				  'Username' => 'missy',
				  'Password' => Hash::make('henri'),
				  'idRole' => '1',
				),

			]);
	}
}

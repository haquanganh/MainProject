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
        $this->call('SkillDetailTableSeeder');
    }
}
class UserTableSeeder extends Seeder{
	public function run(){
		DB::table('users')->insert([
			array('idAccount' => '1',
				  'email' => 'astro@enclave.vn',
				  'password' => Hash::make('astro'),
				  'idRole' => '2',
				),
			array('idAccount' => '2',
				  'email' => 'hampton@enclave.vn',
				  'password' => Hash::make('hampton'),
				  'idRole' => '3',
				),
			array('idAccount' => '3',
				  'email' => 'missy@enclave.vn',
				  'password' => Hash::make('missy'),
				  'idRole' => '4',
				),
			array('idAccount' => '4',
				  'email' => 'talor@enclave.vn',
				  'password' => Hash::make('talor'),
				  'idRole' => '5',
				),
			array('idAccount' => '5',
				  'email' => 'henri@enclave.vn',
				  'password' => Hash::make('henri'),
				  'idRole' => '1',
				),

			]);
	}
}
class RoleTableSeeder extends Seeder{
	public function run(){
		DB::table('Role')->insert([
			array('idRole' => '1',
				  'Role' => 'Administrator',
				  'Note' => 'This is Administrator',
				),
			array('idRole' => '2',
				  'Role' => 'Manager',
				  'Note' => 'This is Manager',
				),
			array('idRole' => '3',
				  'Role' => 'Leader',
				  'Note' => 'This is Leader',
				),
			array('idRole' => '4',
				  'Role' => 'Client',
				  'Note' => 'This is Client',
				),
			array('idRole' => '5',
				  'Role' => 'Member',
				  'Note' => 'This is Member',
				),

			]);
	}
}
class EmployeeTableSeeder extends Seeder{
	
	public function run(){
		$temp = 5;
		DB::table('Employee')->insert([
			array(
					'idEmployee' => $temp,
					'E_Name' => 'Name'.$temp,
					'E_Phone' => $temp,
					'E_Address'=> 'Address'.$temp,
					'E_Skype'=> 'Skype'.$temp,
					'E_Level'=> 'Level'.$temp,
					'E_Avatar'=> 'Avatar'.$temp,
					'E_EngName'=> 'EngName'.$temp,
					'E_Cost_Hour'=> $temp,
					'E_DateofBirth'=> '',
					'idAccount'=> $temp,
				),
			]);
	}
}
class SkillTableSeeder extends Seeder{
	
	public function run(){
		DB::table('Skill')->insert([
			array(
					'idSkill' => 1,
					'Skill' => 'JAVA',
					'S_Note' => 'This is the technical for JAVA',
				),
			array(
					'idSkill' => 2,
					'Skill' => '.NET',
					'S_Note' => 'This is the technical for JAVA',
				),
			array(
					'idSkill' => 3,
					'Skill' => 'Python',
					'S_Note' => 'This is the technical for JAVA',
				),
			]);
	}
}
class SkillDetailTableSeeder extends Seeder{
	
	public function run(){
		$temp = 5;
		DB::table('SkillDetail')->insert([
			array(
					'idEmployee' => 1,
					'idSkill' => 1,
					'S_Rate' => 3,
				),
			array(
					'idSkill' => 2,
					'Skill' => 2,
					'S_Note' => 2,
				),
			array(
					'idSkill' => 3,
					'Skill' => 3,
					'S_Note' => 1,
				),
			array(
					'idSkill' => 2,
					'Skill' => 1,
					'S_Note' => 5,
				),
			array(
					'idSkill' => 2,
					'Skill' => 3,
					'S_Note' => 5,
				),
			]);
	}
}
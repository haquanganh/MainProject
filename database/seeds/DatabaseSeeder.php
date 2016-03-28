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
		DB::table('users')->insert([
			array('idAccount' => '6',
				  'email' => 'huy2@enclave.vn',
				  'password' => Hash::make('123123'),
				  'idRole' => '2',
				),
			array('idAccount' => '7',
				'email' => 'huy3@enclave.vn',
				  'password' => Hash::make('123123'),
				  'idRole' => '3',
				),
			array('idAccount' => '8',
				'email' => 'huy4@enclave.vn',
				  'password' => Hash::make('123123'),
				  'idRole' => '4',
				),
			array('idAccount' => '9',
				'email' => 'huy5@enclave.vn',
				  'password' => Hash::make('123123'),
				  'idRole' => '5',
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
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
        $this->call('TeamMemberTableSeeder');
    }
}
class UserTableSeeder extends Seeder{
	public function run(){
		DB::table('users')->insert([
			// array('email' => 'admin@enclave.vn',
			// 	  'password' => Hash::make('admin'),
			// 	  'idRole' => '1',
			// 	),
			// array('email' => 'projectmanager1@enclave.vn',
			// 	  'password' => Hash::make('projectmanager1'),
			// 	  'idRole' => '2',
			// 	),
			// array('email' => 'projectmanager2@enclave.vn',
			// 	  'password' => Hash::make('projectmanager2'),
			// 	  'idRole' => '2',
			// 	),
			// array('email' => 'projectmanager3@enclave.vn',
			// 	  'password' => Hash::make('projectmanager3'),
			// 	  'idRole' => '2',
			// 	),
			// array('email' => 'projectmanager4@enclave.vn',
			// 	  'password' => Hash::make('projectmanager4'),
			// 	  'idRole' => '2',
			// 	),
			// array('email' => 'projectmanager5@enclave.vn',
			// 	  'password' => Hash::make('projectmanager5'),
			// 	  'idRole' => '2',
			// 	),
			// Member
			// array('email' => 'membem1@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'membem2@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'membem3@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'membem4@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'membem5@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'membem6@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'membem7@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'membem8@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'membem9@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'member10@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'member11@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'member12@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'member13@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'member14@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'member15@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'member16@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'member17@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'member18@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'member19@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'member20@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'member21@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'member22@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'member23@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'member24@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'member25@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'member26@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'member27@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'member28@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'member29@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'member30@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'member31@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'member32@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'member33@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'member34@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '5',
			// 	),
			// array('email' => 'client1@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '4',
			// 	),
			// array('email' => 'client2@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '4',
			// 	),
			// array('email' => 'client3@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '4',
			// 	),
			// array('email' => 'client4@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '4',
			// 	),
			// array('email' => 'client5@enclave.vn',
			// 	  'password' => Hash::make('okall'),
			// 	  'idRole' => '4',
			// 	),
			array('email' => 'leader1@enclave.vn',
				  'password' => Hash::make('okall'),
				  'idRole' => '3',
				),
			array('email' => 'leader2@enclave.vn',
				  'password' => Hash::make('okall'),
				  'idRole' => '3',
				),
			array('email' => 'leader3@enclave.vn',
				  'password' => Hash::make('okall'),
				  'idRole' => '3',
				),
			array('email' => 'leader4@enclave.vn',
				  'password' => Hash::make('okall'),
				  'idRole' => '3',
				),
			array('email' => 'leader5@enclave.vn',
				  'password' => Hash::make('okall'),
				  'idRole' => '3',
				),
			array('email' => 'leader6@enclave.vn',
				  'password' => Hash::make('okall'),
				  'idRole' => '3',
				),
			array('email' => 'leader7@enclave.vn',
				  'password' => Hash::make('okall'),
				  'idRole' => '3',
				),
			array('email' => 'leader8@enclave.vn',
				  'password' => Hash::make('okall'),
				  'idRole' => '3',
				),
			array('email' => 'leader9@enclave.vn',
				  'password' => Hash::make('okall'),
				  'idRole' => '3',
				),
			array('email' => 'leader10@enclave.vn',
				  'password' => Hash::make('okall'),
				  'idRole' => '3',
				),

			]);
	}
}
class TeamMemberTableSeeder extends Seeder{
	public function run(){
		$temp = 1300000012;
		for($i = 1 ; $i < 3; $i++){
			$temp = $temp +1;
		DB::table('TeamMember')->insert([
			array('idTeam' => 5,
				  'idMember' => $temp,
				),
		]);
		}
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
class StatusSeeder extends Seeder{
	public function run(){
		DB::table('E_Status')->insert([
			array('idStatus' => 1,
					'Status' =>'On Working',
			),
			array('idStatus' => 2,
					'Status' =>'Available',
			),
			array('idStatus' => 3,
					'Status' =>'Outside',
			),
		]);
	}
}
class EmployeeTableSeeder extends Seeder{
	
	public function run(){
		$temp = 40;
		$temp1 = 1299999999;
		for($i = 1 ; $i< 16; $i++){
		$temp = $temp + 1;
		$temp1 = $temp1 + 1;
		DB::table('Employee')->insert([
			array(
					'idEmployee' => $temp1,
					'E_Name' => 'Leader'.$i,
					'E_Phone' => $temp,
					'E_Address'=> 'Address'.$i,
					'E_Skype'=> 'Skype'.$i,
					'E_EngName'=> 'Leader'.$i,
					'E_Cost_Hour'=> 10,
					'E_DateofBirth'=> '1994/03/04',
					'idAccount'=> $temp,
					'idStatus'=>1,
					'E_Sex'=>1,
				),
			]);
		}
	}
}
class ClientTableSeeder extends Seeder{
	public function run(){
		$temp =40;
		for($i = 1; $i<6; $i++){
			$temp = $temp+1;
		DB::table('Clients')->insert([
			array(
				'ClientName' => 'Client'.$i,
				'C_Phone' => '120000000'.$i,
				'C_Address'=>'Address'.$i,
				'C_Company'=>'Company'.$i,
				'C_Skype'=>'Skype'.$i,
				'idAccount'=>$temp,
				),

		]);
		}
	}
}
class TeamTableSeeder extends Seeder{
	public function run(){
		$temp = 1000000000;
		for($i = 1; $i < 6; $i++){
			$temp = $temp + 1;
			DB::table('Team')->insert([
				array(
				'idTeam' => $i,
				'TeamName' => 'Team'.$i,
				'idPManager'=>$temp,
				),
			]);
		}
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
class ProjectStatus extends Seeder{
	public function run(){
		DB::table('ProjectStatus')->insert([
			array(
					'idPStatus' => 1,
					'P_Status' => 'In progress',
				),
			array(
					'idPStatus' => 2,
					'P_Status' => 'Done',
				),
		]);
	}
}
class SkillDetailTableSeeder extends Seeder{
	
	public function run(){
		$temp = 1100000000;
		for($i = 1 ; $i < 35 ; $i++){
		$temp = $temp + 1;	
		DB::table('SkillDetail')->insert([
			array(
					'idEmployee' => $temp,
					'idSkill' => 2,
					'S_Rate' => 2,
				),
			]);
		}
	}
}
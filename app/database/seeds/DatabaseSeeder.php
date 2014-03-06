<?php
class DatabaseSeeder extends Seeder {
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Eloquent::unguard ();
		
		$this->call('UserSeeder');
	}
}
class UserSeeder extends Seeder {
	public function run() {
		DB::table ( 'users' )->delete ();
		for($i = 1; $i < 20; $i ++) {
			User::create ( array (
					'first_name' => 'Kuba'.$i,
					'last_name' => 'P',
					'birthday' => date('Y-m-d', strtotime( '30-01-1988' )),
					'email' => 'j'.$i.'p@gmail.com',
					'created_at' => time () 
			) );
		}
	}
}
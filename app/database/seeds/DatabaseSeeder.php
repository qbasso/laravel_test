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
		$this->call('ItemSeeder');
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

class ItemSeeder extends Seeder {
	public function run() {
		DB::table ( 'item' )->delete ();
		$currentUserId = 1;
		for($i = 1; $i < 100; $i ++) {
			Item::create ( array (
			'name' => 'Item'.$i,
			'quantity' => $i,				
			'user_id' => $currentUserId
			) );
			if ($i % 6 == 0) {
				$currentUserId++;
			}
		}
	}
}
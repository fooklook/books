<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		$user = new User();
		$user->name = 'admin';
		$user->email = 'xiashuo.he@foxmail.com';
		$user->password = crypt('admin');
		$user->save();
		// $this->call('UserTableSeeder');
	}

}

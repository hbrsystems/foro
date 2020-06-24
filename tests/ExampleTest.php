<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase {
	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */

//	use DatabaseMigrations;
	use DatabaseTransactions;
	public function testBasicExample() {

		//crear usuario
		$name = 'HENRY BARON';
		$email = 'admin@styde.net';
		$user = factory(\App\User::class)->create([
			'name' => $name,
			'email' => $email]);
		//conectar usuario
		$this->actingAs($user, 'api')
			->visit('api/user')
			->see($name)
			->see($email);
	}
}

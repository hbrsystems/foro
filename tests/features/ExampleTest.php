<?php

class ExampleTest extends FeatureTestCase {
	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */

//	use DatabaseMigrations;
	public function test_basic_example() {

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

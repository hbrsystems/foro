<?php
use App\Post;
use App\User;
abstract class TestCase extends Illuminate\Foundation\Testing\TestCase {
	/**
	 * The base URL to use while testing the application.
	 *
	 * @var string
	 */
	protected $baseUrl = 'http://localhost';
    /**
     * @var \App\User
     */
	protected $defaultUser;

    /**
	 * Creates the application.
	 *
	 * @return \Illuminate\Foundation\Application
	 */
	public function createApplication() {
		$app = require __DIR__ . '/../bootstrap/app.php';

		$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

		return $app;
	}

	public function defaultUser(array $attributes=[]) {
		//creación de usuario default
        if ($this->defaultUser) {
			//ya existe, lo retorna
			return $this->defaultUser;
		}
        //dd($this->defaultUser);
		//no existe, se crea y lo retorna
		return $this->defaultUser = factory(\App\User::class)->create($attributes);
	}

	protected function createPost(array $attributes=[]){
	    return factory(\App\Post::class)->create($attributes);
    }
}

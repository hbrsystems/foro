<?php

use App\Post;
use App\User;

class CreatePostsTest extends FeatureTestCase
{
    public function test_a_user_create_a_post() {

//LO QUE TENEMOS PARA LA PRUEBA
        //vbles que se utiliza varias veces en este metodo
        $title = 'esta es una pregunta';
        $content = 'este es el contenido';
        //crear usuario
        //#1       $user = TestCase::defaultUser();
        //conectar usuario
        //#2       $this->actingAs($user);
        //las 2 instrucciones se pueden integrar así:
        $this->actingAs($user=$this->defaultUser());
//LO QUE SUCEDE EN LA PRUEBA
        $this->visit(route('posts.create'))
            ->type($title, 'title')
            ->type($content, 'content')
            ->press('Publicar');

//LO QUE ESPERAMOS DE LA PRUEBA
        //preguntar si está en la base de datos
        $this->seeInDatabase('posts', [
            'title' => $title,
            'content' => $content,
            'pending' => true,
            'user_id'=>$user->id,
            'slug'=>'esta-es-una-pregunta'
        ]);

        //preguntar si el usuario fue dirigido al elemento título que se ubica en h1 o otra parte
        //el usuario debe ser redirigido al detalle del post
        $this->see( $title);
    }

    public function test_creating_a_post_requires_authentication() {
//LO QUE TENEMOS PARA LA PRUEBA (having)
//LO QUE SUCEDE EN LA PRUEBA (when)
//      $this->visit(route('posts.create'));
//LO QUE ESPERAMOS DE LA PRUEBA (then)
//    $this->seePageIs(route('login'));

        //se pueden encadenar los 2 métodos anteriores así:
        $this->visit(route('posts.create'))
            ->seePageIs(route('login'));
    }

    public function test_create_post_form_validation(){
        $this->actingAs($this->defaultUser())
        ->visit(route('posts.create'))
            ->press('Publicar')
            ->seePageIs(route('posts.create'))
            ->seeErrors([
                'title'=>'el campo título es obligatorio.',
                'content'=>'el campo contenido es obligatorio']);
    }
}
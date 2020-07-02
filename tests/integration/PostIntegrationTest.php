<?php

use App\Post;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostIntegrationTest extends TestCase
{
    use DatabaseTransactions;

    function test_a_slug_is_generate_and_saved_to_the_database()
    {
//se deja usuario aleatorio:        $user=$this->defaultUser();

        $post=$this->createPost([
            'title'=>'Como instalar Laravel'
        ]);

       // dd($post->toArray());

        $this->assertSame(
            'como-instalar-laravel',
            $post->fresh()->slug);
    }


    /*
    function test_a_slug_is_generate_and_saved_to_the_database()
    {
        $user=$this->defaultUser();

        $post=factory(Post::class)->make([
            'title'=>'Como instalar Laravel'
        ]);

        $user->posts()->save($post);

        //forma1 de comprobar post en db
        //$this->assertSame(
         //   'como-instalar-laravel',
          //  $post->fresh()->slug);

        //forma2 de comprobacion post en db
        //$this->seeInDatabase('posts', [
        //   'slug'=>'como-instalar-laravel'
        //]);

        //forma3 de comprob post en db
        $this->assertSame('como-instalar-laravel',$post->slug);
    }
    */
}

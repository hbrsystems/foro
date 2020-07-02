<?php


class ShowPostTest extends FeatureTestCase
{
    public function test_a_user_can_see_the_post_details()
    {
//HAVING
        $user=$this->defaultUser([
            'name'=>'HENRY BARON',
        ]);
        $post=$this->createPost([
            'title'=>'este es el titulo del post',
            'content'=>'este es el contenido del post',
          'user_id'=>$user->id, //se hace aca y no por fuera del factory
//se comentarea user_id para que el $factory de ModelFactory cree el usuario dentro de su factory interno
//sì se asigna user_id por defecto, no se crea otro usuario dentro de $factory del ModelFactory
        ]);

  //      dd(\App\User::all()->toArray(), $post->user_id);
//WHEN
           $this->visit($post->url)
            ->seeInElement('h1',$post->title)
            ->see($post->content)
            ->see($user->name);
    }

    /*
    public function test_a_user_can_see_the_post_details()
    {
        //HAVING
        $user=$this->defaultUser([
            'name'=>'HENRY BARON',
        ]);
        $post=factory(\App\Post::class)->make([
            'title'=>'este es el titulo del post',
            'content'=>'este es el contenido del post',
            'user_id'=>$user->id, //se hace aca y no por fuera del factory
        ]);

        dd(\App\User::all()->toArray(), $post->user_id);

        //       $user->posts()->save($post); //se puso dentro factory
//        dd($post->url);
        //WHEN
//forma1:
        //    $this->visit(route('posts.show',[$post->id,$post->slug]));
//forma2:
        $this->visit($post->url)
            ->seeInElement('h1',$post->title)
            ->see($post->content)
            ->see($user->name);
    }
*/


    public function test_old_urls_are_redirected()  {
        //HAVING

        //dejar autor aleatorio: $user=$this->defaultUser();
        $post=$this->createPost([
            'title'=>'old title',
        ]);
        //WHEN
        //dejar autor aleatorio: $user->posts()->save($post);
        $url=$post->url;
        //THEN
        $post->update(['title'=>'new title']);
        $this->visit($url)
            ->seePageIs($post->url);
    }


    public function test_post_url_with_wrong_slugs_still_work()
    {
        //HAVING
        $user=$this->defaultUser();
        $post=factory(\App\Post::class)->make([
            'title'=>'old title',
        ]);
        //WHEN
        $user->posts()->save($post);
        $url=$post->url;
        //THEN
        $post->update(['title'=>'new title']);
        //forma1:
        //    $this->visit($url)
        //forma2:
        $this->get($url)
//forma1:
  //          ->assertResponseOk();
                //forma2: y controlando el error en el PostController
        ->assertResponseStatus(301);//404 archivo no existe, 301 redirección
    }
}

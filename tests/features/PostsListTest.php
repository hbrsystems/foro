<?php

use App\Post;
use Carbon\Carbon;

class PostsListTest extends FeatureTestCase
{

        public function test_a_user_can_see_the_posts_list_a_go_to_the_details()
    {
        $post=$this->createPost([
            'title'=>'debo usar laravel 5.1 o 5.3 LTS?'
        ]);
        $this->visit('/')
            ->seeInElement('h1', 'Posts')
            ->see($post->title)
            ->click($post->title)
            ->seePageIs($post->url);
    }

    public function test_a_posts_are_paginated(){
            //having...
        //simular que el post se crea 2 dias antes
        $first = factory(Post::class )->create([
            'title'=>'Post mas antiguo',
            'created_at'=>Carbon::now()->subDays(2)]);

        factory(Post::class )->times(15)->create([
            'created_at'=>Carbon::now()->subDays(0)
        ]);

        $last = factory(Post::class )->create([
            'title'=>'Post más reciente',
             'created_at'=>Carbon::now()
        ]);
        //when

 //       dd($first->toArray(),$last->toArray());
//arreglar para que se convierta variable el post #2 porque la prueba falla
        //cuando hayan muchos mas post
        $this->visit('/')
            ->see($last->title)
            ->dontSee($first->title)
            ->click('2')
            ->see($first->title)
            ->dontSee($last->title);
    }
}

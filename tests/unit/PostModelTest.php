<?php

use App\Post;
class PostModelTest extends TestCase
{

    function test_adding_a_title_generates_a_slug()
    {
        $post = new Post([
           'title'=>'Como instalar Laravel'
        ]);
        $this->assertSame('como-instalar-laravel', $post->slug);
    } //para crear el post se usa eloquent en vez de factory

    function test_editing_the_title_changes_the_slug()
    {
        $post = new Post([
            'title'=>'Como instalar Laravel'
        ]);
        $post->title='como instalar laravel 5.1 LTS';
        $this->assertSame('como-instalar-laravel-51-lts', $post->slug);
    }
}

<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WriteCommentTest extends FeatureTestCase
{
    public function test_a_user_can_write_a_comment()
    {
        $post=$this->createPost();
        $user=$this->defaultUser();
        $this->actingAs($user)
            ->visit($post->url)
            ->type('un comentario', 'comment')
            ->press('Publicar comentario');

        $this->seeInDatabase('comments', [
            'comment'=>'un comentario',
            'user_id'=>$user->id,
            'post_id'=>$post->id,
        ]);

        $this->seePageIs($post->url);
    }
}

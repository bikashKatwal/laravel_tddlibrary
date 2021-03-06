<?php

namespace Tests\Feature;

use App\Author;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Throwable;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function an_author_can_be_created()
    {
        //$this->withoutExceptionHandling();
        //Action
        $this->post('/author', [
            'name' => 'Author Name',
            'dob' => '05/14/1988'
        ]);

        $author = Author::all();

        //Expect: I want the count to be 1.
        $this->assertCount(1, $author);
        $this->assertInstanceOf(Carbon::class, $author->first()->dob);
        $this->assertEquals('1988/14/05', $author->first()->dob->format('Y/d/m'));
    }


}

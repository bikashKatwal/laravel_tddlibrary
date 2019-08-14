<?php

namespace Tests\Feature;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookManagementTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function a_book_can_be_added_to_the_library()
    {
        $this->withoutExceptionHandling();

        //Action
        $response = $this->post('/books', [
            'title' => 'Cool Book Title',
            'author' => 'Victor'
        ]);
        $book = Book::first();

        //$response->assertOk();// NOT Required if we are doing assertRedirect

        //Expected: I want the count to be 1.
        $this->assertCount(1, Book::all());
        $response->assertRedirect($book->path());
    }

    /** @test */
    public function a_title_is_required()
    {
        $response = $this->post('/books', [
            'title' => '',
            'author' => 'Victor'
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_author_is_required()
    {
        $response = $this->post('/books', [
            'title' => 'Cool Title',
            'author' => ''
        ]);

        $response->assertSessionHasErrors('author');
    }

    /** @test */
    public function a_book_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $this->post('/books', [
            'title' => 'Cool Title',
            'author' => 'Victor'
        ]);

        $book = Book::first();

        //Action
        $response = $this->patch($book->path(), [
            'title' => 'New Title',
            'author' => 'New Author'
        ]);

        //Expect i.e I expect my title to be 'New Title'
        $this->assertEquals('New Title', Book::first()->title);
        $this->assertEquals('New Author', Book::first()->author);
        $response->assertRedirect($book->path());
    }

    /** @test */
    public function a_book_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $this->post('/books', [
            'title' => 'Cool Title',
            'author' => 'Victor'
        ]);

        $book = Book::first();
        $this->assertCount(1, Book::all());

        //Action
        $response = $this->delete($book->path());

        //Expect i.e I want the count to be 0.
        $this->assertCount(0, Book::all());
        $response->assertRedirect('/books');
    }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookReservationTest extends TestCase
{
    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function a_book_can_be_added_to_the_library()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/books',[
           'title'=>'Cool Book Title',
           'author'=>'Victor'
        ]);

        $response->assertOk();
        $this->assertCount(1, \App\Book::all());
    }
}

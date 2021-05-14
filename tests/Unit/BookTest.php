<?php

namespace Tests\Unit;

use App\Models\Author;
//use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Book;

class BookTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_book_belongs_to_author()
    {
        $book = Book::factory()->create();

        $this->assertInstanceOf(Author::class, $book->author);
    }
}

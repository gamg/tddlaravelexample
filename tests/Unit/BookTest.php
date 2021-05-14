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

    public function test_get_title_in_uppercase()
    {
        $book = Book::factory()->create(['title' => 'New Book Title']);

        $this->assertEquals('NEW BOOK TITLE', $book->title);
    }

    public function test_save_title_without_spaces()
    {
        $book = Book::factory()->create(['title' => ' New book TItle ']);

        $this->assertEquals('NEW BOOK TITLE', $book->title);
        $this->assertDatabaseHas('books', ['title' => 'new book title']);
    }
}

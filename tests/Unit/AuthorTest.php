<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_author_has_many_books()
    {
        $author = Author::factory()->create();

        $this->assertInstanceOf(Collection::class, $author->books);
    }

    public function test_get_name_in_uppercase()
    {
        $author = Author::factory()->create(['name' => 'New NAME']);

        $this->assertEquals('NEW NAME', $author->name);
    }

    public function test_save_name_without_spaces()
    {
        $author = Author::factory()->create(['name' => '   New NAME  ']);

        $this->assertEquals('NEW NAME', $author->name);
        $this->assertDatabaseHas('authors', ['name' => 'new name']);
    }
}

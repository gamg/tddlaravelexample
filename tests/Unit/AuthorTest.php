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
        $author = Author::factory()->create(['name' => 'Nuevo NOMBRE']);

        $this->assertEquals('NUEVO NOMBRE', $author->name);
    }
}

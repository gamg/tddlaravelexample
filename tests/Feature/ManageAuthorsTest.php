<?php

namespace Tests\Feature;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageAuthorsTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_access()
    {
        $author = Author::factory()->create();
        $login = route('login');

        $this->get(route('authors.index'))->assertRedirect($login);
        $this->get(route('authors.create'))->assertRedirect($login);
        $this->get(route('authors.edit', $author))->assertRedirect($login);
    }
}

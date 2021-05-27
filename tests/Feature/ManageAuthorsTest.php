<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\User;
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

    public function test_author_index()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Author::factory()->create(['name' => ' Author 1']);
        Author::factory()->create(['name' => ' Author 2 ']);
        Author::factory()->create(['name' => ' Author 3  ']);

        $response = $this->get(route('authors.index'));

        $response->assertStatus(200)->assertSee('Authors list')
                ->assertSee('AUTHOR 1')
                ->assertSee('AUTHOR 2')
                ->assertSee('AUTHOR 3')
                ->assertViewHas('authors');
    }
}

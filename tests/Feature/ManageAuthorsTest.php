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

    public function test_if_authors_list_is_empty()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('authors.index'));

        $response->assertStatus(200)
            ->assertSee('Authors list')
            ->assertSee('There is not data to show')
            ->assertViewHas('authors');
    }

    public function test_create_author()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('authors.create'));

        $response->assertStatus(200)
            ->assertSee('Create Author');
    }

    public function test_store_author()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $fields = Author::factory()->raw(['name' => 'Adolfo']);

        $response = $this->from(route('authors.create'))
                    ->post(route('authors.store'), $fields);

        $response->assertRedirect(route('authors.create'))
            ->assertSessionHas('status', 'Author registered successfully');

        $this->assertDatabaseHas('authors', ['name' => 'adolfo']);
    }

    public function test_store_author_with_required_name()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $fields = Author::factory()->raw(['name' => '']);

        $response = $this->from(route('authors.create'))
            ->post(route('authors.store'), $fields);

        $response->assertStatus(302)
            ->assertSessionHasErrors('name');
    }
}

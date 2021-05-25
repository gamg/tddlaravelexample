<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_logged_in_can_visit_dashboard()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $this->get('/dashboard')->assertStatus(200);
    }
}

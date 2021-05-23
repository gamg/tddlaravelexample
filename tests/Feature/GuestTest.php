<?php

namespace Tests\Feature;

use Tests\TestCase;

class GuestTest extends TestCase
{
    public function test_guests_are_redirected_to_login()
    {
        $this->get('/')
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }
}

<?php

namespace Tests\Feature;

use App\Models\Chirp;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChirpDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_requires_authentication(): void
    {
        $this->get(route('chirps.index'))->assertRedirect(route('login'));
    }

    public function test_user_can_view_create_update_and_delete_chirps(): void
    {
        $user = User::factory()->create(['password' => 'password']);

        $this->actingAs($user)
            ->get(route('chirps.index'))
            ->assertOk()
            ->assertSee('Latest Chirps');

        $this->post(route('chirps.store'), ['message' => 'First chirp'])
            ->assertRedirect(route('chirps.index'));

        $chirp = Chirp::firstOrFail();
        $this->assertSame('First chirp', $chirp->message);

        $this->put(route('chirps.update', $chirp), ['message' => 'Updated chirp'])
            ->assertRedirect(route('chirps.index'));
        $this->assertDatabaseHas('chirps', ['id' => $chirp->id, 'message' => 'Updated chirp']);

        $this->delete(route('chirps.destroy', $chirp))
            ->assertRedirect(route('chirps.index'));
        $this->assertDatabaseMissing('chirps', ['id' => $chirp->id]);
    }

    public function test_users_cannot_modify_another_users_chirp(): void
    {
        $owner = User::factory()->create(['password' => 'password']);
        $otherUser = User::factory()->create(['password' => 'password']);
        $chirp = $owner->chirps()->create(['message' => 'Private to owner']);

        $this->actingAs($otherUser)
            ->put(route('chirps.update', $chirp), ['message' => 'Changed'])
            ->assertForbidden();

        $this->delete(route('chirps.destroy', $chirp))->assertForbidden();
        $this->assertDatabaseHas('chirps', ['id' => $chirp->id, 'message' => 'Private to owner']);
    }
}

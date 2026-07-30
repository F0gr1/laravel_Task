<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification as NotificationFacade;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_uses_standard_email_verification(): void
    {
        NotificationFacade::fake();

        $response = $this->post('/register', [
            'name' => 'New User',
            'email' => 'new@example.com',
            'password' => 'Password!12345',
            'password_confirmation' => 'Password!12345',
        ]);

        $response->assertRedirect('/home');

        $user = User::query()->where('email', 'new@example.com')->firstOrFail();
        $this->assertNull($user->email_verified_at);
        $this->assertFalse((bool) $user->email_verified);
        $this->assertSame(0, $user->status);
        $this->assertNull($user->email_verify_token);
        NotificationFacade::assertSentTo($user, VerifyEmail::class);
    }

    public function test_unverified_users_cannot_access_tasks(): void
    {
        $user = User::factory()->unverified()->create();
        $this->actingAs($user)
            ->get('/home')
            ->assertRedirect('/email/verify');
    }

    public function test_legacy_verified_status_is_accepted_for_existing_users(): void
    {
        $user = User::factory()->create();
        $user->forceFill([
            'status' => 1,
            'email_verified' => true,
        ])->save();

        $this->assertTrue($user->fresh()->hasVerifiedEmail());
    }
}

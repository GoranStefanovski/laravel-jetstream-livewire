<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_add_a_user()
    {
        $admin = User::factory()->create();
        $this->actingAs($admin);

        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Public User']);

        Livewire::test('add-user')
            ->set('name', 'Test User')
            ->set('email', 'testuser@example.com')
            ->set('password', 'password123')
            ->set('role', 'Admin')
            ->call('addUser')
            ->assertRedirect('/users')
            ->assertSessionHas('message', 'User added successfully!');

        $this->assertDatabaseHas('users', [
            'email' => 'testuser@example.com',
            'name' => 'Test User',
        ]);

        $user = User::where('email', 'testuser@example.com')->first();
        $this->assertTrue($user->hasRole('Admin'));
    }

    /** @test */
    public function it_can_edit_a_user()
    {
        $admin = User::factory()->create();
        $this->actingAs($admin);

        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Public User']);

        $user = User::factory()->create([
            'name' => 'Old Name',
            'email' => 'oldemail@example.com',
            'password' => Hash::make('password123')
        ]);

        $user->assignRole('Public User');

        Livewire::test('edit-user', ['id' => $user->id])
            ->set('name', 'Updated Name')
            ->set('email', 'updatedemail@example.com')
            ->set('password', 'newpassword123')
            ->set('role', 'Admin')
            ->call('updateUser')
            ->assertRedirect('/users')
            ->assertSessionHas('message', 'User updated successfully!');

        $this->assertDatabaseHas('users', [
            'email' => 'updatedemail@example.com',
            'name' => 'Updated Name',
        ]);

        $user = User::where('email', 'updatedemail@example.com')->first();
        $this->assertTrue($user->hasRole('Admin'));
    }

    /** @test */
    public function it_can_delete_a_user()
    {
        $admin = User::factory()->create();
        $this->actingAs($admin);

        $user = User::factory()->create([
            'name' => 'User to Delete',
            'email' => 'deleteuser@example.com',
            'password' => Hash::make('password123')
        ]);

        Livewire::test('user-list')
            ->call('deleteUser', $user->id);

        $this->assertDatabaseMissing('users', [
            'email' => 'deleteuser@example.com',
        ]);
    }
}

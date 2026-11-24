<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    public function test_technician_can_open_the_workshop_dashboard()
    {
        $technician = new User(['name' => 'Teknisi', 'role' => 'teknisi']);

        $this->actingAs($technician)
            ->get('/dashboard')
            ->assertOk();
    }

    public function test_customer_cannot_open_the_workshop_dashboard()
    {
        $customer = new User(['name' => 'Pelanggan', 'role' => 'pelanggan']);

        $this->actingAs($customer)
            ->get('/dashboard')
            ->assertRedirect('/status-servis');
    }
}

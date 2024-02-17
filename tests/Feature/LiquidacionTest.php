<?php

namespace Tests\Feature;

use App\Models\Estatuto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestTenantCase;

class LiquidacionTest extends TestTenantCase
{
    use RefreshDatabase;

    protected $tenancy = true;

    public function setUp(): void
    {
        parent::setUp();

        Estatuto::create([
            'nombre' => 'Test Estatuto',
            'desde' => 1970,
            'hasta' => now()->year,
            'interes' => 0.01,
        ]);
    }

    public function test_liquidacion_no_debt(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_liquidacion_debt_1year(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_liquidacion_debt_5year(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_liquidacion_debt_10year(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}

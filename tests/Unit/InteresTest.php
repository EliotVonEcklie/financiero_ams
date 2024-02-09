<?php

namespace Tests\Unit;

use App\Models\Interes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestTenantCase;

class InteresTest extends TestTenantCase
{
    use RefreshDatabase;

    public function test_intereses(): void
    {
        $this->assertTrue(true);
    }
}

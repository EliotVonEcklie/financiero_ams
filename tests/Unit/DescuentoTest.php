<?php

namespace Tests\Unit;

use App\Models\Descuento;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestTenantCase;

class DescuentoTest extends TestTenantCase
{
    use RefreshDatabase;

    protected $tenancy = true;

    public function test_descuento_intereses(): void
    {
        Descuento::create([
            'es_nacional' => true,
            'hasta' => now()->year,
            'porcentaje' => 69,
        ]);

        $this->assertSame(Descuento::getDescuentoIntereses(now()->startOfYear()), 69);
    }

    public function test_descuento_incentivo(): void
    {
        Descuento::create([
            'es_nacional' => false,
            'hasta' => now()->month,
            'porcentaje' => 69,
        ]);

        $this->assertSame(Descuento::getDescuentoIncentivo(now()->startOfMonth()), 69);
    }

    public function test_many_descuentos(): void
    {
        Descuento::create([
            'es_nacional' => false,
            'hasta' => 1,
            'porcentaje' => 3,
        ]);

        Descuento::create([
            'es_nacional' => false,
            'hasta' => 2,
            'porcentaje' => 2,
        ]);

        Descuento::create([
            'es_nacional' => false,
            'hasta' => 3,
            'porcentaje' => 1,
        ]);

        $this->assertSame(Descuento::getDescuentoIncentivo(now()->setMonth(1)->startOfMonth()), 3);
        $this->assertSame(Descuento::getDescuentoIncentivo(now()->setMonth(2)->startOfMonth()), 2);
        $this->assertSame(Descuento::getDescuentoIncentivo(now()->setMonth(3)->startOfMonth()), 1);
        $this->assertSame(Descuento::getDescuentoIncentivo(now()->setMonth(4)->startOfMonth()), 0);
    }

    public function test_last_day(): void
    {
        Descuento::create([
            'es_nacional' => false,
            'hasta' => 1,
            'porcentaje' => 1,
        ]);

        $this->assertSame(Descuento::lastDay(), now()->setMonth(1)->endOfMonth());
    }
}

<?php

namespace Tests\Unit;

use App\Models\Descuento;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestTenantCase;

class DescuentoTest extends TestTenantCase
{
    use RefreshDatabase;

    protected $tenancy = true;

    public function test_nacional_descuento(): void
    {
        Descuento::create([
            'es_nacional' => true,
            'hasta' => now()->year,
            'porcentaje' => 10,
        ]);

        $this->assertSame(Descuento::getDescuento(now()), 10);
    }

    public function test_monthly_descuento(): void
    {
        Descuento::create([
            'es_nacional' => false,
            'hasta' => now()->month,
            'porcentaje' => 10,
        ]);

        $this->assertSame(Descuento::getDescuento(now()), 10);
    }

    public function test_monthly_and_nacional_descuento(): void
    {
        Descuento::create([
            'es_nacional' => true,
            'hasta' => now()->year,
            'porcentaje' => 10,
        ]);

        Descuento::create([
            'es_nacional' => false,
            'hasta' => now()->month,
            'porcentaje' => 20,
        ]);

        $this->assertSame(Descuento::getDescuento(now()), 10);
    }

    public function test_successive_descuentos(): void
    {
        $now = now();

        Descuento::create([
            'es_nacional' => true,
            'hasta' => $now->year,
            'porcentaje' => 50,
        ]);

        Descuento::create([
            'es_nacional' => false,
            'hasta' => $now->month,
            'porcentaje' => 20,
        ]);

        Descuento::create([
            'es_nacional' => false,
            'hasta' => $now->addMonth()->month,
            'porcentaje' => 10,
        ]);

        Descuento::create([
            'es_nacional' => false,
            'hasta' => $now->addMonth()->month,
            'porcentaje' => 5,
        ]);

        $now->subMonths(2);

        $this->assertSame(Descuento::getDescuento($now), 50);
        $this->assertSame(Descuento::getDescuento($now->addYear()), 20);
        $this->assertSame(Descuento::getDescuento($now->addMonth()), 10);
        $this->assertSame(Descuento::getDescuento($now->addMonth()), 5);
        $this->assertSame(Descuento::getDescuento($now->addMonth()), 0);
    }
}

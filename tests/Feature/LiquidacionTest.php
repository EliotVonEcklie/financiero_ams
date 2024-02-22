<?php

namespace Tests\Feature;

use App\Helpers\Liquidacion;
use App\Models\CodigoDestinoEconomico;
use App\Models\Descuento;
use App\Models\Estatuto;
use App\Models\Interes;
use App\Models\Predio;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestTenantCase;

class LiquidacionTest extends TestTenantCase
{
    use RefreshDatabase, WithFaker;

    protected $tenancy = true;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $predio = Predio::create([
            'codigo_catastro' => '0000001234567890123456789',
            'total' => 1
        ]);

        $predio->informacions()->create([
            'codigo_destino_economico_id' => CodigoDestinoEconomico::create(['codigo' => 'A'])->id,
            'direccion' => 'Calle 123',
            'hectareas' => 1,
            'metros_cuadrados' => 1,
            'area_construida' => 1,
            'predio_tipo_id' => 1
        ]);

        $predio->propietarios()->create([
            'orden' => 1,
            'tipo_documento' => 'C',
            'documento' => '12345678',
            'nombre_propietario' => 'JUAN'
        ]);

        for ($i = (now()->year - 9); $i <= now()->year; $i++) {
            for ($j = 1; $j <= 12; $j++) {
                Interes::create([
                    'vigencia' => $i,
                    'mes' => $j,
                    'moratorio' => 10
                ]);
            }

            $predio->avaluos()->create([
                'vigencia' => $i,
                'valor_avaluo' => 100_000_000,
                'tasa_por_mil' => 1
            ]);
        }

        Descuento::create([
            'hasta' => 12,
            'porcentaje' => 10
        ]);

        Estatuto::create([
            'nombre' => '',
            'vigencia_desde' => now()->year - 9,
            'vigencia_hasta' => now()->year,
            'norma_predial' => true,
            'bomberil' => true,
            'bomberil_predial' => true,
            'bomberil_tarifa' => true,
            'bomberil_tasa' => 1,
            'ambiental' => true,
            'ambiental_predial' => true,
            'ambiental_tarifa' => true,
            'ambiental_tasa' => 1,
            'alumbrado' => false,
            'recibo_caja' => 1000
        ]);

        Carbon::setTestNow(now()->startOfYear());
    }

    public function test_liquidacion_no_debt(): void
    {
        $predio = Predio::firstWhere(['codigo_catastro' => '0000001234567890123456789']);

        $liquidacion = (new Liquidacion($predio, [now()->year]))->toArray();

        print_r($liquidacion);

        $this->assertEquals($liquidacion['total_liquidacion'], 91_180);
        $this->assertEquals($liquidacion['total_valor_avaluo'], 100_000_000);
        $this->assertEquals($liquidacion['total_predial'], 90_000);
        $this->assertEquals($liquidacion['total_predial_descuento'], 10_000);
        $this->assertEquals($liquidacion['total_predial_intereses'], 0);
        $this->assertEquals($liquidacion['total_predial_descuento_intereses'], 0);

        $this->assertEquals($liquidacion['total_bomberil'], 90);
        $this->assertEquals($liquidacion['total_bomberil_intereses'], 0);
        $this->assertEquals($liquidacion['total_bomberil_descuento_intereses'], 0);

        $this->assertEquals($liquidacion['total_ambiental'], 90);
        $this->assertEquals($liquidacion['total_ambiental_intereses'], 0);
        $this->assertEquals($liquidacion['total_ambiental_descuento_intereses'], 0);

        $this->assertEquals($liquidacion['total_alumbrado'], 0);

        $this->assertEquals($liquidacion['total_intereses'], 0);
    }

    public function test_liquidacion_debt_2year(): void
    {
        $predio = Predio::firstWhere(['codigo_catastro' => '0000001234567890123456789']);

        $y = now()->year - 1;

        $liquidacion = (new Liquidacion($predio, [$y++, $y]))->toArray();

        print_r($liquidacion);

        $this->assertEquals($liquidacion['total_liquidacion'], 202_400);
        $this->assertEquals($liquidacion['total_valor_avaluo'], 200_000_000);
        $this->assertEquals($liquidacion['total_predial'], 190_000);
        $this->assertEquals($liquidacion['total_predial_descuento'], 10_000);
        $this->assertEquals($liquidacion['total_predial_intereses'], 10_000);
        $this->assertEquals($liquidacion['total_predial_descuento_intereses'], 0);

        $this->assertEquals($liquidacion['total_bomberil'], 190);
        $this->assertEquals($liquidacion['total_bomberil_intereses'], 10);
        $this->assertEquals($liquidacion['total_bomberil_descuento_intereses'], 0);

        $this->assertEquals($liquidacion['total_ambiental'], 190);
        $this->assertEquals($liquidacion['total_ambiental_intereses'], 10);
        $this->assertEquals($liquidacion['total_ambiental_descuento_intereses'], 0);

        $this->assertEquals($liquidacion['total_alumbrado'], 0);

        $this->assertEquals($liquidacion['total_intereses'], 10_020);
    }

    public function test_liquidacion_debt_5year(): void
    {
        $predio = Predio::firstWhere(['codigo_catastro' => '0000001234567890123456789']);

        $y = now()->year - 4;

        $liquidacion = (new Liquidacion($predio, [$y++, $y++, $y++, $y++, $y]))->toArray();

        print_r($liquidacion);

        $this->assertEquals($liquidacion['total_liquidacion'], 596_183);
        $this->assertEquals($liquidacion['total_valor_avaluo'], 500_000_000);
        $this->assertEquals($liquidacion['total_predial'], 490_000);
        $this->assertEquals($liquidacion['total_predial_descuento'], 10_000);
        $this->assertEquals($liquidacion['total_predial_intereses'], 100_003);
        $this->assertEquals($liquidacion['total_predial_descuento_intereses'], 0);

        $this->assertEquals($liquidacion['total_bomberil'], 490);
        $this->assertEquals($liquidacion['total_bomberil_intereses'], 100);
        $this->assertEquals($liquidacion['total_bomberil_descuento_intereses'], 0);

        $this->assertEquals($liquidacion['total_ambiental'], 490);
        $this->assertEquals($liquidacion['total_ambiental_intereses'], 100);
        $this->assertEquals($liquidacion['total_ambiental_descuento_intereses'], 0);

        $this->assertEquals($liquidacion['total_alumbrado'], 0);

        $this->assertEquals($liquidacion['total_intereses'], 100_203);
    }

    public function test_liquidacion_debt_10year(): void
    {
        $predio = Predio::firstWhere(['codigo_catastro' => '0000001234567890123456789']);

        $liquidacion = (new Liquidacion($predio))->toArray();

        print_r($liquidacion);

        $this->assertEquals($liquidacion['total_liquidacion'], 1_452_886);
        $this->assertEquals($liquidacion['total_valor_avaluo'], 1_000_000_000);
        $this->assertEquals($liquidacion['total_predial'], 990_000);
        $this->assertEquals($liquidacion['total_predial_descuento'], 10_000);
        $this->assertEquals($liquidacion['total_predial_intereses'], 450_006);
        $this->assertEquals($liquidacion['total_predial_descuento_intereses'], 0);

        $this->assertEquals($liquidacion['total_bomberil'], 990);
        $this->assertEquals($liquidacion['total_bomberil_intereses'], 450);
        $this->assertEquals($liquidacion['total_bomberil_descuento_intereses'], 0);

        $this->assertEquals($liquidacion['total_ambiental'], 990);
        $this->assertEquals($liquidacion['total_ambiental_intereses'], 450);
        $this->assertEquals($liquidacion['total_ambiental_descuento_intereses'], 0);

        $this->assertEquals($liquidacion['total_alumbrado'], 0);

        $this->assertEquals($liquidacion['total_intereses'], 450_906);
    }
}

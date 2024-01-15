<?php

namespace Tests\Feature;

use Tests\TestTenantCase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ParseIgac;
use App\Jobs\TransferPredios;
use Illuminate\Database\Schema\Blueprint;

class PrediosIgacTest extends TestTenantCase
{
    protected $tenancy = true;

    public function test(): void
    {
        $test_contents = <<<EOF
5022300010000000100010000000001001001ANGEL RODRIGO BARRETO FLOREZ                                                                         C17161929    EL JARDIN                                                                                            D00000000015210000019800000002279400001012023000100010001000
5022300010000000100110000000001001007ELIDIA ROMERO GUZMAN                                                                                 C41563321    BRISAS DEL ARIARI                                                                                    D00000000032812500023500000003885300001012023000100010011000
5022300010000000100110000000001002007PEDRO JULIO ROMERO CASTRO                                                                            C17105368    BRISAS DEL ARIARI                                                                                    D00000000032812500023500000003885300001012023000100010011000
5022300010000000100110000000001003007ODILIA ROMERO CASTRO                                                                                 C51613827    BRISAS DEL ARIARI                                                                                    D00000000032812500023500000003885300001012023000100010011000
5022300010000000100110000000001004007MARIA CELMIRA ROMERO CASTRO                                                                          C51726503    BRISAS DEL ARIARI                                                                                    D00000000032812500023500000003885300001012023000100010011000
5022300010000000100110000000001005007GLADYS ROMERO CASTRO                                                                                 C31036695    BRISAS DEL ARIARI                                                                                    D00000000032812500023500000003885300001012023000100010011000
5022300010000000100110000000001006007MARINA ROMERO TINOCO                                                                                 C41669344    BRISAS DEL ARIARI                                                                                    D00000000032812500023500000003885300001012023000100010011000
5022300010000000100110000000001007007ANA CECILIA ROMERO GARZON                                                                            C41502686    BRISAS DEL ARIARI                                                                                    D00000000032812500023500000003885300001012023000100010011000
EOF;
        Storage::put('igac-r1.test', $test_contents);

        Schema::create('tesopredios', function (Blueprint $table) {
            $table->string('cedulacatastral', 30);
            $table->string('ord', 4);
            $table->string('tot', 4);
            $table->string('e');
            $table->string('d');
            $table->string('documento');
            $table->string('nombrepropietario');
            $table->string('direccion');
            $table->string('ha');
            $table->string('met2');
            $table->string('areacon');
            $table->double('avaluo');
            $table->string('vigencia', 4);
            $table->string('estado');
            $table->string('tipopredio');
            $table->string('clasifica');
            $table->string('estratos');
            $table->primary(['cedulacatastral', 'ord', 'tot', 'vigencia']);
        });

        Schema::create('tesoprediosavaluos', function (Blueprint $table) {
            $table->string('vigencia', 4);
            $table->string('codigocatastral', 30);
            $table->double('avaluo');
            $table->string('pago');
            $table->string('estado');
            $table->string('ord');
            $table->string('tot');
            $table->string('ha');
            $table->string('met2');
            $table->string('areacon');
            $table->string('tasa');
            $table->string('tipopredio');
            $table->string('estratos');
            $table->string('destino_economico');
            $table->string('tasa_bomberil');
            $table->unique(['vigencia', 'codigocatastral']);
        });

        Bus::chain([
            new ParseIgac('igac-r1.test', null),
            new TransferPredios
        ])->dispatch();

        $this->assertDatabaseCount('predios', 8);

        $this->assertDatabaseHas('predios', [
            'codigo_catastro' => '0001000000010001000000000',
            'orden' => 1,
            'total' => 1
        ]);

        $this->assertDatabaseHas('tesopredios', [
            'cedulacatastral' => '0001000000010001000000000',
            'ord' => '001',
            'tot' => '001',
            'e' => '',
            'd' => 'C',
            'documento' => '17161929',
            'nombrepropietario' => 'ANGEL RODRIGO BARRETO FLOREZ',
            'direccion' => 'EL JARDIN',
            'ha' => '15',
            'met2' => '2100',
            'areacon' => '198',
            'avaluo' => '22794000',
            'vigencia' => '2023',
            'estado' => 'S',
            'tipopredio' => 'rural'
        ]);

        $this->assertDatabaseHas('tesoprediosavaluos', [
            'vigencia' => '2023',
            'codigocatastral' => '0001000000010001000000000',
            'avaluo' => '22794000',
            'pago' => 'N',
            'estado' => 'S',
            'ord' => '001',
            'tot' => '001',
            'ha' => '15',
            'met2' => '2100',
            'areacon' => '198',
            'tasa' => '-1',
            'tipopredio' => 'rural',
            'estratos' => '',
            'destino_economico' => 'D',
            'tasa_bomberil' => '0'
        ]);

        Schema::drop('tesoprediosavaluos');
        Schema::drop('tesopredios');

        Storage::delete('igac-r1.test');
    }
}

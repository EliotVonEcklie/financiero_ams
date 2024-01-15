<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Calculations\RoundPesos;

class RoundPesosTest extends TestCase
{
    public function test(): void
    {
        $this->assertEquals(50, RoundPesos::round(1));
        $this->assertEquals(50, RoundPesos::round(50));
        $this->assertEquals(950, RoundPesos::round(950));
        $this->assertEquals(1000, RoundPesos::round(951));
        $this->assertEquals(1000, RoundPesos::round(1000));
        $this->assertEquals(1050, RoundPesos::round(1001));
        $this->assertEquals(1050, RoundPesos::round(1049));
        $this->assertEquals(1050, RoundPesos::round(1050));
        $this->assertEquals(1100, RoundPesos::round(1051));
        $this->assertEquals(1100, RoundPesos::round(1099));
    }
}

<?php

namespace Tests;

use App\Models\Tenant;

class TestTenantCase extends TestCase
{
    protected $tenancy = false;
    protected $tenant;

    public function setUp(): void
    {
        parent::setUp();

        if ($this->tenancy) {
            $this->initializeTenancy();
        }
    }

    public function tearDown(): void
    {
        if ($this->tenancy) {
            $this->tenant->delete();
        }

        parent::tearDown();
    }

    public function initializeTenancy()
    {
        $this->tenant = Tenant::create();

        tenancy()->initialize($this->tenant);
    }
}

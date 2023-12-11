<?php

namespace App\Http\Controllers;

use App\Jobs\ParseIgac;
use App\Jobs\TransferPredios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

class IgacParserController extends Controller
{
    public function store(Request $request) {
        if (!$request->hasFile('igac_r1') || !$request->hasFile('igac_r2') || !$request->igac_r1->isValid() || !$request->igac_r2->isValid()) {
            return to_route('admin.test_igac', ['errors' => ['Invalid files']]);
        }

        // Store the files while we process them.
        $path_r1 = $request->igac_r1->store('igac');
        $path_r2 = $request->igac_r2->store('igac');

        // Dispatch the jobs.

        Bus::chain([
            new ParseIgac($path_r1, $path_r2),
            new TransferPredios
        ])->dispatch();

        return to_route('admin.test_igac')->with('success', 'Job started successfully');
    }

    public function create() {
        return view('admin.test_igac');
    }
}

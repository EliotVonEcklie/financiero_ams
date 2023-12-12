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
            return response('Invalid files', 400);
        }

        // Store the files while we process them.
        $path_r1 = $request->igac_r1->store('igac');
        $path_r2 = $request->igac_r2->store('igac');

        // Dispatch the jobs.
        Bus::chain([
            new ParseIgac($path_r1, $path_r2),
            new TransferPredios
        ])->dispatch();
    }
}

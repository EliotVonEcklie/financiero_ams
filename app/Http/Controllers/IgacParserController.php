<?php

namespace App\Http\Controllers;

use App\Jobs\ParseIgac;
use App\Jobs\TransferPredios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;

class IgacParserController extends Controller
{
    public function store(Request $request) {
        if (!$request->hasFile('igac_r1') || !$request->igac_r1->isValid()) {
            return response('Invalid files', 400);
        }

        // Store the files while we process them.
        $path_r1 = $request->igac_r1->store('igac');

        if ($request->enable_r2 && $request->hasFile('igac_r2') && $request->igac_r2->isValid()) {
            $path_r2 = $request->igac_r2->store('igac');
        } else {
            $path_r2 = null;
        }

        // Dispatch the jobs.
        Bus::chain([
            new ParseIgac($path_r1, $path_r2),
            new TransferPredios
        ])->dispatch();
    }

    public function status() {
        return response()->json(Cache::get('parse_igac'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIgacRequest;
use App\Jobs\ParseIgac;

class UploadIgacController extends Controller
{
    public function store(StoreIgacRequest $request) {
        $validated = $request->validated();

        // Store the files while we process them.
        $path_r1 = $validated['igac_r1']->store('igac');

        if ($validated['igac_r1'] && $request->hasFile('igac_r2')) {
            $path_r2 = $validated['igac_r2']->store('igac');
        } else {
            $path_r2 = null;
        }

        // Dispatch the jobs.
        ParseIgac::dispatch($path_r1, $path_r2);

        return back();
    }

    public function index() {
        return inertia('UploadIgac/Index');
    }
}

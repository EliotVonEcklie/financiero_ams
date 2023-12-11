<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessIgacFile;
use App\Models\Predio;
use App\Models\DestinoEconomico;
use App\Models\Avaluo;
use App\Models\HistorialPredio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class IgacParserController extends Controller
{
    public function store(Request $request) {
        if (!$request->hasFile('igac_r1') || !$request->hasFile('igac_r2') || !$request->igac_r1->isValid() || !$request->igac_r2->isValid()) {
            return redirect()->route('admin.test_igac')->with('errors', ['Invalid files']);
        }

        // Store the files while we process them.
        $path_r1 = $request->igac_r1->store('igac');
        $path_r2 = $request->igac_r2->store('igac');

        // Dispatch the processing job.
        ProcessIgacFile::dispatch($path_r1, $path_r2);

        return redirect()->route('admin.test_igac')->with('success', 'Job started successfully');
    }

    public function create() {
        return view('admin.test_igac', ['success' => session('success'), 'errors' => session('errors')]);
    }
}

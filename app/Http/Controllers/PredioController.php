<?php

namespace App\Http\Controllers;

use App\Models\Predio;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePredioRequest;
use App\Http\Requests\UpdatePredioRequest;
use Illuminate\Http\Request;

class PredioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Predio::all());
    }

    /**
     * Display a listing of resources based on a search query.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $page = intval($request->input('page'));
        
        $predios = Predio::searchPaginated($query, $page);

        return response()->json($predios);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePredioRequest $request)
    {
        $errors = $request->errors();

        if ($errors->any()) {
            return response()->json($errors->all());
        }

        // The incoming request is valid...
    
        // Retrieve the validated input data...
        $validated = $request->validated();
    
        // Store the predio...
        $predio = Predio::create($validated);
        $predio->id = $predio->cedulacatastral . $predio->tot . $predio-> ord;
        $predio->save();

        return response()->json([
            'success' => 'Saved predio successfully!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Predio $predio)
    {
        return response()->json($predio);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePredioRequest $request, Predio $predio)
    {
        $errors = $request->errors();

        if ($errors->any()) {
            return response()->json($errors->all());
        }

        // The incoming request is valid...
    
        // Retrieve the validated input data...
        $validated = $request->validated();
    
        // Store the predio...
        $predio->fill($validated);
        $predio->id = $predio->cedulacatastral . $predio->tot . $predio-> ord;
        $predio->save();

        return response()->json([
            'success' => 'Updated predio successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Predio $predio)
    {
        $predio->delete();

        return response()->json([
            'success' => 'Deleted predio successfully!'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Recets;
use Illuminate\Http\Request;

class RecetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Recets::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $receta = $user->recetas()->create($request->all());

        return response()->json(['receta' => $receta], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recets $receta)
    {
        $receta->update($request->all());

        return response()->json(['receta' => $receta]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recets $receta)
    {
        $receta->delete();

        return response()->noContent(); // ->json([null, 204]);
    }
}

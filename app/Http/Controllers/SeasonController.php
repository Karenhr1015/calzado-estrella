<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeasonRequest;
use App\Models\Season;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seasons = Season::latest()->paginate();

        return view('seasons.index', compact('seasons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('seasons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SeasonRequest $request)
    {
        Season::create($request->all());

        return to_route('seasons.index')->with('status', __('La temporada se ha creado correctamente.'));
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
        $season = Season::find($id);
        return view('seasons.edit', compact('season'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SeasonRequest $request, string $id)
    {
        $season = Season::find($id);
        $season->update($request->all());
        return to_route('seasons.index')->with('status', __('La temporada se ha editado correctamente.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $season = Season::find($id);
        $season->update(['status' => $request->input('status') ? 0 : 1]);
        
        if($request->input('status')){
            return to_route('seasons.index')->with('status', __('La temporada se ha inactivado correctamente..'));
        }else{
            return to_route('seasons.index')->with('status', __('La temporada se ha activado correctamente.'));
        }
    }
}

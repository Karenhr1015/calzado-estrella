<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColorRequest;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colors = Color::latest()->paginate();

        return view('colors.index', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('colors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ColorRequest $request)
    {
        Color::create($request->all());

        return to_route('colors.index')->with('status', __('The color has been created successfully.'));
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
    public function edit(Color $color)
    {
        $color = Color::find($color->id);
        return view('colors.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ColorRequest $request, string $id)
    {
        $color = Color::find($id);
        $color->update($request->all());
        return to_route('colors.index')->with('status', __('The color has been edited successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $color = Color::find($id);
        $color->update(['status' => $request->input('status') ? 0 : 1]);
        
        if($request->input('status')){
            return to_route('colors.index')->with('status', __('The color has been disabled successfully.'));
        }else{
            return to_route('colors.index')->with('status', __('The color has been enable successfully.'));
        }
    }
}

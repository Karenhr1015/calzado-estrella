<?php

namespace App\Http\Controllers;

use App\Http\Requests\SizeRequest;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Size::query();

        if ($request->has('value')) {
            $query->where('value', 'like', '%' . $request->input('value') . '%');
        }

        $sizes = $query->latest()->paginate();

        return view('sizes.index', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sizes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SizeRequest $request)
    {
        Size::create($request->all());

        return to_route('sizes.index')->with('status', __('La talla se ha creado correctamente.'));
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
        $size = Size::find($id);
        return view('sizes.edit', compact('size'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SizeRequest $request, string $id)
    {
        $size = Size::find($id);
        $size->update($request->all());
        return to_route('sizes.index')->with('status', __('La talla se ha editado correctamente.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $size = Size::find($id);
        $size->update(['status' => $request->input('status') ? 0 : 1]);

        if ($request->input('status')) {
            return to_route('sizes.index')->with('status', __('La talla se ha inactivado correctamente..'));
        } else {
            return to_route('sizes.index')->with('status', __('La talla se ha activado correctamente.'));
        }
    }
}

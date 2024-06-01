<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use App\Models\Season;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        $products = $query->latest()->paginate();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $colors = Color::where('status', 1)->get();
        $sizes = Size::where('status', 1)->get();
        $seasons = Season::where('status', 1)->get();
        $product_types = ProductType::all();

        return view('products.create', compact('colors', 'sizes', 'seasons', 'product_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        /* Obtener los datos validados */
        $validatedData = $request->validated();

        /* Validar la existencia de una foto en la peticion */
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('products', 'public');
            $validatedData['photo'] = $photoPath;
        }

        /* Crear el producto */
        $product = Product::create($validatedData);
        $product->save();

        /* Syncronizar */
        $product->colors()->syncWithoutDetaching($request->color_ids);
        $product->sizes()->syncWithoutDetaching($request->sizes_ids);
        $product->seasons()->syncWithoutDetaching($request->seasons_ids);


        /* Redireccionar a la vista de productos */
        return redirect()->route('products.index')->with('status', 'El producto se ha creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('colors')->find($id);

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with('colors')->find($id);
        $colors = Color::where('status', 1)->get();
        $sizes = Size::where('status', 1)->get();
        $seasons = Season::where('status', 1)->get();
        $product_types = ProductType::all();

        return view('products.edit',  compact('product', 'colors', 'sizes', 'seasons', 'product_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        /* Obtener el producto */
        $product = Product::find($id);

        /* Obtener los datos validados */
        $validatedData = $request->validated();

        /* Validar la existencia de una foto en la petición */
        if ($request->hasFile('photo')) {
            /* Eliminar la foto anterior si existe */
            if ($product->photo) {
                Storage::delete($product->photo);
            }

            /* Subir y guardar la nueva foto */
            $photoPath = $request->file('photo')->store('products', 'public');
            $validatedData['photo'] = $photoPath;
        } else {
            /* Conservar la foto existente si no se envía una nueva */
            $validatedData['photo'] = $product->photo;
        }

        /* Actualizar el producto con los datos validados */
        $product->update($validatedData);

        /* Sincronizar colores */
        $product->colors()->syncWithoutDetaching($request->color_ids);
        $product->sizes()->syncWithoutDetaching($request->sizes_ids);

        return redirect()->route('products.index')->with('status', __('El producto se ha editado correctamente.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $product = Product::find($id);
        $product->update(['status' => $request->input('status') ? 0 : 1]);

        if ($request->input('status')) {
            return to_route('products.index')->with('status', __('El producto se ha inactivado correctamente..'));
        } else {
            return to_route('products.index')->with('status', __('El producto se ha activado correctamente.'));
        }
    }

    public function dashboard()
    {
        return view('products.dashboard');
    }

    /* Fotos */
    public function photos(string $id)
    {
        $product = Product::find($id);
        return view('products.photos', compact('product'));
    }

    /* Fotos */
    public function photos_store(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'color_id' => 'required|exists:colors,id',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $product = Product::find($id);
        $colorId = $request->input('color_id');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'product_' . $id . '_' . $colorId . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('products', $imageName, 'public');

            /* Actualizar la tabla pivot */
            $product->colors()->updateExistingPivot($colorId, ['img_path' => $imagePath]);

            /* Redireccionar a la vista de productos */
            return to_route('products.photos', ['id' => $product->id])->with('status', __('La foto por color se ha guardado correctamente.'));
        }else{
            return to_route('products.photos', ['id' => $product->id])->with('status', __('No se ha proporcionado una foto para el color seleccionado.'));
        }
    }
}

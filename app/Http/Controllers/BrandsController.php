<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::orderBy('created_at', 'DESC')->get();
        return view('brands.index', compact('brands'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
    $request->validate([
        'name' => 'required|min:2|max:50|unique:brands,name',
    ]);

    // Création de la nouvelle catégorie
    $brand = new Brand();
    $brand->name = $request->name;
    $brand->save();

    // Message de succès
    flash('Brand created successfully')->success();

    // Rediriger vers la liste des catégories
    return redirect()->route('brands.index');
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
        $brand = Brand::findOrFail($id);
        return view('brands.edit', compact('brand'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validation
        $request->validate([
            'name' => 'required|min:2|max:50|unique:categories,name,' . $id,
        ]);
    
        // Trouver la catégorie par ID ou échouer
        $brand = Brand::findOrFail($id);
    
        // Mettre à jour le nom de la catégorie
        $brand->name = $request->name;
        $brand->save();
    
        // Flash message de succès
        flash('Brand updated successfully')->success();
    
        // Rediriger vers la page des catégories
        return redirect()->route('brands.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        flash('Brand deleted successfully')->success();
        // Rediriger vers la page des catégories
        return redirect()->route('brands.index');

    }

    public function getBrandsJson(){
        $brands = Brand::all();
        return response()->json([
            'success' => true,
            'data' => $brands,
        ], Response::HTTP_OK);
     
    }
}

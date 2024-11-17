<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SizesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sizes = Size::orderBy('created_at', 'DESC')->get();
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
    public function store(Request $request)
    {
         // Validation
    $request->validate([
        'size' => 'required|min:1|max:50|unique:sizes',
    ]);

    // Création de la nouvelle catégorie
    $size = new Size();
    $size->size = $request->size;
    $size->save();

    // Message de succès
    flash('Size created successfully')->success();

    // Rediriger vers la liste des catégories
    return redirect()->route('sizes.index');

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
        $size = Size::findOrFail($id);
        return view('sizes.edit', compact('size'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         // Validation
         $request->validate([
            'size' => 'required|min:1|max:50|unique:sizes,size,' . $id,
        ]);
    
        // Trouver la catégorie par ID ou échouer
        $size = Size::findOrFail($id);
    
        // Mettre à jour le nom de la catégorie
        $size->size = $request->size;
        $size->save();
    
        // Flash message de succès
        flash('Size updated successfully')->success();
    
        // Rediriger vers la page des catégories
        return redirect()->route('sizes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $size = Size::findOrFail($id);
        $size->delete();

        flash('Size deleted successfully')->success();
        // Rediriger vers la page des catégories
        return redirect()->route('sizes.index');
    }

    public function getSizesJson(){
        $sizes = Size::all();
        return response()->json([
            'success' => true,
            'data' => $sizes,
        ], Response::HTTP_OK);
     
    }
}

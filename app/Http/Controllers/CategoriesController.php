<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'DESC')->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
{
    // Validation
    $request->validate([
        'name' => 'required|min:2|max:50|unique:categories,name',
    ]);

    // Création de la nouvelle catégorie
    $category = new Category();
    $category->name = $request->name;
    $category->save();

    // Message de succès
    flash('Category created successfully')->success();

    // Rediriger vers la liste des catégories
    return redirect()->route('categories.index');
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
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
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
        $category = Category::findOrFail($id);
    
        // Mettre à jour le nom de la catégorie
        $category->name = $request->name;
        $category->save();
    
        // Flash message de succès
        flash('Category updated successfully')->success();
    
        // Rediriger vers la page des catégories
        return redirect()->route('categories.index');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        flash('Category deleted successfully')->success();
        // Rediriger vers la page des catégories
        return redirect()->route('categories.index');


        
    }
}

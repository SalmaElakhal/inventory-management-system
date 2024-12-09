<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Validate;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:50|confirmed',
        ]);
    
        // Création d'un nouvel utilisateur
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->save();
    
        // Ajout d'un message flash de succès
        flash('User created successfully')->success();
    
        // Redirection vers la liste des utilisateurs
        return redirect()->route('users.index')->with('success', 'User created successfully.');
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
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        // Validation des données
        $validatedData = $request->validate([
            'name' => 'required|min:2|max:100',
            // Vérification d'unicité de l'email sauf pour l'utilisateur actuel
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8|max:50|confirmed', // Le mot de passe est facultatif
        ]);
    
        // Récupération de l'utilisateur ou exception 404
        $user = User::findOrFail($id);
    
        // Mise à jour des données de l'utilisateur
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
    
        // Si un mot de passe est fourni, il est hashé et mis à jour
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }
    
        $user->save(); // Sauvegarde des modifications
    
        // Ajout d'un message flash de succès
        flash('User updated successfully')->success();
    
        // Redirection vers la liste des utilisateurs
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Récupération de l'utilisateur ou exception 404
        $user = User::findOrFail($id);
    
        // Ajout d'un message flash de succès
        flash('User deleted successfully')->success();
    
        // Redirection vers la liste des utilisateurs
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
    
}

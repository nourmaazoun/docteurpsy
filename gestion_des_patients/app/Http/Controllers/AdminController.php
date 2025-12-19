<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function showAdmin()
    {
        $Admin = User::all();
        return view('datatable-Administrateurs', ['Admin' => $Admin]);
    }

    // Affiche le formulaire d'édition
    public function edit($id)
    {
        $admin = User::findOrFail($id);
        return view('edit-admin', compact('admin'));
    }

    // Met à jour l'administrateur
    public function update(Request $request, $id)
{
    $admin = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,'.$admin->id,
        'role' => 'required|in:Doc,Sec',
        'statut' => 'required|in:Actif,Inactif',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    if($request->hasFile('image')) {
        $imageName = $request->file('image')->store('images', 'public');
        $admin->image = $imageName;
    }

    $admin->name = $request->name;
    $admin->email = $request->email;
    $admin->role = $request->role;
    $admin->statut = $request->statut;

    $admin->save();

    return redirect()->route('admin.list')->with('success', 'Admin mis à jour avec succès');
}

    // Supprime l'administrateur
    public function destroy($id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.list')->with('success', 'Admin supprimé avec succès');
    }
    
}


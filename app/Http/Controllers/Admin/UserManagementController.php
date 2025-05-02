<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserManagement;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usermanagement = UserManagement::orderBy('created_at', 'DESC')->get();
        return view('usermanagement.index', compact('usermanagement'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usermanagement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Fixed table name
            'password' => 'required|string|max:255',
            'role' => 'required|string|max:255',
        ]);
    
        // Hash password before saving
        $validated['password'] = bcrypt($validated['password']);
        
        UserManagement::create($validated);
    
        return redirect()->route('usermanagement.index')->with('success', 'User added successfully');
    }
    
    public function update(Request $request, string $id)
    {
        $usermanagement = UserManagement::findOrFail($id);
    
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|max:255', // Made nullable
            'role' => 'required|string|max:255',
        ]);
    
        // Hash password if provided
        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }
    
        $usermanagement->update($validated);
    
        return redirect()->route('usermanagement.index')->with('success', 'User updated successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usermanagement = UserManagement::findOrFail($id);
        return view('usermanagement.show', compact('usermanagement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usermanagement = UserManagement::findOrFail($id);
        return view('usermanagement.edit', compact('usermanagement'));
    }

  

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usermanagement = UserManagement::findOrFail($id);
        $usermanagement->delete();

        return redirect()->route('usermanagement.index')->with('success', 'User deleted successfully');
    }
}

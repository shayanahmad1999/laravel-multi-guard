<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Admins can see all users, regular users can only see their own profile
        if (auth('admin')->check()) {
            $users = User::paginate(10);
        } else {
            $users = User::where('id', auth('user')->id())->paginate(10);
        }
        return view('user.crud.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Only admins can create new users
        if (!auth('admin')->check()) {
            abort(403, 'Unauthorized action.');
        }
        return view('user.crud.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Only admins can create new users
        if (!auth('admin')->check()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.crud.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Admins can view any user, regular users can only view their own profile
        if (!auth('admin')->check() && $user->id !== auth('user')->id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('user.crud.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Admins can edit any user, regular users can only edit their own profile
        if (!auth('admin')->check() && $user->id !== auth('user')->id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('user.crud.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Admins can update any user, regular users can only update their own profile
        if (!auth('admin')->check() && $user->id !== auth('user')->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $message = auth('admin')->check() ? 'User updated successfully.' : 'Profile updated successfully.';
        return redirect()->route('user.crud.index')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Only admins can delete users
        if (!auth('admin')->check()) {
            abort(403, 'Unauthorized action.');
        }

        $user->delete();
        return redirect()->route('user.crud.index')->with('success', 'User deleted successfully.');
    }
}
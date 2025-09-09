<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Writer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class WriterCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Admins can see all writers, regular writers can only see their own profile
        if (auth('admin')->check()) {
            $writers = Writer::paginate(10);
        } else {
            $writers = Writer::where('id', auth('writer')->id())->paginate(10);
        }
        return view('writer.crud.index', compact('writers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Only admins can create new writers
        if (!auth('admin')->check()) {
            abort(403, 'Unauthorized action.');
        }
        return view('writer.crud.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Only admins can create new writers
        if (!auth('admin')->check()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:writers',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Writer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('writer.crud.index')->with('success', 'Writer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Writer $writer)
    {
        // Admins can view any writer, regular writers can only view their own profile
        if (!auth('admin')->check() && $writer->id !== auth('writer')->id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('writer.crud.show', compact('writer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Writer $writer)
    {
        // Admins can edit any writer, regular writers can only edit their own profile
        if (!auth('admin')->check() && $writer->id !== auth('writer')->id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('writer.crud.edit', compact('writer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Writer $writer)
    {
        // Admins can update any writer, regular writers can only update their own profile
        if (!auth('admin')->check() && $writer->id !== auth('writer')->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('writers')->ignore($writer->id)],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $writer->name = $request->name;
        $writer->email = $request->email;

        if ($request->filled('password')) {
            $writer->password = Hash::make($request->password);
        }

        $writer->save();

        $message = auth('admin')->check() ? 'Writer updated successfully.' : 'Profile updated successfully.';
        return redirect()->route('writer.crud.index')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Writer $writer)
    {
        // Only admins can delete writers
        if (!auth('admin')->check()) {
            abort(403, 'Unauthorized action.');
        }

        $writer->delete();
        return redirect()->route('writer.crud.index')->with('success', 'Writer deleted successfully.');
    }
}
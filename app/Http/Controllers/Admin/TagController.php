<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Tag;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $tags = Tag::query()
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))
            ->paginate(10);

        return inertia('Admin/Tags/Index', [
            'tags' => $tags,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tags')
            ],
        ], [
            'name.unique' => 'Dieser Tag-Name existiert bereits. Bitte wählen Sie einen anderen Namen.'
        ]);

        Tag::create($validated);

        return redirect()->route('tags.index')
            ->with('success', 'Tag wurde erfolgreich erstellt.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tags')->ignore($tag->id)
            ],
        ], [
            'name.unique' => 'Dieser Tag-Name existiert bereits. Bitte wählen Sie einen anderen Namen.'
        ]);

        $tag->update($request->all());

        return redirect()->route('tags.index')
            ->with('success', 'Tag wurde erfolgreich aktualisiert.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Tag::findOrFail($id)->delete();

        return redirect()->route('tags.index')
            ->with('success', 'Tag wurde gelöscht');
    }
}

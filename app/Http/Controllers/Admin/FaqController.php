<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Faq;
use App\Models\Category;
use App\Models\Tag;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $faqs = Faq::with(['category', 'tags'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('question', 'like', "%{$search}%")
                        ->orWhere('answer', 'like', "%{$search}%")
                        ->orWhereHas('category', function ($catQ) use ($search) {
                            $catQ->where('name', 'like', "%{$search}%");
                        })
                        ->orWhereHas('tags', function ($tagQ) use ($search) {
                            $tagQ->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->orderBy('sort_order')
            ->get();

        return Inertia::render('Admin/Faqs/Index', [
            'faqs' => $faqs,
            'categories' => Category::all(),
            'tags' => Tag::all()
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
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);


        $faq = Faq::create([
            'question' => $validated['question'],
            'answer' => $validated['answer'],
            'category_id' => $validated['category_id'],
            'sort_order' => Faq::query()->max('sort_order') + 1
        ]);

        if (!empty($validated['tags'])) {
            $faq->tags()->sync($validated['tags']);
        }

        return redirect()->route('faqs.index')
            ->with('success', 'FAQ wurde erfolgreich erstellt.');
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
    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id'
        ]);

        $faq->update($validated);
        $faq->tags()->sync($validated['tags']);

        return back()->with('success', 'FAQ updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        Faq::findOrFail($faq->id)->delete();

        return redirect()->route('faqs.index')
            ->with('success', 'FAQ wurde gelöscht');
    }

    public function moveUp($id)
    {
        $faq = Faq::findOrFail($id);

        $previousFaq = Faq::where('sort_order', '<', $faq->sort_order)
            ->orderBy('sort_order', 'desc')
            ->first();

        if ($previousFaq) {
            $currentOrder = $faq->sort_order;
            $faq->update(['sort_order' => $previousFaq->sort_order]);
            $previousFaq->update(['sort_order' => $currentOrder]);
        }

        return back()->with('success', 'FAQ nach oben verschoben.');
    }

    public function moveDown($id)
    {
        $faq = Faq::findOrFail($id);

        $nextFaq = Faq::where('sort_order', '>', $faq->sort_order)
            ->orderBy('sort_order', 'asc')
            ->first();

        if ($nextFaq) {
            $currentOrder = $faq->sort_order;
            $faq->update(['sort_order' => $nextFaq->sort_order]);
            $nextFaq->update(['sort_order' => $currentOrder]);
        }

        return back()->with('success', 'FAQ nach unten verschoben.');
    }
}

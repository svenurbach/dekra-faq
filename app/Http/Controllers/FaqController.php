<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Faq;
use App\Models\Category;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');
        $search = $request->query('search');

        $faqs = Faq::with('category')
            ->when($search && !$category, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('question', 'like', "%{$search}%")
                        ->orWhere('answer', 'like', "%{$search}%")
                        ->orWhereHas(
                            'category',
                            fn($categoryQuery) =>
                            $categoryQuery->where('name', 'like', "%{$search}%")
                        );
                });
            })
            ->when($category && !$search, function ($query) use ($category) {
                $query->whereHas('category', fn($q) => $q->where('name', $category));
            })
            ->get();

        return Inertia::render('Faq', [
            'faqs' => $faqs,
            'categories' => Category::all(),
            'activeCategory' => $category,
            'search' => $search,
        ]);
    }
}

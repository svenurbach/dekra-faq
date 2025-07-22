<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Faq;
use App\Models\Tag;
use Illuminate\Http\Request;

class FaqController extends Controller
{
  public function index(Request $request)
  {
      $tag = $request->query('tag');

      $faqs = Faq::with('tags')
          ->when($tag, function ($query, $tag) {
              $query->whereHas('tags', fn ($q) => $q->where('name', $tag));
          })
          ->get();

      return Inertia::render('Faq', [
          'faqs' => $faqs,
          'tags' => Tag::all(),
          'activeTag' => $tag,
      ]);
  }
}

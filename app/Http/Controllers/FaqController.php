<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();
        return Inertia::render('Faq', [
          'faqs' => $faqs
        ]);
    }
}

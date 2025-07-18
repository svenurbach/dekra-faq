<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class FaqController extends Controller
{
    public function show()
    {
        return Inertia::render('Faq', [
        //   'faq' => $faq
        ]);
    }
}

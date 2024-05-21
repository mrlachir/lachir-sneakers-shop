<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsletterSubscription;

class NewsletterController extends Controller
{
    public function index()
    {
        $newsletters = NewsletterSubscription::latest()
            ->paginate(10);

        return response()->json($newsletters);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255|unique:newsletters,email',
        ]);

        $newsletter = NewsletterSubscription::create($validatedData);

        return response()->json($newsletter, 201);
    }

    public function show(NewsletterSubscription $newsletter)
    {
        return response()->json($newsletter);
    }

    public function update(Request $request, NewsletterSubscription $newsletter)
    {
        $validatedData = $request->validate([
            'email' => 'sometimes|required|string|email|max:255|unique:newsletters,email,' . $newsletter->id,
        ]);

        $newsletter->update($validatedData);

        return response()->json($newsletter);
    }

    public function destroy(NewsletterSubscription $newsletter)
    {
        $newsletter->delete();

        return response()->json(null, 204);
    }
}
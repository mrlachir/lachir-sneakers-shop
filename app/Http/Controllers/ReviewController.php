<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Sneaker;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('sneaker')
            ->latest()
            ->paginate(10);

        return response()->json($reviews);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'sneaker_id' => 'required|integer|exists:sneakers,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $review = Review::create($validatedData);

        return response()->json($review, 201);
    }

    public function show(Review $review)
    {
        return response()->json($review);
    }

    public function update(Request $request, Review $review)
    {
        $validatedData = $request->validate([
            'rating' => 'sometimes|required|integer|min:1|max:5',
            'comment' => 'sometimes|nullable|string',
        ]);

        $review->update($validatedData);

        return response()->json($review);
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return response()->json(null, 204);
    }
}
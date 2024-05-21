<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slideshow;
use Illuminate\Support\Facades\Storage;

class SlideshowController extends Controller
{
    public function index()
    {
        $slideshows = Slideshow::latest()->paginate(10);
        return view('admin.slideshows.index', compact('slideshows'));
    }

    public function create()
    {
        return view('admin.slideshows.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link' => 'nullable|url', // Add validation for link
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);
        
        $imagePath = $request->file('image_path')->store('public/slideshows');

        Slideshow::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image_path' => $imagePath,
            'link' => $validatedData['link'],
            'order' => $validatedData['order'],
            'is_active' => $validatedData['is_active'],
        ]);

        return redirect()->route('admin.slideshows.index');
    }





    public function show(Slideshow $slideshow)
    {
        return response()->json($slideshow);
    }


    public function edit(Slideshow $slideshow)
    {
        return view('admin.slideshows.edit', compact('slideshow'));
    }

    public function update(Request $request, Slideshow $slideshow)
    {
        // Validate the request data
        $request->validate([
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image is optional in the update
            'link' => 'required|url',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        // Update the slideshow record in the database
        if ($request->hasFile('image_path')) {
            // Delete the old image file
            Storage::delete('public/' . $slideshow->image_path);

            // Store the new image in the storage/app/public directory
            $imagePath = $request->file('image_path')->store('public');

            // Update the image filename in the database
            $slideshow->image_path = basename($imagePath);
        }

        // Update other fields
        $slideshow->title = $request->title;
        $slideshow->description = $request->description;
        $slideshow->link = $request->link;
        $slideshow->order = $request->order;
        $slideshow->is_active = $request->is_active;

        // Save the changes
        $slideshow->save();

        return redirect()->route('admin.slideshows.index')->with('success', 'Slideshow updated successfully.');
    }



    public function destroy(Slideshow $slideshow)
    {
        // Delete the image file from storage
        Storage::delete('public/' . $slideshow->image);

        // Delete the slideshow record from the database
        $slideshow->delete();

        return redirect()->route('admin.slideshows.index')->with('success', 'Slideshow deleted successfully.');
    }
}

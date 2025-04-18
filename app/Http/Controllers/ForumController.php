<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ForumController extends Controller
{
    public function overview()
    {
        $forums = Forum::latest()->get();
        return view('forum.overview', compact('forums'));
    }

    public function showForum(Forum $forum)
    {
        $forum->load('threads.user');
        return view('forum.view', compact('forum'));
    }

    public function createForum()
    {
        if (!auth()->user()?->isAdmin()) {
            abort(403);
        }

        return view('forum.create');
    }

    public function storeForum(Request $request)
	{
	    if (!auth()->user()?->isAdmin()) {
	        abort(403);
	    }
	
	    $validated = $request->validate([
	        'name' => 'required|string|max:255',
	        'description' => 'nullable|string|max:1000',
	        'order_index' => 'nullable|integer',
	    ]);
	
	    Forum::create([
	        'uuid' => Str::uuid(),
	        'name' => $validated['name'],
	        'description' => $validated['description'] ?? null,
	        'order_index' => $validated['order_index'] ?? 0,
	        'is_locked' => false,
	    ]);
	
	    return redirect()->route('forum.overview')->with('success', __('forum.created'));
	}

    public function editForum(Forum $forum)
    {
        if (!auth()->user()?->isAdmin()) {
            //return view('errors.custom', ['error' => 403]);
            abort(403);
        }

        return view('forum.edit', compact('forum'));
    }

    public function updateForum(Request $request, Forum $forum)
    {
        if (!auth()->user()?->isAdmin()) {
            //return view('errors.custom', ['error' => 403]);
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $forum->update($validated);

        return redirect()->route('forum.overview')->with('success', __('forum.updated'));
    }

    public function destroyForum(Forum $forum)
    {
        if (!auth()->user()?->isAdmin()) {
            //return view('errors.custom', ['error' => 403]);
            abort(403);
        }

        $forum->delete();

        return redirect()->route('forum.overview')->with('success', __('forum.deleted'));
    }
}

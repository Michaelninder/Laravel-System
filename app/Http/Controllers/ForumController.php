<?php

namespace App\Http\Controllers;
use App\Models\ForumThread as Thread;

use App\Models\Forum;
use App\Models\ForumThread;
use App\Models\ForumComment;
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
        $forum->load('threads');
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
	        'order_index' => 'nullable|integer',
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
	
	public function showThread(Forum $forum, ForumThread $thread)
	{
	    if ($thread->forum_uuid !== $forum->uuid) {
	        abort(404);
	    }
	
	    $thread->load(['comments.user']);
	
	    return view('forum.thread.show', compact('forum', 'thread'));
	}

	public function createThread(Forum $forum)
	{
	    return view('forum.thread.create', compact('forum'));
	}
	
	public function storeThread(Request $request)
	{
	    $validated = $request->validate([
	        'forum_uuid' => 'required|exists:forums,uuid',
	        'title' => 'required|string|max:255',
	        'message' => 'required|string',
	    ]);
	
	    $forum = Forum::where('uuid', $validated['forum_uuid'])->firstOrFail();
	    $user = auth()->user();
	
	    $thread = ForumThread::create([
	        'uuid' => Str::uuid(),
	        'forum_uuid' => $forum->uuid,
	        'user_uuid' => $user->uuid,
	        'title' => $validated['title'],
	        'is_pinned' => false,
	        'is_locked' => false,
	        'views' => 0
	    ]);
	
	    ForumComment::create([
	        'uuid' => Str::uuid(),
	        'thread_uuid' => $thread->uuid,
	        'user_uuid' => $user->uuid,
	        'body' => $validated['message'],
	    ]);
	
	    return redirect()->route('forum.view', $forum)->with('success', __('forum.thread_created'));
	}

	public function editThread(Thread $thread)
	{
	    $this->authorize('update', $thread);
	
	    return view('forum.thread.edit', compact('thread'));
	}
	
	public function updateThread(Request $request, Thread $thread)
	{
	    $this->authorize('update', $thread);
	
	    $validated = $request->validate([
	        'title' => 'required|string|max:255',
	    ]);
	
	    $thread->update($validated);
	
	    return redirect()->route('forum.view', $thread->forum)->with('success', __('forum.thread_updated'));
	}
	
	public function destroyThread(Thread $thread)
	{
	    $this->authorize('delete', $thread);
	
	    $thread->delete();
	
	    return redirect()->route('forum.view', $thread->forum)->with('success', __('forum.thread_deleted'));
	}
	
	public function myThreads()
	{
	    $threads = Thread::where('user_id', auth()->id())->latest()->with('forum')->get();
	    return view('forum.thread.my_threads', compact('threads'));
	}
}

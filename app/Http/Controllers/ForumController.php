<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumPost;
use App\Models\ForumReply;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');

        $posts = ForumPost::with(['user', 'allReplies'])
            ->when($category, function ($q) use ($category) {
                $q->where('category', $category);
            })
            ->orderBy('is_pinned', 'desc')
            ->orderBy('created_at', 'desc')
            ->withCount('allReplies')
            ->paginate(15);

        return view('forum.index', compact('posts', 'category'));
    }

    public function create()
    {
        return view('forum.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:technical_help,academic_questions,general',
        ]);

        ForumPost::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
        ]);

        return redirect()->route('forum.index')->with('status', 'Post created successfully!');
    }

    public function show(ForumPost $post)
    {
        $post->incrementViews();
        $post->load(['user', 'replies.user']);

        return view('forum.show', compact('post'));
    }

    public function storeReply(Request $request, ForumPost $post)
    {
        $request->validate([
            'content' => 'required|string',
            'parent_id' => 'nullable|exists:forum_replies,id',
        ]);

        ForumReply::create([
            'forum_post_id' => $post->id,
            'parent_id' => $request->parent_id,
            'user_id' => $request->user()->id,
            'content' => $request->content,
        ]);

        return back()->with('status', 'Reply posted!');
    }
}

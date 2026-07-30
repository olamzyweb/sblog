<?php

namespace App\Http\Controllers;

use App\Models\NewsPost;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');
        $tag      = $request->query('tag');

        $query = NewsPost::published()->latestFirst();

        // Filter by category (slug-matched)
        if ($category) {
            $query->whereRaw('LOWER(REPLACE(category, " ", "-")) = ?', [strtolower($category)]);
        }

        // Filter by tag (JSON column contains value)
        if ($tag) {
            $query->whereJsonContains('tags', $tag);
        }

        $posts = $query->paginate(6)->withQueryString();

        $categories = NewsPost::published()
            ->select('category')
            ->distinct()
            ->pluck('category');

        $recentPosts = NewsPost::published()
            ->latestFirst()
            ->limit(5)
            ->get();

        // Collect all tags from published posts for the sidebar tag cloud
        $allTags = NewsPost::published()
            ->whereNotNull('tags')
            ->pluck('tags')
            ->flatten()
            ->filter()
            ->unique()
            ->sort()
            ->values();

        return view('pages.news.index', compact('posts', 'categories', 'recentPosts', 'allTags', 'tag', 'category'));
    }

    public function show(NewsPost $post)
    {
        if (!$post->is_published) {
            abort(404);
        }

        $relatedPosts = $post->relatedPosts(3);

        return view('pages.news.show', compact('post', 'relatedPosts'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Game;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::with(['category', 'seller'])
            ->where('published', true)
            ->latest()
            ->get();

        $categories = Category::orderBy('name')->get();

        return view('games.index', compact('games', 'categories'));
    }

    public function category(Category $category)
    {
        $games = Game::with(['category', 'seller'])
            ->where('category_id', $category->id)
            ->where('published', true)
            ->latest()
            ->get();

        return view('games.category', compact('games', 'category'));
    }

    public function show(Game $game)
    {
        if (!$game->published) {
            abort(404);
        }

        $game->load(['category', 'seller']);

        return view('games.show', compact('game'));
    }
}

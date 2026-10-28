<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Game;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index()
    {
        $games = auth()->user()
            ->games()
            ->with('category')
            ->latest()
            ->get();

        return view('seller.index', compact('games'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('seller.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'string', 'max:500'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $data['user_id'] = auth()->id();
        $data['published'] = true;

        Game::create($data);

        return redirect()
            ->route('seller.index')
            ->with('success', 'Игра успешно добавлена.');
    }

    public function edit(Game $game)
    {
        $this->checkOwnership($game);

        $categories = Category::orderBy('name')->get();

        return view('seller.edit', compact('game', 'categories'));
    }

    public function update(Request $request, Game $game)
    {
        $this->checkOwnership($game);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'string', 'max:500'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $game->update($data);

        return redirect()
            ->route('seller.index')
            ->with('success', 'Игра обновлена.');
    }

    public function toggle(Game $game)
    {
        $this->checkOwnership($game);

        $game->update([
            'published' => !$game->published,
        ]);

        return back()->with(
            'success',
            $game->published
                ? 'Игра опубликована.'
                : 'Игра скрыта.'
        );
    }

    private function checkOwnership(Game $game): void
    {
        abort_unless(
            $game->user_id === auth()->id(),
            403,
            'Вы можете изменять только свои игры.'
        );
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Game;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $sellerRole = Role::where('name', 'seller')->firstOrFail();

        $sellers = User::where('role_id', $sellerRole->id)
            ->withCount('games')
            ->orderBy('login')
            ->get();

        return view('admin.index', compact('sellers'));
    }

    public function sellerGames(User $user)
    {
        abort_unless(
            $user->role && $user->role->name === 'seller',
            404
        );

        $games = $user->games()
            ->with('category')
            ->latest()
            ->get();

        return view('admin.seller-games', compact('user', 'games'));
    }

    public function edit(Game $game)
    {
        $categories = Category::orderBy('name')->get();

        $game->load('seller');

        return view('admin.edit', compact('game', 'categories'));
    }

    public function update(Request $request, Game $game)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'string', 'max:500'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $game->update($data);

        return redirect()
            ->route('admin.seller.games', $game->user_id)
            ->with('success', 'Игра обновлена администратором.');
    }

    public function toggle(Game $game)
    {
        $game->update([
            'published' => !$game->published,
        ]);

        return back()->with(
            'success',
            $game->published
                ? 'Игра опубликована.'
                : 'Игра заблокирована.'
        );
    }

    public function destroy(Game $game)
    {
        $sellerId = $game->user_id;

        $game->delete();

        return redirect()
            ->route('admin.seller.games', $sellerId)
            ->with('success', 'Игра удалена.');
    }

    public function users()
    {
        $users = User::with('role')
            ->orderBy('login')
            ->get();

        $roles = Role::orderBy('id')->get();

        return view('admin.users', compact('users', 'roles'));
    }

    public function updateRole(Request $request, User $user)
    {
        $data = $request->validate([
            'role_id' => [
                'required',
                Rule::exists('roles', 'id'),
            ],
        ]);

        if ($user->id === auth()->id()) {
            return back()->withErrors([
                'role_id' => 'Нельзя изменить роль собственной учётной записи.',
            ]);
        }

        $user->update([
            'role_id' => $data['role_id'],
        ]);

        return back()->with('success', 'Роль пользователя изменена.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Game;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function cart()
    {
        $items = auth()->user()->cartItems()->with('game')->get();
        return view('store.cart', compact('items'));
    }

    public function addToCart(Game $game)
    {
        abort_unless($game->published, 404);

        $item = CartItem::firstOrNew([
            'user_id' => auth()->id(),
            'game_id' => $game->id,
        ]);
        $item->quantity = min(99, ($item->quantity ?: 0) + 1);
        $item->save();

        return back()->with('success', 'Игра добавлена в корзину.');
    }

    public function updateCart(Request $request, CartItem $cartItem)
    {
        abort_unless($cartItem->user_id === auth()->id(), 403);
        $data = $request->validate(['quantity' => ['required', 'integer', 'min:1', 'max:99']]);
        $cartItem->update($data);

        return back()->with('success', 'Количество обновлено.');
    }

    public function removeFromCart(CartItem $cartItem)
    {
        abort_unless($cartItem->user_id === auth()->id(), 403);
        $cartItem->delete();

        return back()->with('success', 'Игра удалена из корзины.');
    }

    public function balance()
    {
        return view('store.balance');
    }

    public function topUp(Request $request)
    {
        $data = $request->validate([
            'amount' => ['required', 'numeric', 'min:100', 'max:100000'],
        ]);

        auth()->user()->increment('balance', round((float) $data['amount'], 2));

        return back()->with('success', 'Виртуальный баланс пополнен.');
    }

    public function checkout()
    {
        $userId = auth()->id();

        $order = DB::transaction(function () use ($userId) {
            $user = \App\Models\User::whereKey($userId)->lockForUpdate()->firstOrFail();
            $items = CartItem::where('user_id', $userId)->with('game')->lockForUpdate()->get();

            if ($items->isEmpty()) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'cart' => 'Корзина пуста.',
                ]);
            }

            $totalCents = 0;
            foreach ($items as $item) {
                if (!$item->game || !$item->game->published) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'cart' => 'Одна из игр больше недоступна. Удалите её из корзины.',
                    ]);
                }
                $priceCents = (int) round((float) $item->game->price * 100);
                $totalCents += $priceCents * $item->quantity;
            }

            $balanceCents = (int) round((float) $user->balance * 100);
            if ($balanceCents < $totalCents) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'balance' => 'Недостаточно средств. Пополните виртуальный баланс.',
                ]);
            }

            $order = Order::create([
                'user_id' => $userId,
                'total' => $totalCents / 100,
                'status' => 'completed',
            ]);

            foreach ($items as $item) {
                $order->items()->create([
                    'game_id' => $item->game_id,
                    'game_name' => $item->game->name,
                    'price' => $item->game->price,
                    'quantity' => $item->quantity,
                ]);
            }

            $user->balance = ($balanceCents - $totalCents) / 100;
            $user->save();
            CartItem::where('user_id', $userId)->delete();

            return $order;
        });

        return redirect()->route('orders')->with('success', 'Покупка успешно оформлена.');
    }

    public function orders()
    {
        $orders = Order::with('items')->where('user_id', auth()->id())->latest()->get();
        return view('store.orders', compact('orders'));
    }
}

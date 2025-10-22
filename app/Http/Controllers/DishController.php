<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DishController extends Controller
{
    // Barcha taomlarni ko‘rish (barchaga ruxsat)
    public function index()
    {
        return Dish::all();
    }

    // Yangi taom qo‘shish (faqat admin va waiter)
    public function store(Request $request)
    {
        $user = Auth::user();
        if (!in_array($user->role_id, [1,2])) {
            return response()->json(['message' => 'Sizda bu amal uchun ruxsat yo‘q!'], 403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|string',
        ]);

        $dish = Dish::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request->image,
            'created_by' => $user->id,
        ]);

        return response()->json(['message' => 'Taom qo‘shildi!', 'dish' => $dish]);
    }

    // Taomni tahrirlash (faqat admin va waiter)
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if (!in_array($user->role_id, [1,2])) {
            return response()->json(['message' => 'Sizda bu amal uchun ruxsat yo‘q!'], 403);
        }

        $dish = Dish::findOrFail($id);
        $dish->update($request->only(['name', 'description', 'price', 'image']));

        return response()->json(['message' => 'Taom yangilandi!', 'dish' => $dish]);
    }

    // Taomni o‘chirish (faqat admin va waiter)
    public function destroy($id)
    {
        $user = Auth::user();
        if (!in_array($user->role_id, [1,2])) {
            return response()->json(['message' => 'Sizda bu amal uchun ruxsat yo‘q!'], 403);
        }

        $dish = Dish::findOrFail($id);
        $dish->delete();

        return response()->json(['message' => 'Taom o‘chirildi!']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function dish(Request $request){
        return Dish::all();
    }

    // Waiter buyurtmalarni ko‘radi
    public function index()
    {
        $user = Auth::user();

        if (!in_array($user->role_id, [1, 2])) {
            return response()->json(['message' => 'Sizda bu amal uchun ruxsat yo‘q!'], 403);
        }

        $orders = Order::with('user:id,name,email')->get();
        return response()->json($orders);
    }

    // Buyurtma holatini o‘zgartirish (faqat waiter/admin)
    public function updateStatus(Request $request, $id)
    {
        $user = Auth::user();

        if (!in_array($user->role_id, [1, 2])) {
            return response()->json(['message' => 'Faqat waiter yoki admin o‘zgartira oladi!'], 403);
        }

        $request->validate([
            'status' => 'required|string'
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return response()->json([
            'message' => 'Buyurtma holati yangilandi!',
            'order' => $order
        ]);
    }


    // Foydalanuvchi o‘z buyurtmalarini ko‘rishi
    public function myOrders()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();

        return response()->json($orders);
    }

        private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // km
        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos(num: $latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        return $earthRadius * $angle; // km
    }

    public function store(Request $request)
    {
        
        $dish = Dish::find($request->dish_id);
        // Umumiy narxni hisoblaymiz
        $total = $dish->price * $request->quantity;
        // Restoranning koordinatalari (masalan, Dish modelida saqlanadi)
        $restaurantLatitude = $dish->latitude ?? 50.115; // test uchun
        $restaurantLongitude = $dish->longitude ?? 67.85; // test uchun

        
        //Masofani hisoblaymiz (Haversine formula)
        $distance = $this->calculateDistance(
            $request->latitude,
            $request->longitude,
            $restaurantLatitude,
            $restaurantLongitude
        );
        
        $dishCount = is_array($request->dishes) ? count($request->dishes) : 0;
        //Yetkazib berish vaqtini hisoblash
          $cookTime = $request->quantity * 1.25;
          $deliveryTime = $distance/1000 * 3;
          $estimatedTime = $cookTime + $deliveryTime;
          $hours = floor($estimatedTime / 60);
          $minutes = $estimatedTime % 60;
          $formattedTime = $hours+$minutes;

        //Order yaratamiz
        $order = Order::create([
              'user_id' => Auth::id(),
              'dish_id' =>$request ->dish_id,
              'quantity' => $request->quantity,
              'total_price' => $total,
              'distance_km' => round($distance,0),
              'estimated_time_min' => $formattedTime,
              'status' => $request->status,
            ]);

            return response()->json([
            'message' => 'Buyurtmangiz qabul qilindi!',
            'order' => $order,
        ]);
    }

}

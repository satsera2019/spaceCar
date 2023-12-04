<?php

namespace App\Http\Controllers\Api\UserPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPanel\CreateParcelRequest;
use App\Models\Parcel;
use Illuminate\Http\Request;

class ParcelController extends Controller
{
    public function store(CreateParcelRequest $request)
    {
        try {
            Parcel::create([
                'user_id' => auth()->id,
                'tracking_id' => $request->tracking_id,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'online_address' => $request->online_address,
                'description' => $request->description,
            ]);
        } catch (\Exception $e) {
            info($e);
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
            ]);
        }
    }
}

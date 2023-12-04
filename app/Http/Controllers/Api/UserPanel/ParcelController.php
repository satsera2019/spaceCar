<?php

namespace App\Http\Controllers\Api\UserPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPanel\CreateParcelRequest;
use App\Http\Requests\UserPanel\UpdateParcelRequest;
use App\Models\Parcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParcelController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $userParcels =  $user->parcels;

        return response()->json([
            'user_parcels' => $userParcels,
        ]);
    }

    public function store(CreateParcelRequest $request)
    {
        try {
            $parcel = Parcel::create([
                'user_id' => auth()->user()->id,
                'tracking_id' => $request->tracking_id,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'online_address' => $request->online_address,
                'description' => $request->description,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Parcel created successfully.',
                'data' => $parcel,
            ]);
        } catch (\Exception $e) {
            info($e);
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
            ]);
        }
    }

    public function update(UpdateParcelRequest $request, Parcel $parcel)
    {
        try {
            $parcel->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Parcel updated successfully.',
                'data' => $parcel,
            ]);
        } catch (\Exception $e) {
            info($e);
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.',
            ]);
        }
    }

    public function delete(Parcel $parcel)
    {
        $parcel->delete();
        
        return response()->json(['message' => 'Parcel deleted successfully.']);
    }
}

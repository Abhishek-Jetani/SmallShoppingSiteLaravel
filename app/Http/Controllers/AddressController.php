<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;

class AddressController extends Controller
{
    public function getStates()
    {
        $states = State::all();
        return response()->json($states);
    }

    public function getCities(Request $request)
    {
        $state_id = $request->state_id;
        $cities = State::findOrFail($state_id)->cities;
        return response()->json($cities);
    }
}

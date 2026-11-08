<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;

class AdminLocationController extends Controller
{
    public function index()
    {
        $items = Location::all();

        return view('admin.locations.index', compact('items'));
    }

    public function store(Request $request)
    {
        Location::create([
            'location_name' => $request->location_name
        ]);

        return back();
    }

    public function update(Request $request, $id)
    {
        Location::findOrFail($id)->update([
            'location_name' => $request->location_name
        ]);

        return back();
    }

    public function destroy($id)
    {
        Location::destroy($id);

        return back();
    }
}
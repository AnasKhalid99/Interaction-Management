<?php

namespace App\Http\Controllers;

use App\Models\Interaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InteractionController extends Controller
{	

	public function index()
    {
        $interactions = Interaction::all();

        return response()->json($interactions, 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'label' => 'required|string',
            'type' => 'required|string',
        ]);

        $interaction = Interaction::create($validatedData);

        return response()->json($interaction, 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'label' => 'required|string',
            'type' => 'required|string',
        ]);

        $interaction = Interaction::findOrFail($id);
        $interaction->update($validatedData);

        return response()->json($interaction, 200);
    }

    public function destroy($id)
    {
        $interaction = Interaction::findOrFail($id);
        $interaction->delete();

        return response()->json(['message' => 'Interaction deleted successfully'], 200);
    }

    public function trackEvent($id)
    {

	    $interaction = Interaction::findOrFail($id);
	    return response()->json(['message' => 'Event tracked successfully', 'interaction' => $interaction]);
    }

    public function getStatistics(Request $request)
	{
	    // Validate the request
	    $request->validate([
	        'label' => 'required|string',
	    ]);

	    $label = $request->input('label');

	     $statistics = Interaction::where('label', $label)
	        ->groupBy('label', 'type')
	        ->select([
	            \DB::raw('COUNT(*) as count'),
	            'label',
	            'type',
	        ])
	        ->first();

	    return response()->json($statistics);
	}
}

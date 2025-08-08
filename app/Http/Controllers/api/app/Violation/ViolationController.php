<?php

namespace App\Http\Controllers\api\app\Violation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Violation;

class ViolationController extends Controller
{
    /**
     * Store a newly created violation in storage.
     * 
     * 
     */

    public function index()
{
    $violations = Violation::with(['internetUser', 'violationType'])->get();

    return response()->json([
        'data' => $violations,
    ], 200);
}

   public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'internet_user_id' => 'required|exists:internet_users,id',
            'violation_type_id' => 'required|exists:violations_types,id',
            'comment' => 'nullable|string',
        ]);

        $violation = Violation::create([
            'internet_user_id' => $validated['internet_user_id'],
            'violation_type_id' => $validated['violation_type_id'],
            'comment' => $validated['comment'] ?? '',
        ]);

        return response()->json([
            'message' => 'Violation created successfully!',
            'data' => $violation,
        ], 201);

    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Server error: ' . $e->getMessage()
        ], 500);
    }
}

}

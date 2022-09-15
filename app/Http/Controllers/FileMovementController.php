<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Office;
use App\Models\Movement;
use Illuminate\Http\Request;

class FileMovementController extends Controller
{
    public function receiveUpdate(File $file)
    {
        // Check if the file has a movement and if the movement's to_office_id is the users office and the received_at is null
        if ($file->movement && $file->movement->to_office_id == auth()->user()->office->id && $file->movement->received_at == null) {
            $file->movement->update([
                'received_at' => now(),
                'user_id' => auth()->user()->id,
            ]);
        } else {
            // Return 403 error
            return abort(403);
        }
        return redirect()->back()->with('success', 'File received successfully');
    }

    public function dispatchView(File $file)
    {
        // Get offices excluding users office
        $offices = Office::where('id', '!=', auth()->user()->office_id)->get();
        return view('file.movement.dispatch', compact('file', 'offices'));
    }


    public function dispatchUpdate(File $file, Request $request)
    {
        $validated = $request->validate([
            'to_office_id' => 'required|exists:offices,id',
            'remarks' => 'nullable|string',
        ]);

        // Create a new movement
        $movement = Movement::create([
            'office_id' => auth()->user()->office_id,
            'file_id' => $file->id,
            'from_office_id' => auth()->user()->office_id,
            'to_office_id' => $validated['to_office_id'],
            'received_at' => null,
            'dispatched_at' => now(),
            'user_id' => auth()->user()->id,
            'remarks' => $validated['remarks'],
        ]);

        $file->update([
            'movement_id' => $movement->id,
            'current_office_id' => $validated['to_office_id'],
        ]);


        return redirect()->route('dashboard', $file->id)->with('success', 'File dispatched successfully');
    }
}

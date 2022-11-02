<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Office;
use App\Models\Movement;
use Illuminate\Http\Request;

class ReceiveOtherFilesController extends Controller
{
    public function index(File $file){
        $offices = Office::all();
        return view('file.receiveOtherFilesIndex', compact('offices', 'file'));
    }

    public function store(File $file, Request $request){
        $validated = $request->validate([
            'from_office_id' => 'required|exists:offices,id',
        ]);

        // Check if file has a movement without a received_at
        if ($file->movement && $file->movement->received_at == null) {
            // Complete the movement
            $file->movement->update([
                'received_at' => now(),
                'remarks' => $file->movement->remarks . ' - ' . 'File deemed received',
            ]);
        }

        // Create a new movement
        $movement = Movement::create([
            'office_id' => auth()->user()->office_id,
            'file_id' => $file->id,
            'from_office_id' => $validated['from_office_id'],
            'to_office_id' => auth()->user()->office_id,
            'received_at' => now(),
            'dispatched_at' => now(),
            'user_id' => auth()->user()->id,
            'remarks' => 'Received from office directly (without dispatch)',
        ]);

        $file->update([
            'movement_id' => $movement->id,
            'current_office_id' => auth()->user()->office_id,
        ]);

        return redirect()->route('dashboard', $file->id)->with('success', 'File received successfully');
    }
}

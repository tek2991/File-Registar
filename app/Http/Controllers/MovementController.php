<?php

namespace App\Http\Controllers;

use App\Models\Movement;
use Illuminate\Http\Request;

class MovementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('movement.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movement  $movement
     * @return \Illuminate\Http\Response
     */
    public function show(Movement $movement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movement  $movement
     * @return \Illuminate\Http\Response
     */
    public function edit(Movement $movement)
    {
        // Verify if the user is the owner of the movement and if the file is not received
        if ($movement->user_id == auth()->user()->id && $movement->received_at == null) {
            $file = $movement->file;
            $offices = \App\Models\Office::all();
            return view('movement.edit', compact('movement', 'file', 'offices'));
        } else {
            return redirect()->route('file.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movement  $movement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movement $movement)
    {
        // Verify if the user is the owner of the movement and if the file is not received
        if ($movement->user_id == auth()->user()->id && $movement->received_at == null) {
            $validated = $request->validate([
                'to_office_id' => 'required|exists:offices,id',
                'remarks' => 'nullable|string|max:255',
            ]);

            $movement->update($validated);
            $file = $movement->file;
            $file->update([
                'current_office_id' => $movement->to_office_id,
            ]);
            return redirect()->route('file.index')->with('success', 'Movement updated successfully: '. $movement->file->file_number);
        } else {
            return redirect()->route('file.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movement  $movement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movement $movement)
    {
        //
    }
}

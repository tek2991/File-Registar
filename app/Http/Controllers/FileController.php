<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Office;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('file.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $offices = Office::all();
        return view('file.create', compact('offices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_office_id' => 'required|exists:offices,id',
            'name' => 'required|string|max:255',
        ]);

        $parent_office = Office::find($validated['parent_office_id']);
        // get last six digits of timestamp
        $file_number = substr((string)time(), -6);
        $file_number = $parent_office->initials . '-' . $file_number;

        // Add file number to validated data
        $validated['file_number'] = $file_number;
        // Add current office to validated data
        $validated['current_office_id'] = $validated['parent_office_id'];

        $file = File::create($validated);

        return redirect()->route('file.index')->with('success', 'File created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        $offices = Office::all();
        return view('file.show', compact('file', 'offices'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        $offices = Office::all();
        return view('file.edit', compact('file', 'offices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        $validated = $request->validate([
            'parent_office_id' => 'required|exists:offices,id',
            'name' => 'required|string|max:255',
            'file_number' => 'required|string|max:255|unique:files,file_number,' . $file->id,
        ]);

        $file->update($validated);

        return redirect()->route('file.index')->with('success', 'File updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        //
    }
}

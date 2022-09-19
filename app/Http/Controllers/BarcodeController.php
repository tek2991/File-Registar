<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class BarcodeController extends Controller
{
    //
    public function index()
    {
        return view('barcode.index');
    }

    public function generate(Request $request)
    {
        $validated = $request->validate([
            'file_numbers' => 'required',
        ]);

        // explode by commas and new lines
        $file_numbers = preg_split('/[\s,]+/', $validated['file_numbers']);
        // check if every file number exists in DB and make array of entrys that do not exist
        $not_found = [];
        foreach ($file_numbers as $filenumber) {
            $file = File::where('file_number', $filenumber)->first();
            if (!$file) {
                $not_found[] = $filenumber;
            }
        }
        // if there are any files that do not exist, return file_numbers validation error
        if (count($not_found) > 0) {
            return redirect()->back()->withInput()->withErrors(['file_numbers' => 'File numbers not found: ' . implode(', ', $not_found)]);
        }

        $files = File::whereIn('file_number', $file_numbers)->get();

        // return barcode.index with old input and files
        return redirect()->route('barcode.index')->with('files', $files)->withInput();
    }
}

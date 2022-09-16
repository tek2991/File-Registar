<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Office extends Model
{
    use HasFactory;
    protected $fillable = [
        'initials',
        'name',
    ];

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }

    public function expected_file_ids()
    {
        // Get the files whose current office is this office
        $files_in_this_office = File::where('current_office_id', $this->id)->get();

        // Create an array of file ids
        $file_ids = [];

        foreach ($files_in_this_office as $file) {
            // Check if the file has a movement
            if ($file->movement) {
                // Check if the file's movement's to office is this office and the file's movement's received_at is null
                if ($file->movement->to_office_id == $this->id && $file->movement->received_at == null) {
                    // Add the file id to the array
                    $file_ids[] = $file->id;
                }
            }
        }

        // Return the array of file ids
        return $file_ids;
    }

    public function received_file_ids()
    {
        // Get the files whose current office is this office
        $files_in_this_office = File::where('current_office_id', $this->id)->get();

        // Create an array of file ids
        $file_ids = [];

        foreach ($files_in_this_office as $file) {
            // Check if the file has a movement
            if ($file->movement) {
                // Check if the file's movement's to office is this office and the file's movement's received_at is not null
                if ($file->movement->to_office_id == $this->id && $file->movement->received_at !== null) {
                    // Add the file id to the array
                    $file_ids[] = $file->id;
                }
            }else{
                // Add the file id to the array
                $file_ids[] = $file->id;
            }
        }

        // Return the array of file ids
        return $file_ids;
    }
}

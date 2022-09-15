<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'file_number',
        'parent_office_id',
        'current_office_id',
        'movement_id',
    ];

    public function parentOffice()
    {
        return $this->belongsTo(Office::class, 'parent_office_id');
    }

    public function currentOffice()
    {
        return $this->belongsTo(Office::class, 'current_office_id');
    }

    public function movement()
    {
        return $this->belongsTo(Movement::class);
    }
}

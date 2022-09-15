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
}

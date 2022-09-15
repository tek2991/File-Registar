<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $fillable = [
        'office_id',
        'file_id',
        'from_office_id',
        'to_office_id',
        'received_at',
        'dispatched_at',
        'user_id',
    ];

    protected $casts = [
        'received_at' => 'datetime',
        'dispatched_at' => 'datetime',
    ];

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function fromOffice()
    {
        return $this->belongsTo(Office::class, 'from_office_id');
    }

    public function toOffice()
    {
        return $this->belongsTo(Office::class, 'to_office_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

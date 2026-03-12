<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $table = 'house';

    protected $primaryKey = 'house_id';

    public $timestamps = false;

    protected $fillable = [
        'member_id',
        'address',
        'fee',
        'gender',
        'roomtype',
        'no_avaliablity',
        'create_date',
        'update_date',
        'description',
    ];

    // Cast fee to a number for math operations
    protected $casts = [
        'fee' => 'decimal:0',
        'create_date' => 'datetime',
        'update_date' => 'datetime',
    ];

    // a house belongs to one member
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'member_id');
    }

    //readable gender label
    public function getGenderLabelAttribute(): string
    {
        return match ($this->gender) {
            1 => 'Male Only',
            2 => 'Female Only',
            default => 'Any Gender',
        };
    }
}
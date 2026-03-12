<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryView extends Model
{
    protected $table = 'history_view';

    protected $primaryKey = 'view_id';

    public $timestamps = false;

    protected $fillable = [
        'member_id',
        'remarks',
        'create_date',
    ];

    // history record belongs to one member
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'member_id');
    }
}

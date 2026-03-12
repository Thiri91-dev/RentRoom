<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Member extends Authenticatable
{
    use Notifiable;


    protected $table = 'member';


    protected $primaryKey = 'member_id';


    public $timestamps = false;


    protected $fillable = [
        'type',
        'name',
        'email',
        'password',
        'mobile_no',
    ];


    protected $hidden = ['password'];


    protected function casts(): array
    {
        return ['password' => 'hashed'];
    }

    // one member can have many houses
    public function houses()
    {
        return $this->hasMany(House::class, 'member_id', 'member_id');
    }

    // one member can have many history views
    public function historyViews()
    {
        return $this->hasMany(HistoryView::class, 'member_id', 'member_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'name',
        'period',
        'amount',
        'id_household',
    ];

    protected $casts = [
        'period' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function household()
    {
        return $this->belongsTo(Household::class, 'id_household');
    }


}

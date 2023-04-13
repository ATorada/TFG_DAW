<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'name',
        'period',
        'category',
        'amount',
        'constant',
        'is_income',
        'compute_household',
        'id_household',
        'unique_user_name_period',
    ];

    protected $casts = [
        'period' => 'date',
        'constant' => 'boolean',
        'is_income' => 'boolean',
        'compute_household' => 'boolean',
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

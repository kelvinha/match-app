<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchIndividu extends Model
{
    use HasFactory;

    protected $table = 'match_individu';
    protected $primaryKey = 'id';
    protected $fillable = [
        'member_id',
        'team',
        'match',
    ];

    public function member()
    {
        return $this->belongsTo('App\Models\Members', 'member_id');
    }
}

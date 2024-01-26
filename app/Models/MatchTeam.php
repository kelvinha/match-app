<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Member;

class MatchTeam extends Model
{
    use HasFactory;

    protected $table = 'match_team';
    protected $primaryKey = 'id';
    protected $fillable = [
        'member_id',
        'team',
        'match',
        'gender',
    ];

    public function member()
    {
        return $this->belongsTo('App\Models\Members', 'member_id');
    }
}

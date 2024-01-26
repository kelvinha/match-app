<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MatchTeam;

class Members extends Model
{
    use HasFactory;

    protected $table = 'members';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
        'gender',
    ];

    public function memberTeam()
    {
        return $this->hasOne('App\Models\MatchTeam', 'id');
    }

    public function memberTunggal()
    {
        return $this->hasOne('App\Models\MatchIndividu', 'id');
    }   
}

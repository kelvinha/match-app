<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Members;
use App\Models\MatchTeam;
use App\Models\MatchIndividu;

class MatchController extends Controller
{

    public function indexTeam()
    {
        $data['matchTeam'] = MatchTeam::get()->groupBy(['match', 'team']);
        return view('match.team.index', $data);
    }

    public function indexIndividu()
    {
        $data['matchIndividu'] = MatchIndividu::get()->groupBy(['match', 'team']);
        return view('match.individu.index', $data);
    }

    public function resetTeam()
    {
        $cek_match_team = MatchTeam::count();
        if($cek_match_team == 0) {
            return back()->with('info', 'Data Match kosong guys!');
        } else if(Members::count() == 0) {
            return back()->with('info', 'Members kosong guys!');
        } else {
            MatchTeam::query()->truncate();
            return back();
        }
    }

    public function resetIndividu()
    {
        $cek_match_team = MatchIndividu::count();
        if($cek_match_team == 0) {
            return back()->with('info', 'Data Match kosong guys!');
        } else if(Members::count() == 0) {
            return back()->with('info', 'Members kosong guys!');
        } else {
            MatchIndividu::query()->truncate();
            return back();
        }
    }

    public function makeMatchTeam(Request $request)
    {
        switch ($request->tipe) {
            case 1:
                $result = $this->matchCampuran();
                break;
            case 2:
                $result =  $this->matchPasangan();
                break;
        }
        return $result;
    }

    public function matchPasangan()
    {
        $cek_match_team = MatchTeam::count();
        if ($cek_match_team > 0) {
            return back()->with('info', 'Lakukan reset terlebih dahulu guys!');
        } else if(Members::count() == 0) {
            return back()->with('info', 'Members kosong guys!');
        } else if (Members::count() < 4) {
            return back()->with('info', 'Members harus minimal 4!');
        } else {
        $cowo = Members::where('gender','male')->inRandomOrder()->get();
        $cewe = Members::where('gender','female')->inRandomOrder()->get();
        $team = 1; $match = 1;
        foreach ($cowo as $key => $value) {
            $cek_team = MatchTeam::where('team', $team)->where('match', $match)->count();
            $cek_match = MatchTeam::where('match', $match)->count();

            if ($cek_team == 1) {
                $team++;
                if ($team == 3) {
                    $team = 1;
                }
            }
            if ($cek_match == 2) {
                $match++;
            }

            $add_team = new MatchTeam;
            $add_team->member_id = $value->id;
            $add_team->gender = $value->gender;
            $add_team->team = $team;
            $add_team->match = $match;
            $add_team->save();
        }

        $array = [];
        $cek_total_match = MatchTeam::distinct()->get('match');
        foreach ($cek_total_match as $key => $value) {
            array_push($array, $value->match);
        }
        // dd($array);
        $team = 1; $match = 1;
        foreach ($cewe as $key => $value) {
            $add_team = new MatchTeam;
            $add_team->member_id = $value->id;
            $add_team->gender = $value->gender;
            $add_team->team = $team; // 1
            $add_team->match = $match; // 1
            $add_team->save();
            $team++;
            if ($team % 2 == 0) {
                $team = 2;
            } else {
                $team = 1;
            }
            $cek_team = MatchTeam::where('match', $match)->count();
            if ($cek_team == 4) {
                $match++;
            }
            
        }
        return back();
        }
    }

    public function matchCampuran()
    {
        $cek_match_team = MatchTeam::count();
        if ($cek_match_team > 0) {
            return back()->with('info', 'Lakukan reset terlebih dahulu guys!');
        } else if(Members::count() == 0) {
            return back()->with('info', 'Members kosong guys!');
        } else if (Members::count() < 4) {
            return back()->with('info', 'Members harus minimal 4!');
        } else {
            $data['member'] = Members::inRandomOrder()->get();
            $team = 1; $match = 1;
            foreach ($data['member'] as $key => $value) {
                $cek_team = MatchTeam::where('team', $team)->where('match', $match)->count();
                $cek_match = MatchTeam::where('match', $match)->count();
    
                if ($cek_team == 2) {
                    $team++;
                    if ($team == 3) {
                        $team = 1;
                    }
                }
                if ($cek_match == 4) {
                    $match++;
                }
    
                $add_team = new MatchTeam;
                $add_team->member_id = $value->id;
                $add_team->gender = $value->gender;
                $add_team->team = $team;
                $add_team->match = $match;
                $add_team->save();
            }
            return back();
        }
    }

    public function matchTunggal()
    {
        $cek_match_team = MatchIndividu::count();
        if ($cek_match_team > 0) {
            return back()->with('info', 'Lakukan reset terlebih dahulu guys!');
        } else if(Members::count() == 0) {
            return back()->with('info', 'Members kosong guys!');
        } else if (Members::count() < 4) {
            return back()->with('info', 'Members harus minimal 4!');
        } else {
            $data['member'] = Members::inRandomOrder()->get();
            $team = 1; $match = 1;
            foreach ($data['member'] as $key => $value) {
                $cek_team = MatchIndividu::where('team', $team)->where('match', $match)->count();
                $cek_match = MatchIndividu::where('match', $match)->count();
    
                if ($cek_team == 1) {
                    $team++;
                    if ($team == 3) {
                        $team = 1;
                    }
                }
                if ($cek_match == 2) {
                    $match++;
                }
    
                $add_team = new MatchIndividu;
                $add_team->member_id = $value->id;
                $add_team->team = $team;
                $add_team->match = $match;
                $add_team->save();
            }
            return back();
        }
    }
}

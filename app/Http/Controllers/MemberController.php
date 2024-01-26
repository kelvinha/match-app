<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Members;
use App\Models\MatchTeam;
use App\Models\MatchIndividu;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['members'] = Members::orderBy('nama','asc')->get();
        $data['members_total'] = Members::count();
        $data['members_cowo'] = Members::where('gender','male')->count();
        $data['members_cewe'] = Members::where('gender','female')->count();
        return view('member.index', $data);
    }

    public function store(Request $request)
    {
        Members::create($request->all());
        return back()->with('msg', 'Berhasil ditambahkan!');   
    }

    public function destroy($id)
    {
        Members::find($id)->delete();
        MatchTeam::query()->truncate();
        MatchIndividu::query()->truncate();
        return back()->with('msg', 'Berhasil dihapuskan!'); 
    }

    public function resetMember()
    {
        Members::query()->truncate();
        MatchTeam::query()->truncate();
        MatchIndividu::query()->truncate();
        return back()->with('msg', 'Data Berhasil direset!'); 
    }
}

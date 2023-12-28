<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use \App\Models\MA_skor; 
use \App\Models\MA_klub; 
use \App\Models\MA_admin; 

class A_skor extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(! Session::get('admin.id')) {
            return Redirect("admin"); 
        }else{
            $sess_id = Session::get('admin.id');
            $sess_id_group = DB::table('tb_admin_group_2')->where('id_admin', $sess_id)->first()->id_group;
            $akses = DB::table('tb_admin_menu')
            ->select('tb_admin_rel_group.akses')
            ->where('tb_admin_menu.url', 'admin_skor')
            ->where('tb_admin_menu.deleted_at', null)
            ->where('tb_admin_rel_group.id_group', $sess_id_group)
            ->where('tb_admin_rel_group.deleted_at', null)
            ->join('tb_admin_rel_group', 'tb_admin_menu.id', '=', 'tb_admin_rel_group.id_menu')
            ->get();
            if(count($akses) != 0){
                $akses_temp = array();
                foreach ($akses as $key) {
                    array_push($akses_temp, $key->akses);
                }
                if (in_array('1', $akses_temp)){
                    $data_a = DB::table('tb_skor')
                    ->select('id_lawan');

                    $data_b = DB::table('tb_skor')
                    ->select('id_klub')
                    ->union($data_a)
                    ->get();
                    $data = $data_b;
                    foreach($data as $row){
                        $row->klub = MA_klub::select('nama')->where('id', $row->id_klub)->first()->nama;
                        $row->main = MA_skor::where('id_klub', $row->id_klub)->orWhere('id_lawan', $row->id_klub)->count();
                        $row->menang = MA_skor::where('id_klub_menang', $row->id_klub)->count();
                        $row->kalah = MA_skor::where('id_klub_kalah', $row->id_klub)->count();
                        $row->seri = $row->main - ($row->menang + $row->kalah);

                        $goal_menang_1 = MA_skor::where('id_klub', $row->id_klub)->sum('skor');
                        $goal_menang_2 = MA_skor::where('id_lawan', $row->id_klub)->sum('skor_lawan');
                        $row->goal_menang = $goal_menang_1 + $goal_menang_2;

                        $goal_kalah_1 = MA_skor::where('id_klub', $row->id_klub)->sum('skor_lawan');
                        $goal_kalah_2 = MA_skor::where('id_lawan', $row->id_klub)->sum('skor');
                        $row->goal_kalah = $goal_kalah_1 + $goal_kalah_2;

                        $poin_1 = MA_skor::where('id_klub', $row->id_klub)->where('id_klub_menang', $row->id_klub)->sum('poin_menang');
                        $poin_2 = MA_skor::where('id_klub', $row->id_klub)->where('id_klub_kalah', $row->id_klub)->sum('poin_kalah');
                        $poin_3 = MA_skor::where('id_klub', $row->id_klub)->where('id_klub_menang', '0')->sum('poin_menang');
                        $poin_4 = MA_skor::where('id_lawan', $row->id_klub)->where('id_klub_menang', $row->id_klub)->sum('poin_menang');
                        $poin_5 = MA_skor::where('id_lawan', $row->id_klub)->where('id_klub_kalah', $row->id_klub)->sum('poin_kalah');
                        $poin_6 = MA_skor::where('id_lawan', $row->id_klub)->where('id_klub_kalah', '0')->sum('poin_kalah');
                        $row->poin = $poin_1 + $poin_2 + $poin_3 + $poin_4 + $poin_5 + $poin_6;
                    }
                    $data = collect($data)->sortByDesc('poin');
                    if($request->ajax()){
                        return datatables()->of($data)->addIndexColumn()->toJson();
                        //return response()->json($data);
                    }
                    return view('admin.skor')->with('active_menu', 'Skor')->with('akses_menu', $akses_temp);
                }else{
                    return view('unauthorized');
                }
            }else{
                return view('unauthorized');
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sess_id = Session::get('admin.id');
        $sess_username = MA_admin::select('username')->where('id', $sess_id)->first()->username;
        $data = $request->arr_skor;
        for($i = 0; $i < count($data); $i ++){
            $poin_menang = '3';
            $poin_kalah = '0';
            if((int)$data[$i]['skor_1'] == (int)$data[$i]['skor_2']){
                $poin_menang = '1';
                $poin_kalah = '1';
                $klub_menang = '0';
                $klub_kalah = '0';
            }
            if((int)$data[$i]['skor_1'] > (int)$data[$i]['skor_2']){
                $klub_menang = $data[$i]['klub_1'];
                $klub_kalah = $data[$i]['klub_2'];
            }
            if((int)$data[$i]['skor_1'] < (int)$data[$i]['skor_2']){
                $klub_menang = $data[$i]['klub_2'];
                $klub_kalah = $data[$i]['klub_1'];
            }
            $saved = MA_skor::create(
                [
                    'id_klub'           => $data[$i]['klub_1'],
                    'id_lawan'          => $data[$i]['klub_2'],
                    'id_klub_menang'    => $klub_menang,
                    'id_klub_kalah'     => $klub_kalah,
                    'poin_menang'       => $poin_menang,
                    'poin_kalah'        => $poin_kalah,
                    'skor'              => $data[$i]['skor_1'],
                    'skor_lawan'        => $data[$i]['skor_2'],
                    'created_by'        => $sess_id,
                    'updated_by'        => $sess_id,
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s')
                ]
            );
            if($i == (count($data) - 1) && $saved){
                return response()->json([
                    'success'   => true,
                    'type'      => 'disimpan'
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function autocomplete_klub(Request $request)
    {
        $data = DB::table('tb_klub')
        ->select('nama')
        ->where('nama', 'LIKE', '%'. $request->get('keyword') . '%')
        ->get();
        foreach ($data as $row){
            $result[] = $row->nama;
        }
        return response()->json($result);
    }

    public function autocomplete_klub_id(Request $request)
    {
        $data = DB::table('tb_klub')->where('nama', $request->value)->first()->id;
        return response()->json($data);
    }
}

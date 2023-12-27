<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use \App\Models\MA_skor; 
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
                    $data = DB::table('tb_skor')
                    ->select('tb_skor.*', 'tb_klub.nama as klub')
                    ->where('tb_skor.deleted_at', null)
                    ->leftJoin('tb_klub', 'tb_skor.id_klub', '=', 'tb_klub.id')
                    ->orderBy('tb_skor.id', 'asc')
                    ->get();
                    foreach ($data as $row) {
                        $lawan = DB::table('tb_klub')
                        ->select('nama as lawan')
                        ->where('id', $row->id_lawan)
                        ->first();
                        $row->lawan = $lawan->lawan;
                        $row->created = $row->created_by;
                        if(is_numeric($row->created_by)){
                            $created = DB::table('tb_admin')
                            ->select('tb_admin.username')
                            ->where('tb_admin.id', $row->created_by)
                            ->first();
                            $row->created = $created->username;
                        }
                        $row->updated = $row->updated_by;
                        if(is_numeric($row->updated_by)){
                            $updated = DB::table('tb_admin')
                            ->select('tb_admin.username')
                            ->where('tb_admin.id', $row->updated_by)
                            ->first();
                            $row->updated = $updated->username;
                        }
                    }
                    if($request->ajax()){
                        return datatables()->of($data)->addIndexColumn()->toJson();
                        //return response()->json($data);
                    }
                    return view('admin.klub')->with('active_menu', 'Klub')->with('akses_menu', $akses_temp);
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
        //
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
}

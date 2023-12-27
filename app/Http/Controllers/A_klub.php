<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use \App\Models\MA_klub; 
use \App\Models\MA_admin; 

class A_klub extends Controller
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
            ->where('tb_admin_menu.url', 'admin_klub')
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
                    $data = DB::table('tb_klub')
                    ->select('tb_klub.*', 'tb_kota.nama as kota')
                    ->where('tb_klub.deleted_at', null)
                    ->leftJoin('tb_kota', 'tb_klub.id_kota', '=', 'tb_kota.id_kota')
                    ->orderBy('tb_klub.id', 'asc')
                    ->get();
                    foreach ($data as $row) {
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
        $sess_id = Session::get('admin.id');
        $sess_username = MA_admin::select('username')->where('id', $sess_id)->first()->username;
        $check_klub = MA_klub::where('nama', $request->nama)->count();
        if($check_klub != 0){
            return response()->json([
                'duplicate' => true
            ]);
        }else{
            $data = MA_klub::create(
                [
                    'nama'          => $request->nama,
                    'id_kota'       => $request->id_kota,
                    'created_by'    => $sess_id,
                    'created_at'    => date('Y-m-d H:i:s')
                ]
            );
            if($data){
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
        $data = DB::table('tb_klub')
        ->select('tb_klub.*', 'tb_kota.nama as kota')
        ->where('tb_klub.id', $id)
        ->leftJoin('tb_kota', 'tb_klub.id_kota', '=', 'tb_kota.id_kota')
        ->first();
        return response()->json($data);
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
        $sess_id = Session::get('admin.id');
        $sess_username = MA_admin::select('username')->where('id', $sess_id)->first()->username;

        $check_klub = MA_klub::where('id', '!=', $id)->where('nama', $request->nama)->count();

        if($check_klub != 0){
            return response()->json([
                'duplicate' => true
            ]);
        }else{
            $data = MA_klub::find($id);
            $data->nama         = $request->nama;
            $data->id_kota      = $request->id_kota;
            $data->updated_by   = $sess_id;
            $data->updated_at   = date('Y-m-d H:i:s');
            $data->save();
    
            return response()->json([
                'success'   => true,
                'type'      => 'diupdate',
                'a'      => $check_klub,
            ]);
        }
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

    public function hapus(Request $request)
    {
        $sess_id = Session::get('admin.id');
        $sess_username = MA_admin::select('username')->where('id', $sess_id)->first()->username;

        $id = $request->id;
        $data = MA_klub::find($id);
        $data->deleted_by   = $sess_id;
        $data->deleted_at   = date('Y-m-d H:i:s');
        $data->save();

        return response()->json([
            'success'   => true
        ]);
    }

    public function autocomplete_kota(Request $request)
    {
        $data = DB::table('tb_kota')
        ->select('nama')
        ->where('nama', 'LIKE', '%'. $request->get('keyword') . '%')
        ->get();
        foreach ($data as $row){
            $result[] = $row->nama;
        }
        return response()->json($result);
    }

    public function autocomplete_kota_id(Request $request)
    {
        $data = DB::table('tb_kota')->where('nama', $request->value)->first()->id_kota;
        return response()->json($data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use App\Models\MA_setting;
use App\Models\MA_admin;

class A_setting extends Controller
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
            ->where('tb_admin_menu.url', 'setting_admin')
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
                    return view('admin.setting')->with('active_menu', 'Pengaturan')->with('akses_menu', $akses_temp);
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

        $data_url = MA_setting::find('1');
        $data_url->value        = $request->url;
        $data_url->updated_by   = $sess_id;
        $data_url->updated_at   = date('Y-m-d H:i:s');
        $data_url->save();

        $data_title = MA_setting::find('2');
        $data_title->value        = $request->title;
        $data_title->updated_by   = $sess_id;
        $data_title->updated_at   = date('Y-m-d H:i:s');
        $data_title->save();

        $data_description = MA_setting::find('3');
        $data_description->value        = $request->description;
        $data_description->updated_by   = $sess_id;
        $data_description->updated_at   = date('Y-m-d H:i:s');
        $data_description->save();

        $file_path = public_path('project/image');
        $file_extension = array('jpg', 'jpeg', 'png', 'bmp', 'gif', 'svg', 'ico');
        $file_size = 5120000;//5 mb

        $delete_image = $request->delete_image;
        $last_image = $request->get_image;
        $file_upload = $request->file('image');
        if($file_upload != ''){
            if($file_upload->getSize() > $file_size){
                return response()->json([
                    'size'   => true
                ]);
            }else{
                if (in_array($file_upload->guessClientExtension(), $file_extension)){
                    $file_names = $file_upload->getClientOriginalName();
                    $image = time() . '-' . ((strpos($file_names, ' ') ? str_replace(' ', '_', $file_names) : $file_names));
                    $request->image->move($file_path, $image);
                    //update db
                    $data_logo = MA_setting::find('4');
                    $data_logo->value        = $image;
                    $data_logo->updated_by   = $sess_id;
                    $data_logo->updated_at   = date('Y-m-d H:i:s');
                    $data_logo->save();

                    if($last_image != ''){
                        File::delete($file_path . '/' . $last_image);
                    }elseif($delete_image != ''){
                        File::delete($file_path . '/' . $delete_image);
                    }
                }else{
                    return response()->json([
                        'extension'   => true
                    ]);
                }
            }
        }else{
            if($last_image == '' && $delete_image != ''){
                File::delete($file_path . '/' . $delete_image);
                $image  = '';
            }elseif($last_image == '' && $delete_image == ''){
                $image  = '';
            }else{
                $image  = $last_image;
            }
            $data_logo = MA_setting::find('4');
            $data_logo->value        = $image;
            $data_logo->updated_by   = $sess_id;
            $data_logo->updated_at   = date('Y-m-d H:i:s');
            $data_logo->save();
        }

        $delete_image2 = $request->delete_image2;
        $last_image2 = $request->get_image2;
        $file_upload2 = $request->file('image2');
        if($file_upload2 != ''){
            if($file_upload2->getSize() > $file_size){
                return response()->json([
                    'size'   => true
                ]);
            }else{
                if (in_array($file_upload2->guessClientExtension(), $file_extension)){
                    $file_names2 = $file_upload2->getClientOriginalName();
                    $image2 = time() . '-' . (strpos($file_names2, ' ') ? str_replace(' ', '_', $file_names2) : $file_names2);
                    $request->image2->move($file_path, $image2);
                    //update db
                    $data_logo = MA_setting::find('5');
                    $data_logo->value        = $image2;
                    $data_logo->updated_by   = $sess_id;
                    $data_logo->updated_at   = date('Y-m-d H:i:s');
                    $data_logo->save();

                    if($last_image2 != ''){
                        File::delete($file_path . '/' . $last_image2);
                    }elseif($delete_image2 != ''){
                        File::delete($file_path . '/' . $delete_image2);
                    }
                }else{
                    return response()->json([
                        'extension'   => true
                    ]);
                }
            }
        }else{
            if($last_image2 == '' && $delete_image2 != ''){
                File::delete($file_path . '/' . $delete_image2);
                $image2  = '';
            }elseif($last_image2 == '' && $delete_image2 == ''){
                $image2  = '';
            }else{
                $image2  = $last_image2;
            }
            $data_logo = MA_setting::find('5');
            $data_logo->value        = $image2;
            $data_logo->updated_by   = $sess_id;
            $data_logo->updated_at   = date('Y-m-d H:i:s');
            $data_logo->save();
        }

        $data_footer = MA_setting::find('6');
        $data_footer->value        = $request->footer;
        $data_footer->updated_by   = $sess_id;
        $data_footer->updated_at   = date('Y-m-d H:i:s');
        $data_footer->save();

        return response()->json([
            'success'   => true
        ]);
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

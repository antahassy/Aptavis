<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use \App\Models\MA_login;

class A_login extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(! Session::get('admin.id')) {
            return view('admin.index');
        }else{
            return Redirect('admin_dashboard');
        }
    }

    public function login(Request $request)
    {
        $username = $request->login_username;
        $password = $request->login_password;

        $data = MA_login::where("username", $username)->first();
        if($data){
            if($data->active == 0){
                return response()->json([
                    'banned'   => true
                ]);
            }else{
                if(\Hash::check($password, $data->password)){
                    $request->session()->put("admin.id", $data->id);
                    return response()->json([
                        'success'   => true
                    ]);
                }else{
                    return response()->json([
                        'pass'   => true
                    ]);
                }
            }
        }else{
            return response()->json([
                'username'   => true
            ]);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return Redirect("/");
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

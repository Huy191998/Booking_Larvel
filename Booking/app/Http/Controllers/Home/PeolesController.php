<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\peoples;
use App\Models\users;
use App\Models\cities;
use Carbon\Carbon;
use Session;


//khai bao formRequest
use App\Http\Requests\PeopleRequest;

class PeolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $cities = cities::where('isdelete', false)->pluck('name', 'id')->toArray();
        $peoples = peoples::where('isdelete', false)->get();
        $users = users::where('isdelete', false)->pluck('name', 'id')->toArray();
        return view('peoples.index', compact('peoples', 'users', 'cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = cities::where('isdelete', false)->pluck('name', 'id')->toArray();
        return view('Client.Peoples.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PeopleRequest $request)
    {
        //dd($request);
        $request->validated();
        $user_id = users::insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'Role' => false,
            'Isdelete' => false,
            'provider' => '',
            'provider_id' => '',
            'password' => bcrypt($request->password),
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        $users_data = users::findOrfail($user_id);
        //dd($user_id);
        $peoples = new peoples([
            'first_name' => $request->first_name,
            'lats_name' => $request->lats_name,
            'Idcard' => $request->Idcard,
            'Birthday' => $request->Birthday,
            'phone' => $request->phone,
            'Sex' => $request->Sex,
            'Isdelete' => false,
            'Address' => $request->Address,
            'users_id' => $user_id,
            'cyti_id' => $request->cyti_id,
            'created_at' => Carbon::now()->toDateTimeString(),

        ]);
        $users_data->peoples()->save($peoples);

        Session::flash('thongdiep', 'Bạn đã tạo thành công');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

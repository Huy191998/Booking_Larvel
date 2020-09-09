<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\cities;
use Illuminate\Http\Request;
use App\Models\regions;
use Carbon\Carbon;
use Session;
use DB;

//khai bao formRequest
use App\Http\Requests\RegionsRequest;

class RegionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->seachname != null) {

            $regions = regions::where('isdelete', 0)->where('name', 'like', '%' . $request->seachname . '%')->orWhere('id', 'like',
                '%' . $request->seachname . '%')->orWhere('Status', 'like', '%' . $request->seachname . '%')->paginate(10);
            return view('Admin.Regions.index', compact('regions'));
        }

        $regions = regions::where('isdelete', false)->paginate(10);
        return view('Admin.Regions.index', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Regions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegionsRequest $request)
    {
        // $regions = new regions([
        //    'name'=>$request->Name,
        //    'Status'=>$request->Status,
        //    'Isdelete'=>false,
        //    'created_at' => Carbon::now()->toDateTimeString(),

        // ]);
        $request->validated();
        $regions = new regions();
        $regions->name = $request->Name;
        $regions->Status = $request->Status;
        $regions->Isdelete = false;
        $regions->created_at = Carbon::now()->toDateTimeString();
        $regions->save();
        //dd($regions);

        if ($regions) return redirect('Admin/regions')->with('thongbao','Ban đã tạo thành công!');
        else return back()->with('loi','Bạn đã tạo không thành công!');
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
        $regions = regions::findOrFail($id);
        return view('Admin.Regions.edit', compact('regions'));
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
        $request->validate([

            'Name'=>'required|max:100|min:3|unique:regions,name|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',
            'Status'=>'required|max:200|min:5|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',

        ],
            [
                'Name.required' => 'Tên Vùng Không được bỏ trống',
                'Name.max' => 'Độ dài Tên Vùng dùng tối đa là 100 ký tự',
                'Name.min' => 'Độ dài Tên Vùng dùng tối thiểu là 3 ký tự',
                'Name.not_regex' => 'Tên Vùng không nhập các ký tự đặc biệt',
                'Name.unique' => 'Tên Vùng đã tồn tại',

                'Status.required' => 'Ghi chú Không được bỏ trống',
                'Status.max' => 'Độ dài Ghi chú dùng tối đa là 200 ký tự',
                'Status.min' => 'Độ dài Ghi chú dùng tối thiểu là 3 ký tự',
                'Status.not_regex' => 'Ghi chú không nhập các ký tự đặc biệt',

            ]);
        $regions = regions::findOrFail($id);
        //dd($regions);
        if (isset($regions)) {

            $regions->name = $request->Name;
            $regions->Status = $request->Status;
            $regions->updated_at = Carbon::now()->toDateTimeString();
            //dd($regions);
            $regions->update();
            //echo "string";

            $regions = regions::where('isdelete', false)->paginate(10);
            return redirect('Admin/regions')->with('thongbao','Ban đã cập nhập thành công!');
        }
        // $regions = regions::where('isdelete', false)->get();
        // return view('Admin.Regions.index', compact('regions'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $regions = regions::findOrFail($request->id);
        if ($regions) {
            $regions->Isdelete = true;
            $regions->update();
            //echo "string";
            return back()->with('thongbao','Đã xóa thành công!');
        }
        else return back()->with('loi','Xóa không thành công!');
    }


}

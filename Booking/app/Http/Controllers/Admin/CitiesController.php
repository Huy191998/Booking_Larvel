<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\kindrooms;
use Illuminate\Http\Request;
use App\Models\Cities;
use App\Models\regions;
use Carbon\Carbon;
use Session;

//khai bao formRequest
use App\Http\Requests\CitiesRequest;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $regions = regions::all();
        $cities = cities::all();
        if ($request->seachname != null) {
            $cities = Cities::where('isdelete', 0)->where('Name', 'like', '%' . $request->seachname . '%')->orWhere('id', 'like',
                '%' . $request->seachname . '%')->orWhere('Status', 'like', '%' . $request->seachname . '%')->paginate(10);
            return view('Admin.Cities.index', compact('cities', 'regions'));
        }
        if ($request->seachregions != null) {
            $cities = Cities::where('region_id', 'like', $request->seachregions)->where('isdelete', 0)->paginate(10);
            return view('Admin.Cities.index', compact('cities', 'regions'));
        }

        $cities = Cities::where('isdelete', false)->paginate(10);
        $regions = regions::where('isdelete', false)->pluck('name', 'id')->toArray();
        return view('Admin.Cities.index', compact('cities', 'regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Cities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CitiesRequest $request)
    {
        $request->validated();
        //dd($request);
        if ($request->images) {
            $request->images->move('img', $request->images->getClientOriginalName());
            $cities = new cities([
                'Name' => $request->Name,
                'Status' => $request->Status,
                'image' => $request->images->getClientOriginalName(),
                'region_id' => $request->region_id,
                'Isdelete' => false,
                'created_at' => Carbon::now()->toDateTimeString(),

            ]);
            $cities->save();
        }
        if ($cities) return redirect('Admin/cities')->with('thongbao','Ban đã tạo thành công!');
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
        $city = cities::findOrFail($id);
        $regions = regions::pluck('name', 'id')->toArray();
        //dd($city);
        return view('Admin.Cities.edit', compact('city', 'regions'));
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

             'Name'=>'required|max:200|min:3|unique:cities,name|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',
             'Status'=>'required|max:200|min:3|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',

             'region_id'=>'required',

        ],
            [
                'Name.required' => 'Tên Thành phố Không được bỏ trống',
                'Name.max' => 'Độ dài Tên Thành phố dùng tối đa là 100 ký tự',
                'Name.min' => 'Độ dài Tên Thành phố dùng tối thiểu là 3 ký tự',
                'Name.not_regex' => 'Tên Thành phố không nhập các ký tự đặc biệt',
                'Name.unique' => 'Tên Thành phố đã tồn tại',

                'Status.required' => 'Ghi chú Không được bỏ trống',
                'Status.max' => 'Độ dài Ghi chú dùng tối đa là 100 ký tự',
                'Status.min' => 'Độ dài Ghi chú dùng tối thiểu là 3 ký tự',
                'Status.not_regex' => 'Ghi chú không nhập các ký tự đặc biệt',

                'region_id.required'=>'Vùng miền không được bỏ trống',

            ]);
        $city = cities::findOrFail($id);
        //dd($regions);
        if (isset($city)) {
            if ($request->images) {
                $request->images->move('img', $request->images->getClientOriginalName());
                $city->Name = $request->Name;
                $city->Status = $request->Status;
                $city->image = $request->images->getClientOriginalName();
                $city->region_id = $request->region_id;
                $city->updated_at = Carbon::now()->toDateTimeString();
                //dd($regions);
                $city->update();
                //echo "string";

                // return back()->with('thongdiep','Cập nhập thành công');
            } else {
                $city->Name = $request->Name;
                $city->Status = $request->Status;
                $city->region_id = $request->region_id;
                $city->updated_at = Carbon::now()->toDateTimeString();
                //dd($regions);
                $city->update();
            }
        }
        return redirect('Admin/cities')->with('thongbao','Ban đã cập nhập thành công!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $city = Cities::findOrFail($request->id);
        if ($city) {
            $city->Isdelete = true;
            $city->update();
            //echo "string";
            return back()->with('thongbao','Đã xóa thành công!');
        }
        else return back()->with('loi','Xóa không thành công!');
    }
}

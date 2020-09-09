<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\roomcategorys;
use Carbon\Carbon;
use Session;

//khai bao formRequest
use App\Http\Requests\RoomCategorysRequest;

class RoomCategorysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->seachname != null) {
            $roomcategorys = roomcategorys::where('isdelete', 0)->where('RoomCategory', 'like',
                '%' . $request->seachname . '%')->orWhere('Describe', 'like',
                '%' . $request->seachname . '%')->orWhere('id', 'like',
                '%' . $request->seachname . '%')->paginate(10);
            return view('Admin.RoomCategorys.index', compact('roomcategorys'));
        }
        $roomcategorys = roomcategorys::where('isdelete', false)->paginate(10);
        return view('Admin.RoomCategorys.index', compact('roomcategorys'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomCategorysRequest $request)
    {
        //dd($request);
        $request->validated();
        $roomcategorys = new roomcategorys();
        $roomcategorys->RoomCategory = $request->Name;
        $roomcategorys->AmountPeople = $request->AmountPeople;
        $roomcategorys->Describe = $request->Describe;
        $roomcategorys->Isdelete = false;
        $roomcategorys->created_at = Carbon::now()->toDateTimeString();
        $roomcategorys->save();

        $roomcategorys->save();
        if ($roomcategorys) {
            return redirect('Admin/roomcategorys')->with('thongbao', 'Ban đã tạo thành công!');
        } else {
            return back()->with('loi', 'Bạn đã tạo không thành công!');
        }
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
        $roomcategorys = roomcategorys::findOrFail($id);
        return view('Admin.RoomCategorys.edit', compact('roomcategorys'));
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
            'Name'=>'required|max:100|min:2|unique:roomcategory,RoomCategory|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',
            'Describe'=>'required|max:200|min:5|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',

            'AmountPeople'=>'required|numeric',
        ],
            [
                'Name.required' => 'Loại phòng Không được bỏ trống',
                'Name.max' => 'Độ dài Loại Phòng dùng tối đa là 100 ký tự',
                'Name.min' => 'Độ dài Loại phòng dùng tối thiểu là 2 ký tự',
                'Name.not_regex' => 'Loại phòng không nhập các ký tự đặc biệt',
                'Name.unique' => 'Loại phòng đã tồn tại',

                'Describe.required' => 'Mô Tả Không được bỏ trống',
                'Describe.max' => 'Độ dài Mô Tả dùng tối đa là 200 ký tự',
                'Describe.min' => 'Độ dài Mô Tả dùng tối thiểu là 5 ký tự',
                'Describe.not_regex' => 'Mô Tả không nhập các ký tự đặc biệt',

                'AmountPeople.required'=> 'Số người không được bỏ trống',
                'AmountPeople.numeric' => 'Số người không hợp lệ!',
            ]);
        $roomcategorys = roomcategorys::findOrFail($id);
        if (isset($roomcategorys)) {

            $roomcategorys->RoomCategory = $request->Name;
            $roomcategorys->AmountPeople = $request->AmountPeople;
            $roomcategorys->Describe = $request->Describe;
            $roomcategorys->updated_at = Carbon::now()->toDateTimeString();
            $roomcategorys->update();
            return redirect('Admin/roomcategorys')->with('thongbao', 'Bạn đã cập nhập thành công !!!');
//
//            Session::flash('thongbao', 'Bạn đã cập nhập thành công !!!');
//            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $roomcategorys = roomcategorys::findOrFail($request->id);
        if ($roomcategorys) {
            $roomcategorys->Isdelete = true;
            $roomcategorys->update();
            //echo "string";
            return back()->with('thongbao', 'Đã xóa thành công!');
        } else {
            return back()->with('loi', 'Xóa không thành công!');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\roomcategorys;
use Illuminate\Http\Request;
use App\Models\kindrooms;
use Carbon\Carbon;
use Session;

//khai bao formRequest
use App\Http\Requests\KindroomsRequest;

class KindroomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->seachname != null) {
            $kindrooms = kindrooms::where('isdelete', 0)->where('Name', 'like', '%' . $request->seachname . '%')->orWhere('id', 'like',
                '%' . $request->seachname . '%')->orWhere('Describe', 'like',
                '%' . $request->seachname . '%')->paginate(10);
            return view('Admin.Kindrooms.index', compact('kindrooms'));
        }
        $kindrooms = kindrooms::where('isdelete', false)->paginate(10);
        return view('Admin.Kindrooms.index', compact('kindrooms'));
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
    public function store(KindroomsRequest $request)
    {
        $request->validated();
        $kindrooms = new kindrooms();
        $kindrooms->name = $request->Name;

        $kindrooms->Describe = $request->Describe;
        $kindrooms->Isdelete = false;
        $kindrooms->created_at = Carbon::now()->toDateTimeString();

        $kindrooms->save();
        if ($kindrooms) {
            return redirect('Admin/kindrooms')->with('thongbao', 'Ban đã tạo thành công!');
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
        $kindrooms = kindrooms::findOrFail($id);
        return view('Admin.Kindrooms.edit', compact('kindrooms'));
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
            'Name'=>'required|max:200|min:5|unique:kindrooms,name|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',
            'Describe'=>'required|max:200|min:5|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',

        ],
            [
                'Name.required' => 'Hạng Phòng Không được bỏ trống',
                'Name.max' => 'Hạng Phòng Tên Vùng dùng tối đa là 100 ký tự',
                'Name.min' => 'Độ dài Hạng Phòng dùng tối thiểu là 5 ký tự',
                'Name.not_regex' => 'Hạng Phòng không nhập các ký tự đặc biệt',
                'Name.unique' => 'Hạng Phòng đã tồn tại',

                'Describe.required' => 'Mô Tả Không được bỏ trống',
                'Describe.max' => 'Độ dài Mô Tả dùng tối đa là 100 ký tự',
                'Describe.min' => 'Độ dài Mô Tả dùng tối thiểu là 5 ký tự',
                'Describe.not_regex' => 'Mô Tả không nhập các ký tự đặc biệt',
            ]);
        $kindrooms = kindrooms::findOrFail($id);
        if (isset($kindrooms)) {

            $kindrooms->name = $request->Name;

            $kindrooms->Describe = $request->Describe;
            $kindrooms->updated_at = Carbon::now()->toDateTimeString();
            $kindrooms->update();

            return redirect('Admin/kindrooms')->with('thongbao', 'Ban đã cập nhập thành công!');

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

        $kindrooms = kindrooms::findOrFail($request->id);
        if ($kindrooms) {
            $kindrooms->Isdelete = true;
            $kindrooms->update();
            //echo "string";
            return back()->with('thongbao', 'Đã xóa thành công!');
        } else {
            return back()->with('loi', 'Xóa không thành công!');
        }
    }
}

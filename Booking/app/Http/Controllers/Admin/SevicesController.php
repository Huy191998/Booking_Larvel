<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sevices;
use Carbon\Carbon;

//gọi thư viện
use Session;
use Str;

//khai bao formRequest
use App\Http\Requests\SevicesRequest;

class SevicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->seachname != null) {
            $sevices = sevices::where('isdelete', 0)->where('Name', 'like', '%' . $request->seachname . '%')->orWhere('Name_icon', 'like',
                '%' . $request->seachname . '%')->orWhere('slug', 'like',
                '%' . $request->seachname . '%')->orWhere('id', 'like',
                '%' . $request->seachname . '%')->orWhere('Describe', 'like', '%' . $request->seachname . '%')->paginate(10);
            return view('Admin.Sevices.index', compact('sevices'));
        }
        $sevices = sevices::where('isdelete', false)->paginate(10);
        return view('Admin.Sevices.index', compact('sevices'));
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
    public function store(SevicesRequest $request)
    {
        $request->validated();

        $sevices = new sevices([
            'Name' => $request->Name,
            'slug' => Str::slug($request->Name),
            'Name_icon' => $request->Name_icon,
            'Describe' => $request->Describe,
            'Isdelete' => false,
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);

        $sevices->save();
        if ($sevices) {
            return redirect('Admin/sevices')->with('thongbao', 'Ban đã tạo thành công!');
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
        $sevices = sevices::findOrFail($id);
        return view('Admin.Sevices.edit', compact('sevices'));
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
            'Name'=>'required|max:100|min:2|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',
            'Name_icon'=> 'required|max:50',
            'Describe'=>'required|max:200|min:5|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',

        ],
            [
                'Name_icon.required'=>'Tên Icon không được bỏ trống',
                'Name.Name_icon'=> 'Tên Icon không được quá 50 kí tự',

                'Name.required' => 'Tên tiện ích Không được bỏ trống',
                'Name.max' => 'Độ dài tiện ích dùng tối đa là 100 ký tự',
                'Name.min' => 'Độ dài tiện ích dùng tối thiểu là 2 ký tự',
                'Name.not_regex' => 'tiện ích không nhập các ký tự đặc biệt',

                'Describe.required' => 'Ghi chú Không được bỏ trống',
                'Describe.max' => 'Độ dài Ghi chú dùng tối đa là 200 ký tự',
                'Describe.min' => 'Độ dài Ghi chú dùng tối thiểu là 5 ký tự',
                'Describe.not_regex' => 'Ghi chú không nhập các ký tự đặc biệt',
            ]);
        $sevices = sevices::findOrFail($id);
        //dd($regions);
        if (isset($sevices)) {

            $sevices->Name = $request->Name;
            $sevices->Name_icon = $request->Name_icon;
            $sevices->Describe = $request->Describe;
            $sevices->Isdelete = false;
            $sevices->created_at = Carbon::now()->toDateTimeString();
            $sevices->update();
            //echo "string";
            return redirect('Admin/sevices')->with('thongbao', 'Ban đã cập nhập thành công!');

         //return back()->with('thongbao','Cập nhập thành công');
        }
        //return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $sevices = sevices::findOrFail($request->id);
        if ($sevices) {
            $sevices->Isdelete = true;
            $sevices->update();
            //echo "string";
            return back()->with('thongbao','Đã xóa thành công!');
        }
        else return back()->with('loi','Xóa không thành công!');
    }
}

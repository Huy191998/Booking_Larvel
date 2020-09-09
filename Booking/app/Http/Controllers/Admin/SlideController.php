<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Slide;

//gọi thư viện
use Session;
use Str;

//khai bao formRequest
use App\Http\Requests\SlideRequest;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->seachname != null) {
            $slides = Slide::where('isDeleted', 0)->where('ct', 'like', '%' . $request->seachname . '%')->orWhere('description', 'like',
                '%' . $request->seachname . '%')->orWhere('id', 'like', '%' . $request->seachname . '%')->paginate(5);
            return view('Admin.slides.index', compact('slides'));
        }
        $slides = Slide::where('isDeleted', false)->paginate(5);
        return view('Admin.slides.index', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.slides.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SlideRequest $request)
    {

        //dd($request);
        $request->validated();
        $nameimage=$request->image->getClientOriginalName();
        $request->image->move('images', $nameimage);
        $slides = new Slide([
            'ct' => $request->ct,
            'image' => $nameimage,
            'url' => $request->url,
            'description' => $request->description,
            'isDeleted' => false,
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
        //dd($slides);
        $slides->save();
        if ($slides) return redirect('Admin/slide')->with('thongbao','Ban đã tạo thành công!');
        else return back()->with('loi','Bạn đã tạo không thành công!');
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $slide = Slide::findOrFail($request->id);
        if ($slide) {
            $slide->isDeleted = true;
            $slide->update();
            //echo "string";
            return back()->with('thongbao','Đã xóa thành công!');
        }
        else return back()->with('loi','Xóa không thành công!');
    }
}

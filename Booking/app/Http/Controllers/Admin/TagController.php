<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\blog;
use App\Models\Tag;

//gọi thư viện
use Session;
use Carbon\Carbon;
use Str;

//khai bao formRequest
use App\Http\Requests\TagRequest;


class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->seachname != null) {
            $tag_info = Tag::where('isDeleted', 0)->where('tag_name', 'like', '%' . $request->seachname . '%')->orWhere('slug', 'like',
                '%' . $request->seachname . '%')->orWhere('id', 'like', '%' . $request->seachname . '%')->paginate(5);
            return view('Admin.Tags.index', compact('tag_info'));
        }
        $tag_info = Tag::where('isDeleted', false)->paginate(5);
        return view('Admin.Tags.index', compact('tag_info'));
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
    public function store(TagRequest $request)
    {
        $request->validated();
        $tag = new Tag([
            'tag_name' => $request->tag_name,
            'slug' => Str::slug($request->tag_name),
            'isDeleted' => false
        ]);

        $tag->save();
        if ($tag) return redirect('Admin/tags')->with('thongbao','Ban đã tạo thành công!');
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
    public function destroy(Request $request)
    {
        $tag = Tag::findOrFail($request->id);
        if ($tag) {
            $tag->isDeleted = true;
            $tag->update();
            //echo "string";
            return back()->with('xoa','Đã xóa thành công!');
        }
        else return back()->with('xoaloi','Xóa không thành công!');
    }
}

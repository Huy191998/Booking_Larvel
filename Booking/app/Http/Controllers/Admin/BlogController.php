<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\blog;
use App\Models\Tag;
use App\Models\Seoable;
use App\Models\blogtag;
//gọi thư viện
use Session;
use Carbon\Carbon;
use Str;

//khai bao formRequest
use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->seachname != null) {
            $blog = blog::where('isDeleted', 0)->where('title', 'like', '%' . $request->seachname . '%')->orWhere('id', 'like',
                '%' . $request->seachname . '%')->orWhere('ct', 'like',
                '%' . $request->seachname . '%')->paginate(5);
            return view('Admin.Blog.index', compact('blog'));
        }

        $blog = blog::where('isDeleted', false)->latest()->paginate(5);
        //2. đổ dữ liệu ra view
        return view('Admin.Blog.index', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tag = Tag::where('isDeleted', false)->pluck('tag_name', 'id')->toArray();
        return view('Admin.Blog.create', compact('tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        //dd($request);
        $request->validated();
        if ($request->hasFile('image')) {
            $request->image->move('images', $request->image->getClientOriginalName());
            $blog = new blog([
                'day' => Carbon::now()->toDateTimeString(),
                'title' => $request->title,
                'ct' => $request->ct,
                'images' => $request->image->getClientOriginalName(),
                'isDeleted' => false,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);

            $tag_list = $request->tag;

            $seo_data = new Seoable([
                'title' => $request->title,
                'keywords' => $request->keywords,
                'desc' => $request->desc,
                'isDeleted' => false
            ]);
            //dd($seo_data);

            $blog->save();
            //dd($request -> blog_data);
            //dd($seo_data);
            $blog->tag()->attach($tag_list);
            $blog->seo()->save($seo_data);
            //dd($request -> blog_data);
        } else {
            return redirect('Admin/blog')->with('loi','Ban đã tạo thành công!');
        }
        return redirect('Admin/blog')->with('thongbao','Ban đã tạo thành công!');



    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    //lấy post có cùng tag_id

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //1. kiểm tra dữ liệu theo id được yêu cầu
        $blog = blog::with('seo', 'tag')->findOrFail($id);
        //dd($post);
        $tag = Tag::pluck('tag_name', 'id')->toArray();
        //2. Đổ dữ liệu ra form edit
        return view('Admin.Blog.edit', compact('blog', 'tag'));
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
           'title'=>'required|max:190',
           'ct'=>'required|min:500',
           'keyword'=>'required',
           'desc' => 'required',
           'tag'=>'required',

       ],
           [
               'title.required'=>'Tiêu đề không được bỏ trống',
               'title.max'=>'Tiêu đề chỉ tối đa 190 ký tự',
               'ct.required'=>'Nội dung không được bỏ trống',
               'ct.min'=>'Nội dung phải ít hơn 500 ký tự',
               'keyword.required'=>'Từ khóa không được bỏ trống',
               'desc.required'=>'Miêu tả không được bỏ trốngL',
               'tag.required'=>'Thẻ Tag không được bỏ trống',

           ]);
       //dd($request);
        if ($request->image) {
            $request->image->move('images', $request->image->getClientOriginalName());

            $blog = blog::with('seo')->findOrfail($id);
            $blog->title = $request->title;
            $blog->ct = $request->ct;
            $blog->images = $request->image->getClientOriginalName();

            //lay cac du lieu trong tag
            //$tag_list = $request->tag;
            $blogtag = blogtag::where('blog_id',$id)->pluck('id')->toArray();
             foreach ($blogtag as $blogtag) {
                $tag = blogtag::findOrFail($blogtag);
                $tag->delete();
            }
            foreach ($request->tag as $tag) {
                $posts = new blogtag([
                'blog_id' => $id,
                'tag_id' => $tag,
                'updated_at' => Carbon::now()->toDateTimeString(),

            ]);
                $posts->save();
            }
            //lay du lieu seoale
            $seo = Seoable::where('seoble_id', $id)->first();
            $seo->title = $request->title;
            $seo->desc = $request->desc;
            $seo->keywords = $request->keyword;
            $seo->update();

            $blog->update();
            //$blog->tag()->Sync($tag_list);

            return redirect('Admin/blog')->with('thongbao','Ban đã cập nhập thành công!');

//            Session::flash('thongbao', 'cập nhập thành công');
//            return back();
        } else {
            $blog = blog::with('seo')->findOrfail($id);
            $blog->title = $request->title;
            $blog->ct = $request->ct;


            //lay cac du lieu trong tag
            //$tag_list = $request->tag;
             $blogtag = blogtag::where('blog_id',$id)->pluck('id')->toArray();
             foreach ($blogtag as $blogtag) {
                $tag = blogtag::findOrFail($blogtag);
                $tag->delete();
            }
            foreach ($request->tag as $tag) {
                $posts = new blogtag([
                'blog_id' => $id,
                'tag_id' => $tag,
                'updated_at' => Carbon::now()->toDateTimeString(),

            ]);
                $posts->save();
            }
            //lay du lieu seoale
            $seo = Seoable::where('seoble_id', $id)->first();
            $seo->title = $request->title;
            $seo->desc = $request->desc;
            $seo->keywords = $request->keyword;
            $seo->update();

            $blog->update();
            //$blog->tag()->Sync($tag_list);

            return redirect('Admin/blog')->with('thongbao','Ban đã cập nhập thành công!');
//            Session::flash('thongbao', 'cập nhập thành công');
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
        $blog = blog::findOrFail($request->id);
        if ($blog) {
            $blog->isDeleted = true;
            $blog->update();
            //echo "string";
            return back()->with('thongbao', 'Đã xóa thành công!');
        } else {
            return back()->with('loi', 'Xóa không thành công!');
        }
    }
}

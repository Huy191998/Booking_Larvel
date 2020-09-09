<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\blog;
use Illuminate\Http\Request;
use App\Models\regions;
use App\Models\peoples;
use App\Models\hotel;
use App\Models\roomcategorys;
use App\Models\posts;
use App\Models\images;
use App\Models\comments;
use App\Models\cities;
use App\Models\rooms;
use App\Models\users;
use App\Models\bookrooms;
use App\Models\Tag;
use App\Models\blogtag;
use App\Models\Seoable;
use Carbon\Carbon;
use Auth;
use App\Models\Slide;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function blog()
    {
        //dd($request);

        $blog = blog::where('isDeleted', false)->latest()->paginate(3);
        //dd($product);
        return view('Client.danhsach.blog', compact('blog'));
    }

    public function TagBog($id)
    {
        $tag = blogtag::where('tag_id', $id)->pluck('blog_id')->toArray();
        $blog = blog::where('isDeleted', false)->whereIn('id', $tag)->paginate(3);
        //dd($product);
        return view('Client.danhsach.blog', compact('blog'));
    }

    public function showBlog($id)
    {
        //dd($id);
        $blog = blog::where('isDeleted', false)->latest()->findOrFail($id);
        //dd($post);
        //2. show dữ liệu
        return view('Client.blog.show', compact('blog'));
    }

    public function blogInTag($tag_id)
    {
        //1. lấy dữ liệu where có nghĩa là nó sẽ xét neus tag_id tồn tại trong Tag thì xuất thông qua post
        $blog = Tag::findOrFail($tag_id)->blog()->get();
        //dd($posts);
        //2. đổ ra view
        return view('Client.danhsach.blog', compact('blog'));
    }

    public function index()
    {

        $slide = Slide::where('isDeleted', false)->latest()->paginate(3);
        $cities = cities::where('isdelete', false)->get();
        $rooms = rooms::where('isdelete', false)->with('hotels')->latest()->paginate(4);
        $hotel = hotel::where('isdelete', false)->latest()->paginate(8);
        $city = cities::where('isdelete', false)->pluck('Name', 'id')->toArray();
        $blog = blog::where('isDeleted', false)->paginate(3);
        $tag = blogtag::where('tag_id')->pluck('blog_id')->toArray();
        //dd( $rooms);
        return view('Client.home.index', compact('cities', 'rooms', 'hotel', 'city', 'slide', 'blog', 'tag'));


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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function showrooms(Request $request, $id)
    {

        $rooms = rooms::findOrFail($id);
        $in_at = $request->in_at;
        $out_at = $request->out_at;
        //$out_at = date('Y-m-d', strtotime('+1 day', strtotime($out_at)));
        // if($in_at != null ){
        //    $bookrooms = bookrooms::where('out_at', '>=', $in_at)->where('in_at', '<=',$out_at)->pluck('rooms_id')->toArray();
        //    $view = rooms::where('hotels_id', $rooms->hotels_id)->whereNotIn('id',$bookrooms)->get();
        //    //dd($view);
        // }
        $children = $request->children;
        $view = rooms::where('hotels_id', $rooms->hotels_id)->paginate(3);
        $sevice = posts::where('rooms_id', $id)->get();
        $img = images::where('rooms_id', $id)->get();

        $comments = comments::where('rooms_id', $id)->latest()->paginate(5);
        if (Auth::user()) {
            $users = peoples::where('users_id', Auth::user()->id)->pluck('id')->toArray();
            $city = cities::where('isdelete', false)->pluck('Name', 'id')->toArray();
            return view('Client.Rooms.show',
                compact('rooms', 'img', 'view', 'comments', 'sevice', 'in_at', 'out_at', 'users', 'city', 'children'));
        } else {
            $users = null;
            $city = cities::where('isdelete', false)->pluck('Name', 'id')->toArray();
            return view('Client.Rooms.show',
                compact('rooms', 'img', 'view', 'comments', 'sevice', 'in_at', 'out_at', 'users', 'city', 'children'));
        }

    }

    public function showhotels(Request $request, $id)
    {
        $cities = cities::all();
        if ($request->seachname != null) {
            $city = cities::where('isdelete', false)->pluck('name', 'id')->toArray();

            $hotel = hotel::where('Name', 'like', '%' . $request->seachname . '%')->where('city_id',
                $id)->where('isdelete', 0)->get();
            return view('Client.Hotels.list', compact('hotel', 'city'));
        }
        if ($request->seachCount_star != null) {
            $city = cities::where('isdelete', false)->pluck('name', 'id')->toArray();

            $hotel = hotel::where('Count_star', 'like', '%' . $request->seachCount_star . '%')->where('city_id',
                $id)->where('isdelete', 0)->get();
            return view('Client.Hotels.list', compact('hotel', 'city'));
        }
        if ($request->city_id != null) {
            $city = cities::where('isdelete', false)->pluck('name', 'id')->toArray();

            $hotel = hotel::where('city_id', 'like', '%' . $request->city_id . '%')->where('city_id',
                $id)->where('isdelete', 0)->get();
            return view('Client.Hotels.list', compact('hotel', 'city'));
        }
        $city = cities::where('isdelete', false)->pluck('name', 'id')->toArray();
        $hotel = hotel::where('city_id', $id)->where('isdelete', 0)->paginate(3);
        //dd($hotel);
        return view('Client.Hotels.show', compact('hotel', 'city', 'cities'));
    }

    public function listrooms($id)
    {

        $hotel = hotel::findOrFail($id);
        $rooms = Rooms::where('hotels_id', $id)->where('isdelete', 0)->paginate(4);
        return view('Client.Rooms.list', compact('rooms'));
    }

    public function listhotels(Request $request)
    {
        //
        $cities = cities::all();
        if ($request->seachname != null && $request->seachCount_star != null && $request->city_id != null) {

            $city = cities::where('isdelete', false)->pluck('name', 'id')->toArray();

            $hotel = hotel::where('Name', 'like', '%' . $request->seachname . '%')->where('city_id',
                $request->city_id)->where('Count_star', $request->seachCount_star)->where('isdelete', 0)->paginate(10);

            return view('Client.Hotels.list', compact('hotel', 'city', 'cities'));
        }
        if ($request->seachname != null && $request->seachCount_star != null && $request->city_id == null) {

            $city = cities::where('isdelete', false)->pluck('name', 'id')->toArray();

            $hotel = hotel::where('Name', 'like', '%' . $request->seachname . '%')->where('Count_star',
                $request->seachCount_star)->where('isdelete', 0)->paginate(10);

            return view('Client.Hotels.list', compact('hotel', 'city', 'cities'));
        }
        if ($request->seachname != null && $request->seachCount_star == null && $request->city_id != null) {

            $city = cities::where('isdelete', false)->pluck('name', 'id')->toArray();

            $hotel = hotel::where('Name', 'like', '%' . $request->seachname . '%')->where('city_id',
                $request->city_id)->where('isdelete', 0)->paginate(10);

            return view('Client.Hotels.list', compact('hotel', 'city', 'cities'));
        }
        if ($request->seachname == null && $request->seachCount_star != null && $request->city_id != null) {

            $city = cities::where('isdelete', false)->pluck('name', 'id')->toArray();

            $hotel = hotel::where('Count_star', $request->seachCount_star)->where('city_id',
                $request->city_id)->where('isdelete', 0)->paginate(10);

            return view('Client.Hotels.list', compact('hotel', 'city', 'cities'));
        }
        if ($request->seachname != null && $request->seachCount_star == null && $request->city_id == null) {

            $city = cities::where('isdelete', false)->pluck('name', 'id')->toArray();

            $hotel = hotel::where('Name', 'like', '%' . $request->seachname . '%')->where('isdelete', 0)->paginate(10);

            return view('Client.Hotels.list', compact('hotel', 'city', 'cities'));
        }
        if ($request->seachname == null && $request->seachCount_star != null && $request->city_id == null) {
            $city = cities::where('isdelete', false)->pluck('name', 'id')->toArray();

            $hotel = hotel::where('Count_star', $request->seachCount_star)->where('isdelete',
                0)->paginate(10);
            return view('Client.Hotels.list', compact('hotel', 'city', 'cities'));
        }
        if ($request->seachname == null && $request->seachCount_star == null && $request->city_id != null) {
            $city = cities::where('isdelete', false)->pluck('name', 'id')->toArray();

            $hotel = hotel::where('city_id', $request->city_id)->where('isdelete', 0)->paginate(10);
            return view('Client.Hotels.list', compact('hotel', 'city', 'cities'));
        }
        $hotel = hotel::where('Isdelete', 0)->paginate(10);
        $city = cities::where('Isdelete', false)->pluck('name', 'id')->toArray();

        //dd($hotel);
        return view('Client.Hotels.list', compact('hotel', 'city', 'cities'));
    }

    public function searchrooms(Request $request)
    {

        //dd($request->daterange);
        $date = explode('-', $request->daterange);

        $children = $request->childrenPeople;
        $in_at = Carbon::parse($date[0])->format('Y-m-d');
        $out_at1 = Carbon::parse($date[1])->format('Y-m-d');
        if ($in_at == $out_at1) {
            $out_at = date('Y-m-d', strtotime('+1 day', strtotime($out_at1)));
            //dd($request);
            $bookrooms = bookrooms::where('out_at', '>=', $in_at)->where('in_at', '<=',
                $out_at)->pluck('rooms_id')->toArray();
            if ($request->city_id != "null" && $request->People != null && $request->childrenPeople != null) {
                $hotel = hotel::where('city_id', $request->city_id)->pluck('id')->toArray();
                $roomcategory = roomcategorys::where('AmountPeople', '>=', $request->People)->pluck('id')->toArray();

                $rooms = Rooms::where('hotels_id', $hotel)->whereIn('roomcategory_id',
                    $roomcategory)->where('AmountPeople', '>=', $request->childrenPeople)->orderBy('rates',
                    'DESC')->where('Isdelete',
                    0)->paginate(4);
                $city = cities::where('Isdelete', false)->pluck('name', 'id')->toArray();

                $cities = cities::all();

                return view('Client.Rooms.searchrooms',
                    compact('rooms', 'city', 'in_at', 'out_at', 'cities', 'children'));
            }

            if ($request->city_id == "null" && $request->People == null && $request->childrenPeople == null) {

                //dd($request);
                $city = cities::where('Isdelete', false)->pluck('name', 'id')->toArray();
                $rooms = Rooms::whereNotIn('id', $bookrooms)->where('Isdelete', 0)->orderBy('rates',
                    'DESC')->paginate(4);
                $cities = cities::all();
                return view('Client.Rooms.searchrooms',
                    compact('rooms', 'city', 'in_at', 'out_at', 'cities', 'children'));
            }
            if ($request->city_id != "null" && $request->People == null && $request->childrenPeople == null) {
                //dd($request);
                $hotel = hotel::where('city_id', $request->city_id)->pluck('id')->toArray();
                $city = cities::where('Isdelete', false)->pluck('name', 'id')->toArray();
                $rooms = Rooms::whereNotIn('id', $bookrooms)->whereIn('hotels_id', $hotel)->where('Isdelete',
                    0)->orderBy('rates', 'DESC')->paginate(4);
                //dd($hotel);
                $cities = cities::all();
                return view('Client.Rooms.searchrooms',
                    compact('rooms', 'city', 'in_at', 'out_at', 'cities', 'children'));
            }
            if ($request->city_id == "null" && $request->People != null && $request->childrenPeople == null) {
                $roomcategory = roomcategorys::where('AmountPeople', '>=', $request->People)->pluck('id')->toArray();
                $city = cities::where('Isdelete', false)->pluck('name', 'id')->toArray();
                $rooms = Rooms::whereNotIn('id', $bookrooms)->whereIn('roomcategory_id',
                    $roomcategory)->orderBy('rates', 'DESC')->where('Isdelete', 0)->paginate(4);
                $cities = cities::all();
                return view('Client.Rooms.searchrooms',
                    compact('rooms', 'city', 'in_at', 'out_at', 'cities', 'children'));
            }
            if ($request->city_id == "null" && $request->People == null && $request->childrenPeople != null) {
                $cities = cities::all();
                $city = cities::where('Isdelete', false)->pluck('name', 'id')->toArray();
                $rooms = Rooms::where('AmountPeople', '>=', $request->childrenPeople)->where('Isdelete',
                    0)->orderBy('rates', 'DESC')->paginate(4);

                return view('Client.Rooms.searchrooms',
                    compact('rooms', 'city', 'in_at', 'out_at', 'cities', 'children'));
            }
            if ($request->city_id != "null" && $request->People == null && $request->childrenPeople != null) {
                $hotel = hotel::where('city_id', $request->city_id)->pluck('id')->toArray();
                $rooms = rooms::whereNotIn('id', $bookrooms)->where('Isdelete', 0)->whereIn('hotels_id',
                    $hotel)->where('AmountPeople', '>=', $request->childrenPeople)->orderBy('rates',
                    'DESC')->paginate(4);
                $city = cities::where('Isdelete', false)->pluck('name', 'id')->toArray();
                $cities = cities::all();
                return view('Client.Rooms.searchrooms',
                    compact('rooms', 'city', 'in_at', 'out_at', 'cities', 'children'));
            }
            if ($request->city_id != "null" && $request->People != null && $request->childrenPeople == null) {
                $hotel = hotel::where('city_id', $request->city_id)->pluck('id')->toArray();
                $roomcategory = roomcategorys::where('AmountPeople', '>=', $request->People)->pluck('id')->toArray();
                //dd( $rooms);
                $rooms = Rooms::whereIn('hotels_id', $hotel)->whereIn('roomcategory_id',
                    $roomcategory)->where('Isdelete', 0)->orderBy('rates', 'DESC')->paginate(4);
                $city = cities::where('Isdelete', false)->pluck('name', 'id')->toArray();
                $cities = cities::all();
                return view('Client.Rooms.searchrooms',
                    compact('rooms', 'city', 'in_at', 'out_at', 'cities', 'children'));
            }
            if ($request->city_id == "null" && $request->People != null && $request->childrenPeople != null) {
                $roomcategory = roomcategorys::where('AmountPeople', '>=', $request->People)->pluck('id')->toArray();
                $cities = cities::all();
                $rooms = rooms::whereNotIn('id', $bookrooms)->where('Isdelete', 0)->where('AmountPeople', '>=',
                    $request->childrenPeople)->whereIn('roomcategory_id', $roomcategory)->orderBy('rates',
                    'DESC')->paginate(4);
                $city = cities::where('Isdelete', false)->pluck('name', 'id')->toArray();

                return view('Client.Rooms.searchrooms',
                    compact('rooms', 'city', 'in_at', 'out_at', 'cities', 'children'));
            }

        }
        if ($in_at != $out_at1) {
            $out_at = $out_at1;
            $bookrooms = bookrooms::where('out_at', '>=', $in_at)->where('in_at', '<=',
                $out_at)->pluck('rooms_id')->toArray();
            if ($request->city_id != "null" && $request->People != null && $request->childrenPeople != null) {
                $hotel = hotel::where('city_id', $request->city_id)->pluck('id')->toArray();
                $roomcategory = roomcategorys::where('AmountPeople', '>=', $request->People)->pluck('id')->toArray();
                //dd( $rooms);
                $rooms = Rooms::whereIn('hotels_id', $hotel)->whereIn('roomcategory_id',
                    $roomcategory)->where('AmountPeople', '>=', $request->childrenPeople)->where('Isdelete',
                    0)->orderBy('rates', 'DESC')->paginate(4);
                $city = cities::where('Isdelete', false)->pluck('name', 'id')->toArray();
                $cities = cities::all();
                return view('Client.Rooms.searchrooms',
                    compact('rooms', 'city', 'in_at', 'out_at', 'cities', 'children'));
            }

            if ($request->city_id == "null" && $request->People == null && $request->childrenPeople == null) {
                $city = cities::where('Isdelete', false)->pluck('name', 'id')->toArray();
                $rooms = Rooms::whereNotIn('id', $bookrooms)->where('Isdelete', 0)->orderBy('rates',
                    'DESC')->paginate(4);
                $cities = cities::all();
                return view('Client.Rooms.searchrooms',
                    compact('rooms', 'city', 'in_at', 'out_at', 'cities', 'children'));
            }
            if ($request->city_id != "null" && $request->People == null && $request->childrenPeople == null) {
                $hotel = hotel::where('city_id', $request->city_id)->pluck('id')->toArray();
                $city = cities::where('Isdelete', false)->pluck('name', 'id')->toArray();
                $rooms = Rooms::whereNotIn('id', $bookrooms)->whereIn('hotels_id', $hotel)->orderBy('rates',
                    'DESC')->where('Isdelete',
                    0)->paginate(4);
                $cities = cities::all();
                return view('Client.Rooms.searchrooms',
                    compact('rooms', 'city', 'in_at', 'out_at', 'cities', 'children'));
            }
            if ($request->city_id == "null" && $request->People != null && $request->childrenPeople == null) {
                $roomcategory = roomcategorys::where('AmountPeople', '>=', $request->People)->pluck('id')->toArray();
                $city = cities::where('Isdelete', false)->pluck('name', 'id')->toArray();
                $rooms = Rooms::whereNotIn('id', $bookrooms)->whereIn('roomcategory_id',
                    $roomcategory)->where('Isdelete', 0)->orderBy('rates', 'DESC')->paginate(4);
                $cities = cities::all();
                return view('Client.Rooms.searchrooms',
                    compact('rooms', 'city', 'in_at', 'out_at', 'cities', 'children'));
            }
            if ($request->city_id == "null" && $request->People == null && $request->childrenPeople != null) {
                $cities = cities::all();
                $city = cities::where('Isdelete', false)->pluck('name', 'id')->toArray();
                $rooms = Rooms::where('AmountPeople', '>=', $request->childrenPeople)->where('Isdelete',
                    0)->orderBy('rates', 'DESC')->paginate(4);
                return view('Client.Rooms.searchrooms',
                    compact('rooms', 'city', 'in_at', 'out_at', 'cities', 'children'));
            }
            if ($request->city_id != "null" && $request->People == null && $request->childrenPeople != null) {
                $hotel = hotel::where('city_id', $request->city_id)->pluck('id')->toArray();
                $rooms = rooms::whereNotIn('id', $bookrooms)->where('Isdelete', 0)->whereIn('hotels_id',
                    $hotel)->where('AmountPeople', '>=', $request->childrenPeople)->orderBy('rates',
                    'DESC')->paginate(4);
                $city = cities::where('Isdelete', false)->pluck('name', 'id')->toArray();
                $cities = cities::all();
                return view('Client.Rooms.searchrooms',
                    compact('rooms', 'city', 'in_at', 'out_at', 'cities', 'children'));
            }
            if ($request->city_id != "null" && $request->People != null && $request->childrenPeople == null) {
                $hotel = hotel::where('city_id', $request->city_id)->pluck('id')->toArray();
                $roomcategory = roomcategorys::where('AmountPeople', '>=', $request->People)->pluck('id')->toArray();
                //dd( $rooms);
                $rooms = Rooms::whereIn('hotels_id', $hotel)->whereIn('roomcategory_id',
                    $roomcategory)->where('Isdelete', 0)->orderBy('rates', 'DESC')->paginate(4);
                $city = cities::where('Isdelete', false)->pluck('name', 'id')->toArray();
                $cities = cities::all();
                return view('Client.Rooms.searchrooms',
                    compact('rooms', 'city', 'in_at', 'out_at', 'cities', 'children'));
            }
            if ($request->city_id == "null" && $request->People != null && $request->childrenPeople != null) {
                $roomcategory = roomcategorys::where('AmountPeople', '>=', $request->People)->pluck('id')->toArray();
                $cities = cities::all();
                $rooms = rooms::whereNotIn('id', $bookrooms)->where('Isdelete', 0)->where('AmountPeople', '>=',
                    $request->childrenPeople)->whereIn('roomcategory_id', $roomcategory)->orderBy('rates',
                    'DESC')->paginate(4);
                $city = cities::where('Isdelete', false)->pluck('name', 'id')->toArray();
                return view('Client.Rooms.searchrooms',
                    compact('rooms', 'city', 'in_at', 'out_at', 'cities', 'children'));
            }

        }


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

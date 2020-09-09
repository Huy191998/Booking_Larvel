<?php

namespace App\Http\Controllers\Hotels;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\posts;
use App\Models\hotel;
use App\Models\sevices;
use App\Models\rooms;
use App\Models\roomcategorys;
use App\Models\kindrooms;
use App\Models\images;
use App\Models\comments;
use Carbon\Carbon;
use Session;


//khai bao formRequest
use App\Http\Requests\RoomsRequest;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomsRequest $request)
    {
        $request->validated();
        //dd($request->images[1]->getClientOriginalName());
        $rooms = rooms::insertGetId([

            'rates' => $request->rates,
            'acreage' => $request->acreage,
            'AmountPeople' => $request->AmountPeople,
            'surcharge' => $request->surcharge,
            'image' => $request->images[0]->getClientOriginalName(),
            'roomcategory_id' => $request->roomcategorys_id,
            'kindrooms_id' => $request->kindrooms_id,
            'description' => $request->description,
            'hotels_id' => $request->hotels_id,
            'Isdelete' => false,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        $rooms_data = rooms::findOrfail($rooms);
        //$rooms->save();
        //dd($rooms);
        foreach ($request->sevices_id as $id) {
            $posts = new posts([
                'rooms_id' => $rooms,
                'sevices_id' => $id,
                'created_at' => Carbon::now()->toDateTimeString(),

            ]);
            $rooms_data->posts()->save($posts);

        }


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                //dd($image);
                $image->move('img', $image->getClientOriginalName());
                $images = new images([
                    'image' => $image->getClientOriginalName(),
                    'code' => ++$key,
                    'rooms_id' => $rooms,
                    'created_at' => Carbon::now()->toDateTimeString(),

                ]);
                $rooms_data->images()->save($images);
            }
        }
        return redirect("Hotels/hotel/$request->hotels_id")->with('thongbao', 'Đã tạo phòng thành công');


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

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function editrooms($id)
    {
        $rooms = rooms::with('sevices')->findOrFail($id);
        $sevices = sevices::where('isdelete', false)->pluck('Name', 'id')->toArray();
        //dd($rooms->sevices->Name);
        $kindrooms = kindrooms::where('isdelete', false)->pluck('Name', 'id')->toArray();
        $roomcategorys = roomcategorys::where('isdelete', false)->pluck('RoomCategory', 'id')->toArray();

        $posts = posts::where('rooms_id', $id)->pluck('sevices_id')->toArray();
        //dd($sevices['0']);
        return view('Hotels.Rooms.edit', compact('sevices', 'kindrooms', 'rooms', 'roomcategorys', 'posts'));
    }

    public function edit($id)
    {
        $sevices = sevices::where('isdelete', false)->pluck('Name', 'id')->toArray();
        $hotel = hotel::findOrFail($id);
        $rooms = rooms::where('isdelete', false)->where('hotels_id', $id)->get();
        $kindrooms = kindrooms::where('isdelete', false)->pluck('Name', 'id')->toArray();
        $roomcategorys = roomcategorys::where('isdelete', false)->pluck('RoomCategory', 'id')->toArray();
        return view('Hotels.Rooms.create', compact('hotel', 'sevices', 'kindrooms', 'rooms', 'roomcategorys'));
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
            'rates'=>'required',
            'acreage'=>'required',
            'AmountPeople'=>'required',
            'surcharge'=>'required',
            'roomcategorys_id'=>'required',
            'kindrooms_id'=>'required',
            'sevices_id'=>'required',
            'description'=>'required|max:200|min:5|
                            not_regex:/[`\~\!\@\#\$\%\^\&\*\_\=\+\"\:\;\<\.\>\?]/',
        ],
            [
            'rates.required'=>'Giá không được bỏ trống',
            'acreage.required'=>'Diện tích không được bỏ trống',
            'AmountPeople.required'=>'Số người không được bỏ trống',
            'surcharge.required'=>'Phụ thu không được bỏ trống',
            'roomcategorys_id.required'=>'Loại phòng phải được chọn, không được bỏ trống',
            'kindrooms_id.required'=>'Hạng phòng phải được chọn, không được bỏ trống',
            'sevices_id.required'=>'Tiện ích phải được chọn, không được bỏ trống',

            'description.required' => 'Mô Tả Không được bỏ trống',
            'description.max' => 'Độ dài Mô Tả dùng tối đa là 100 ký tự',
            'description.min' => 'Độ dài Mô Tả dùng tối thiểu là 5 ký tự',
            'description.not_regex' => 'Mô Tả không nhập các ký tự đặc biệt',

            ]);
        if ($request->images) {
            $rooms = rooms::with('posts')->findOrfail($id);
            $rooms->rates = $request->rates;
            $rooms->acreage = $request->acreage;
            $rooms->AmountPeople = $request->AmountPeople;
            $rooms->surcharge = $request->surcharge;
            $rooms->surcharge = $request->images[0]->getClientOriginalName();
            $rooms->roomcategory_id = $request->roomcategorys_id;
            $rooms->kindrooms_id = $request->kindrooms_id;
            $rooms->hotels_id = $request->hotels_id;
            $rooms->updated_at = Carbon::now()->toDateTimeString();
            //$rooms->update();
            $rooms_id = posts::where('rooms_id',$id)->pluck('id')->toArray();
            //dd($rooms_id);
            foreach ($rooms_id as $rooms_id) {
                $posts = posts::findOrFail($rooms_id);
                $posts->delete();
            }
            foreach ($request->sevices_id as $sevices_id) {
            $posts = new posts([
                'rooms_id' => $id,
                'sevices_id' => $sevices_id,
                'updated_at' => Carbon::now()->toDateTimeString(),

            ]);
            $posts->save();

            }
            $images_id = images::where('rooms_id',$id)->pluck('id')->toArray();
            foreach ($images_id as $images_id) {
                $images = images::findOrFail($images_id);
                $images->delete();
            }

            foreach ($request->file('images') as $key => $image) {
                //dd($image);
                $image->move('img', $image->getClientOriginalName());
                $images = new images([
                    'image' => $image->getClientOriginalName(),
                    'code' => ++$key,
                    'rooms_id' => $id,
                    'created_at' => Carbon::now()->toDateTimeString(),

                ]);
                $images->save();


        }
            return back()->with('thongbao', 'Cập nhập phòng thành công');
        }else{
            //dd($request);
            $rooms = rooms::with('posts')->findOrfail($id);
            $rooms->rates = $request->rates;
            $rooms->acreage = $request->acreage;
            $rooms->AmountPeople = $request->AmountPeople;
            $rooms->surcharge = $request->surcharge;

            $rooms->roomcategory_id = $request->roomcategorys_id;
            $rooms->kindrooms_id = $request->kindrooms_id;
            $rooms->hotels_id = $request->hotels_id;
            $rooms->updated_at = Carbon::now()->toDateTimeString();
            //$rooms->update();
            $rooms_id = posts::where('rooms_id',$id)->pluck('id')->toArray();
            //dd($rooms_id);
            foreach ($rooms_id as $rooms_id) {
                $posts = posts::findOrFail($rooms_id);
                $posts->delete();
            }
            foreach ($request->sevices_id as $sevices_id) {
            $posts = new posts([
                'rooms_id' => $id,
                'sevices_id' => $sevices_id,
                'updated_at' => Carbon::now()->toDateTimeString(),

            ]);
            $posts->save();

            }
            return back()->with('thongbao', 'Cập nhập phòng thành công');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rooms = rooms::findOrFail($id);
        if ($rooms) {
            $rooms->Isdelete = true;
            $rooms->update();
            //echo "string";
            return back()->with('thongbao','Đã xóa thành công!');
        }
        else return back()->with('err','Xóa không thành công!');
    }
}

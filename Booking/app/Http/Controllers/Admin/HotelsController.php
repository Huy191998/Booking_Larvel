<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\hotel;

class HotelsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->seachname != null) {
            $hotel = hotel::where('isdelete', 0)->where('Name', 'like', '%' . $request->seachname . '%')->orWhere('id', 'like',
                '%' . $request->seachname . '%')->orWhere('Address', 'like',
                '%' . $request->seachname . '%')->orWhere('Phone', 'like',
                '%' . $request->seachname . '%')->orWhere('email', 'like',
                '%' . $request->seachname . '%')->orWhere('Status', 'like', '%' . $request->seachname . '%')->latest()->paginate(10);
            return view('Admin.Hotels.index', compact('hotel'));
        }
        $hotel = hotel::where('isdelete', false)->paginate(10);
        //dd($users);
        return view('Admin.Hotels.index', compact('hotel'));
    }

    public function destroy(Request $request)
    {

        $hotel = hotel::findOrFail($request->id);

        if ($hotel) {
            $hotel->Isdelete = true;
            $hotel->update();
            //echo "string";
        }
        return redirect("Admin/hotels")->with('thongbao', 'Đã xóa thành công !');
    }

    public function update(Request $request)
    {

        $hotel = hotel::findOrFail($request->id);

        if ($hotel) {
            $hotel->Status = true;
            $hotel->update();
            //echo "string";
        }

        return redirect("Admin/hotels")->with('loi', 'Đã kích hoạt thành công !');
    }

    public function update2(Request $request)
    {

        $hotel = hotel::findOrFail($request->id);

        if ($hotel) {
            $hotel->Status = false;
            $hotel->update();
            //echo "string";
        }

        return redirect("Admin/hotels")->with('loi', 'Đã khóa thành công !');
    }
}

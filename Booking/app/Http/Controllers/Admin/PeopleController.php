<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\users;
use App\Models\Peoples;

class PeopleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->seachname != null) {
            $People = Peoples::where('isdelete', 0)->where('first_name', 'like', '%' . $request->seachname . '%')->orWhere('id', 'like',
                '%' . $request->seachname . '%')->orWhere('lats_name', 'like',
                '%' . $request->seachname . '%')->orWhere('Address', 'like', '%' . $request->seachname . '%')->paginate(10);
            return view('Admin.Users.index', compact('People'));
        }

        $People = Peoples::where('isdelete', false)->paginate(10);
        //dd($users);
        return view('Admin.Users.index', compact('People'));
    }

    public function show($id)
    {
        $People = Peoples::findOrFail($id);
        //dd($People);
        return view('Admin.Users.show', compact('People'));
    }

    public function destroy(Request $request)
    {

        $users = users::findOrFail($request->id);
        $var = Peoples::where('users_id', $request->id)->get('id');
        $People = Peoples::findOrFail($var[0]->id);
        //dd($People);
        if ($users) {
            $users->Isdelete = true;
            $users->update();
            //echo "string";
        }
        if ($People) {
            $People->Isdelete = true;
            $People->update();
            //echo "string";
        }
        return redirect("Admin/users")->with('thongbao', 'Đã xóa thành công !');
    }
}

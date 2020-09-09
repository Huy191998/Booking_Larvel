<?php

namespace App\Http\Controllers\Admin;

use App\HelpersClass\Date;
use App\Http\Controllers\Controller;
use App\Models\blog;
use App\Models\bookrooms;
use App\Models\comments;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use App\Models\hotel;
use App\Models\images;
use App\Models\kindrooms;
use App\Models\roomcategorys;
use App\Models\sevices;
use App\Models\cities;
use App\Models\rooms;
use App\Models\users;
use Carbon\Carbon;
use App\Models\peoples;
use Session;
use Auth;
use DB;

class AdminController extends Controller
{
    public function index()
    {
        $bookrooms = bookrooms::all();
        $users = users::all();
        $comments = comments::all();
        $hotels = hotel::all();
        $cities = cities::all();
        $blog = blog::all();

        $listDay = Date::getListDayInMonth();

        //doanh thu phong theo thang
        $revenueTransactionMonth = bookrooms::whereMonth('created_at', date('m'))
            ->select(\DB::raw('sum(total) as totalMoney'), \DB::raw('DATE(created_at) day'))
            ->groupBy('day')
            ->get()->toArray();
        $arrRevenueTransactionMonth = [];
        foreach ($listDay as $day) {
            $totals = 0;
            foreach ($revenueTransactionMonth as $key => $revenue) {
                if ($revenue['day'] == $day) {
                    $totals = $revenue['totalMoney'];
                    break;
                }
            }
            $arrRevenueTransactionMonth[] = (int)$totals;
        }


//
//        $users = bookrooms::select(\DB::raw("COUNT(*) as count"))
//            ->whereYear('created_at', date('Y'))
//            ->groupBy(\DB::raw("Month(created_at)"))
//            ->pluck('count');


        //analytics
        $data = DB::table('peoples')->select(DB::raw('Sex as Sex'),
            DB::raw('count(*) as number'))->groupBy('Sex')->get();
        $array[] = ['Sex', 'Number'];
        foreach ($data as $key => $value) {
            $array[++$key] = [$value->Sex, $value->number];
        }

        return view('Admin.Home.index',
            compact('arrRevenueTransactionMonth', 'listDay', 'bookrooms', 'users', 'comments', 'hotels', 'cities',
                'blog'))->with('Sex', json_encode($array));

    }


}

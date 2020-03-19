<?php
namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
class SampleController extends Controller
{
    public function index(){
        $user_data = DB::select('select * from members');
        return view('sample',['data' => $user_data]);
    }
}

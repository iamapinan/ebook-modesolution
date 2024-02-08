<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->s !== '')
            $data = DB::table('users')->where('role_id', 2)->where('name', 'like', '%' . $request->s . '%')->select()->orderBy('id', 'DESC')->paginate(20);
        else
            $data = DB::table('users')->where('role_id', 2)->select()->orderBy('id', 'DESC')->paginate(20);

        return view('UserManager')->with('users', $data);
    }

    public function profile() {
        $data = DB::table('users')->where('id', Auth::user()->id )->select()->get();
        return view('profile')->with('profile', $data[0]);
    }

    public function update(Request $request, $id) {
        DB::table('users')->where('id', $id )
          ->update([
              'name' => $request->input('fullname' ), 
              'organization' => $request->input( 'organization' ) 
            ]);
        return back()->with('status', 'บันทึกเรียบร้อยแล้ว');
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class bookController extends Controller
{
    protected $fields = [
        'id', 
        'title', 
        'description', 
        'cover_file', 
        'author', 
        'user_id', 
        'isPublic', 
        'fileUrl', 
        'group_id', 
        'cat_id', 
        'view', 
        'sub_cat', 
        'grade', 
        'subject', 
        'gradetitle',
        'link_test',
        'recommend'
    ];

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    //
    public function index(){

        $books = DB::table('all_book_data')
        ->select($this->fields)
        ->where('user_id', Auth::id())
        ->orderBy('id', 'DESC')
        ->paginate(20);
       
        return view('book')->with('books', $books);
    }

    public function search(Request $request){

        $books = DB::table('all_book_data')
        ->select($this->fields)
        ->where('user_id', Auth::id())
        ->where('title', 'like', '%' . $request->q . '%')
        ->orWhere('description', 'like', '%' . $request->q . '%')
        ->orderBy('id', 'DESC')
        ->paginate(20);
       
        return view('book')->with('books', $books);
    }

    public function recommend(Request $request) {
        DB::table('book')
        ->where('id', $request->id)
        ->update(['recommend' => 1]);
        return back()->with('status', 'ตั้งเป็นเนื้อหาแนะนำแล้ว');
    }

    public function un_recommend(Request $request) {
        DB::table('book')
        ->where('id', $request->id)
        ->update(['recommend' => 0]);
        return back()->with('status', 'ยกเลิกเนื้อหาแนะนำแล้ว');
    }

    public function delete(Request $request) {

        $directory = Storage::disk('book')->path('/') . $request->id;
        DB::table('book')->where('id', '=', $request->id)->delete();
        Storage::deleteDirectory($directory);
        return back()->with('status', 'ลบเสร็จแล้ว');
    }
}

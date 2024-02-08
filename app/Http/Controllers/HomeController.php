<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $books = DB::table('all_book_data')
        ->select($this->fields)
        ->where( 'user_id', Auth::id() )
        ->orderBy('id', 'DESC')
        ->paginate(4);
        
        return view('home')->with('books',$books);
    }

    public function robot() {
        return view('robot');
    }
    public function group_files() {
        $groups = DB::table('user_groups')
        ->where('id', Auth::user()->user_groups_id)
        ->select()->get();

        return view('group_files')->with('user_groups', $groups[0]);
    }
}

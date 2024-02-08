<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use ChrisKonnertz\OpenGraph\OpenGraph;

class ViewController extends Controller
{
    //
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
        'type_book',
        'gradetitle',
        'link_pretest',
        'link_test'
    ];

    public function index(Request $request) {

        $content = DB::table('all_book_data')
        ->select($this->fields)
        ->where('id', $request->id)->get();

        $user = DB::table('users')->where('id', $content[0]->user_id)->first();

        if(count($content)==0) {
            return redirect('/404');
        }

        $title =  $content[0]->title.' - '. config('app.name');
        $ogp = new OpenGraph;
        $og = $ogp->title($content[0]->title)
        ->type('article')
        ->image(asset('storage/book/'.str_replace('thumb','large', $content[0]->cover_file) ))
        ->description($content[0]->description)
        ->url();

        DB::table('book')
        ->where('id', $request->id)
        ->update(['view'=>($content[0]->view+1)]);

        if(!Auth::guest()) {
            DB::table('view_history')
            ->insert(['content_id'=>$request->id, 'user'=>Auth::user()->id]);
        }

        return view('view', ['content' => $content, 'user_info' => $user], compact('title', 'og'));
    }
}

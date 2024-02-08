<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use ChrisKonnertz\OpenGraph\OpenGraph;

class ShelfController extends Controller
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
    //
    public function index(Request $request){

        $user = DB::table('users')->select(['id','name'])->where('email', base64_decode($request->id))->get();

        $recommend = DB::table('all_book_data')
        ->select($this->fields)
        ->where('user_id', $user[0]->id)
        ->where('isPublic', 1)
        ->where('recommend', 1)
        ->orderBy('id', 'DESC')
        ->paginate(20);
        
        if(Auth::guest()) {
            $books = DB::table('all_book_data')
            ->select($this->fields)
            ->where( 'user_id', $user[0]->id )
            ->where('isPublic', 1)
            ->orderBy('id', 'DESC')
            ->paginate(20);
        } else {
            $books = DB::table('all_book_data')
            ->select($this->fields)
            ->where( 'user_id', $user[0]->id )
            ->orderBy('id', 'DESC')
            ->paginate(20);
        }

        $banner = DB::table('banner')->where('user_id', $user[0]->id)->first();

        $banner_data = [
            'file' => $banner == null ? '/images/banner.jpg' : Storage::disk('banner')->url($banner->banner_file)
        ];
        $title =  'ห้องสมุดของ '.$user[0]->name .' - '.env('APP_NAME');
        $ogp = new OpenGraph;
        $og = $ogp->title($user[0]->name)
        ->type('article')
        ->image($banner_data['file'])
        ->description('ห้องสมุดของ '.$user[0]->name)
        ->url();

        return view('list', ['list'=> $books, 'user'=> $user[0], 'recommend'=>$recommend, 'banner' => $banner_data], compact('title', 'og'));
    }
}

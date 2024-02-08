<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class bannerController extends Controller
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
    public function index()
    {
        $banner = DB::table('banner')->where('user_id', Auth::user()->id)->first();

        $banner_data = [
            'file' => $banner == null ? '/images/banner.jpg' : Storage::disk('banner')->url($banner->banner_file)
        ];

        return view( 'banner', ['banner'=> $banner_data] );
    }

    public function upload(Request $request)
    {
        //bannerfile
        // var_dump($request->file('bannerfile'));
        list($width, $height, $type, $attr) = getimagesize($request->file('bannerfile')->getRealPath());
        $user_id = Auth::user()->id;
        $md5Name = md5_file($request->file('bannerfile')->getRealPath());
        $guessExtension = $request->file('bannerfile')->guessExtension();
        $ext_allow = ['jpg', 'png', 'jpeg'];

        if(!in_array($guessExtension, $ext_allow))
        {
            return view('banner', ['status' => 'ชนิดไฟล์ไม่ถูกต้อง รองรับเฉพาะ .jpg, .png เท่านั้น', 'respone_type' => 'warning' ]);
        }

        if($width !== 1100 && $height !== 560)
        {
            return view('banner', ['status' => 'ความกว้างแและความสูงของรูปต้องเป็น 1100x560 เท่านั้น', 'respone_type' => 'warning' ]);
        }
        
        if(file_exists(Storage::disk('banner')->path($user_id . '/'. $md5Name.'.'.$guessExtension)))
            unlink(Storage::disk('banner')->path($user_id . '/'. $md5Name.'.'.$guessExtension));

        $file = $request->file('bannerfile')->storeAs($user_id, $md5Name.'.'.$guessExtension  ,'banner');

        DB::table('banner')->updateOrInsert(
            ['user_id' => $user_id], ['banner_file' => $file]
        );

        return view('banner', [ 'banner' => [ 'file'=>'/storage/banner/'.$file ], 'status' => 'บันทึกเรียบร้อยแล้ว', 'respone_type' => 'success' ]);
    }
}


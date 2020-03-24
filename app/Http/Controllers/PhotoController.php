<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhoto;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function __construct()
    {
        // 認証が必要
        $this->middleware('auth');
    }
    /**
 * 写真一覧
 */
   public function index()
   {
    $photos = Photo::with(['owner'])
        ->orderBy(Photo::CREATED_AT, 'desc')->paginate();

    return $photos;
    }
    /**
        * 写真投稿
        * @param StorePhoto $request
        * @return \Illuminate\Http\Response
        */
       public function create(StorePhoto $request)
       {
           $photo = new Photo();
           list(, $fileData) = explode(';', $request->imageData);
           list(, $fileData) = explode(',', $fileData);
           $fileData = base64_decode($fileData);
           Storage::put('test.jpeg', $fileData);

           // データベースエラー時にファイル削除を行うため
           // トランザクションを利用する
           DB::beginTransaction();

           try {
           } catch (\Exception $exception) {
           }

           // リソースの新規作成なので
           // レスポンスコードは201(CREATED)を返却する
           return response($photo, 201);
       }    
}

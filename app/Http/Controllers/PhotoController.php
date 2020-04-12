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
    //$this->middleware('auth');
    $this->middleware('auth')->except(['index', 'download', 'show']);
  }
  /**
  * 写真一覧
  */
  public function index(Request $request)
  {
    $photos = [];
    $photos = Photo::where('event_id', $request->event_id)->get();
    \Log::info('$photos');
    \Log::info($photos);

    $contents = [];
    foreach ($photos as $photo)
    {
      $photo->data = Storage::get($photo->filename);
    }
    return response($photos, 201);
  }
  /**
  * 写真投稿
  * @param StorePhoto $request
  * @return \Illuminate\Http\Response
  */
  public function create(StorePhoto $request)
  {
    //イベントにすでに写真が登録されている確認する
    $photo = Photo::where('event_id', $request->event_id)->first();

    //レコード作成
    $photo = new Photo();
    $photo->filename = $photo->id . '.' . $request->extension;
    $fileData = $request->imageData;

    //file保存
    Storage::put($photo->filename, $fileData);
    // 画像は不要
    $photo->data= '';
    //イベントID
    $photo->event_id= $request->eventId;
    //所有ユーザID
    $photo->user_id = \Auth::user()->id;
    //保存
    $photo->save();

    // リソースの新規作成なので
    // レスポンスコードは201(CREATED)を返却する
    return response($photo, 201);
  }         

}

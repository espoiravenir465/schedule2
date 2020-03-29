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
      //$photos = Photo::with(['owner'])
      //    ->orderBy(Photo::CREATED_AT, 'desc')->paginate();
      //return $photos;
      \Log::info('phototest');
      $photo = Photo::where('event_id', $request->event_id)->first();
      if (is_null($photo)){
        $content = null;
      }else{
        $content = Storage::get($photo->filename);
      }

      //$content = base64_encode($content);
      //\Log::info($content);
      return response($content, 201);
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
       \Log::info('aaaphoto');
       \Log::info($photo);
       if (empty($photo))
       {
         //レコード作成
         $photo = new Photo();
         $photo->filename = $photo->id . '.' . $request->extension;

         //base64 decode
         //list(, $fileData) = explode(';', $request->imageData);
         //list(, $fileData) = explode(',', $fileData);
         //$fileData = base64_decode($fileData);
         $fileData = $request->imageData;

         //file保存
         Storage::put($photo->filename, $fileData);

         //イベントID
         $photo->event_id= $request->eventId;
         //所有ユーザID
         $photo->user_id = \Auth::user()->id;
         //保存
         $photo->save();

         // リソースの新規作成なので
         // レスポンスコードは201(CREATED)を返却する
         return response($photo, 201);
       } else {
         //写真がなければ削除のみ、あれば削除して作成
         \Log::info('imageData');
         \Log::info($request->imageData);
         if(empty($request->imageData))
         {
           //ファイル削除
           Storage::delete($photo->filename);
           //DB削除
           $photo = Photo::where('event_id', $request->event_id)->delete();
         }else{
           //ファイル削除
           Storage::delete($photo->filename);
           //DB削除
           $photo = Photo::where('event_id', $request->event_id)->delete();
           //レコード作成
           $photo = new Photo();
           $photo->filename = $photo->id . '.' . $request->extension;

           $fileData = $request->imageData;

           //file保存
           Storage::put($photo->filename, $fileData);

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
     }     

}

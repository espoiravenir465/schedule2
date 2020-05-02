<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhoto;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;



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

    $client = new Google_Client();
    $client->setClientId( env('GOOGLE_CLIENT_ID') );
    $client->setClientSecret( env('GOOGLE_CLIENT_SECRET') );
    $client->setScopes( env('APP_URL') );
    $client->refreshToken( env('GOOGLE_REFRESH_TOKEN') );
    $service = new Google_Service_Drive($client);

    $contents = [];
    foreach ($photos as $photo)
    {
      //local用
      //$photo->data = Storage::get($photo->filename);

      //$response = $service->files->get($photo->file_id
      //,[
      //  "alt" => "media"
      //  ]
      //);
      $http = $client->authorize();
      $response = $http->request(
        'GET',
        //'/drive/v3/files/' . $photo->file_id . '/export'
        '/drive/v3/files/' . $photo->file_id,
        [
          //'query' => ['alt' => 'media'],
          'query' => ['alt' => 'media','mimeType' => $photo->mime_type],
        ]
      );
      //\Log::info($response->getImageMediaMetadata());
      //$photo->data = $response->getImageMediaMetadata();
      $photo->data = $response->getBody()->getContents();
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

    //file保存(local用)
    //Storage::put($photo->filename, $fileData);

    $client = new Google_Client();
    $client->setClientId( env('GOOGLE_CLIENT_ID') );
    $client->setClientSecret( env('GOOGLE_CLIENT_SECRET') );
    $client->setScopes( env('APP_URL') );
    $client->refreshToken( env('GOOGLE_REFRESH_TOKEN') );
    $service = new Google_Service_Drive($client);

    //$results = $service->files->listFiles();
    //if (count($results->getFiles()) == 0) {
    //  \Log::info("No Files found.");
    //} else {
    //  \Log::info("filels:");
    //  foreach ($results->getFiles() as $file) {
    //    \Log::info($file->getName());
    //  }
    //}

    $data['name'] =$photo->filename;
    $mimeType = 'image/jpeg';
    //if ($request->extension == 'png'):
    //  $mimeType = 'image/png';
    //elseif ($request->extension == 'gif'):
    //  $mimeType = 'image/gif';
    //else:
    //  $mimeType = 'image/jpeg';
    //endif;
    //$data['mimeType'] = $mimeType;
    $data['mimeType'] = 'image/jpeg';
    $data['parents'][] = env('GOOGLE_SCHEDULE_FOLDER_ID');
    //$data['data'][] = $request->imageData;
    $data['uploadType'] = 'multipart';

    $fileMetadata = new Google_Service_Drive_DriveFile($data);
    //$file = $service->files->create($fileMetadata,['fields'=>'id,name,parents,mimeType,data']);
    $file = $service->files->create($fileMetadata,
    array('fields'=>'id',
    'data'=>$request->imageData)
    );
    // 画像は不要
    $photo->data= '';
    //イベントID
    $photo->event_id= $request->eventId;
    // mimeType
    $photo->mime_type= $mimeType;
    //所有ユーザID
    $photo->user_id = \Auth::user()->id;
    //ファイルID
    $photo->file_id = $file->id;
    //保存
    $photo->save();

    // リソースの新規作成なので
    // レスポンスコードは201(CREATED)を返却する
    return response($photo, 201);
  }

}

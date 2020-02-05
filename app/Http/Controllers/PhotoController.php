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

    
}

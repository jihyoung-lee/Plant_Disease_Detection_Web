<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function admin()
    {
        $train = Train::latest()->paginate(5);

        return view('admin/admin', compact('train'));
    }

    public function delete(Train $train)
    {
        $train->delete();

        return redirect()->route('admin.admin');
    }

    public function adminUpdate(Train $train)
    {
        $train->update(['modify' => 1]);
        $url = $this->getUrl($train);
        $this->sliceFileDir($train, $url);

        return redirect()->back()->with([
            'status' => '수정완료'
        ]);
    }

    public function getUrl(Train $train): string
    {
        $url = $train->cropName . '_' . $train->sickNameKor;
        return $url;
    }

    public function sliceFileDir(Train $train, string $url): void
    {
        $filename = $train->url;
        $userOpinion = $train->userOpinion;
        $class = class_basename($filename);
        Storage::disk('s3')->move("public/{$url}/{$class}", "public/{$userOpinion}/{$class}");
        $slice = Str::before($filename, '/public/');
        $urlUpdate = $slice . "/public/{$userOpinion}/{$class}";

        $train->url = $urlUpdate;
        $train->modify = 1;
        $train->save();
    }
}

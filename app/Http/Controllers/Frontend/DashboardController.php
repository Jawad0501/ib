<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\Quote;
use App\Models\UserUploadedFile;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $folders = Folder::where('user_id', auth()->id())->latest()->take(6)->get();
        $recently_viewed_files = [];
        $latestQuotes = Quote::where('user_id', auth()->id())->where('recently_viewed_file', '!=', null)->orderByDesc(
            DB::raw("JSON_UNQUOTE(JSON_EXTRACT(recently_viewed_file, '$.viewing_time'))")
        )->get();

        $latestFiles = UserUploadedFile::where('user_id', auth()->id())->where('recently_viewed_file', '!=', null)->orderByDesc(
            DB::raw("JSON_UNQUOTE(JSON_EXTRACT(recently_viewed_file, '$.viewing_time'))")
        )->get();

        foreach($latestQuotes as $quote){
            array_push($recently_viewed_files, $quote);
        }

        foreach($latestFiles as $file){
            array_push($recently_viewed_files, $file);
        }

        $recently_viewed_files = collect($recently_viewed_files);

        $recently_viewed_files = $recently_viewed_files->sortByDesc(function ($file) {
            return data_get($file, 'recently_viewed_file.viewing_time');
        })->take(6);

        return view('frontend.dashboard', compact('folders', 'recently_viewed_files'));
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\QuoteStage;
use App\Http\Controllers\Controller;
use App\Models\Quote;
use App\Models\Folder;
use App\Models\FolderFile;
use App\Models\UserUploadedFile;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRequestQuoteMail;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $folders = Folder::query()->where('user_id', auth()->id())->get();
        $artworks = Quote::where('user_id', auth()->id())->stage(QuoteStage::ORDER)->where('artwork', '!=', null)->get();
        $artworks_inside_folders = FolderFile::where('user_id', auth()->id())->where('type', 'artwork')->get();
        $artworks_without_folder = [];

        if(count($artworks) > 0){
            if(count($artworks_inside_folders) > 0){
                foreach($artworks as $artwork){
                    $file = null;
                    foreach($artworks_inside_folders as $file_inside_folder){
                        if($artwork->artwork == $file_inside_folder->file_path){
                            $file = $artwork;
                            break;
                        }
                    }

                    if($file != null){
                        array_push($artworks_without_folder, $artwork);
                    }

                }

                $artworks_without_folder = collect($artworks_without_folder);
                $artworks = $artworks->diff($artworks_without_folder);

                if(count($artworks) == 0){
                    $artworks = null;
                }
            }
        }
        else{
            $artworks = null;
        }




        $approval_files = Quote::where('user_id', auth()->id())->stage(QuoteStage::ORDER)->where('approval_file', '!=', null)->get();
        $approval_files_inside_folders = FolderFile::where('user_id', auth()->id())->where('type', 'approval_file')->get();
        $approval_files_without_folder = [];

        if(count($approval_files) > 0){
            if(count($approval_files_inside_folders) > 0){
                foreach($approval_files as $approval_file){
                    $file = null;
                    foreach($approval_files_inside_folders as $file_inside_folder){
                        if($approval_file->approval_file == $file_inside_folder->file_path){
                            $file = $approval_file;
                            break;
                        }
                    }

                    if($file != null){
                        array_push($approval_files_without_folder, $approval_file);
                    }

                }

                $approval_files_without_folder = collect($approval_files_without_folder);
                $approval_files = $approval_files->diff($approval_files_without_folder);

                if(count($approval_files) == 0){
                    $approval_files = null;
                }
            }
        }
        else{
            $approval_files = null;
        }


        $uploaded_files = UserUploadedFile::where('user_id', auth()->id())->where('artwork', false)->get();
        $uploaded_files_inside_folder = FolderFile::where('user_id', auth()->id())->where('type', 'uploaded_file')->get();
        $uploaded_files_without_folder = [];

        if(count($uploaded_files) > 0){
            if(count($uploaded_files_inside_folder) > 0){
                foreach($uploaded_files as $uploaded_file){
                    $file = null;
                    foreach($uploaded_files_inside_folder as $file_inside_folder){
                        if($uploaded_file->file_path == $file_inside_folder->file_path){
                            $file = $uploaded_file;
                            break;
                        }
                    }

                    if($file != null){
                        array_push($uploaded_files_without_folder, $uploaded_file);
                    }

                }

                $uploaded_files_without_folder = collect($uploaded_files_without_folder);
                $uploaded_files = $uploaded_files->diff($uploaded_files_without_folder);

                if(count($uploaded_files) == 0){
                    $uploaded_files = null;
                }
            }
        }
        else{
            $uploaded_files = null;
        }

        $uploaded_artworks = UserUploadedFile::where('user_id', auth()->id())->where('artwork', true)->get();
        $uploaded_artworks_inside_folder = FolderFile::where('user_id', auth()->id())->where('type', 'uploaded_file')->get();
        $uploaded_artworks_without_folder = [];

        if(count($uploaded_artworks) > 0){
            if(count($uploaded_artworks_inside_folder) > 0){
                foreach($uploaded_artworks as $uploaded_file){
                    $file = null;
                    foreach($uploaded_artworks_inside_folder as $file_inside_folder){
                        if($uploaded_file->file_path == $file_inside_folder->file_path){
                            $file = $uploaded_file;
                            break;
                        }
                    }

                    if($file != null){
                        array_push($uploaded_artworks_without_folder, $uploaded_file);
                    }

                }

                $uploaded_artworks_without_folder = collect($uploaded_artworks_without_folder);
                $uploaded_artworks = $uploaded_artworks->diff($uploaded_artworks_without_folder);

                if(count($uploaded_artworks) == 0){
                    $uploaded_artworks = null;
                }
            }
        }
        else{
            $uploaded_artworks = null;
        }


        return view('frontend.file.index', compact('folders', 'artworks', 'approval_files', 'uploaded_files', 'uploaded_artworks'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $file = Quote::query()->where('id', decrypt($id))->where('user_id', auth()->id())->stage(QuoteStage::PROOF)->firstOrFail();
        return view('frontend.file.download', compact('file'));
    }

    public function addFolder()
    {
        return view('frontend.file.add-folder');
    }

    public function showFolder($id){


        $selected_folder = Folder::where('id', $id)->first();
        $files = $selected_folder->files()->get();
        $artworks = [];
        $approval_files = [];
        $uploaded_files = [];
        $uploaded_artworks = [];
        $folders = Folder::query()->where('user_id', auth()->id())->get();

        foreach($files as $file){
            if($file->type == 'artwork'){
                $artwork = Quote::where('id', $file->quote_id)->first();
                array_push($artworks, $artwork);
            }


            if($file->type == 'approval_file'){
                $approval_file = Quote::where('id', $file->quote_id)->first();
                array_push($approval_files, $approval_file);
            }

            if($file->type == 'uploaded_file'){
                $uploaded_file = UserUploadedFile::where('id', $file->file_id)->first();
                if($uploaded_file->artwork == false){
                    array_push($uploaded_files, $uploaded_file);
                }
                else{
                    array_push($uploaded_artworks, $uploaded_file);
                }
            }
        }

        if(count($artworks) > 0){
            $artworks = collect($artworks);
        }
        else{
            $artworks = null;
        }

        if(count($approval_files) > 0){
            $approval_files = collect($approval_files);
        }
        else{
            $approval_files = null;
        }

        if(count($uploaded_files) > 0){
            $uploaded_files = collect($uploaded_files);
        }
        else{
            $uploaded_files = null;
        }

        if(count($uploaded_artworks) > 0){
            $uploaded_artworks = collect($uploaded_artworks);
        }
        else{
            $uploaded_artworks = null;
        }



        return view('frontend.file.show-folder', compact('selected_folder', 'artworks', 'approval_files', 'uploaded_files', 'folders', 'uploaded_artworks'));
    }

    public function storeFolder(Request $request)
    {
        $request->validate([
            'folder_name' => ['required'],
            'icon_color'  => ['required']
        ]);

        $folder = Folder::create([
            'user_id'     => auth()->id(),
            'folder_name' => $request->folder_name,
            'icon_color'  => $request->icon_color
        ]);

        // $activity = Activity::where('subject_id', $folder->id)->where('causer_id', auth()->id())->where('event', 'created')->first();
        // $activity->update([
        //     'description' => 'Created a folder named '.$request->folder_name.'.',
        // ]);

        return response()->json(['message' => 'Folder Created']);
    }

    public function updateFolder(Request $request, $id){
        $folder = Folder::where('id', $id)->first();
        $temp = $folder;

        $folder->update([
            'folder_name' => $request->folder_name,
            'icon_color'  => $request->icon_color
        ]);

        // $activity = Activity::where('subject_id', $folder->id)->where('causer_id', auth()->id())->where('event', 'updated')->first();
        // if($folder->folder_name !== $temp->folder_name && $folder->icon_color !== $temp->icon_color){
        //     $activity->update([
        //         'description' => 'Updated the folder named '.$temp->folder_name.' to '.$folder->folder_name.' and changed its icon color.',

        //     ]);
        // }
        // else{
        //     if($folder->folder_name !== $temp->folder_name){
        //         $activity->update([
        //             'description' => 'Updated the folder named '.$temp->folder_name.' to '.$folder->folder_name.'.',
        //         ]);
        //     }
        //     elseif($folder->icon_color !== $temp->icon_color){
        //         $activity->update([
        //             'description' => 'Updated the icon color of the folder named '.$folder->folder_name.'.',
        //         ]);
        //     }
        // }


        return response()->json(['message' => 'Folder Updated']);
    }

    public function deleteFolder($id){
        $folder = Folder::where('id', $id)->first();
        $folder_files = $folder->files()->get();

        foreach($folder_files as $file){
            $file->delete();
        }

        $folder->delete();

        return redirect()->back();
    }

    public function moveToFolder(Request $request){

        $validated = $request->validate([
            'id' => 'required',
            'quote' => 'required',
            'type' => 'required'
        ]);


        if($request->type == 'uploaded_file'){

            //this is not quote. It is an UserUploadedFile model colletion.
            $file_path = $request->quote['file_path'];

            FolderFile::create([
                'user_id'   => auth()->id(),
                'quote_id'  => null,
                'file_id'   => $request->quote['id'],
                'folder_id' => $request->id,
                'file_path' => $file_path,
                'type'      => $request->type
            ]);

            return response()->json(['messase' => $file_path]);
        }
        else{
            if($request->type == 'artwork'){

                $file_path = $request->quote['artwork'];

            }
            if($request->type == 'approval_file'){
                $file_path = $request->quote['approval_file'];

            }

            FolderFile::create([
                'user_id'   => auth()->id(),
                'quote_id'  => $request->quote['id'],
                'folder_id' => $request->id,
                'file_path' => $file_path,
                'type'      => $request->type
            ]);

            return response()->json(['messase' => $file_path]);
        }

    }

    public function checkFileInFolder(Request $request){

        if($request->type == 'artwork'){
            $quotes = Quote::where('user_id', auth()->id())->stage(QuoteStage::ORDER)->where('artwork', '!=', null)->get();
            $files_in_folder = FolderFile::where('user_id', auth()->id())->where('type', 'artwork')->get();
            $file_already_in_folder = [];

            foreach($quotes as $quote){
                $file = $files_in_folder->where('file_path', $quote->artwork)->first();
                if($file != null){
                    array_push($file_already_in_folder, $file);
                }
            }

            if(count($file_already_in_folder) == count($quotes)){
                return response()->json(['message' => 'all files are in folder', 'quotes' => count($quotes), 'files_in_folder' => count($file_already_in_folder)]);
            }
        }

        if($request->type == 'approval_file'){
            $quotes = Quote::where('user_id', auth()->id())->stage(QuoteStage::ORDER)->where('approval_file', '!=', null)->get();
            $files_in_folder = FolderFile::where('user_id', auth()->id())->where('type', 'approval_file')->get();
            $file_already_in_folder = [];

            foreach($quotes as $quote){
                $file = $files_in_folder->where('file_path', $quote->approval_file)->first();
                if($file != null){
                    array_push($file_already_in_folder, $file);
                }

            }

            if(count($file_already_in_folder) == count($quotes)){
                return response()->json(['message' => 'all files are in folder', 'quotes' => count($quotes), 'files_in_folder' => count($file_already_in_folder)]);
            }
        }
        // $quotes = Quote::where('user_id', auth()->id())->
        return response()->json(['messase' => $request->type]);
    }

    public function removeFileFromFolder($folder_id, $file_id, $type){

        if($type == 'uploaded_file'){
            $file = FolderFile::where('user_id', auth()->id())->where('file_id', $file_id)->where('folder_id', $folder_id)->first();
        }
        else{
            $file = FolderFile::where('user_id', auth()->id())->where('quote_id', $file_id)->where('folder_id', $folder_id)->first();
        }

        $file->delete();

        return redirect()->back();
    }

    public function moveToAnotherFolder($move_to, $move_from, $file, $type){

        if($type != 'uploaded_file'){
            $folderfile = FolderFile::where('user_id', auth()->id())->where('quote_id', $file)->where('folder_id', $move_from)->first();
            $folderfile->folder_id = $move_to;
            $folderfile->save();

            return redirect()->back();
        }
        else{
            $folderfile = FolderFile::where('user_id', auth()->id())->where('file_id', $file)->where('folder_id', $move_from)->first();
            $folderfile->folder_id = $move_to;
            $folderfile->save();

            return redirect()->back();
        }

    }

    public function uploadFile($folder){

        if($folder == 'null'){
            $selected_folder = null;
            return view('frontend.file.upload-file', compact('selected_folder'));
        }
        else{
            $selected_folder = Folder::where('id', $folder)->first();
            return view('frontend.file.upload-file', compact('selected_folder'));
        }

    }

    public function storeFile(Request $request){

        $request->validate([
            'uploaded_file' => ['file','mimes:pdf,docx,zip,png,jpg','max:10240']
        ]);

        if($request->hasFile('uploaded_file')){
            $file_path = fileUpload($request->file('uploaded_file'), 'uploaded');
        }

        if($request->type == 'artwork'){
            $artwork = true;
        }
        else{
            $artwork = false;
        }

        UserUploadedFile::create([
            'user_id' => auth()->id(),
            'file_path' => $file_path,
            'artwork' => $artwork
        ]);

        return response()->json(['message' => 'file uploaded']);
    }

    public function storeFileToFolder(Request $request, $folder){

        $request->validate([
            'uploaded_file' => ['file','mimes:pdf,docx,zip,png,jpg','max:10240']
        ]);

        if($request->hasFile('uploaded_file')){
            $file_path = fileUpload($request->file('uploaded_file'), 'uploaded');
        }

        $file = UserUploadedFile::create([
            'user_id' => auth()->id(),
            'file_path' => $file_path
        ]);

        FolderFile::create([
            'user_id'   => auth()->id(),
            'file_id'   => $file->id,
            'folder_id' => $folder,
            'file_path' => $file_path,
            'type'      => 'uploaded_file'
        ]);

        return response()->json(['message' => 'file uploaded to folder']);
    }

    public function updateRecentView(Request $request){

        if($request->type == 'artwork'){
            $quote = Quote::where('id', $request->file['id'])->first();
            $quote->recently_viewed_file = ['file' => $request->file['artwork'], 'viewing_time' => Carbon::now()->format('Y-m-d H:i:s')];
            $quote->save();
        }
        elseif($request->type == 'approval_file'){
            $quote = Quote::where('id', $request->file['id'])->first();
            $quote->recently_viewed_file = ['file' => $request->file['approval_file'], 'viewing_time' => Carbon::now()->format('Y-m-d H:i:s')];
            $quote->save();
        }
        elseif($request->type == 'uploaded_file'){
            $file = UserUploadedFile::where('id', $request->file['id'])->first();
            $file->recently_viewed_file = ['file' => $request->file['file_path'], 'viewing_time' => Carbon::now()->format('Y-m-d H:i:s')];
            $file->save();
        }
        return response()->json(['message' => 'recently view changed']);
    }

    public function requestQuote($file, $type){

        $title = 'Place Order';
        $user = auth()->user();

        if($type == 'uploaded'){
            $file = UserUploadedFile::where('id', $file)->first();
        }
        if($type == 'order'){
            $file = Quote::where('id', $file)->first();
        }

        return view('frontend.file.quote-or-order-modal', compact('title', 'file', 'user', 'type'));
    }

    public function addItem(){
        return view('frontend.file.item');
    }

    public function submitQuoteRequest(Request $request){

        $requested_quote = $request->validate([
            'file_id' => ['required'],
            'user_id' => ['required'],
            'type' => ['required'],
            'title' => ['required'],
            'reference' => ['nullable'],
            'pO_Number' => ['nullable'],
            'delivery_Address' => ['required'],
            'note' => ['nullable', 'string'],
            'items'                             => ['nullable','array'],
            'items.*.product_name'              => ['nullable'],
            'items.*.qty'                       => ['nullable','integer'],
        ]);

        $user = User::where('id', $request->user_id)->first();


        if($request->type == 'uploaded'){
            $file = UserUploadedFile::where('id', $request->file_id)->first();
        }
        else if($request->type == 'order'){
            $file = Quote::where('id', $request->file_id)->first();
        }

        Mail::to(config('mail.from.address'))->send(new UserRequestQuoteMail($requested_quote, $file, $user));
        return response()->json(['message' => 'Order Request Sent Succesfully']);
    }
}

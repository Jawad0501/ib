@php
    $previous_route = app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName();
    if($previous_route == 'file.index'){
        $action = route('file.store-file');
    }
    else{
        $action = route('file.store-file-to-folder', $selected_folder->id);
    }

    if($previous_route == 'file.index'){
        $redirect = route('file.index');
    }
    else{
        $redirect = route('file.show-folder', $selected_folder->id);
    }


@endphp

<x-frontend.modal title="Upload File" size="md" button="Upload" action={{$action}}  redirect="{{$redirect}}"  enctype="multipart/form-data">
    {{-- <div class="mb-3">
        <div>
            <label for="uploaded_file" class="w-100 mb-1 form-label">
                File Type
            </label>
            <select name="type" id="type" class="form-control">
                <option value="artwork" selected>Artwork</option>
                <option value="other">Other</option>
            </select>
        </div>
    </div> --}}
    <div class="mb-3">
        <div>
            <label for="uploaded_file" class="w-100 mb-1 form-label">
                Select File
            </label>
            <input id="uploaded_file" name="uploaded_file" type="file" class="form-control"  >
            <p class="mt-2" style="font-size:14px;">Accepted file types: .png, .jpg, .pdf, .docx, .zip</p>
        </div>
    </div>
</x-frontend.modal>




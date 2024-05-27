@extends('layouts.frontend.app')

@section('title', 'Files')

@section('content')
    <section style="" class="">

        <div class="container mb-5">

            <h5 class="fs-5 fw-semibold my-4">My Files</h5>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <h5 class="fs-5 fw-semibold mt-4">Folders</h5>
                <x-admin.page-button :href="route('file.add-folder')" id="editBtn" class="bg-dark text-white mt-4" title="Add Folder" icon="add" />
            </div>

            <hr class="mb-5">
            <div class="row gy-4 mb-5 ">
                @foreach($folders as $folder)
                <div class="col-xs-12 col-md-6 col-lg-4 col-xl-6 col-xxl-4">
                    <div class="bg-white p-4 rounded-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <label for="edit_icon_color_{{$folder->id}}" class="block" onclick="event.stopPropagation()">
                                    <input id="edit_icon_color_{{$folder->id}}" disabled type="color"  class="position-absolute mt-2 color" value="#0cd3ed" style="z-index: -999" oninput="updateFirst(event,{{$folder->id}})" onchange="watchColorPicker(event,{{$folder->id}})">
                                    <svg id="folder_icon_{{$folder->id}}" xmlns="http://www.w3.org/2000/svg" width="32" viewBox="0 0 512 512" fill="{{$folder->icon_color}}" >
                                        <path d="M64 480H448c35.3 0 64-28.7 64-64V160c0-35.3-28.7-64-64-64H288c-10.1 0-19.6-4.7-25.6-12.8L243.2 57.6C231.1 41.5 212.1 32 192 32H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64z"/>
                                    </svg>
                                </label>
                                <input id="folder_{{$folder->id}}" data-id="{{$folder->id}}" onclick="event.stopPropagation()" class="folder mb-0 ms-3 fw-semibold remove-default-input-style w-75" readonly value="{{$folder->folder_name}}"/>
                            </div>
                            <div class="d-flex align-items-center" style="cursor: pointer;">
                                <div class="me-2">
                                    <a href="{{route('file.show-folder', $folder->id)}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                                            <path d="M384 480h48c11.4 0 21.9-6 27.6-15.9l112-192c5.8-9.9 5.8-22.1 .1-32.1S555.5 224 544 224H144c-11.4 0-21.9 6-27.6 15.9L48 357.1V96c0-8.8 7.2-16 16-16H181.5c4.2 0 8.3 1.7 11.3 4.7l26.5 26.5c21 21 49.5 32.8 79.2 32.8H416c8.8 0 16 7.2 16 16v32h48V160c0-35.3-28.7-64-64-64H298.5c-17 0-33.3-6.7-45.3-18.7L226.7 50.7c-12-12-28.3-18.7-45.3-18.7H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H87.7 384z"/>
                                        </svg>
                                    </a>
                                </div>
                                <div id="edit-folder-{{$folder->id}}" class="me-2" onclick="editFolder(event, {{$folder->id}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                        <path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/>
                                    </svg>
                                </div>
                                <input type="hidden" id="token_{{$folder->id}}" value="{{csrf_token()}}">
                                <div id="update-folder-{{$folder->id}}" class="me-2 d-none" onclick="updateFolder(event, {{$folder->id}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                        <path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/>
                                    </svg>
                                </div>
                                <div style="cursor: pointer;" id="deleteModalOpener" data-bs-toggle="modal" data-bs-target="#delete-warning-modal-{{$folder->id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                        <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/>
                                    </svg>
                                </div>
                                @include('components.frontend.delete-warning-modal', ['title' => 'Folder', 'route' => 'file.delete-folder', 'id' => $folder->id])
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>


            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fs-5 fw-semibold mt-4">Uploaded Artwork</h5>
                <x-admin.page-button :href="route('file.upload-file', 'null')" id="editBtn" class="bg-dark text-white mt-4" title="Upload File" icon="add" />
            </div>
            <hr class="mb-5">

            <div id="artworks_section" class="row gy-4 mb-5">
                @if($artworks)
                @foreach($artworks as $file)

                @php
                    $file_path = $file->artwork;
                    $file_name = pathinfo($file_path, PATHINFO_BASENAME);
                    $file_filename = pathinfo($file_path, PATHINFO_FILENAME);
                    $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                @endphp

                <div id="file_{{$file_filename}}"  class="col-xs-12 col-md-6 col-lg-4 col-xl-6 col-xxl-4">
                    <div  class="bg-white p-4 rounded-4">
                        <div class=" d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center" data-bs-toggle="dropdown">
                                @if($file_extension == 'png' || $file_extension == 'jpg')
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" fill="#00e1ff" viewBox="0 0 512 512" class="me-3">
                                    <path d="M448 80c8.8 0 16 7.2 16 16V415.8l-5-6.5-136-176c-4.5-5.9-11.6-9.3-19-9.3s-14.4 3.4-19 9.3L202 340.7l-30.5-42.7C167 291.7 159.8 288 152 288s-15 3.7-19.5 10.1l-80 112L48 416.3l0-.3V96c0-8.8 7.2-16 16-16H448zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm80 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/>
                                </svg>
                                @elseif($file_extension == 'pdf' || $file_extension == 'docx')
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" fill="#00e1ff" viewBox="0 0 384 512" class="me-3">
                                    <path d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z"/>
                                </svg>
                                @elseif($file_extension == 'zip')
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" fill="#00e1ff" viewBox="0 0 384 512" class="me-3">
                                    <path d="M64 464c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16h48c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16h48v80c0 17.7 14.3 32 32 32h80V448c0 8.8-7.2 16-16 16H64zM64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V154.5c0-17-6.7-33.3-18.7-45.3L274.7 18.7C262.7 6.7 246.5 0 229.5 0H64zm48 112c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H128c-8.8 0-16 7.2-16 16zm0 64c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H128c-8.8 0-16 7.2-16 16zm-6.3 71.8L82.1 335.9c-1.4 5.4-2.1 10.9-2.1 16.4c0 35.2 28.8 63.7 64 63.7s64-28.5 64-63.7c0-5.5-.7-11.1-2.1-16.4l-23.5-88.2c-3.7-14-16.4-23.8-30.9-23.8H136.6c-14.5 0-27.2 9.7-30.9 23.8zM128 336h32c8.8 0 16 7.2 16 16s-7.2 16-16 16H128c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                                </svg>
                                @endif
                                <div class="fw-semibold" style="cursor:pointer; font-size:14px">
                                    {{$file_filename}}
                                </div>
                                @include('components.frontend.show-file-modal', ['title' => $file_filename, 'file' => $file_path, 'file_type' => $file_extension ])

                            </div>
                            <div class="dropdown p-0 m-0">

                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 128 512" class="dropdown-toggle" data-bs-toggle="dropdown">
                                    <path d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z"/>
                                </svg>
                                <div class="dropdown-menu p-0 m-0" aria-labelledby="dropdownMenuButton1">

                                    <div class="accordion m-0 p-0" id="accordionExample" onclick="event.stopPropagation()">
                                        <div class="accordion-item" style="cursor:pointer;">
                                            <p class="accordion-header" id="headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="font-size: 14px">
                                                Add To Folder
                                            </button>
                                            </p>

                                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body p-0">
                                                    @foreach($folders as $folder)
                                                        {{-- <form action="{{route('file.move-to-another-folder', [$folder->id, $selected_folder->id, $file->id, 'uploadedFile'])}}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <li><button type="submit" class="dropdown-item" >{{$folder->folder_name}}</button></li>
                                                        </form> --}}
                                                        <div onclick="moveToFolder({{$folder->id}}, '{{csrf_token()}}', {{$file}}, 'artwork', '{{$file_filename}}')" class="dropdown-item" href="#">{{$folder->folder_name}}</div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="border-top" style="font-size: 14px; padding:10px;cursor:pointer">
                                            <div id="showFileModalOpener" onclick="updateRecentlyViewedFile({{$file}}, 'artwork', '{{csrf_token()}}')" data-bs-toggle="modal" data-bs-target="#showFileModal_{{$file_filename}}" style="cursor:pointer; font-size:14px">
                                                Show
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="border-top" style="font-size: 14px; padding:10px;cursor:pointer">
                                            <a href="{{ uploadedFile($file_path) }}" download style="all:unset">
                                                Download
                                            </a>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="border-top" style="font-size: 14px; padding:10px;cursor:pointer">
                                            <a id="addBtn" href="{{ route('file.request-for-quote', [$file, 'order']) }}" style="all:unset">
                                                Place Order
                                            </a>
                                        </div>
                                    </div>

                                    {{-- <div>
                                        <form action="{{route('file.remove-file-from-folder', [$selected_folder->id, $file->id, 'uploadedFile'])}}" method="POST" >
                                            @csrf
                                            @method('DELETE')

                                            <button style="all:unset; font-size: 14px; padding:10px;">
                                                Remove
                                            </button>
                                        </form>

                                    </div> --}}
                                </div>
                            </div>
                            {{-- <div class="d-flex align-items-center" style="cursor: pointer;">
                                <a href="{{ uploadedFile($file_path) }}" download class="me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                        <path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
                                    </svg>
                                </a>
                                <div class="dropdown">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <path d="M512 416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96C0 60.7 28.7 32 64 32H192c20.1 0 39.1 9.5 51.2 25.6l19.2 25.6c6 8.1 15.5 12.8 25.6 12.8H448c35.3 0 64 28.7 64 64V416zM232 376c0 13.3 10.7 24 24 24s24-10.7 24-24V312h64c13.3 0 24-10.7 24-24s-10.7-24-24-24H280V200c0-13.3-10.7-24-24-24s-24 10.7-24 24v64H168c-13.3 0-24 10.7-24 24s10.7 24 24 24h64v64z"/>
                                    </svg>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <h6 class="py-2 px-3">Add to Folder</h6>
                                        @foreach($folders as $folder)
                                            <li><div onclick="moveToFolder({{$folder->id}}, '{{csrf_token()}}', {{$file}}, 'uploadedFile', '{{$file_filename}}')" class="dropdown-item" href="#">{{$folder->folder_name}}</div></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                @endforeach
                @endif

                @if($approval_files)
                @foreach($approval_files as $file)

                @php
                    $file_path = $file->approval_file;
                    $file_name = pathinfo($file_path, PATHINFO_BASENAME);
                    $file_filename = pathinfo($file_path, PATHINFO_FILENAME);
                    $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                @endphp

                <div id="file_{{$file_filename}}"  class="col-xs-12 col-md-6 col-lg-4 col-xl-6 col-xxl-4">
                    <div  class="bg-white p-4 rounded-4">
                        <div class=" d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center" data-bs-toggle="dropdown">
                                @if($file_extension == 'png' || $file_extension == 'jpg')
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" fill="#00e1ff" viewBox="0 0 512 512" class="me-3">
                                    <path d="M448 80c8.8 0 16 7.2 16 16V415.8l-5-6.5-136-176c-4.5-5.9-11.6-9.3-19-9.3s-14.4 3.4-19 9.3L202 340.7l-30.5-42.7C167 291.7 159.8 288 152 288s-15 3.7-19.5 10.1l-80 112L48 416.3l0-.3V96c0-8.8 7.2-16 16-16H448zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm80 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/>
                                </svg>
                                @elseif($file_extension == 'pdf' || $file_extension == 'docx')
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" fill="#00e1ff" viewBox="0 0 384 512" class="me-3">
                                    <path d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z"/>
                                </svg>
                                @elseif($file_extension == 'zip')
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" fill="#00e1ff" viewBox="0 0 384 512" class="me-3">
                                    <path d="M64 464c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16h48c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16h48v80c0 17.7 14.3 32 32 32h80V448c0 8.8-7.2 16-16 16H64zM64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V154.5c0-17-6.7-33.3-18.7-45.3L274.7 18.7C262.7 6.7 246.5 0 229.5 0H64zm48 112c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H128c-8.8 0-16 7.2-16 16zm0 64c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H128c-8.8 0-16 7.2-16 16zm-6.3 71.8L82.1 335.9c-1.4 5.4-2.1 10.9-2.1 16.4c0 35.2 28.8 63.7 64 63.7s64-28.5 64-63.7c0-5.5-.7-11.1-2.1-16.4l-23.5-88.2c-3.7-14-16.4-23.8-30.9-23.8H136.6c-14.5 0-27.2 9.7-30.9 23.8zM128 336h32c8.8 0 16 7.2 16 16s-7.2 16-16 16H128c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                                </svg>
                                @endif
                                <div class="fw-semibold" style="cursor:pointer; font-size:14px">
                                    {{$file_filename}}
                                </div>
                                @include('components.frontend.show-file-modal', ['title' => $file_filename, 'file' => $file->file_path, 'file_type' => $file_extension ])

                            </div>
                            <div class="dropdown p-0 m-0">

                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 128 512" class="dropdown-toggle" data-bs-toggle="dropdown">
                                    <path d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z"/>
                                </svg>
                                <div class="dropdown-menu p-0 m-0" aria-labelledby="dropdownMenuButton1">

                                    <div class="accordion m-0 p-0" id="accordionExample" onclick="event.stopPropagation()">
                                        <div class="accordion-item" style="cursor:pointer;">
                                            <p class="accordion-header" id="headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="font-size: 14px">
                                                Add To Folder
                                            </button>
                                            </p>

                                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body p-0">
                                                    @foreach($folders as $folder)
                                                        {{-- <form action="{{route('file.move-to-another-folder', [$folder->id, $selected_folder->id, $file->id, 'uploadedFile'])}}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <li><button type="submit" class="dropdown-item" >{{$folder->folder_name}}</button></li>
                                                        </form> --}}
                                                        <div onclick="moveToFolder({{$folder->id}}, '{{csrf_token()}}', {{$file}}, 'approval_file', '{{$file_filename}}')" class="dropdown-item" href="#">{{$folder->folder_name}}</div>
                                                    @endforeach
                                                </div>
                                                {{-- <li class="accordion-body p-0"><div onclick="moveToFolder({{$folder->id}}, '{{csrf_token()}}', {{$file}}, 'uploadedFile', '{{$file_filename}}')" class="dropdown-item" href="#">{{$folder->folder_name}}</div></li> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="border-top" style="font-size: 14px; padding:10px;cursor:pointer">
                                            <div id="showFileModalOpener" onclick="updateRecentlyViewedFile({{$file}}, 'approval_file', '{{csrf_token()}}')" data-bs-toggle="modal" data-bs-target="#showFileModal_{{$file_filename}}" style="cursor:pointer; font-size:14px">
                                                Show
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="border-top" style="font-size: 14px; padding:10px;cursor:pointer">
                                            <a href="{{ uploadedFile($file_path) }}" download style="all:unset">
                                                Download
                                            </a>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="border-top" style="font-size: 14px; padding:10px;cursor:pointer">
                                            <a id="addBtn" href="{{ route('file.request-for-quote', [$file, 'order']) }}" style="all:unset">
                                                Place Order
                                            </a>
                                        </div>
                                    </div>

                                    {{-- <div>
                                        <form action="{{route('file.remove-file-from-folder', [$selected_folder->id, $file->id, 'uploadedFile'])}}" method="POST" >
                                            @csrf
                                            @method('DELETE')

                                            <button style="all:unset; font-size: 14px; padding:10px;">
                                                Remove
                                            </button>
                                        </form>

                                    </div> --}}
                                </div>
                            </div>
                            {{-- <div class="d-flex align-items-center" style="cursor: pointer;">
                                <a href="{{ uploadedFile($file_path) }}" download class="me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                        <path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
                                    </svg>
                                </a>
                                <div class="dropdown">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <path d="M512 416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96C0 60.7 28.7 32 64 32H192c20.1 0 39.1 9.5 51.2 25.6l19.2 25.6c6 8.1 15.5 12.8 25.6 12.8H448c35.3 0 64 28.7 64 64V416zM232 376c0 13.3 10.7 24 24 24s24-10.7 24-24V312h64c13.3 0 24-10.7 24-24s-10.7-24-24-24H280V200c0-13.3-10.7-24-24-24s-24 10.7-24 24v64H168c-13.3 0-24 10.7-24 24s10.7 24 24 24h64v64z"/>
                                    </svg>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <h6 class="py-2 px-3">Add to Folder</h6>
                                        @foreach($folders as $folder)
                                            <li><div onclick="moveToFolder({{$folder->id}}, '{{csrf_token()}}', {{$file}}, 'uploadedFile', '{{$file_filename}}')" class="dropdown-item" href="#">{{$folder->folder_name}}</div></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                @endforeach
                @endif

                @if($uploaded_artworks)
                    @foreach($uploaded_artworks as $file)

                    @php
                        $file_path = $file->file_path;
                        $file_name = pathinfo($file_path, PATHINFO_BASENAME);
                        $file_filename = pathinfo($file_path, PATHINFO_FILENAME);
                        $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                    @endphp

                    <div id="file_{{$file_filename}}"  class="col-xs-12 col-md-6 col-lg-4 col-xl-6 col-xxl-4">
                        <div  class="bg-white p-4 rounded-4">
                            <div class=" d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center" data-bs-toggle="dropdown">
                                    @if($file_extension == 'png' || $file_extension == 'jpg')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" fill="#00e1ff" viewBox="0 0 512 512" class="me-3">
                                        <path d="M448 80c8.8 0 16 7.2 16 16V415.8l-5-6.5-136-176c-4.5-5.9-11.6-9.3-19-9.3s-14.4 3.4-19 9.3L202 340.7l-30.5-42.7C167 291.7 159.8 288 152 288s-15 3.7-19.5 10.1l-80 112L48 416.3l0-.3V96c0-8.8 7.2-16 16-16H448zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm80 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/>
                                    </svg>
                                    @elseif($file_extension == 'pdf' || $file_extension == 'docx')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" fill="#00e1ff" viewBox="0 0 384 512" class="me-3">
                                        <path d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z"/>
                                    </svg>
                                    @elseif($file_extension == 'zip')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" fill="#00e1ff" viewBox="0 0 384 512" class="me-3">
                                        <path d="M64 464c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16h48c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16h48v80c0 17.7 14.3 32 32 32h80V448c0 8.8-7.2 16-16 16H64zM64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V154.5c0-17-6.7-33.3-18.7-45.3L274.7 18.7C262.7 6.7 246.5 0 229.5 0H64zm48 112c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H128c-8.8 0-16 7.2-16 16zm0 64c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H128c-8.8 0-16 7.2-16 16zm-6.3 71.8L82.1 335.9c-1.4 5.4-2.1 10.9-2.1 16.4c0 35.2 28.8 63.7 64 63.7s64-28.5 64-63.7c0-5.5-.7-11.1-2.1-16.4l-23.5-88.2c-3.7-14-16.4-23.8-30.9-23.8H136.6c-14.5 0-27.2 9.7-30.9 23.8zM128 336h32c8.8 0 16 7.2 16 16s-7.2 16-16 16H128c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                                    </svg>
                                    @endif
                                    <div class="fw-semibold" style="cursor:pointer; font-size:14px">
                                        {{$file_filename}}
                                    </div>
                                    @include('components.frontend.show-file-modal', ['title' => $file_filename, 'file' => $file->file_path, 'file_type' => $file_extension ])

                                </div>
                                <div class="dropdown p-0 m-0">

                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 128 512" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <path d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z"/>
                                    </svg>
                                    <div class="dropdown-menu p-0 m-0" aria-labelledby="dropdownMenuButton1">

                                        <div class="accordion m-0 p-0" id="accordionExample" onclick="event.stopPropagation()">
                                            <div class="accordion-item" style="cursor:pointer;">
                                                <p class="accordion-header" id="headingOne">
                                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="font-size: 14px">
                                                    Add To Folder
                                                  </button>
                                                </p>

                                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body p-0">
                                                        @foreach($folders as $folder)
                                                            {{-- <form action="{{route('file.move-to-another-folder', [$folder->id, $selected_folder->id, $file->id, 'uploadedFile'])}}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <li><button type="submit" class="dropdown-item" >{{$folder->folder_name}}</button></li>
                                                            </form> --}}
                                                            <div onclick="moveToFolder({{$folder->id}}, '{{csrf_token()}}', {{$file}}, 'uploadedFile', '{{$file_filename}}')" class="dropdown-item" href="#">{{$folder->folder_name}}</div>
                                                        @endforeach
                                                    </div>
                                                    {{-- <li class="accordion-body p-0"><div onclick="moveToFolder({{$folder->id}}, '{{csrf_token()}}', {{$file}}, 'uploadedFile', '{{$file_filename}}')" class="dropdown-item" href="#">{{$folder->folder_name}}</div></li> --}}
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="border-top" style="font-size: 14px; padding:10px;cursor:pointer">
                                                <div id="showFileModalOpener" onclick="updateRecentlyViewedFile({{$file}}, 'uploadedFile', '{{csrf_token()}}')" data-bs-toggle="modal" data-bs-target="#showFileModal_{{$file_filename}}" style="cursor:pointer; font-size:14px">
                                                    Show
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="border-top" style="font-size: 14px; padding:10px;cursor:pointer">
                                                <a href="{{ uploadedFile($file_path) }}" download style="all:unset">
                                                    Download
                                                </a>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="border-top" style="font-size: 14px; padding:10px;cursor:pointer">
                                                <a id="addBtn" href="{{ route('file.request-for-quote', [$file, 'uploaded']) }}" style="all:unset">
                                                    Place Order
                                                </a>
                                            </div>
                                        </div>

                                        {{-- <div>
                                            <form action="{{route('file.remove-file-from-folder', [$selected_folder->id, $file->id, 'uploadedFile'])}}" method="POST" >
                                                @csrf
                                                @method('DELETE')

                                                <button style="all:unset; font-size: 14px; padding:10px;">
                                                    Remove
                                                </button>
                                            </form>

                                        </div> --}}
                                    </div>
                                </div>
                                {{-- <div class="d-flex align-items-center" style="cursor: pointer;">
                                    <a href="{{ uploadedFile($file_path) }}" download class="me-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                            <path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
                                        </svg>
                                    </a>
                                    <div class="dropdown">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <path d="M512 416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96C0 60.7 28.7 32 64 32H192c20.1 0 39.1 9.5 51.2 25.6l19.2 25.6c6 8.1 15.5 12.8 25.6 12.8H448c35.3 0 64 28.7 64 64V416zM232 376c0 13.3 10.7 24 24 24s24-10.7 24-24V312h64c13.3 0 24-10.7 24-24s-10.7-24-24-24H280V200c0-13.3-10.7-24-24-24s-24 10.7-24 24v64H168c-13.3 0-24 10.7-24 24s10.7 24 24 24h64v64z"/>
                                        </svg>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <h6 class="py-2 px-3">Add to Folder</h6>
                                            @foreach($folders as $folder)
                                                <li><div onclick="moveToFolder({{$folder->id}}, '{{csrf_token()}}', {{$file}}, 'uploadedFile', '{{$file_filename}}')" class="dropdown-item" href="#">{{$folder->folder_name}}</div></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif

                    @if($uploaded_files)
                    @foreach($uploaded_files as $file)

                    @php
                        $file_path = $file->file_path;
                        $file_name = pathinfo($file_path, PATHINFO_BASENAME);
                        $file_filename = pathinfo($file_path, PATHINFO_FILENAME);
                        $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                    @endphp

                    <div id="file_{{$file_filename}}"  class="col-xs-12 col-md-6 col-lg-4 col-xl-6 col-xxl-4">
                        <div  class="bg-white p-4 rounded-4">
                            <div class=" d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center" data-bs-toggle="dropdown">
                                    @if($file_extension == 'png' || $file_extension == 'jpg')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" fill="#00e1ff" viewBox="0 0 512 512" class="me-3">
                                        <path d="M448 80c8.8 0 16 7.2 16 16V415.8l-5-6.5-136-176c-4.5-5.9-11.6-9.3-19-9.3s-14.4 3.4-19 9.3L202 340.7l-30.5-42.7C167 291.7 159.8 288 152 288s-15 3.7-19.5 10.1l-80 112L48 416.3l0-.3V96c0-8.8 7.2-16 16-16H448zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm80 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/>
                                    </svg>
                                    @elseif($file_extension == 'pdf' || $file_extension == 'docx')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" fill="#00e1ff" viewBox="0 0 384 512" class="me-3">
                                        <path d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z"/>
                                    </svg>
                                    @elseif($file_extension == 'zip')
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" fill="#00e1ff" viewBox="0 0 384 512" class="me-3">
                                        <path d="M64 464c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16h48c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16h48v80c0 17.7 14.3 32 32 32h80V448c0 8.8-7.2 16-16 16H64zM64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V154.5c0-17-6.7-33.3-18.7-45.3L274.7 18.7C262.7 6.7 246.5 0 229.5 0H64zm48 112c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H128c-8.8 0-16 7.2-16 16zm0 64c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H128c-8.8 0-16 7.2-16 16zm-6.3 71.8L82.1 335.9c-1.4 5.4-2.1 10.9-2.1 16.4c0 35.2 28.8 63.7 64 63.7s64-28.5 64-63.7c0-5.5-.7-11.1-2.1-16.4l-23.5-88.2c-3.7-14-16.4-23.8-30.9-23.8H136.6c-14.5 0-27.2 9.7-30.9 23.8zM128 336h32c8.8 0 16 7.2 16 16s-7.2 16-16 16H128c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                                    </svg>
                                    @endif
                                    <div class="fw-semibold" style="cursor:pointer; font-size:14px">
                                        {{$file_filename}}
                                    </div>
                                    @include('components.frontend.show-file-modal', ['title' => $file_filename, 'file' => $file->file_path, 'file_type' => $file_extension ])

                                </div>
                                <div class="dropdown p-0 m-0">

                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 128 512" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <path d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z"/>
                                    </svg>
                                    <div class="dropdown-menu p-0 m-0" aria-labelledby="dropdownMenuButton1">

                                        <div class="accordion m-0 p-0" id="accordionExample" onclick="event.stopPropagation()">
                                            <div class="accordion-item" style="cursor:pointer;">
                                                <p class="accordion-header" id="headingOne">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="font-size: 14px">
                                                    Add To Folder
                                                </button>
                                                </p>

                                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body p-0">
                                                        @foreach($folders as $folder)
                                                            {{-- <form action="{{route('file.move-to-another-folder', [$folder->id, $selected_folder->id, $file->id, 'uploadedFile'])}}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <li><button type="submit" class="dropdown-item" >{{$folder->folder_name}}</button></li>
                                                            </form> --}}
                                                            <div onclick="moveToFolder({{$folder->id}}, '{{csrf_token()}}', {{$file}}, 'uploadedFile', '{{$file_filename}}')" class="dropdown-item" href="#">{{$folder->folder_name}}</div>
                                                        @endforeach
                                                    </div>
                                                    {{-- <li class="accordion-body p-0"><div onclick="moveToFolder({{$folder->id}}, '{{csrf_token()}}', {{$file}}, 'uploadedFile', '{{$file_filename}}')" class="dropdown-item" href="#">{{$folder->folder_name}}</div></li> --}}
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="border-top" style="font-size: 14px; padding:10px;cursor:pointer">
                                                <div id="showFileModalOpener" onclick="updateRecentlyViewedFile({{$file}}, 'uploadedFile', '{{csrf_token()}}')" data-bs-toggle="modal" data-bs-target="#showFileModal_{{$file_filename}}" style="cursor:pointer; font-size:14px">
                                                    Show
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="border-top" style="font-size: 14px; padding:10px;cursor:pointer">
                                                <a href="{{ uploadedFile($file_path) }}" download style="all:unset">
                                                    Download
                                                </a>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="border-top" style="font-size: 14px; padding:10px;cursor:pointer">
                                                <a id="addBtn" href="{{ route('file.request-for-quote', [$file, 'uploaded']) }}" style="all:unset">
                                                    Place Order
                                                </a>
                                            </div>
                                        </div>

                                        {{-- <div>
                                            <form action="{{route('file.remove-file-from-folder', [$selected_folder->id, $file->id, 'uploadedFile'])}}" method="POST" >
                                                @csrf
                                                @method('DELETE')

                                                <button style="all:unset; font-size: 14px; padding:10px;">
                                                    Remove
                                                </button>
                                            </form>

                                        </div> --}}
                                    </div>
                                </div>
                                {{-- <div class="d-flex align-items-center" style="cursor: pointer;">
                                    <a href="{{ uploadedFile($file_path) }}" download class="me-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                            <path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
                                        </svg>
                                    </a>
                                    <div class="dropdown">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <path d="M512 416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96C0 60.7 28.7 32 64 32H192c20.1 0 39.1 9.5 51.2 25.6l19.2 25.6c6 8.1 15.5 12.8 25.6 12.8H448c35.3 0 64 28.7 64 64V416zM232 376c0 13.3 10.7 24 24 24s24-10.7 24-24V312h64c13.3 0 24-10.7 24-24s-10.7-24-24-24H280V200c0-13.3-10.7-24-24-24s-24 10.7-24 24v64H168c-13.3 0-24 10.7-24 24s10.7 24 24 24h64v64z"/>
                                        </svg>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <h6 class="py-2 px-3">Add to Folder</h6>
                                            @foreach($folders as $folder)
                                                <li><div onclick="moveToFolder({{$folder->id}}, '{{csrf_token()}}', {{$file}}, 'uploadedFile', '{{$file_filename}}')" class="dropdown-item" href="#">{{$folder->folder_name}}</div></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
            </div>

            <div class="">


                <div id="uploadedFiles_section" class="row gy-4">

                </div>
            </div>
        </div>

    </section>

    <style>
        .remove-default-input-style{
            outline: none;
            border: none;
        }

        .accordion-button:focus {
            box-shadow: none;
            outline: none;
            background-color: transparent;

        }

        .accordion-button{
            padding: 10px !important;
        }

        .accordion{
            border: none !important;
            --bs-accordion-border-color: none !important;
        }

        .accordion-header{
            font-size: 12px !important;
            --bs-accordion-btn-icon-width: 1rem;
        }

        .accordion-button:not(.collapsed){
            border-bottom: 1px solid lightgray;
        }
    </style>


    <script>

        document.querySelector("section").addEventListener('click', function(){

            for (let i = 0; i < folders.length; i++) {
                let folder = folders[i];
                let edit_icon_color = document.getElementById(`edit_icon_color_${folder.dataset.id}`)
                if(folder.classList.contains('pe-none')){
                }
                else{
                    folder.classList.add('pe-none')
                }

                folder.setAttribute('readonly', true);

                if(folder.classList.contains('remove-default-input-style')){
                }
                else{
                    folder.classList.add('remove-default-input-style');
                }

                if(edit_icon_color.hasAttribute('disabled')){

                }
                else{
                    edit_icon_color.setAttribute('disabled', true)
                }

                let update_icon = document.getElementById(`update-folder-${folder.dataset.id}`)
                let edit_icon = document.getElementById(`edit-folder-${folder.dataset.id}`)

                if(edit_icon.classList.contains('d-none')){
                    edit_icon.classList.remove('d-none')
                }
                else{

                }

                if(update_icon.classList.contains('d-none')){

                }
                else{
                    update_icon.classList.add('d-none')
                }
            }
        })

        function editFolder(event, id){

            event.stopPropagation();
            folders = document.getElementsByClassName("folder")
            for (let i = 0; i < folders.length; i++) {
                let folder = folders[i];
                if(folder.dataset.id == id){
                    let edit_input = document.getElementById(`folder_${id}`)
                    let edit_icon_color = document.getElementById(`edit_icon_color_${id}`)

                    if(edit_input.classList.contains('pe-none')){
                        edit_input.classList.remove('pe-none');
                    }
                    edit_input.removeAttribute('readonly');
                    edit_input.classList.remove('remove-default-input-style');
                    edit_input.click();

                    edit_icon_color.removeAttribute('disabled')

                    let update_icon = document.getElementById(`update-folder-${id}`)
                    let edit_icon = document.getElementById(`edit-folder-${id}`)

                    if(edit_icon.classList.contains('d-none')){

                    }
                    else{
                        edit_icon.classList.add('d-none')
                    }

                    if(update_icon.classList.contains('d-none')){
                        update_icon.classList.remove('d-none')
                    }
                }
                else{
                    let edit_input = document.getElementById(`folder_${folder.dataset.id}`);
                    let edit_icon_color = document.getElementById(`edit_icon_color_${folder.dataset.id}`)
                    if(edit_input.classList.contains('pe-none')){

                    }
                    else{
                        edit_input.classList.add('pe-none');
                    }
                    edit_input.setAttribute('readonly', true);
                    edit_input.classList.add('remove-default-input-style');

                    if(edit_icon_color.hasAttribute('disabled')){

                    }
                    else{
                        edit_icon_color.setAttribute('disabled', true)
                    }

                    let update_icon = document.getElementById(`update-folder-${folder.dataset.id}`)
                    let edit_icon = document.getElementById(`edit-folder-${folder.dataset.id}`)

                    if(edit_icon.classList.contains('d-none')){
                        edit_icon.classList.remove('d-none')
                    }
                    else{

                    }

                    if(update_icon.classList.contains('d-none')){

                    }
                    else{
                        update_icon.classList.add('d-none')
                    }
                }
            }


        }

        function updateFolder(event, id){
            event.stopPropagation();
            let csrfToken = document.getElementById(`token_${id}`).value
            let folder_name = document.getElementById(`folder_${id}`).value
            let icon_color = document.getElementById(`edit_icon_color_${id}`).value
            var url = "{{route('file.update-folder', 'id')}}";
            url = url.replace('id', id);
            fetch(url, {
                method:'PUT',
                credentials: "same-origin",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                body:JSON.stringify({
                    id: id,
                    folder_name: folder_name,
                    icon_color: icon_color
                }),
            })
            .then(res=>res.clone().json())
            .then( json => {
                let edit_input = document.getElementById(`folder_${id}`);
                let edit_icon_color = document.getElementById(`edit_icon_color_${id}`)
                if(edit_input.classList.contains('pe-none')){

                }
                else{
                    edit_input.classList.add('pe-none');
                }
                edit_input.setAttribute('readonly', true);
                edit_input.classList.add('remove-default-input-style');

                if(edit_icon_color.hasAttribute('disabled')){

                }
                else{
                    edit_icon_color.setAttribute('disabled', true)
                }

                let update_icon = document.getElementById(`update-folder-${id}`)
                let edit_icon = document.getElementById(`edit-folder-${id}`)

                if(edit_icon.classList.contains('d-none')){
                    edit_icon.classList.remove('d-none')
                }
                else{

                }

                if(update_icon.classList.contains('d-none')){

                }
                else{
                    update_icon.classList.add('d-none')
                }
            })
        }


        function updateFirst(event, id) {
            icon = document.getElementById(`folder_icon_${id}`);
            icon.style.fill = event.target.value;
        }

        function watchColorPicker(event, id) {
            icon = document.getElementById(`folder_icon_${id}`);
            icon.style.fill = event.target.value;
        }

        function moveToFolder(folder, csrfToken, quote, type, filename){
            let url = "{{route('file.move-to-folder')}}"
            fetch(url, {
                method:'POST',
                credentials: "same-origin",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                body:JSON.stringify({
                    id: folder,
                    quote: quote,
                    type: type
                }),
            })
            .then(res=>res.clone().json())
            .then(json => {
                let element = document.getElementById(`file_${filename}`);
                element.classList.remove('col-sm-6');
                element.classList.remove('col-lg-4');
                element.classList.add('d-none');


                let url = "{{route('file.check-file-belongs-to-folder', 'type')}}"
                url = url.replace('type', type)
                fetch(url)
                .then(res=>res.clone().json())
                .then(json => {
                    console.log(json);
                    if(type == 'artwork'){
                        if(json.message == 'all files are in folder'){
                            document.getElementById('artworks_section').innerHTML = '<div class="text-center w-100">No existing artworks!</div>'
                        }
                    }

                    if(type == 'approval_file'){
                        if(json.message == 'all files are in folder'){
                            document.getElementById('approval_files_section').innerHTML = '<div class="text-center w-100">No existing approval files!</div>'
                        }
                    }
                })

            })
        }

        function updateRecentlyViewedFile(file, type, _token){
            let url = "{{route('file.update-recently-viewed-file')}}";
            fetch(url, {
                method: 'PUT',
                credentials: "same-origin",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": _token
                },
                body:JSON.stringify({
                    file: file,
                    type: type,
                }),
            })
            .then(res=>res.clone().json())
            .then(json => {
                console.log(json);
            })
        }
    </script>
@endsection

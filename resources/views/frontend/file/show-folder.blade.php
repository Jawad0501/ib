@extends('layouts.frontend.app')

@section('title', $selected_folder->folder_name)

@section('content')
    <section style="height: calc(100vh - 100px)" class="mb-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fs-5 fw-semibold mb-4"> <a href="{{route('file.index')}}" style="all: unset; cursor: pointer">My Files</a> > {{$selected_folder->folder_name}}</h5>
                <x-admin.page-button :href="route('file.upload-file', $selected_folder->id)" id="editBtn" class="bg-dark text-white mt-4" title="Upload File" icon="add" />
            </div>
            <div id="artworks_section" class="row gy-4 mb-5">
                @if($artworks)
                @foreach($artworks as $file)

                @php
                    $file_path = $file->artwork;
                    $file_name = pathinfo($file_path, PATHINFO_BASENAME);
                    $file_filename = pathinfo($file_path, PATHINFO_FILENAME);
                    $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                @endphp

                <div id="file_{{$file_filename}}"  class="col-sm-6 col-lg-4">
                    <div  class="bg-white p-4 rounded-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center"  data-bs-toggle="dropdown">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" fill="#00e1ff" viewBox="0 0 512 512" class="me-3">
                                    <path d="M448 80c8.8 0 16 7.2 16 16V415.8l-5-6.5-136-176c-4.5-5.9-11.6-9.3-19-9.3s-14.4 3.4-19 9.3L202 340.7l-30.5-42.7C167 291.7 159.8 288 152 288s-15 3.7-19.5 10.1l-80 112L48 416.3l0-.3V96c0-8.8 7.2-16 16-16H448zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm80 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/>
                                </svg>
                                <div style="cursor:pointer;">
                                    {{$file_name}}
                                </div>

                                @include('components.frontend.show-file-modal', ['title' => $file_filename, 'file' => $file->artwork, 'file_type' => $file_extension])

                            </div>
                            <div class="d-flex align-items-center" style="cursor: pointer;">
                                {{-- <a href="{{ uploadedFile($file_path) }}" download class="me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                        <path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
                                    </svg>
                                </a> --}}
                                <div>
                                    <div class="dropdown p-0 m-0">

                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 128 512" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <path d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z"/>
                                        </svg>
                                        <div class="dropdown-menu p-0 m-0" aria-labelledby="dropdownMenuButton1">
                                            <div class="accordion m-0 p-0" id="accordionExample" onclick="event.stopPropagation()">
                                                <div class="accordion-item" style="cursor:pointer;">
                                                    <p class="accordion-header" id="headingOne">
                                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="font-size: 14px">
                                                        Move To Folder
                                                      </button>
                                                    </p>

                                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body p-0">
                                                            @foreach($folders as $folder)
                                                                @if($folder->id != $selected_folder->id)
                                                                    <form action="{{route('file.move-to-another-folder', [$folder->id, $selected_folder->id, $file->id, 'artwork'])}}" method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <li><button type="submit" class="dropdown-item" >{{$folder->folder_name}}</button></li>
                                                                    </form>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                  </div>
                                            </div>

                                            <div>
                                                <div class="border-top" style="font-size: 14px; padding:10px;cursor:pointer">
                                                    <div id="showFileModalOpener" onclick="updateRecentlyViewedFile({{$file}}, 'uploaded_file', '{{csrf_token()}}')" data-bs-toggle="modal" data-bs-target="#showFileModal_{{$file_filename}}" style="cursor:pointer; font-size:14px">
                                                        Show
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="border-bottom border-top" style="font-size: 14px; padding:10px;">
                                                    <a href="{{ uploadedFile($file_path) }}" download style="all:unset">
                                                        Download
                                                    </a>
                                                </div>
                                            </div>

                                            <div>
                                                <form method="POST" action="{{route('file.remove-file-from-folder', [$selected_folder->id, $file->id, 'artwork'])}}">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button style="all:unset; font-size: 14px; padding:10px;">
                                                        Remove
                                                    </button>
                                                </form>
                                            </div>

                                            <div>
                                                <div class="border-top" style="font-size: 14px; padding:10px;cursor:pointer">
                                                    <a id="addBtn" href="{{ route('file.request-for-quote', [$file, 'order']) }}" style="all:unset">
                                                        Place Order
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

                <div id="file_{{$file_filename}}"  class="col-sm-6 col-lg-4">
                    <div  class="bg-white p-4 rounded-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center"  data-bs-toggle="dropdown">
                                @if($file_extension == 'png' || $file_extension == 'jpg' || $file_extension == 'jpeg')
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" fill="#00e1ff" viewBox="0 0 512 512" class="me-3">
                                    <path d="M448 80c8.8 0 16 7.2 16 16V415.8l-5-6.5-136-176c-4.5-5.9-11.6-9.3-19-9.3s-14.4 3.4-19 9.3L202 340.7l-30.5-42.7C167 291.7 159.8 288 152 288s-15 3.7-19.5 10.1l-80 112L48 416.3l0-.3V96c0-8.8 7.2-16 16-16H448zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm80 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/>
                                </svg>
                                @elseif($file_extension == 'pdf' || $file_extension == 'docx')
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" fill="#00e1ff" viewBox="0 0 384 512" class="me-3">
                                    <path d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z"/>
                                </svg>
                                @elseif($file_extension == 'zip')
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" fill="#00e1ff" viewBox="0 0 384 512" class="me-3">
                                    <path d="M64 464c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16h48c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16h48v80c0 17.7 14.3 32 32 32h80V448c0 8.8-7.2 16-16 16H64zM64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V154.5c0-17-6.7-33.3-18.7-45.3L274.7 18.7C262.7 6.7 246.5 0 229.5 0H64zm48 112c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H128c-8.8 0-16 7.2-16 16zm0 64c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H128c-8.8 0-16 7.2-16 16zm-6.3 71.8L82.1 335.9c-1.4 5.4-2.1 10.9-2.1 16.4c0 35.2 28.8 63.7 64 63.7s64-28.5 64-63.7c0-5.5-.7-11.1-2.1-16.4l-23.5-88.2c-3.7-14-16.4-23.8-30.9-23.8H136.6c-14.5 0-27.2 9.7-30.9 23.8zM128 336h32c8.8 0 16 7.2 16 16s-7.2 16-16 16H128c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                                </svg>
                                @endif
                                <div style="cursor:pointer;">
                                    {{$file_name}}
                                </div>
                                @include('components.frontend.show-file-modal', ['title' => $file_filename, 'file' => $file->approval_file, 'file_type' => $file_extension ])

                            </div>
                            <div class="d-flex align-items-center" style="cursor: pointer;">
                                {{-- <a href="{{ uploadedFile($artwork_path) }}" download class="me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                        <path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
                                    </svg>
                                </a> --}}
                                <div>
                                    <div class="dropdown p-0 m-0">

                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 128 512" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <path d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z"/>
                                        </svg>
                                        <div class="dropdown-menu p-0 m-0" aria-labelledby="dropdownMenuButton1">
                                            <div class="accordion m-0 p-0" id="accordionExample" onclick="event.stopPropagation()">
                                                <div class="accordion-item" style="cursor:pointer;">
                                                    <p class="accordion-header" id="headingOne">
                                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="font-size: 14px">
                                                        Move To Folder
                                                      </button>
                                                    </p>

                                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body p-0">
                                                            @foreach($folders as $folder)
                                                                @if($folder->id != $selected_folder->id)
                                                                    <form action="{{route('file.move-to-another-folder', [$folder->id, $selected_folder->id, $file->id, 'approval_file'])}}" method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <li><button type="submit" class="dropdown-item" >{{$folder->folder_name}}</button></li>
                                                                    </form>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                  </div>
                                            </div>

                                            <div>
                                                <div class="border-top" style="font-size: 14px; padding:10px;cursor:pointer">
                                                    <div id="showFileModalOpener" onclick="updateRecentlyViewedFile({{$file}}, 'uploaded_file', '{{csrf_token()}}')" data-bs-toggle="modal" data-bs-target="#showFileModal_{{$file_filename}}" style="cursor:pointer; font-size:14px">
                                                        Show
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="border-bottom border-top" style="font-size: 14px; padding:10px;">
                                                    <a href="{{ uploadedFile($file_path) }}" download style="all:unset">
                                                        Download
                                                    </a>
                                                </div>
                                            </div>

                                            <div>
                                                <form action="{{route('file.remove-file-from-folder', [$selected_folder->id, $file->id, 'approval_file'])}}" method="POST" >
                                                    @csrf
                                                    @method('DELETE')

                                                    <button style="all:unset; font-size: 14px; padding:10px;">
                                                        Remove
                                                    </button>
                                                </form>

                                            </div>

                                            <div>
                                                <div class="border-top" style="font-size: 14px; padding:10px;cursor:pointer">
                                                    <a id="addBtn" href="{{ route('file.request-for-quote', [$file, 'order']) }}" style="all:unset">
                                                        Place Order
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

                <div id="file_{{$file_filename}}"  class="col-sm-6 col-lg-4">
                    <div  class="bg-white p-4 rounded-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center"  data-bs-toggle="dropdown">
                                @if($file_extension == 'png' || $file_extension == 'jpg' || $file_extension == 'jpeg')
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" fill="#00e1ff" viewBox="0 0 512 512" class="me-3">
                                    <path d="M448 80c8.8 0 16 7.2 16 16V415.8l-5-6.5-136-176c-4.5-5.9-11.6-9.3-19-9.3s-14.4 3.4-19 9.3L202 340.7l-30.5-42.7C167 291.7 159.8 288 152 288s-15 3.7-19.5 10.1l-80 112L48 416.3l0-.3V96c0-8.8 7.2-16 16-16H448zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm80 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/>
                                </svg>
                                @elseif($file_extension == 'pdf' || $file_extension == 'docx')
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" fill="#00e1ff" viewBox="0 0 384 512" class="me-3">
                                    <path d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z"/>
                                </svg>
                                @elseif($file_extension == 'zip')
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" fill="#00e1ff" viewBox="0 0 384 512" class="me-3">
                                    <path d="M64 464c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16h48c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16h48v80c0 17.7 14.3 32 32 32h80V448c0 8.8-7.2 16-16 16H64zM64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V154.5c0-17-6.7-33.3-18.7-45.3L274.7 18.7C262.7 6.7 246.5 0 229.5 0H64zm48 112c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H128c-8.8 0-16 7.2-16 16zm0 64c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H128c-8.8 0-16 7.2-16 16zm-6.3 71.8L82.1 335.9c-1.4 5.4-2.1 10.9-2.1 16.4c0 35.2 28.8 63.7 64 63.7s64-28.5 64-63.7c0-5.5-.7-11.1-2.1-16.4l-23.5-88.2c-3.7-14-16.4-23.8-30.9-23.8H136.6c-14.5 0-27.2 9.7-30.9 23.8zM128 336h32c8.8 0 16 7.2 16 16s-7.2 16-16 16H128c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                                </svg>
                                @endif
                                <div  style="cursor:pointer;">
                                    {{$file_name}}
                                </div>
                                @include('components.frontend.show-file-modal', ['title' => $file_filename, 'file' => $file->file_path, 'file_type' => $file_extension ])

                            </div>
                            <div class="d-flex align-items-center" style="cursor: pointer;">
                                {{-- <a href="{{ uploadedFile($artwork_path) }}" download class="me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                        <path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
                                    </svg>
                                </a> --}}
                                <div>
                                    <div class="dropdown p-0 m-0">

                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 128 512" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <path d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z"/>
                                        </svg>
                                        <div class="dropdown-menu p-0 m-0" aria-labelledby="dropdownMenuButton1">
                                            <div class="accordion m-0 p-0" id="accordionExample" onclick="event.stopPropagation()">
                                                <div class="accordion-item" style="cursor:pointer;">
                                                    <p class="accordion-header" id="headingOne">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="font-size: 14px">
                                                        Move To Folder
                                                        </button>
                                                    </p>

                                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body p-0">
                                                            @foreach($folders as $folder)
                                                                @if($folder->id != $selected_folder->id)
                                                                    <form action="{{route('file.move-to-another-folder', [$folder->id, $selected_folder->id, $file->id, 'uploaded_file'])}}" method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <li><button type="submit" class="dropdown-item" >{{$folder->folder_name}}</button></li>
                                                                    </form>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="border-top" style="font-size: 14px; padding:10px;cursor:pointer">
                                                    <div id="showFileModalOpener" onclick="updateRecentlyViewedFile({{$file}}, 'uploaded_file', '{{csrf_token()}}')" data-bs-toggle="modal" data-bs-target="#showFileModal_{{$file_filename}}" style="cursor:pointer; font-size:14px">
                                                        Show
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="border-bottom border-top" style="font-size: 14px; padding:10px;">
                                                    <a href="{{ uploadedFile($file_path) }}" download style="all:unset">
                                                        Download
                                                    </a>
                                                </div>
                                            </div>

                                            <div>
                                                <form action="{{route('file.remove-file-from-folder', [$selected_folder->id, $file->id, 'uploaded_file'])}}" method="POST" >
                                                    @csrf
                                                    @method('DELETE')

                                                    <button style="all:unset; font-size: 14px; padding:10px;">
                                                        Remove
                                                    </button>
                                                </form>

                                            </div>

                                            <div>
                                                <div class="border-top" style="font-size: 14px; padding:10px;cursor:pointer">
                                                    <a id="addBtn" href="{{ route('file.request-for-quote', [$file, 'uploaded']) }}" style="all:unset">
                                                        Place Order
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

                <div id="file_{{$file_filename}}"  class="col-sm-6 col-lg-4">
                    <div  class="bg-white p-4 rounded-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center"  data-bs-toggle="dropdown">
                                @if($file_extension == 'png' || $file_extension == 'jpg' || $file_extension == 'jpeg')
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" fill="#00e1ff" viewBox="0 0 512 512" class="me-3">
                                    <path d="M448 80c8.8 0 16 7.2 16 16V415.8l-5-6.5-136-176c-4.5-5.9-11.6-9.3-19-9.3s-14.4 3.4-19 9.3L202 340.7l-30.5-42.7C167 291.7 159.8 288 152 288s-15 3.7-19.5 10.1l-80 112L48 416.3l0-.3V96c0-8.8 7.2-16 16-16H448zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm80 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/>
                                </svg>
                                @elseif($file_extension == 'pdf' || $file_extension == 'docx')
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" fill="#00e1ff" viewBox="0 0 384 512" class="me-3">
                                    <path d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z"/>
                                </svg>
                                @elseif($file_extension == 'zip')
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" fill="#00e1ff" viewBox="0 0 384 512" class="me-3">
                                    <path d="M64 464c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16h48c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16h48v80c0 17.7 14.3 32 32 32h80V448c0 8.8-7.2 16-16 16H64zM64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V154.5c0-17-6.7-33.3-18.7-45.3L274.7 18.7C262.7 6.7 246.5 0 229.5 0H64zm48 112c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H128c-8.8 0-16 7.2-16 16zm0 64c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H128c-8.8 0-16 7.2-16 16zm-6.3 71.8L82.1 335.9c-1.4 5.4-2.1 10.9-2.1 16.4c0 35.2 28.8 63.7 64 63.7s64-28.5 64-63.7c0-5.5-.7-11.1-2.1-16.4l-23.5-88.2c-3.7-14-16.4-23.8-30.9-23.8H136.6c-14.5 0-27.2 9.7-30.9 23.8zM128 336h32c8.8 0 16 7.2 16 16s-7.2 16-16 16H128c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                                </svg>
                                @endif
                                <div style="cursor:pointer;">
                                    {{$file_name}}
                                </div>
                                @include('components.frontend.show-file-modal', ['title' => $file_filename, 'file' => $file->file_path, 'file_type' => $file_extension ])

                            </div>
                            <div class="d-flex align-items-center" style="cursor: pointer;">
                                {{-- <a href="{{ uploadedFile($artwork_path) }}" download class="me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                        <path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
                                    </svg>
                                </a> --}}
                                <div>
                                    <div class="dropdown p-0 m-0">

                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 128 512" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <path d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z"/>
                                        </svg>
                                        <div class="dropdown-menu p-0 m-0" aria-labelledby="dropdownMenuButton1">
                                            <div class="accordion m-0 p-0" id="accordionExample" onclick="event.stopPropagation()">
                                                <div class="accordion-item" style="cursor:pointer;">
                                                    <p class="accordion-header" id="headingOne">
                                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="font-size: 14px">
                                                        Move To Folder
                                                      </button>
                                                    </p>

                                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body p-0">
                                                            @foreach($folders as $folder)
                                                                @if($folder->id != $selected_folder->id)
                                                                    <form action="{{route('file.move-to-another-folder', [$folder->id, $selected_folder->id, $file->id, 'uploaded_file'])}}" method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <li><button type="submit" class="dropdown-item" >{{$folder->folder_name}}</button></li>
                                                                    </form>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                  </div>
                                            </div>

                                            <div>
                                                <div class="border-top" style="font-size: 14px; padding:10px;cursor:pointer">
                                                    <div id="showFileModalOpener" onclick="updateRecentlyViewedFile({{$file}}, 'uploaded_file', '{{csrf_token()}}')" data-bs-toggle="modal" data-bs-target="#showFileModal_{{$file_filename}}" style="cursor:pointer; font-size:14px">
                                                        Show
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="border-bottom border-top" style="font-size: 14px; padding:10px;">
                                                    <a href="{{ uploadedFile($file_path) }}" download style="all:unset">
                                                        Download
                                                    </a>
                                                </div>
                                            </div>

                                            <div>
                                                <form action="{{route('file.remove-file-from-folder', [$selected_folder->id, $file->id, 'uploaded_file'])}}" method="POST" >
                                                    @csrf
                                                    @method('DELETE')

                                                    <button style="all:unset; font-size: 14px; padding:10px;">
                                                        Remove
                                                    </button>
                                                </form>

                                            </div>

                                            <div>
                                                <div class="border-top" style="font-size: 14px; padding:10px;cursor:pointer">
                                                    <a id="addBtn" href="{{ route('file.request-for-quote', [$file, 'uploaded']) }}" style="all:unset">
                                                        Place Order
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>


    </section>

    <style>
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

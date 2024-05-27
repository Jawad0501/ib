@extends('layouts.admin.app')

@section('title', 'User Files')

@section('content')
    <div class="bg-white">
        <div class="d-flex justify-content-between px-3 pt-2 pb-0" style="font-size: 1.285rem; color: #5e5873; font-weight:500">
            <div>
                User Files
            </div>

            <div class="">
                <x-admin.page-button :href="route('admin.user.index')" title="Back To Customers" icon="back" />
            </div>
        </div>

        <div class="container p-4">
            <h6 class="mb-2">Artworks</h6>
            <div id="artworks_section" class="row gy-4 mb-5">
                @if(count($artworks) > 0)
                @foreach($artworks as $file)

                @php
                    $artwork_path = $file->artwork;
                    $artwork_name = pathinfo($artwork_path, PATHINFO_BASENAME);
                    $artwork_filename = pathinfo($artwork_path, PATHINFO_FILENAME);
                    $artwork_extension = pathinfo($artwork_path, PATHINFO_EXTENSION);
                @endphp

                <div id="file_{{$artwork_filename}}"  class="col-xs-12 col-md-6 col-lg-4 col-xl-6 col-xxl-4 rounded-4">
                    <div  class="bg-white py-1 px-2 rounded-4"  style="box-shadow: 0px 0px 2px 1px rgba(0, 0, 0, 0.2);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" fill="#000000" viewBox="0 0 512 512" class="me-3">
                                    <path d="M448 80c8.8 0 16 7.2 16 16V415.8l-5-6.5-136-176c-4.5-5.9-11.6-9.3-19-9.3s-14.4 3.4-19 9.3L202 340.7l-30.5-42.7C167 291.7 159.8 288 152 288s-15 3.7-19.5 10.1l-80 112L48 416.3l0-.3V96c0-8.8 7.2-16 16-16H448zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm80 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/>
                                </svg>
                                <div id="showFileModalOpener" onclick="updateRecentlyViewedFile({{$file}}, 'artwork', '{{csrf_token()}}')" data-bs-toggle="modal" data-bs-target="#showFileModal_{{$artwork_filename}}" class="fw-semibold" style="cursor:pointer; font-size:14px">
                                    {{$artwork_filename}}
                                </div>

                                @include('components.frontend.show-file-modal', ['title' => $artwork_filename, 'file' => $file->artwork, 'file_type' => $artwork_extension])

                            </div>
                            <div class="d-flex align-items-center" style="cursor: pointer;">
                                <a href="{{ uploadedFile($artwork_path) }}" download class="me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                        <path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="text-center w-100 text-black">No artworks!</div>
                @endif
            </div>


            <h6 class="mb-2">Approval Files</h6>

            <div id="approval_files_section" class="row gy-4 mb-5">
                @if(count($approval_files) > 0)
                @foreach($approval_files as $file)

                @php
                    $file_path = $file->approval_file;
                    $file_name = pathinfo($file_path, PATHINFO_BASENAME);
                    $file_filename = pathinfo($file_path, PATHINFO_FILENAME);
                    $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                @endphp

                <div id="file_{{$file_filename}}"  class="col-xs-12 col-md-6 col-lg-4 col-xl-6 col-xxl-4">
                    <div  class="bg-white py-1 px-2 rounded-4"  style="box-shadow: 0px 0px 2px 1px rgba(0, 0, 0, 0.2);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                @if($file_extension == 'png' || $file_extension == 'jpg')
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" fill="#000000" viewBox="0 0 512 512" class="me-3">
                                    <path d="M448 80c8.8 0 16 7.2 16 16V415.8l-5-6.5-136-176c-4.5-5.9-11.6-9.3-19-9.3s-14.4 3.4-19 9.3L202 340.7l-30.5-42.7C167 291.7 159.8 288 152 288s-15 3.7-19.5 10.1l-80 112L48 416.3l0-.3V96c0-8.8 7.2-16 16-16H448zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm80 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/>
                                </svg>
                                @elseif($file_extension == 'pdf' || $file_extension == 'docx')
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" fill="#000000" viewBox="0 0 384 512" class="me-3">
                                    <path d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z"/>
                                </svg>
                                @elseif($file_extension == 'zip')
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" fill="#000000" viewBox="0 0 384 512" class="me-3">
                                    <path d="M64 464c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16h48c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16h48v80c0 17.7 14.3 32 32 32h80V448c0 8.8-7.2 16-16 16H64zM64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V154.5c0-17-6.7-33.3-18.7-45.3L274.7 18.7C262.7 6.7 246.5 0 229.5 0H64zm48 112c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H128c-8.8 0-16 7.2-16 16zm0 64c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H128c-8.8 0-16 7.2-16 16zm-6.3 71.8L82.1 335.9c-1.4 5.4-2.1 10.9-2.1 16.4c0 35.2 28.8 63.7 64 63.7s64-28.5 64-63.7c0-5.5-.7-11.1-2.1-16.4l-23.5-88.2c-3.7-14-16.4-23.8-30.9-23.8H136.6c-14.5 0-27.2 9.7-30.9 23.8zM128 336h32c8.8 0 16 7.2 16 16s-7.2 16-16 16H128c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                                </svg>
                                @endif
                                <div id="showFileModalOpener" onclick="updateRecentlyViewedFile({{$file}}, 'approval_file', '{{csrf_token()}}')" data-bs-toggle="modal" data-bs-target="#showFileModal_{{$file_filename}}" class="fw-semibold" style="cursor:pointer; font-size:14px">
                                    {{$file_filename}}
                                </div>
                                @include('components.frontend.show-file-modal', ['title' => $file_filename, 'file' => $file->approval_file, 'file_type' => $file_extension ])

                            </div>
                            <div class="d-flex align-items-center" style="cursor: pointer;">
                                <a href="{{ uploadedFile($file_path) }}" download class="me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                        <path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="text-center w-100 text-black">No approval files!</div>
                @endif
            </div>

            <h6 class="mb-2">Uploaded Files</h6>

            <div id="uploadedFiles_section" class="row gy-4">
                @if(count($uploadedFiles) > 0)
                @foreach($uploadedFiles as $file)

                @php
                    $file_path = $file->file_path;
                    $file_name = pathinfo($file_path, PATHINFO_BASENAME);
                    $file_filename = pathinfo($file_path, PATHINFO_FILENAME);
                    $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
                @endphp

                <div id="file_{{$file_filename}}"  class="col-xs-12 col-md-6 col-lg-4 col-xl-6 col-xxl-4">
                    <div  class="bg-white py-1 px-2 rounded-4" style="box-shadow: 0px 0px 2px 1px rgba(0, 0, 0, 0.2);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                @if($file_extension == 'png' || $file_extension == 'jpg')
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" fill="#000000" viewBox="0 0 512 512" class="me-3">
                                    <path d="M448 80c8.8 0 16 7.2 16 16V415.8l-5-6.5-136-176c-4.5-5.9-11.6-9.3-19-9.3s-14.4 3.4-19 9.3L202 340.7l-30.5-42.7C167 291.7 159.8 288 152 288s-15 3.7-19.5 10.1l-80 112L48 416.3l0-.3V96c0-8.8 7.2-16 16-16H448zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm80 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/>
                                </svg>
                                @elseif($file_extension == 'pdf' || $file_extension == 'docx')
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" fill="#000000" viewBox="0 0 384 512" class="me-3">
                                    <path d="M320 464c8.8 0 16-7.2 16-16V160H256c-17.7 0-32-14.3-32-32V48H64c-8.8 0-16 7.2-16 16V448c0 8.8 7.2 16 16 16H320zM0 64C0 28.7 28.7 0 64 0H229.5c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64z"/>
                                </svg>
                                @elseif($file_extension == 'zip')
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" fill="#000000" viewBox="0 0 384 512" class="me-3">
                                    <path d="M64 464c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16h48c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16h48v80c0 17.7 14.3 32 32 32h80V448c0 8.8-7.2 16-16 16H64zM64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V154.5c0-17-6.7-33.3-18.7-45.3L274.7 18.7C262.7 6.7 246.5 0 229.5 0H64zm48 112c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H128c-8.8 0-16 7.2-16 16zm0 64c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16s-7.2-16-16-16H128c-8.8 0-16 7.2-16 16zm-6.3 71.8L82.1 335.9c-1.4 5.4-2.1 10.9-2.1 16.4c0 35.2 28.8 63.7 64 63.7s64-28.5 64-63.7c0-5.5-.7-11.1-2.1-16.4l-23.5-88.2c-3.7-14-16.4-23.8-30.9-23.8H136.6c-14.5 0-27.2 9.7-30.9 23.8zM128 336h32c8.8 0 16 7.2 16 16s-7.2 16-16 16H128c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                                </svg>
                                @endif
                                <div id="showFileModalOpener" onclick="updateRecentlyViewedFile({{$file}}, 'uploadedFile', '{{csrf_token()}}')" data-bs-toggle="modal" data-bs-target="#showFileModal_{{$file_filename}}" class="fw-semibold" style="cursor:pointer; font-size:14px">
                                    {{$file_filename}}
                                </div>
                                @include('components.frontend.show-file-modal', ['title' => $file_filename, 'file' => $file->file_path, 'file_type' => $file_extension ])

                            </div>
                            <div class="d-flex align-items-center" style="cursor: pointer;">
                                <a href="{{ uploadedFile($file_path) }}" download class="me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                        <path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else

                <div class="text-center w-100 text-black">No uploaded files!</div>
                @endif
            </div>
        </div>
    </div>

    <script>

        function toggleRow(quote_sl){
            let rows = document.querySelectorAll('.table-row');
            rows.forEach((row) => {
                if(row.id == `quote_${quote_sl}`){
                    let quote_row = document.getElementById(`hidden_${row.id}`)
                    let parent_quote_row = document.getElementById(`quote_${quote_sl}`)
                    let parent_row_tds = parent_quote_row.querySelectorAll('td')
                    parent_row_tds.forEach((node) => {
                        node.style.cssText = 'border-bottom-style: none !important'
                    })
                    parent_quote_row.style.cssText = 'border-bottom-style: none !important;'
                    quote_row.style.cssText = 'border-top-style: none !important;'
                    if(quote_row.classList.contains('d-none')){
                        quote_row.classList.remove('d-none')
                    }
                    else{
                        quote_row.classList.add('d-none')
                        parent_row_tds.forEach((node) => {
                            node.style.cssText = 'border-bottom-style: solid !important;'
                        })
                        quote_row.style.cssText = 'border-top-style: solid !important;'
                    }
                }
                else{
                    let quote_row = document.getElementById(`hidden_${row.id}`)
                    let parent_quote_row = document.getElementById(row.id)
                    let parent_row_tds = parent_quote_row.querySelectorAll('td')
                    parent_row_tds.forEach((node) => {
                        node.style.cssText = 'border-bottom-style: solid !important;'
                    })
                    parent_quote_row.style.cssText = 'border-bottom-style: solid !important;'
                    quote_row.style.cssText = 'border-top-style: solid !important;'
                    if(quote_row.classList.contains('d-none')){

                    }
                    else{
                        quote_row.classList.add('d-none')
                    }
                }
            })

        }

    </script>
@endsection

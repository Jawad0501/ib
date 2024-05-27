@extends('layouts.frontend.app')

@section('title', 'Dashboard')

@section('content')
    <section>
        <div class="container">
            <div class="row gy-5">
                <div class="col-12">
                    <div class="welcome-div d-flex flex-column justify-content-center" style="background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8) ), url({{url('storage/dashboard/banner.png')}}); background-size: cover; background-repeat: no-repeat; height: 240px;">
                        <div>
                            <h3 class="fs-3 fw-semibold mb-0">Welcome back {{ auth()->user()->name }}!</h3>
                            <p class="mb-0 fs-14 text-white">Today {{ date('F d, Y | H:i A') }}</p>
                        </div>
                        <div class="mt-4">
                            <p class="mb-0 fs-14 fw-medium">{{auth()->user()->designation}}</p>
                            <p class="mb-0 fs-14 fw-medium">{{ auth()->user()->company_name }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <h5 class="fs-5 fw-semibold mb-4">My Files</h5>
                    <div class="row gy-4">
                        @foreach($folders as $folder)
                        <div class="col-sm-6 col-lg-4">
                            <div class="bg-white p-4 rounded-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <svg id="folder_icon_{{$folder->id}}" xmlns="http://www.w3.org/2000/svg" width="32" viewBox="0 0 512 512" fill="{{$folder->icon_color}}" >
                                            <path d="M64 480H448c35.3 0 64-28.7 64-64V160c0-35.3-28.7-64-64-64H288c-10.1 0-19.6-4.7-25.6-12.8L243.2 57.6C231.1 41.5 212.1 32 192 32H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64z"/>
                                        </svg>
                                        <a href="{{route('file.show-folder', $folder->id)}}" style="all:unset; cursor:pointer" class="mb-0 ms-3 fw-semibold">{{$folder->folder_name}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fs-5 fw-semibold mb-0">Recent View</h5>
                        <div>
                            <a href="#" class="text-grey">See More</a>
                        </div>
                    </div>

                    <div class="row gy-4 text-center text-sm-start">
                        @foreach ($recently_viewed_files as $file)
                            @php
                                if($file->artwork == $file->recently_viewed_file['file']){
                                    $file_type = 'artwork';
                                }
                                elseif($file->approval_file == $file->recently_viewed_file['file']){
                                    $file_type = 'approval_file';
                                }
                                elseif(($file->file_path == $file->recently_viewed_file['file'])){
                                    $file_type = 'uploadedFile';
                                }


                                $file_path = $file->recently_viewed_file['file'];
                                $file_name = pathinfo($file_path, PATHINFO_BASENAME);
                                $file_filename = pathinfo($file_path, PATHINFO_FILENAME);
                                $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);

                                $to = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', Carbon\Carbon::now());
                                $from = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $file->recently_viewed_file['viewing_time']);

                                $time_diff = $to->diffInSeconds($from);
                                $time_with = 'seconds';

                                if($time_diff >= 60 && $time_diff <= 3599){
                                    $time_diff = $to->diffInMinutes($from);
                                    $time_with = 'minute(s)';
                                }
                                elseif($time_diff >= 3600 && $time_diff <= 86399){
                                    $time_diff = $to->diffInHours($from);
                                    $time_with = 'hour(s)';
                                }
                                else{
                                    $time_diff = $to->diffInDays($from);
                                    $time_with = 'day(s)';
                                }
                            @endphp

                            <div class="col-12 col-sm-6 col-xxl-3 col-md-6 col-xl-6 col-lg-4">
                                <object data="{{ uploadedFile($file->recently_viewed_file['file']) }}" class="recent-view w-100"></object>
                                <div id="showFileModalOpener" onclick="updateRecentlyViewedFile({{$file}}, '{{$file_type}}', '{{csrf_token()}}')" data-bs-toggle="modal" data-bs-target="#showFileModal_{{$file_filename}}" style="cursor:pointer;">
                                    <p class="fw-semibold fs-14 mb-0">{{$file_filename}}</p>
                                </div>
                                @include('components.frontend.show-file-modal', ['title' => $file_filename, 'file' => $file_path, 'file_type' => $file_extension ])
                                <p class="fw-medium fs-14 text-grey">Viewed {{$time_diff}} {{$time_with}} ago</p>
                            </div>
                        @endforeach
                    </div>

                </div>


            </div>
        </div>
    </section>

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

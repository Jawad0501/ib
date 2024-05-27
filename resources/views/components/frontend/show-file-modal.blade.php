@props([
    'title',
    'description' => null,
    'button' => null,
    'file' => null,
    'file_type' => null
])

@php
    $size = $file != null ? Storage::disk('public')->size($file) : 0
@endphp

<div class="modal fade" id="showFileModal_{{$title}}" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ ucfirst($title) }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="mx-4 my-2">
                @if($file_type != 'zip')
                    @if($file_type == 'png' || $file_type == 'jpg')
                        <div class="d-flex justify-content-between align-items-center my-3">
                            <div>
                                <h6>Type: Image</h6>
                                <h6>File Extension: (.{{$file_type}})</h6>
                                <h6>Size: {{$size/1000}}KB</h6>
                            </div>
                            <div>
                                <a href="{{ uploadedFile($file) }}" download>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" viewBox="0 0 512 512">
                                        <path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <object data="{{ uploadedFile($file) }}" width="100%" height="700px"></object>
                    @elseif($file_type == 'pdf' || $file_type == 'docx')
                        <div class="my-3">
                            <h6>Type: Document</h6>
                            <h6>File Extension: (.{{$file_type}})</h6>
                            <h6>Size: {{$size/1000}}KB</h6>
                        </div>

                        <object data="{{ uploadedFile($file) }}" width="100%" height="700px"></object>

                    @endif
                @else
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <div class="my-3">
                            <svg xmlns="http://www.w3.org/2000/svg"  width="100" fill="#00e1ff" viewBox="0 0 512 512">
                                <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24V264c0 13.3-10.7 24-24 24s-24-10.7-24-24V152c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z"/>
                            </svg>
                        </div>
                        <h5 class="my-3">
                            Zip Type file can not be previwed!
                        </h5>

                        <div class="text-center my-3">
                            <h6>Type: Zipped Folder</h6>
                            <h6>File Extension: (.{{$file_type}})</h6>
                            <h6>Size: {{$size/1000}}KB</h6>
                        </div>

                        <div class="my-3">
                            <a href="{{ uploadedFile($file) }}" download class="btn btn-dark">
                                Download File
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

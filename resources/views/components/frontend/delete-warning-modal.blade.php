@props([
    'title',
    'description' => null,
    'button' => null,
    'size' => 'md',
])

<div class="modal fade" id="delete-warning-modal-{{$id}}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-{{ $size}}">
        <div class="modal-content py-5">
            <div class="modal-header" style="border: none">
                <div class="title text-center w-100">
                    <h5 class="heading">Delete {{$title}}</h5>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" fill="red" height="100" viewBox="0 0 512 512">
                    <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24V264c0 13.3-10.7 24-24 24s-24-10.7-24-24V152c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z"/>
                </svg>
            </div>

            <div class="fs-3 fw-bold text-center mt-3">
                Are you sure?
            </div>

            <div class="d-flex justify-content-center align-items-center w-50 mx-auto">
                <form class="w-100" action="{{route($route, $id)}}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button class="btn w-100 me-3 mt-3 py-2 border" type="submit">Yes</button>
                </form>
                {{-- <div class="btn w-25 me-3 mt-3 py-2 border">
                    <a href="{{route($route, $id)}}" style="all: unset">
                       Yes
                    </a>
                </div> --}}

                <button class="btn w-100 ms-2 mt-3 py-2 border" class="btn-close" data-bs-dismiss="modal" type="submit">No</button>
                {{-- <div class="btn mt-3 py-2 border">
                    <a href="" style="all: unset">
                       No
                    </a>
                </div> --}}
            </div>
        </div>

    </div>
</div>

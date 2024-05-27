<x-frontend.modal title="{{$title}}" size="lg" button="Submit" action="{{route('file.submit-request')}}"  enctype="multipart/form-data">
    <input type="hidden" name="file_id" id="file_id" value="{{$file->id}}">
    <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
    <input type="hidden" name="type" id="type" value="{{$type}}">
    <x-frontend.form-group label="title" placeholder="Enter Title" column="col-12" class="mb-3" required />

    <div class="row">
        <x-frontend.form-group label="reference" placeholder="Enter Reference" column="col-6" class="mb-3"  />
        <x-frontend.form-group label="pO_Number" placeholder="Enter PO Number" column="col-6" class="mb-3"  />
    </div>

    <x-frontend.form-group label="delivery_Address" placeholder="Enter Delivery Address" column="col-12" class="mb-3" required />
    <x-frontend.form-group label="Notes" for="note" isType="textarea" placeholder="Names, multi set etc" column="col-12" class="mb-3" :required="false" />

    <div class="border rounded py-4 px-3 mt-4" style="position: relative">
        <div style="position: absolute; top: -13px; left: 5px; background-color: white; font-size: 17px">
            Items
        </div>
        <div>
            <div id="quotes-items">
                @include('frontend.file.item')
            </div>
            <div class="mt-3 d-flex justify-content-end">
                <a href="{{ route('file.add-item') }}" class="btn btn-dark" id="addItem">Add Item</a>
            </div>

        </div>
    </div>
</x-frontend.modal>




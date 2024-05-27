<x-frontend.modal title="Create Folder" size="md" button="Create" action="{{ route('file.store-folder') }}">
    <div class="mb-3">
        <label for="folder_name" class="w-100 mb-1 form-label">
            Folder Name
        </label>
        <div class="d-flex align-items-center w-100 border py-1 px-2 rounded">
            <label for="icon_color">
                <input type="color" id="icon_color" name="icon_color" class="position-absolute mt-2" value="#0cd3ed" style="z-index: -999">
                <svg id="folder_icon" xmlns="http://www.w3.org/2000/svg" width="32" viewBox="0 0 512 512" fill="#0cd3ed" >
                    <path d="M64 480H448c35.3 0 64-28.7 64-64V160c0-35.3-28.7-64-64-64H288c-10.1 0-19.6-4.7-25.6-12.8L243.2 57.6C231.1 41.5 212.1 32 192 32H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64z"/>
                </svg>
            </label>
            <input id="folder_name" name="folder_name" type="text" class="remove-default-input-style p-2 ms-2 w-100" placeholder="Enter folder name">
        </div>
    </div>
</x-frontend.modal>

<style>
    .remove-default-input-style{
        outline: none;
        border: none;
    }
</style>

<script>

    document.getElementById('icon_color').addEventListener("input", updateFirst, false);
    document.getElementById('icon_color').addEventListener("change", watchColorPicker, false);

    function updateFirst(event) {
        icon = document.getElementById("folder_icon");
        icon.style.fill = event.target.value;
    }

    function watchColorPicker(event) {
        icon = document.getElementById("folder_icon");
        console.log(icon);
        icon.style.fill = event.target.value;
    }


</script>



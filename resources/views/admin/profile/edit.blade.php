<x-admin.modal
    title="Update Profile"
    :action="route('admin.profile.update')"
    button="Update"
    id="submit"
    enctype="multipart/form-data"
>
    @method('PUT')

    <x-admin.form-group
        label="name"
        placeholder="Enter name"
        :value="auth()->user()->name"
    />
    <x-admin.form-group
        label="email"
        type="email"
        placeholder="Enter email"
        :value="auth()->user()->email"
    />
    <x-admin.form-group
        label="image"
        type="file"
        accept="image/*"
        data-show-image="show_profile_image"
    />
</x-admin.modal>

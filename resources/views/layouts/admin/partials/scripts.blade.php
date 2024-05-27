<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('vendors/js/vendors.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/toastr/toastr.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/sweetalert2/sweetalert2.js')) }}"></script>
<!-- BEGIN Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{asset(mix('vendors/js/ui/jquery.sticky.js'))}}"></script>
@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('js/core/app-menu.js')) }}"></script>
<script src="{{ asset(mix('js/core/app.js')) }}"></script>

<!-- custome scripts file for user -->
<script src="{{ asset(mix('js/core/scripts.js')) }}"></script>

@if($configData['blankPage'] === false)
<script src="{{ asset(mix('js/scripts/customizer.js')) }}"></script>
@endif
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{ asset(mix('js/scripts/pages/helper.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/pages/datatables-data.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/pages/crud.js')) }}"></script>
@yield('page-script')
<!-- END: Page JS-->

<script>
    window.permissions = @json($permissions)
</script>

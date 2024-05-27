@extends('layouts.frontend.guest')

@section('title', 'Approval Proof')

@section('content')

    <x-frontend.page-title title="Approval Proof" />

    <!-- START CATEGORY -->
    <section class="section">
        <div class="container">
            <!--end row-->
            <div class="row gy-4">

                @if (session()->has('message'))
                    <div class="col-md-8 mx-auto">
                        <div class="alert alert-success">{{ session()->get('message') }}</div>
                    </div>
                @endif

                <div class="col-lg-12 mx-auto">
                    <object data="{{ uploadedFile($order->approval_file) }}" type="application/pdf" width="100%" height="700px">
                       <p>
                           Your web browser doesn't have a PDF plugin. Instead you can
                           <a href="{{ uploadedFile($order->approval_file) }}" download>click here to download the PDF file.</a>
                       </p>
                    </object>
                </div>

                <div class="col-md-8 mx-auto">
                    <form action="{{ route('approval.store', request()->route('invoice')) }}" class="needs-validation" method="POST">
                        @csrf
                        <input type="hidden" name="invoice">
                        <div class="row gy-3">
                            <div class="col-12">
                                <label for="approval_status" class="form-label">Approval Status</label>
                                <select class="form-select @error('approval_status') is-invalid  @enderror" name="approval_status" id="approval_status">
                                    @foreach ([\App\Helpers\QuoteStatus::APPROVED,\App\Helpers\QuoteStatus::REJECT] as $status)
                                        <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                                @error('approval_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 d-none" id="reject_reason_field">
                                <label for="reject_reason" class="form-label">Reject reason</label>
                                <textarea class="form-control @error('reject_reason') is-invalid  @enderror" name="reject_reason" id="reject_reason" placeholder="Please write reject please"></textarea>
                                @error('reject_reason')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="mt-3 text-end">
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--end row-->

        </div>
        <!--end container-->
    </section>
    <!-- END CATEGORY -->
@endsection

@push('scripts')
    <script>
        window.onload = function() {
            var approvalElement = document.querySelector('select#approval_status');
            var rejectReasonEl  = document.getElementById('reject_reason_field');

            approvalElement.addEventListener('change', function(e) {
                if (e.target.value === 'reject') {
                    rejectReasonEl.classList.remove('d-none');
                }
                else {
                    rejectReasonEl.classList.add('d-none');
                }
            });
        }
    </script>
@endpush

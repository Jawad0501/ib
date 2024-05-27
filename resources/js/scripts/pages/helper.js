const csrf_token = document.querySelector('meta[name="csrf-token"').getAttribute('content');

const showUploadedFile = (avatar) => {
    return avatar != null ? `${location.origin}/storage/${avatar}` : 'https://picsum.photos/seed/picsum/200/300';
}

const convertAmount = (number, decimals = 2, dec_point = '.', thousands_sep = ',') => {

    var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    toFixedFix = function (n, prec) {
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        var k = Math.pow(10, prec);
        return Math.round(n * k) / k;
    },
    s = (prec ? toFixedFix(n, prec) : Math.round(n)).toString().split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }

    const currency_symbol = document.querySelector('meta[name="currency_symbol"]').getAttribute('content');

    return `${currency_symbol}${s.join(dec)}`;
}

const datatableButtons = (items = []) => {
    const icons = {
        edit: 'ti-edit',
        show: 'ti-eye',
        delete: 'ti-trash',
        approved: 'ti-check',
        invoice: 'ti-file',
        download: 'ti-download',
        upload: 'ti-upload'
    }

    let buttons = '<div class="d-flex align-items-center">';
    items.forEach(item => {
        if (permissions.includes(item.permission || null)) {
            const id = item.id ? `id="${item.type}Btn"`:''
            buttons += `<a href="${item.url}" ${id} class="btn btn-sm btn-icon">
                <i class="ti ${icons[item.type]}" style="font-size: 1.3rem"></i>
                ${item.text}
            </a>`
        }
    });
    buttons += '</div>';
    return buttons;
}

const datatableStatus = (type, text) => {
    return `<span class="badge bg-${type}">${text}</span>`;
}

const datatableImg = (file) => {
    return `<div class="avatar avatar-lg">
                <img src="${showUploadedFile(file)}" alt="Avatar" class="rounded-circle">
            </div>`;
}

const hasPermission = (permission) => {
    if(permissions.includes(permission)){
        return true;
    }
    else{
        return false;
    }
}

/* Send delete request in server */
const deleteData = (btn, url, removeElement = null) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        customClass: {
            confirmButton: 'btn btn-primary me-3',
            cancelButton: 'btn btn-label-secondary'
        },
        buttonsStyling: false
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                type: 'DELETE',
                url: url,
                data: {
                    _method: 'DELETE',
                    _token: csrf_token
                },
                dataType: 'JSON',
                beforeSend: () => $(btn).addClass("disabled"),
                success: function (response) {
                    handleSuccess(response);
                    if(removeElement != null) {
                        $(removeElement).remove();
                    }
                    // swal("Deleted!", "Your file has been deleted.", "success");
                },
                complete: () => $(btn).removeClass("disabled"),
                error: function (e) {
                    handleError(e);
                },
            });
            return true;
        }
        else return false;
    });
};


/* Handle success request response */
const handleSuccess = (response, redirect = null) => {
    const errMsg = $('#err-msg');
    toastr.clear();
    if (typeof response.message !== 'undefined' || typeof response.status !== 'undefined') {
        if(errMsg.length > 0) {
            $(errMsg).removeClass('d-none').text(response.message || response.status);

            setTimeout(() => $(errMsg).addClass('d-none'), 3000)
        }
        else {
            toastr.success(response.message || response.status, "Success!");
        }
    }
    if ((typeof response.redirect !== 'undefined' && response.redirect !== null) || (typeof redirect !== 'undefined' && redirect !== null)) {
        location.replace(redirect || response.redirect);
    }
    else {
        $('.modal').modal('hide');

        if(typeof response.add_from_inside !== 'undefined' && response.add_from_inside) {
            const customer = $('select#customer');
            $.ajax({
                type: "GET",
                url: route('admin.user.create', {_query: {customer_get: true}}),
                dataType: "JSON",
                success: function (res) {
                    let options = '<option value="">Select customer</option>'
                    $.each(res.customers, function (key, val) {
                        options += `<option value="${val.id}" ${key === 0 ? 'selected':''}>${val.name}</option>`
                    });
                    customer.html(options);
                    select2Init(customer)
                },
                error: (e) => handleError(e)
            });
        }

        if(typeof response.product_key !== 'undefined' && response.product_key !== null) {
            const selects = $('.repeater-wrapper select.select2');
            $.ajax({
                type: "GET",
                url: route('admin.product.create', {_query: {product_get: true}}),
                dataType: "JSON",
                success: function (res) {
                    selects.each(function() {
                        const el = $(this)
                        if(el.attr('name') == `items[${response.product_key}][product]`){
                            let options = '<option value="">Select product</option>'
                        window.products = res.products
                        if(response.save_product == false){
                            window.products.unshift({
                                id: 0,
                                name: response.name,
                                description: response.description,
                                unit_price: response.unit_price,
                                setup_price: response.setup_price,
                                vat: response.vat,
                                vat_percentage: response.vat_percentage
                            })
                        }
                        $.each(window.products, function (key, val) {
                            options += `<option value="${val.id}" ${el.attr('name') === `items[${response.product_key}][product]` && key === 0 ? 'selected':''}>${val.name}</option>`
                            if(el.attr('name') === `items[${response.product_key}][product]` && key === 0){
                                const productNameEl   = $(`input[name="items[${response.product_key}][product_name]"]`);
                                const productDescEl   = $(`input[name="items[${response.product_key}][product_description]"]`);
                                const unitPriceEl   = $(`input[name="items[${response.product_key}][unit_price]"]`);
                                const subtotalEl    = $(`input[name="items[${response.product_key}][subtotal]"]`);
                                const setupPriceEl  = $(`input[name="items[${response.product_key}][setup_price]"]`);
                                const discountEl    = $(`input[name="items[${response.product_key}][discount]"]`);
                                const vatEl         = $(`select[name="items[${response.product_key}][vat]"]`);
                                const vatamountEl   = $(`input[name="items[${response.product_key}][vat_percentage]"]`);
                                const totalEl       = $(`input[name="items[${response.product_key}][total]"]`);


                                const unit_price = parseFloat(val.unit_price)? parseFloat(val.unit_price) : parseFloat(0);
                                const setup_price = parseFloat(val.setup_price)? parseFloat(val.setup_price) : parseFloat(0);
                                const quantity   = parseInt(1);
                                const discount   = parseFloat(0);
                                const vat = val.vat;
                                const subtotal   = (unit_price * quantity) + setup_price;
                                const discount_amount = subtotal * (discount/100);
                                const subtotal_after_discount = subtotal - discount_amount;
                                const vat_percentage = parseFloat(val.vat_percentage)? parseFloat(val.vat_percentage) : parseFloat(0);
                                const vatAmount  = subtotal_after_discount * (vat_percentage/100);
                                const total      = subtotal_after_discount + vatAmount;

                                if(response.save_product == false){
                                    productNameEl.val(response.name)
                                    productDescEl.val(response.description)
                                }
                                unitPriceEl.val(unit_price)
                                setupPriceEl.val(setup_price)
                                vatEl.val(vat);
                                vatamountEl.val(vat_percentage)
                                discountEl.val(discount)

                                subtotalEl.val(parseFloat(subtotal_after_discount).toFixed(2))
                                totalEl.val(parseFloat(total).toFixed(2))

                                let total_subtotal = 0;
                                let total_vat = 0;
                                let total_total = 0;

                                $('input.total_subtotal').each(function() {
                                    total_subtotal += parseFloat($(this).val())
                                });
                                $('input.total_vat').each(function() {
                                    total_vat += parseFloat($(this).val())
                                });
                                $('input.total_total').each(function() {
                                    total_total += parseFloat($(this).val())
                                });

                                $('#subtotals').text(convertAmount(total_subtotal));
                                $('#vat_per').text('20%');
                                $('#vats').text(convertAmount(total_total - total_subtotal));
                                $('#totals').text(convertAmount(total_total));

                            }
                        });
                        el.html(options);
                        select2Init(el)
                        }

                    });
                },
                error: (e) => handleError(e)
            });
        }

        if(typeof table !== 'undefined') {
            table.ajax.reload();
        }
    }
}

/* Handle error request response */
const handleError = (e, redirect = null) => {
    console.log(e);
    if (e.status === 0) {
        toastr.error(
            "Not connected Please verify your network connection.",
            "Connect Internet"
        );
    }
    else if (e.status === 200 && typeof redirect !== 'undefined') {
        location.replace(redirect);
    }
    else if (e.status === 404) {
        toastr.error("The requested data not found.", "Not Found");
    }
    else if (e.status === 403) {
        toastr.error("You are not allowed this action", "UNAUTHORIZED");
    }
    else if (e.status === 419) {
        toastr.error("CSRF token mismatch", "Something wrong");
    }
    else if (e.status === 500) {
        toastr.error("Internal Server Error.", "Server Error");
    }
    else if (e === "parsererror") {
        toastr.error("Requested JSON parse failed.", "Opps!!");
    }
    else if (e === "timeout") {
        toastr.error("Requested Time out.", "Try Again");
    }
    else if (e === "abort") {
        toastr.error("Request aborted.", "Something Wrong");
    }
    else if (e.status === 422) {
        $.each(e.responseJSON.errors, function (index, error) {
            $("#invalid_" + index).text(error[0]);
            $("#" + index).addClass("is-invalid");
        });
        toastr.error(e.responseJSON.message, "Opps!!");
    }
    else if ([300, 301, 302, 401].includes(e.status)) {
        toastr.error(e.responseJSON.message, "Opps!!");
    }
    else {
        toastr.error(e.statusText, "Something Wrong");
    }
    return true;
}

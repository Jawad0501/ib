$(function() {


    $(document).on('change', 'input[type="file"]', function (e) {
        const show = $(this).data('show-image');
        showImage(e, show);
    });

    // When file select then show this image
    const showImage = (event, show) => {
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = (e) => {
            $(`#${show}`).attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    }

    const selectAll = document.getElementById('selectAll')
    if (selectAll) {
        selectAll.addEventListener('click', (e) => {
            const checkboxes = document.querySelectorAll('input.permission-checkbox');
            checkboxes.forEach(element => element.checked = e.target.checked ? true: false);
        })
    }

    // Add/Edit/Show modal show
    $(document).on('click', '#addBtn, #editBtn, #showBtn, #invoiceBtn, #approvedBtn, #downloadBtn, #uploadBtn', function(e) {
        e.preventDefault();
        sendGetRequest($(this).attr('href'), $(this))
    });

    /* Send a GET request in the server */
    const sendGetRequest = (url, btn) => {
        $('#modal').remove();
        $.ajax({
            type: "GET",
            url: url,
            dataType: "HTML",
            beforeSend: function () {
                $(btn).addClass("disabled");
            },
            success: function (response) {
                $('.content-wrapper').append(response);
                $("#modal").modal("show");
            },
            complete: function () {
                $(btn).removeClass("disabled");
            },
            error: function (e) {
                handleError(e)
            }
        });
    }

    /* Submit post request in server without file upload */
    $(document).on('submit', 'form#submit', function (e) {
        e.preventDefault();
        // const clickedButton = e.target.activeElement;
        let draft = $(this).find('input[name="is_draft"]').val()

        if(draft == "true"){
            const url      = $(this).attr('action');
            const file     = $(this).attr('enctype');
            const redirect = $(this).data('redirect');
            const btn      = $(this).find('button[data-button="draft"]')[0];
            const spinner  = $(this).find('span#draft-spinner')[0];
            const btnText  = $(this).find('span#draft-btn--text')[0];

            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');

            const options = {
                type: 'POST',
                url: url,
                dataType: 'JSON'
            }

            if (typeof file === 'undefined') {
                options.data = $(this).serialize();
            }
            else {
                options.data = new FormData($(this)[0]);
                options.contentType = false;
                options.enctype = file;
                options.processData = false;
            }

            $.ajax({
                ...options,
                beforeSend: () => {
                    $(spinner).removeClass('d-none')
                    $(btn).addClass('disabled')
                    $(btnText).text('Please wait...')
                },
                success: (response) => handleSuccess(response, redirect),
                complete: () => {
                    $(spinner).addClass('d-none')
                    $(btn).removeClass('disabled')
                    $(btnText).text($(btn).data('text'))
                },
                error: (e) => handleError(e, redirect)
            });
        }
        else{
            const url      = $(this).attr('action');
            const file     = $(this).attr('enctype');
            const redirect = $(this).data('redirect');
            const btn      = $(this).find('button[data-button="submit"]')[0];
            const spinner  = $(this).find('span#submit-spinner')[0];
            const btnText  = $(this).find('span#btn--text')[0];

            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');

            const options = {
                type: 'POST',
                url: url,
                dataType: 'JSON'
            }

            if (typeof file === 'undefined') {
                options.data = $(this).serialize();
            }
            else {
                options.data = new FormData($(this)[0]);
                options.contentType = false;
                options.enctype = file;
                options.processData = false;
            }

            $.ajax({
                ...options,
                beforeSend: () => {
                    $(spinner).removeClass('d-none')
                    $(btn).addClass('disabled')
                    $(btnText).text('Please wait...')
                },
                success: (response) => handleSuccess(response, redirect),
                complete: () => {
                    $(spinner).addClass('d-none')
                    $(btn).removeClass('disabled')
                    $(btnText).text($(btn).data('text'))
                },
                error: (e) => handleError(e, redirect)
            });
        }

    });

    // Delete Data
    $(document).on("click", "#deleteBtn", function (e) {
        e.preventDefault();
        var url = $(this).attr("href");
        deleteData($(this), url);
    });

    // Product
    $(document).on('change', 'select#vat', function(e) {
        const vatAmount = $('input#vat_percentage');

        if(e.target.value === 'no') {
            vatAmount.val(0);
            vatAmount.parent().addClass('d-none')
        }
        else {
            vatAmount.val(20);
            vatAmount.parent().removeClass('d-none')
        }
    });

    // Quotes

    // Add new quotes item
    $(document).on('click', '#addItem', function (e) {
        e.preventDefault();
        const btn = $(this);
        $.ajax({
            type: 'GET',
            url: e.target.href,
            dataType: 'HTML',
            beforeSend: () => btn.addClass('disabled'),
            success: function (response) {
                $('#quotes-items').append(response)
                const repeaterItem = $('#quotes-items').children().last().data('repeater-item');
                select2Init($(`select[name="items[${repeaterItem}][product]"]`))
            },
            complete: () => btn.removeClass('disabled'),
            error: (e) => handleError(e)
        });
    });

    // Remove quote item
    $(document).on('click', '#removeItem', function (e) {
        e.preventDefault();
        const parent = $(this).parent().parent().parent();
        const url = $(this).attr('href')
        if(url !== 'javascript:void(0)') {
            deleteData($(this), url, parent)
        }
        else {
            parent.remove()
            calculateTotal()
        }
    });

    $('#quotes-items').on('change, input', 'input, select', function (e) {
        const key = $(this).closest('.repeater-wrapper').data('repeater-item');
        calculationQuoteItem(key, e.target.name)
    })

    // Calculate every
    const calculationQuoteItem = (key, name) => {
        const unitPriceEl  = $(`input[name="items[${key}][unit_price]"]`);
        const quantityEl   = $(`input[name="items[${key}][qty]"]`);
        const subtotalEl   = $(`input[name="items[${key}][subtotal]"]`);
        const setupPriceEl = $(`input[name="items[${key}][setup_price]"]`);
        const discountEl = $(`input[name="items[${key}][discount]"]`);
        const discountAmountcEl  = $(`input[name="items[${key}][discount_amount]"]`);
        const vatEl      = $(`select[name="items[${key}][vat]"]`);
        const vatPercEl  = $(`input[name="items[${key}][vat_percentage]"]`);
        const vatAmountcEl  = $(`input[name="items[${key}][vat_amount]"]`);
        const totalEl    = $(`input[name="items[${key}][total]"]`);
        const prodName   = $(`input[name="items[${key}][product_name]"]`);
        const prodDesc   = $(`input[name="items[${key}][product_description]"]`);

        if (name === `items[${key}][product]`) {
            const productId = $(`select[name="items[${key}][product]"]`).val();
            if (productId.includes('__string')) {
                var product = customProducts.find(prod => prod.product_name == productId.replace('__string', ''));
            }
            else {
                var product = products.find(prod => prod.id == productId);
            }

            if (typeof product?.product_name !== 'undefined') {
                prodName.val(product?.product_name)
                prodDesc.val(product?.product_description)
            }

            unitPriceEl.val(product?.unit_price)
            setupPriceEl.val(product?.setup_price)
            vatPercEl.val(product?.vat_percentage)
            vatEl.html(`<option value="yes" ${product?.vat == 'yes' ? 'selected':''}>Yes</option><option value="no" ${product?.vat == 'no' ? 'selected':''}>No</option>`)
        }
        else if(name === `items[${key}][vat]`) {
            vatPercEl.val(vatEl.val() == 'no' ? 0 : 20)
        }

        const unit_price  = parseFloat(unitPriceEl.val())? parseFloat(unitPriceEl.val()): parseFloat(0);
        const setup_price = parseFloat(setupPriceEl.val())? parseFloat(setupPriceEl.val()) : parseFloat(0);
        const quantity    = parseInt(quantityEl.val())? parseInt(quantityEl.val()) : parseInt(1);
        const discount    = parseFloat(discountEl.val())? parseFloat(discountEl.val()) : parseFloat(0);
        const subtotal    = ((unit_price * quantity) + setup_price);
        const discount_amount = subtotal * (discount / 100);
        const vat_percentage  = parseFloat(vatPercEl.val())? parseFloat(vatPercEl.val()): parseFloat(0);
        const vatAmount  = subtotal * (vat_percentage / 100);
        const grandtotal = (subtotal - discount_amount) + vatAmount;

        subtotalEl.val(parseFloat(subtotal).toFixed(2))
        vatAmountcEl.val(parseFloat(vatAmount).toFixed(2))
        discountAmountcEl.val(parseFloat(discount_amount).toFixed(2))
        totalEl.val(parseFloat(grandtotal).toFixed(2))

        calculateTotal()
    }

    const calculateTotal = () => {
        let total_subtotal = 0;
        let total_discount_amount = 0;
        let total_vat = 0;
        let grand_total = 0;


        $('input.total_subtotal').each(function() {
            total_subtotal += parseFloat($(this).val())
        });
        $('input.total_discount_amount').each(function() {
            total_discount_amount += parseFloat($(this).val())
        });
        $('input.total_vat').each(function() {
            total_vat += parseFloat($(this).val())
        });
        $('input.total_total').each(function() {
            grand_total += parseFloat($(this).val())
        });

        $('#subtotals').text(convertAmount(total_subtotal));
        $('#discounts').text(convertAmount(total_discount_amount));
        $('#vat_per').text('20%');
        $('#vats').text(convertAmount(total_vat));
        $('#totals').text(convertAmount(grand_total));
    }

    $('#shippings').on('change, input', function (e){
        const shipping_amount = $('#shippings').val();
        let total_total = 0;
        $('input.total_total').each(function() {
            total_total += parseFloat($(this).val())
        });
        total_amount_with_shipping = parseFloat(parseFloat(total_total) + parseFloat(shipping_amount)).toFixed(2);
        if(shipping_amount == 0 || shipping_amount == ''){
            calculateTotal()
        }
        else{
            $('#totals').text(convertAmount(total_amount_with_shipping));
        }
    })

});

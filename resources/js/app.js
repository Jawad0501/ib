try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

$(function() {

    // const toggledClasses = () => {
    //     if(window.innerWidth >= 1200) {
    //         $('.wrapper').addClass('toggled-left toggled-right');
    //     }
    // }
    // toggledClasses();


    $(document).on('click', '#toggled-left', function() {
        $('.aside').addClass('toggled');
        $('.overlay-bg').removeClass('d-none');
    });

    $(document).on('click', '#toggled-right', function() {
        $('.right-bar').addClass('toggled');
        $('.overlay-bg').removeClass('d-none');
    });

    $(document).on('click', '.overlay-bg', function () {
        $('.aside, .right-bar').removeClass('toggled');
        $('.overlay-bg').addClass('d-none');
    });



    $(document).on('change', 'input[type="file"]', function (e) {
        let show = $(this).data('show-image');
        showImage(e, show);
    });

    // When file select then show this image
    let showImage = (event, show) => {
        let file = event.target.files[0];
        let reader = new FileReader();
        reader.onload = (e) => {
            $(`#${show}`).attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    }

    // Initialize Select2 plugin
    let select2Initilize = () => {
        let select2 = $('.select2');
        if (select2.length) {
            select2.each(function () {
                $(this).select2()
                // var $this = $(this);
                // $this.wrap('<div class="position-relative"></div>').select2({
                //     // placeholder: 'Select value',
                //     dropdownParent: $this.parent()
                // });
            });
        }
    }

    // Add/Edit/Show modal show
    $(document).on('click', '#addBtn, #editBtn, #showBtn', function(e) {
        e.preventDefault();
        sendGetRequest($(this).attr('href'), $(this))
    });

    // Show modal
    $(document).on("click", "#approvedBtn", function (e) {
        e.preventDefault();
        let btn  = $(this);
        let url  = $(this).attr("href");
        let data = {_method: 'PUT'}

        submitForm(url, data, btn);
    });

    /* Send a GET request in the server */
    function sendGetRequest(url, btn){
        $('#modal').remove();
        $.ajax({
            type: "GET",
            url: url,
            dataType: "HTML",
            beforeSend: function () {
                $(btn).addClass("disabled");
            },
            success: function (response) {
                $('.page-content').append(response);
                $("#modal").modal("show");

                select2Initilize()
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
        const url      = $(this).attr('action');
        const file     = $(this).attr('enctype');
        const redirect = $(this).data('redirect');
        const btn      = $(this).find('button[type="submit"]')[0];
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

    });



    // Delete Data
    $(document).on('click', '#deleteBtn', function (e) {
        e.preventDefault();
        deleteData($(this), $(this).attr('href'));
    });

    $(document).on("click", "#printBtn", function (e) {
        e.preventDefault();
        console.log(e);
        let url  = $(this).attr("href");
        window.open(url, '_blank', 'location=yes,height=1080,width=720,scrollbars=yes,status=yes');
    });


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
                // select2Init($(`select[name="items[${repeaterItem}][product]"]`))
            },
            complete: () => btn.removeClass('disabled'),
            error: (e) => handleError(e)
        });
    });

    $(document).on('click', '#removeItem', function (e) {
        e.preventDefault();
        const parent = $(this).parent().parent().parent();
        const url = $(this).attr('href')
        if(url !== 'javascript:void(0)') {
            deleteData($(this), url, parent)
        }
        else {
            parent.remove()
        }
    });


});

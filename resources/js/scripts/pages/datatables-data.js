$(function () {
    ("use strict");
    const dtDom = `<"row mx-1"<"col-sm-12 col-md-3" l><"col-sm-12 col-md-9"<"dt-action-buttons text-xl-end text lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center flex-wrap me-1"<"me-3"f>B>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>`;
    try {
        $.extend(true, $.fn.dataTable.defaults, {
            ordering: true,
            processing: true,
            serverSide: true,
            order: [[0, "desc"]],
            dom: dtDom,
            language: {
                sLengthMenu: "Show _MENU_",
                search: "Search",
                searchPlaceholder: "Search..",
            },
            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: "&nbsp;",
                    next: "&nbsp;",
                },
            },
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.childRow,
                    type: "column",
                    renderer: function (api, rowIdx, columns) {
                        var data = $.map(columns, function (col, i) {
                            return col.columnIndex !== 6 // ? Do not show row in modal popup if title is blank (for check box)
                                ? '<tr data-dt-row="' +
                                      col.rowIdx +
                                      '" data-dt-column="' +
                                      col.columnIndex +
                                      '">' +
                                      "<td>" +
                                      col.title +
                                      ":" +
                                      "</td> " +
                                      "<td>" +
                                      col.data +
                                      "</td>" +
                                      "</tr>"
                                : "";
                        }).join("");
                        return data
                            ? $('<table class="table"/>').append(
                                  "<tbody>" + data + "</tbody>"
                              )
                            : false;
                    },
                },
            },
        });
    } catch (error) {
        console.log(error);
    }

    const dataTableInitilize = (options) => {
        var table = $('#datatable').DataTable(options);
        window.table = table
    }

    // ROLE MANAGEMENT DATATABLE
    if(route().current('admin.role.index')) {
        var options = {
            ajax: route('admin.role.index'), // JSON file to add data
            columns: [
                // columns according to JSON
                { data: "DT_RowIndex", name: "id", searchable: false, render: (data, type, row) => `<div class="d-flex">
                <div>
                    ${data}
                </div>
                <div class="d-sm-none" style="margin-left: 5px">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                        <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/>
                    </svg>
                </div>
                </div>`  },
                { data: "name", name: "name" },
                { data: 'permissions', name: 'permissions', render: (data) => data.length},
                { data: ""},
            ],
            columnDefs: [
                {
                    // Actions
                    targets: -1,
                    title: "Actions",
                    orderable: false,
                    render: function (data, type, row) {
                        return `<div class="dropdown">
                            <button class="btn btn-dark dropdown-toggle type="button" id="dropdownMenuButton_${row.id}" data-bs-toggle="dropdown" aria-expanded="false">
                            Actions
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton_${row.id}" style="width: 160px">
                            <li>${datatableButtons([{ url: route('admin.role.edit', row.id), type: 'edit', id: false, permission: 'edit_role', text: 'Edit Role'}])}</li>
                            <li>${datatableButtons([{ url: route('admin.role.destroy', row.id), type: 'delete', id: true, permission: 'delete_role', text: 'Delete Role'}])}</li>
                            </ul>
                        </div>`
                    },
                },
            ],
            buttons: [
                {
                    extend: "collection",
                    className: `btn btn-outline-secondary dropdown-toggle me-2`,
                    text:
                        feather.icons["external-link"].toSvg({
                            class: "font-small-4 me-50",
                        }) + "Export",
                    buttons: [
                        {
                            extend: "print",
                            text:
                                feather.icons["printer"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Print",
                            className: "dropdown-item",
                        },
                        {
                            extend: "csv",
                            text:
                                feather.icons["file-text"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Csv",
                            className: "dropdown-item",
                        },
                        {
                            extend: "excel",
                            text:
                                feather.icons["file"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Excel",
                            className: "dropdown-item",
                        },
                        {
                            extend: "pdf",
                            text:
                                feather.icons["clipboard"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Pdf",
                            className: "dropdown-item",
                        },
                        {
                            extend: "copy",
                            text:
                                feather.icons["copy"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Copy",
                            className: "dropdown-item",
                        },
                    ],
                    init: function (api, node, config) {
                        $(node).removeClass("btn-secondary");
                        $(node).parent().removeClass("btn-group");
                        setTimeout(function () {
                            $(node)
                                .closest(".dt-buttons")
                                .removeClass("btn-group")
                                .addClass("d-inline-flex mt-50");
                        }, 50);
                    },
                }
            ],
        };
        dataTableInitilize(options)
    }

    // ROLE MANAGEMENT DATATABLE
    if(route().current('admin.permission.index')) {
        var options = {
            ajax: route('admin.permission.index'), // JSON file to add data
            columns: [
                // columns according to JSON
                { data: "DT_RowIndex", name: "id", searchable: false },
                { data: "module.name", name: "module.name" },
                { data: "name", name: "name" }
            ],
            buttons: [
                {
                    extend: "collection",
                    className: `btn btn-outline-secondary dropdown-toggle me-2 ${hasPermission('export_user') == true ? '' : 'd-none'}`,
                    text:
                        feather.icons["external-link"].toSvg({
                            class: "font-small-4 me-50",
                        }) + "Export",
                    buttons: [
                        {
                            extend: "print",
                            text:
                                feather.icons["printer"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Print",
                            className: "dropdown-item",
                        },
                        {
                            extend: "csv",
                            text:
                                feather.icons["file-text"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Csv",
                            className: "dropdown-item",
                        },
                        {
                            extend: "excel",
                            text:
                                feather.icons["file"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Excel",
                            className: "dropdown-item",
                        },
                        {
                            extend: "pdf",
                            text:
                                feather.icons["clipboard"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Pdf",
                            className: "dropdown-item",
                        },
                        {
                            extend: "copy",
                            text:
                                feather.icons["copy"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Copy",
                            className: "dropdown-item",
                        },
                    ],
                    init: function (api, node, config) {
                        $(node).removeClass("btn-secondary");
                        $(node).parent().removeClass("btn-group");
                        setTimeout(function () {
                            $(node)
                                .closest(".dt-buttons")
                                .removeClass("btn-group")
                                .addClass("d-inline-flex mt-50");
                        }, 50);
                    },
                }
            ],
        };
        dataTableInitilize(options)
    }

    // User
    if(route().current('admin.staff.index')) {
        var options = {
            ajax: route('admin.staff.index'), // JSON file to add data
            columns: [
                // columns according to JSON
                { data: "DT_RowIndex", name: "id", searchable: false, render: (data, type, row) => `<div class="d-flex">
                <div>
                    ${data}
                </div>
                <div class="d-sm-none" style="margin-left: 5px">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                        <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/>
                    </svg>
                </div>
                </div>`  },
                { data: "role.name", name: "role.name" },
                { data: "name", name: "name" },
                { data: "email", name: "email" },
                { data: "phone", name: "phone" },
                { data: "" },
            ],
            columnDefs: [
                {
                    // Actions
                    targets: -1,
                    title: "Actions",
                    orderable: false,
                    render: function (data, type, row) {
                        return `<div class="dropdown">
                            <button class="btn btn-dark dropdown-toggle type="button" id="dropdownMenuButton_${row.id}" data-bs-toggle="dropdown" aria-expanded="false">
                            Actions
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton_${row.id}" style="width: 160px">
                            <li>${datatableButtons([{ url: route('admin.staff.edit', row.id), type: 'edit', id: true, permission: 'edit_user', text: 'Edit User'}])}</li>
                            <li>${datatableButtons([{ url: route('admin.staff.destroy', row.id), type: 'delete', id: true, permission: 'delete_user', text: 'Delete User'}])}</li>
                            </ul>
                        </div>`
                    },
                },
            ],
            buttons: [
                {
                    extend: "collection",
                    className: `btn btn-outline-secondary dropdown-toggle me-2`,
                    text:
                        feather.icons["external-link"].toSvg({
                            class: "font-small-4 me-50",
                        }) + "Export",
                    buttons: [
                        {
                            extend: "print",
                            text:
                                feather.icons["printer"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Print",
                            className: "dropdown-item",
                        },
                        {
                            extend: "csv",
                            text:
                                feather.icons["file-text"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Csv",
                            className: "dropdown-item",
                        },
                        {
                            extend: "excel",
                            text:
                                feather.icons["file"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Excel",
                            className: "dropdown-item",
                        },
                        {
                            extend: "pdf",
                            text:
                                feather.icons["clipboard"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Pdf",
                            className: "dropdown-item",
                        },
                        {
                            extend: "copy",
                            text:
                                feather.icons["copy"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Copy",
                            className: "dropdown-item",
                        },
                    ],
                    init: function (api, node, config) {
                        $(node).removeClass("btn-secondary");
                        $(node).parent().removeClass("btn-group");
                        setTimeout(function () {
                            $(node)
                                .closest(".dt-buttons")
                                .removeClass("btn-group")
                                .addClass("d-inline-flex mt-50");
                        }, 50);
                    },
                }
            ],
        };
        dataTableInitilize(options)
    }

    // User
    if(route().current('admin.user.index')) {
        var options = {
            ajax: route('admin.user.index'), // JSON file to add data
            columns: [
                // columns according to JSON
                { data: "DT_RowIndex", name: "id", searchable: false, render: (data, type, row) => `<div class="d-flex">
                <div>
                    ${data}
                </div>
                <div class="d-sm-none" style="margin-left: 5px">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                        <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/>
                    </svg>
                </div>
                </div>`  },
                { data: "name", name: "name", render: (data, type, row) =>  `<a href="user/quotes/${row.id}" style="all:unset; cursor: pointer">${data}</a>` },
                { data: "email", name: "email", render: (data, type, row) =>  `<a href="user/quotes/${row.id}" style="all:unset; cursor: pointer">${data}</a>` },
                { data: "company_name", name: "company_name", render: (data, type, row) =>  `<a href="user/quotes/${row.id}" style="all:unset; cursor: pointer">${data}</a>` },
                { data: "telephone", name: "telephone" },
                { data: "vat_number", name: "vat_number" },
                { data: "" },
            ],
            columnDefs: [
                {
                    // Actions
                    targets: -1,
                    title: "Actions",
                    orderable: false,
                    render: function (data, type, row) {
                        return `<div class="dropdown">
                            <button class="btn btn-dark dropdown-toggle type="button" id="dropdownMenuButton_${row.id}" data-bs-toggle="dropdown" aria-expanded="false">
                            Actions
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton_${row.id}" style="width: 160px">
                            <li>${datatableButtons([{ url: route('admin.user.quotes', row.id), type: 'show', id: false, permission: 'show_customer', text: 'Show Customer'}])}</li>
                            <li>${datatableButtons([{ url: route('admin.user.edit', row.id), type: 'edit', id: true, permission: 'edit_customer', text: 'Edit Customer'}])}</li>
                            <li>${datatableButtons([{ url: route('admin.user.destroy', row.id), type: 'delete', id: true, permission: 'delete_customer', text: 'Delete Customer'}])}</li>
                            </ul>
                        </div>`
                    },
                },
            ],
            buttons: [
                {
                    extend: "collection",
                    className: `btn btn-outline-secondary dropdown-toggle me-2 ${hasPermission('export_user') == true ? '' : 'd-none'}`,
                    text:
                        feather.icons["external-link"].toSvg({
                            class: "font-small-4 me-50",
                        }) + "Export",
                    buttons: [
                        {
                            extend: "print",
                            text:
                                feather.icons["printer"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Print",
                            className: "dropdown-item",
                        },
                        {
                            extend: "csv",
                            text:
                                feather.icons["file-text"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Csv",
                            className: "dropdown-item",
                        },
                        {
                            extend: "excel",
                            text:
                                feather.icons["file"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Excel",
                            className: "dropdown-item",
                        },
                        {
                            extend: "pdf",
                            text:
                                feather.icons["clipboard"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Pdf",
                            className: "dropdown-item",
                        },
                        {
                            extend: "copy",
                            text:
                                feather.icons["copy"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Copy",
                            className: "dropdown-item",
                        },
                    ],
                    init: function (api, node, config) {
                        $(node).removeClass("btn-secondary");
                        $(node).parent().removeClass("btn-group");
                        setTimeout(function () {
                            $(node)
                                .closest(".dt-buttons")
                                .removeClass("btn-group")
                                .addClass("d-inline-flex mt-50");
                        }, 50);
                    },
                }
            ],
        };
        dataTableInitilize(options)
    }

    // Product
    if(route().current('admin.product.index')) {
        var options = {
            ajax: route('admin.product.index'), // JSON file to add data
            columns: [
                // columns according to JSON
                { data: "DT_RowIndex", name: "id", searchable: false, render: (data, type, row) => `<div class="d-flex">
                <div>
                    ${data}
                </div>
                <div class="d-sm-none" style="margin-left: 5px">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                        <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/>
                    </svg>
                </div>
                </div>`  },
                { data: "name", name: "name" },
                { data: "sku_number", name: "sku_number" },
                { data: "ur_code", name: "ur_code" },
                { data: "unit_price", name: "unit_price", render: (data) => convertAmount(data) },
                { data: "" },
            ],
            columnDefs: [
                {
                    // Actions
                    targets: -1,
                    title: "Actions",
                    orderable: false,
                    render: function (data, type, row) {
                        return `<div class="dropdown">
                            <button class="btn btn-dark dropdown-toggle type="button" id="dropdownMenuButton_${row.id}" data-bs-toggle="dropdown" aria-expanded="false">
                            Actions
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton_${row.id}" style="width: 160px">
                            <li>${datatableButtons([{ url: route('admin.product.edit', row.id), type: 'edit', id: true, permission: 'edit_product', text: 'Edit Product'}])}</li>
                            <li>${datatableButtons([{ url: route('admin.product.destroy', row.id), type: 'delete', id: true, permission: 'delete_product', text: 'Delete Product'}])}</li>
                            </ul>
                        </div>`

                    },
                },
            ],
            buttons: [
                {
                    extend: "collection",
                    className: `btn btn-outline-secondary dropdown-toggle me-2 ${hasPermission('export_product') == true ? '' : 'd-none'}`,
                    text:
                        feather.icons["external-link"].toSvg({
                            class: "font-small-4 me-50",
                        }) + "Export",
                    buttons: [
                        {
                            extend: "print",
                            text:
                                feather.icons["printer"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Print",
                            className: "dropdown-item",
                        },
                        {
                            extend: "csv",
                            text:
                                feather.icons["file-text"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Csv",
                            className: "dropdown-item",
                        },
                        {
                            extend: "excel",
                            text:
                                feather.icons["file"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Excel",
                            className: "dropdown-item",
                        },
                        {
                            extend: "pdf",
                            text:
                                feather.icons["clipboard"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Pdf",
                            className: "dropdown-item",
                        },
                        {
                            extend: "copy",
                            text:
                                feather.icons["copy"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Copy",
                            className: "dropdown-item",
                        },
                    ],
                    init: function (api, node, config) {
                        $(node).removeClass("btn-secondary");
                        $(node).parent().removeClass("btn-group");
                        setTimeout(function () {
                            $(node)
                                .closest(".dt-buttons")
                                .removeClass("btn-group")
                                .addClass("d-inline-flex mt-50");
                        }, 50);
                    },
                }
            ],
        };
        dataTableInitilize(options)
    }

    // Quotes
    if(route().current('admin.quotes.index')) {
        var options = {
            ajax: route('admin.quotes.index'), // JSON file to add data
            columns: [
                // columns according to JSON
                { data: "DT_RowIndex", name: "id", searchable: false, render: (data, type, row) => `<div class="d-flex">
                <div>
                    ${data}
                </div>
                <div class="d-sm-none" style="margin-left: 5px">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                        <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/>
                    </svg>
                </div>
                </div>`  },
                { data: "invoice", name: "invoice", render: (data, type, row) =>  `<a href="quotes/${row.id}" style="all:unset; cursor: pointer">${data}</a>` },
                { data: "created_at", name: "created_at", render: (data, type, row) =>  `<a href="quotes/${row.id}" style="all:unset; cursor: pointer">${data}</a>` },
                { data: "user.company_name", name: "user.company_name", render: (data, type, row) =>  `<a href="quotes/${row.id}" style="all:unset; cursor: pointer">${data}</a>` },
                { data: "admin.name", name: "admin.name",  render: (data, type, row) =>  `<a href="quotes/${row.id}" style="all:unset; cursor: pointer">${data}</a>` },
                { data: "items_sum_subtotal", name: "items_sum_subtotal", searchable: false, orderable: false, render: (data) => convertAmount(data) },
                { data: "items_sum_total", name: "items_sum_total", searchable: false, orderable: false, render: (data, type, row) => convertAmount(parseFloat(data) + parseFloat(row.shipping_amount))},
                { data: "" },
            ],
            columnDefs: [
                {
                    // Actions
                    targets: -1,
                    title: "Actions",
                    orderable: false,
                    render: function (data, type, row) {
                        return `<div class="dropdown">
                            <button class="btn btn-dark dropdown-toggle type="button" id="dropdownMenuButton_${row.id}" data-bs-toggle="dropdown" aria-expanded="false">
                            Actions
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton_${row.id}" style="width: 160px">
                            <li>${datatableButtons([{ url: route('admin.quotes.approve', row.id), type: 'approved', id: true, permission: 'edit_quote', text: 'Approve Quote'}])}</li>
                            <li>${datatableButtons([{ url: route('admin.quotes.edit', row.id), type: 'edit', id: false, permission: 'edit_quote', text: 'Edit Quote'}])}</li>
                            <li>${datatableButtons([{ url: route('admin.quotes.download', row.id), type: 'download', id: false, permission: 'show_quote', text: 'Download Quote'}])}</li>
                            <li>${datatableButtons([{ url: route('admin.invoice.edit', row.id), type: 'invoice', id: true, permission: 'edit_invoice', text: 'Send Invoice'}])}</li>
                            <li>${datatableButtons([{ url: route('admin.quotes.destroy', row.id), type: 'delete', id: true, permission: 'delete_quote', text: 'Delete Quote'}])}</li>
                            </ul>
                        </div>`
                    },
                },
            ],
            buttons: [
                {
                    extend: "collection",
                    className: `btn btn-outline-secondary dropdown-toggle me-2 ${hasPermission('export_quote') == true ? '' : 'd-none'}`,
                    text:
                        feather.icons["external-link"].toSvg({
                            class: "font-small-4 me-50",
                        }) + "Export",
                    buttons: [
                        {
                            extend: "print",
                            text:
                                feather.icons["printer"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Print",
                            className: "dropdown-item",
                        },
                        {
                            extend: "csv",
                            text:
                                feather.icons["file-text"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Csv",
                            className: "dropdown-item",
                        },
                        {
                            extend: "excel",
                            text:
                                feather.icons["file"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Excel",
                            className: "dropdown-item",
                        },
                        {
                            extend: "pdf",
                            text:
                                feather.icons["clipboard"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Pdf",
                            className: "dropdown-item",
                        },
                        {
                            extend: "copy",
                            text:
                                feather.icons["copy"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Copy",
                            className: "dropdown-item",
                        },
                    ],
                    init: function (api, node, config) {
                        $(node).removeClass("btn-secondary");
                        $(node).parent().removeClass("btn-group");
                        setTimeout(function () {
                            $(node)
                                .closest(".dt-buttons")
                                .removeClass("btn-group")
                                .addClass("d-inline-flex mt-50");
                        }, 50);
                    },
                }
            ],
        };
        dataTableInitilize(options)
    }

    // Drafts
    if(route().current('admin.quotes.drafts')) {
        var options = {
            ajax: route('admin.quotes.drafts'), // JSON file to add data
            columns: [
                // columns according to JSON
                { data: "DT_RowIndex", name: "id", searchable: false, render: (data, type, row) => `<div class="d-flex">
                <div>
                    ${data}
                </div>
                <div class="d-sm-none" style="margin-left: 5px">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                        <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/>
                    </svg>
                </div>
                </div>`  },
                { data: "invoice", name: "invoice", render: (data, type, row) =>  `<a href="${row.id}" style="all:unset; cursor: pointer">${data}</a>` },
                { data: "created_at", name: "created_at", render: (data, type, row) =>  `<a href="${row.id}" style="all:unset; cursor: pointer">${data}</a>` },
                { data: "user.company_name", name: "user.company_name", render: (data, type, row) =>  `<a href="${row.id}" style="all:unset; cursor: pointer">${data}</a>` },
                { data: "admin.name", name: "admin.name",  render: (data, type, row) =>  `<a href="${row.id}" style="all:unset; cursor: pointer">${data}</a>` },
                { data: "items_sum_subtotal", name: "items_sum_subtotal", searchable: false, orderable: false, render: (data) => convertAmount(data) },
                { data: "items_sum_total", name: "items_sum_total", searchable: false, orderable: false, render: (data, type, row) => convertAmount(parseFloat(data) + parseFloat(row.shipping_amount))},
                { data: "" },
            ],
            columnDefs: [
                {
                    // Actions
                    targets: -1,
                    title: "Actions",
                    orderable: false,
                    render: function (data, type, row) {
                        return `<div class="dropdown">
                            <button class="btn btn-dark dropdown-toggle type="button" id="dropdownMenuButton_${row.id}" data-bs-toggle="dropdown" aria-expanded="false">
                            Actions
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton_${row.id}" style="width: 160px">
                            <li>${datatableButtons([{ url: route('admin.quotes.edit', row.id), type: 'edit', id: false, permission: 'edit_quote', text: 'Edit Quote'}])}</li>
                            <li>${datatableButtons([{ url: route('admin.quotes.destroy', row.id), type: 'delete', id: true, permission: 'delete_quote', text: 'Delete Quote'}])}</li>
                            </ul>
                        </div>`
                    },
                },
            ],
            buttons: [
                {
                    extend: "collection",
                    className: `btn btn-outline-secondary dropdown-toggle me-2 ${hasPermission('export_quote') == true ? '' : 'd-none'}`,
                    text:
                        feather.icons["external-link"].toSvg({
                            class: "font-small-4 me-50",
                        }) + "Export",
                    buttons: [
                        {
                            extend: "print",
                            text:
                                feather.icons["printer"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Print",
                            className: "dropdown-item",
                        },
                        {
                            extend: "csv",
                            text:
                                feather.icons["file-text"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Csv",
                            className: "dropdown-item",
                        },
                        {
                            extend: "excel",
                            text:
                                feather.icons["file"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Excel",
                            className: "dropdown-item",
                        },
                        {
                            extend: "pdf",
                            text:
                                feather.icons["clipboard"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Pdf",
                            className: "dropdown-item",
                        },
                        {
                            extend: "copy",
                            text:
                                feather.icons["copy"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Copy",
                            className: "dropdown-item",
                        },
                    ],
                    init: function (api, node, config) {
                        $(node).removeClass("btn-secondary");
                        $(node).parent().removeClass("btn-group");
                        setTimeout(function () {
                            $(node)
                                .closest(".dt-buttons")
                                .removeClass("btn-group")
                                .addClass("d-inline-flex mt-50");
                        }, 50);
                    },
                }
            ],
        };
        dataTableInitilize(options)
    }

    // Proof
    if(route().current('admin.proof.index')) {
        var options = {
            ajax: route('admin.proof.index'), // JSON file to add data
            columns: [
                // columns according to JSON
                { data: "DT_RowIndex", name: "id", searchable: false, render: (data, type, row) => `<div class="d-flex">
                <div>
                    ${data}
                </div>
                <div class="d-sm-none" style="margin-left: 5px">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                        <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/>
                    </svg>
                </div>
                </div>`  },
                { data: "invoice", name: "invoice", render: (data, type, row) =>  `<a href="proof/${row.id}" style="all:unset; cursor: pointer">${data}</a>` },
                { data: "created_at", name: "created_at", render: (data, type, row) =>  `<a href="proof/${row.id}" style="all:unset; cursor: pointer">${data}</a>` },
                { data: "user.company_name", name: "user.company_name", render: (data, type, row) =>  `<a href="proof/${row.id}" style="all:unset; cursor: pointer">${data}</a>` },
                { data: "approval_file", name: "approval_file", render: function(data){
                    if(data != null){
                        return '<span class="badge bg-primary text-capitalize">Proof Sent</span>'
                    }
                    else{
                        return '<span class="badge bg-primary text-capitalize">Not Sent</span>'
                    }
                }},
                { data: "items_sum_subtotal", name: "items_sum_subtotal", searchable: false, orderable: false, render: (data) => convertAmount(data) },
                { data: "items_sum_total", name: "items_sum_total", searchable: false, orderable: false, render: (data, type, row) => convertAmount(parseFloat(data) + parseFloat(row.shipping_amount))},
                { data: "artwork", name: "artwork", searchable: false, orderable: false, render: (data) => {
                    return `<a href="${showUploadedFile(data)}" download class="text-primary"><i class="ti ti-download" style="font-size: 1.3rem"></i>Download</a>`
                }},
                { data: "" },
            ],
            columnDefs: [
                {
                    // Actions
                    targets: -1,
                    title: "Actions",
                    orderable: false,
                    render: function (data, type, row) {
                        return `<div class="dropdown">
                            <button class="btn btn-dark dropdown-toggle type="button" id="dropdownMenuButton_${row.id}" data-bs-toggle="dropdown" aria-expanded="false">
                            Actions
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton_${row.id}" style="width: 160px">
                            <li>${datatableButtons([{ url: route('admin.proof.edit', row.id), type: 'upload', id: true, permission: 'edit_proof', text: 'Edit Proof'}])}</li>
                            <li>${datatableButtons([{ url: route('admin.invoice.edit', row.id), type: 'invoice', id: true, permission: 'edit_invoice', text: 'Send Invoice'}])}</li>
                            <li>${datatableButtons([{ url: route('admin.proof.destroy', row.id), type: 'delete', id: true, permission: 'delete_proof', text: 'Delete Proof'}])}</li>
                            </ul>
                        </div>`
                    },
                },
            ],
            buttons: [
                {
                    extend: "collection",
                    className: `btn btn-outline-secondary dropdown-toggle me-2 ${hasPermission('export_proof') == true ? '' : 'd-none'}`,
                    text:
                        feather.icons["external-link"].toSvg({
                            class: "font-small-4 me-50",
                        }) + "Export",
                    buttons: [
                        {
                            extend: "print",
                            text:
                                feather.icons["printer"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Print",
                            className: "dropdown-item",
                        },
                        {
                            extend: "csv",
                            text:
                                feather.icons["file-text"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Csv",
                            className: "dropdown-item",
                        },
                        {
                            extend: "excel",
                            text:
                                feather.icons["file"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Excel",
                            className: "dropdown-item",
                        },
                        {
                            extend: "pdf",
                            text:
                                feather.icons["clipboard"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Pdf",
                            className: "dropdown-item",
                        },
                        {
                            extend: "copy",
                            text:
                                feather.icons["copy"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Copy",
                            className: "dropdown-item",
                        },
                    ],
                    init: function (api, node, config) {
                        $(node).removeClass("btn-secondary");
                        $(node).parent().removeClass("btn-group");
                        setTimeout(function () {
                            $(node)
                                .closest(".dt-buttons")
                                .removeClass("btn-group")
                                .addClass("d-inline-flex mt-50");
                        }, 50);
                    },
                }
            ],
        };
        dataTableInitilize(options)
    }

    //Artwork
    if(route().current('admin.artwork.index')) {
        var options = {
            ajax: route('admin.artwork.index'), // JSON file to add data
            columns: [
                // columns according to JSON
                { data: "DT_RowIndex", name: "id", searchable: false, render: (data, type, row) => `<div class="d-flex">
                <div>
                    ${data}
                </div>
                <div class="d-sm-none" style="margin-left: 5px">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                        <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/>
                    </svg>
                </div>
                </div>` },
                { data: "invoice", name: "invoice", render: (data, type, row) =>  `<a href="artwork/${row.id}" style="all:unset; cursor: pointer">${data}</a>` },
                { data: "created_at", name: "created_at", render: (data, type, row) =>  `<a href="artwork/${row.id}" style="all:unset; cursor: pointer">${data}</a>` },
                { data: "user.company_name", name: "user.company_name", render: (data, type, row) =>  `<a href="artwork/${row.id}" style="all:unset; cursor: pointer">${data}</a>` },
                { data: "artwork", name: "status", searchable: false, orderable: false, render: function (data) {
                    if(data != null){
                        return '<span class="badge bg-primary text-capitalize">Received</span>'
                    }
                    else{
                        return '<span class="badge bg-primary text-capitalize">Awaiting</span>'
                    }
                }},
                { data: "approval_file", name: "proof", searchable: false, orderable: false, render: function (data, type, row) {
                    if(data != null){
                        if(row.status == 'approved'){
                            return '<span class="badge bg-primary text-capitalize">Approved</span>'
                        }
                        else if(row.status == 'reject'){
                            return '<span class="badge bg-primary text-capitalize">Rejected</span>'
                        }
                        else{
                            return '<span class="badge bg-primary text-capitalize">Sent</span>'
                        }
                    }
                    else{
                        return '<span class="badge bg-primary text-capitalize">Not Sent</span>'
                    }
                }},
                { data: "" },
            ],
            columnDefs: [
                {
                    // Actions
                    targets: -1,
                    title: "Actions",
                    orderable: false,
                    render: function (data, type, row) {
                        return `<div class="dropdown">
                            <button class="btn btn-dark dropdown-toggle type="button" id="dropdownMenuButton_${row.id}" data-bs-toggle="dropdown" aria-expanded="false">
                            Actions
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton_${row.id}" style="width: 160px">
                            <li>${datatableButtons([{ url: route('admin.proof.edit', row.id), type: 'upload', id: true, permission: 'edit_artwork', text: 'Send Proof'}])}</li>
                            <li>${datatableButtons([{ url: route('admin.artwork.edit', row.id), type: 'upload', id: true, permission: 'edit_artwork', text: 'Send Artwork'}])}</li>
                            <li>${datatableButtons([{ url: route('admin.invoice.edit', row.id), type: 'invoice', id: true, permission: 'edit_invoice', text: 'Send Invoice'}])}</li>
                            </ul>
                        </div>`

                        // <li>${datatableButtons([{ url: route('admin.proof.destroy', row.id), type: 'delete', id: true, permission: 'delete_proof', text: 'Delete Artwork'}])}</li>
                    },
                },
            ],
            buttons: [
                {
                    extend: "collection",
                    className: `btn btn-outline-secondary dropdown-toggle me-2 ${hasPermission('export_artwork') == true ? '' : 'd-none'}`,
                    text:
                        feather.icons["external-link"].toSvg({
                            class: "font-small-4 me-50",
                        }) + "Export",
                    buttons: [
                        {
                            extend: "print",
                            text:
                                feather.icons["printer"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Print",
                            className: "dropdown-item",
                        },
                        {
                            extend: "csv",
                            text:
                                feather.icons["file-text"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Csv",
                            className: "dropdown-item",
                        },
                        {
                            extend: "excel",
                            text:
                                feather.icons["file"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Excel",
                            className: "dropdown-item",
                        },
                        {
                            extend: "pdf",
                            text:
                                feather.icons["clipboard"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Pdf",
                            className: "dropdown-item",
                        },
                        {
                            extend: "copy",
                            text:
                                feather.icons["copy"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Copy",
                            className: "dropdown-item",
                        },
                    ],
                    init: function (api, node, config) {
                        $(node).removeClass("btn-secondary");
                        $(node).parent().removeClass("btn-group");
                        setTimeout(function () {
                            $(node)
                                .closest(".dt-buttons")
                                .removeClass("btn-group")
                                .addClass("d-inline-flex mt-50");
                        }, 50);
                    },
                }
            ],
        };
        dataTableInitilize(options)
    }



    // Order
    if(route().current('admin.order.index')) {
        var options = {
            ajax: route('admin.order.index'), // JSON file to add data
            columns: [
                // columns according to JSON
                { data: "DT_RowIndex", name: "id", searchable: false, render: (data, type, row) => `<div class="d-flex align-items-center">
                <div>
                    ${data}
                </div>
                <div class="d-sm-none" style="margin-left: 5px">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                        <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/>
                    </svg>
                </div>
                </div>`},
                { data: "invoice", name: "invoice", render: (data, type, row) =>  `<a href="order/${row.id}" style="all:unset; cursor: pointer">${data}</a>` },
                { data: "created_at", name: "created_at", render: (data, type, row) =>  `<a href="order/${row.id}" style="all:unset; cursor: pointer">${data}</a>`  },
                { data: "user.company_name", name: "user.company_name", render: (data, type, row) =>  `<a href="order/${row.id}" style="all:unset; cursor: pointer">${data}</a>`  },
                { data: "status", name: "status", render: (data) => `<span class="badge bg-primary text-capitalize">${data}</span>` },
                { data: "items_sum_subtotal", name: "items_sum_subtotal", searchable: false, orderable: false, render: (data) => convertAmount(data) },
                { data: "items_sum_total", name: "items_sum_total", searchable: false, orderable: false, render: (data, type, row) => convertAmount(parseFloat(data) + parseFloat(row.shipping_amount))},
                { data: "artwork", name: "artwork", searchable: false, orderable: false, render: function (data) {
                    if(data != null){
                        return '<span class="badge bg-primary text-capitalize">Received</span>'
                    }
                    else{
                        return '<span class="badge bg-primary text-capitalize">Awaiting</span>'
                    }
                }},
                { data: "approval_file", name: "proof", searchable: false, orderable: false, render: function (data, type, row) {
                    if(data != null){
                        if(row.status == 'approved'){
                            return '<span class="badge bg-primary text-capitalize">Approved</span>'
                        }
                        else if(row.status == 'reject'){
                            return '<span class="badge bg-primary text-capitalize">Rejected</span>'
                        }
                        else{
                            return '<span class="badge bg-primary text-capitalize">Sent</span>'
                        }
                    }
                    else{
                        return '<span class="badge bg-primary text-capitalize">Not Sent</span>'
                    }
                }},
                { data: "" },
            ],
            columnDefs: [
                {
                    // Actions
                    targets: -1,
                    title: "Actions",
                    orderable: false,
                    render: function (data, type, row) {
                        return `<div class="dropdown">
                            <button class="btn btn-dark dropdown-toggle type="button" id="dropdownMenuButton_${row.id}" data-bs-toggle="dropdown" aria-expanded="false">
                            Actions
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton_${row.id}" style="width: 160px">
                            <li>${datatableButtons([{ url: route('admin.order.edit', row.id), type: 'edit', id: true, permission: 'edit_order', text: 'Change Status'}])}</li>
                            <li>${datatableButtons([{ url: route('admin.invoice.edit', row.id), type: 'invoice', id: true, permission: 'edit_invoice', text: 'Send Invoice'}])}</li>
                            <li>${datatableButtons([{ url: route('admin.order.destroy', row.id), type: 'delete', id: true, permission: 'delete_order', text: 'Delete Order'}])}</li>
                            </ul>
                        </div>`
                    },
                },
            ],
            buttons: [
                {
                    extend: "collection",
                    className: `btn btn-outline-secondary dropdown-toggle me-2 ${hasPermission('export_order') == true ? '' : 'd-none'}`,
                    text:
                        feather.icons["external-link"].toSvg({
                            class: "font-small-4 me-50",
                        }) + "Export",
                    buttons: [
                        {
                            extend: "print",
                            text:
                                feather.icons["printer"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Print",
                            className: "dropdown-item",
                        },
                        {
                            extend: "csv",
                            text:
                                feather.icons["file-text"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Csv",
                            className: "dropdown-item",
                        },
                        {
                            extend: "excel",
                            text:
                                feather.icons["file"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Excel",
                            className: "dropdown-item",
                        },
                        {
                            extend: "pdf",
                            text:
                                feather.icons["clipboard"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Pdf",
                            className: "dropdown-item",
                        },
                        {
                            extend: "copy",
                            text:
                                feather.icons["copy"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Copy",
                            className: "dropdown-item",
                        },
                    ],
                    init: function (api, node, config) {
                        $(node).removeClass("btn-secondary");
                        $(node).parent().removeClass("btn-group");
                        setTimeout(function () {
                            $(node)
                                .closest(".dt-buttons")
                                .removeClass("btn-group")
                                .addClass("d-inline-flex mt-50");
                        }, 50);
                    },
                }
            ],
        };
        dataTableInitilize(options)
    }

    // Invoice
    if(route().current('admin.invoice.index')) {
        var options = {
            ajax: {
                url: route('admin.invoice.index'),
                data: function(q) {
                    q.status = $('#invoiceType').val()
                    q.vat_status = $('#vatType').val()
                }
            }, // JSON file to add data
            columns: [
                // columns according to JSON
                { data: "DT_RowIndex", name: "id", searchable: false, render: (data, type, row) => `<div class="d-flex">
                    <div>
                        ${data}
                    </div>
                    <div class="d-sm-none" style="margin-left: 5px">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                            <path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/>
                        </svg>
                    </div>
                </div>` },
                { data: "created_at", name: "created_at" },
                { data: "invoice", name: "invoice" },
                { data: "user.company_name", name: "user.company_name" },
                { data: "invoice_status", name: "invoice_status", searchable: true, render: (data, type, row) => `<a href="invoice/change-invoice-status/${row.invoice}" id="editBtn" class="badge bg-primary text-capitalize"
                >${data}</a>` },
                { data: "vat_status", name: "vat_status", searchable: true, render: (data, type, row) => `<a href="invoice/change-vat-status/${row.invoice}" id="editBtn" class="badge bg-primary text-capitalize"
                >${data}</a>` },
                { data: "" },
            ],
            columnDefs: [
                {
                    // Actions
                    targets: -1,
                    title: "Actions",
                    orderable: false,
                    render: function (data, type, row) {
                        return `<div class="dropdown">
                            <button class="btn btn-dark dropdown-toggle type="button" id="dropdownMenuButton_${row.id}" data-bs-toggle="dropdown" aria-expanded="false">
                            Actions
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton_${row.id}" style="width: 160px">
                            <li class="d-none d-sm-block">${datatableButtons([{ url: route('admin.invoice.show', row.id), type: 'show', id: false, permission: 'show_invoice', text: 'Show Invoice'}])}</li>
                            <li>${datatableButtons([{ url: route('admin.invoice.edit', row.id), type: 'invoice', id: true, permission: 'edit_invoice', text: 'Send Invoice'}])}</li>
                            <li>${datatableButtons([{ url: route('admin.invoice.download', row.id), type: 'download', id: false, permission: 'show_invoice', text: 'Download Invoice'}])}</li>
                            </ul>
                        </div>`
                    },
                },
            ],
            buttons: [
                {
                    extend: "collection",
                    attr: {id: 'invoice_export_button'},
                    className: `btn btn-outline-secondary dropdown-toggle me-2 ${hasPermission('export_invoice') == true ? '' : 'd-none'}`,
                    text:
                        feather.icons["external-link"].toSvg({
                            class: "font-small-4 me-50",
                        }) + "Export",
                    buttons: [
                        {
                            extend: "print",
                            text:
                                feather.icons["printer"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Print",
                            className: "dropdown-item",
                        },
                        {
                            extend: "csv",
                            text:
                                feather.icons["file-text"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Csv",
                            className: "dropdown-item",
                        },
                        {
                            extend: "excel",
                            text:
                                feather.icons["file"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Excel",
                            className: "dropdown-item",
                        },
                        {
                            extend: "pdf",
                            text:
                                feather.icons["clipboard"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Pdf",
                            className: "dropdown-item",
                        },
                        {
                            extend: "copy",
                            text:
                                feather.icons["copy"].toSvg({
                                    class: "font-small-4 me-50",
                                }) + "Copy",
                            className: "dropdown-item",
                        },
                    ],
                    init: function (api, node, config) {
                        $(node).removeClass("btn-secondary");
                        $(node).parent().removeClass("btn-group");
                        setTimeout(function () {
                            $(node)
                                .closest(".dt-buttons")
                                .removeClass("btn-group")
                                .addClass("d-inline-flex mt-50");
                        }, 50);
                    },
                }
            ],
        };
        dataTableInitilize(options)

        $(document).on('change', '#invoiceType', function(e){
            table.ajax.reload();
        })

        $(document).on('change', '#vatType', function(e){
            table.ajax.reload();
        })
    }

});


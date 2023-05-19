{{-- ====A+P+P+K+E+Y==== --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@lang('default.app_name')</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('admin/vendors/iconfonts/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendor.bundle.addons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/lightcase.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/css/datepicker.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.css">
    <link rel="stylesheet" href="{{ asset('izitoast/css/iziToast.min.css') }}">

    {{-- Datatable Group --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.0/css/all.min.css">

    <style>
        @font-face {
            font-family: "HiraKakuPro";
            src: url("{{ asset('font/HiraKakuPro-W3.ttf') }}") format("truetype");
        }

        @import url('https://fonts.googleapis.com/css2?family=Gothic+A1:wght@500&family=Nanum+Gothic&display=swap');
        @import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap');

        #map-tracking {
            height: 250px;
            border-radius: 5px;
        }

        #map-user {
            height: 250px;
            border-radius: 5px;
        }

        #map-destination {
            height: 250px;
            border-radius: 5px;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/style-custom.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" />

    @stack('css')
</head>

<body class="sidebar-fixed" class="app" style="font-family:HiraKakuPro;">
    <div class="container-scroller">

        @include('layouts.navbar')


        <div class="container-fluid page-body-wrapper">

            @include('layouts.sidebar')

            <div class="main-panel">
                <div class="content-wrapper" id="app">
                    @yield('content')
                </div>
            </div>

        </div>

        <span style="float: right; padding-right: 60px; padding-top: 10px; padding-bottom: 10px">Version 22041802</span>
    </div>

    <!-- build:js -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="{{ asset('admin/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('admin/js/lightcase.js') }}"></script>

    {{-- Datatable group --}}
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    {{-- End Datatable group --}}

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.25.0/axios.min.js"
        integrity="sha512-/Q6t3CASm04EliI1QyIDAA/nDo9R8FQ/BULoUFyN4n/BDdyIxeH7u++Z+eobdmr11gG5D/6nPFyDlnisDwhpYA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js"></script>

    <!-- build:js -->
    <script src="{{ asset('admin/js/dropify.js') }}"></script>
    <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin/js/off-canvas.js') }}"></script>
    <script src="{{ asset('admin/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('admin/js/template.js') }}"></script>
    <script src="{{ asset('admin/js/settings.js') }}"></script>
    <script src="{{ asset('admin/js/bootbox.all.min.js') }}"></script>
    <script src="{{ asset('admin/js/jpaginate.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.js"></script>
    <script src="{{ asset('izitoast/js/iziToast.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/datepicker.min.js"></script>
    <script src="{{ asset('admin/js/air-datepicker-lang.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/i18n/datepicker.en.js"></script>

    <script>
        function numberFormat(nStr) {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }

        var mixin = {
            data: {
                data: [],
                form: [],
                loading: false,
                error: false
            },
            methods: {
                showEditForm() {
                    $('#content-edit').fadeIn();
                    $('#back').css('display', 'inline-block');
                },
                removeEditForm() {
                    $('#content-edit').fadeOut();
                    $('#back').css('display', 'none');
                },
                showTableAdmin() {
                    $('#create').css('display', 'inline-block');
                    $('#action').css('display', 'inline-block');
                    $('#content-table').fadeIn();
                    this.removeBtnImageModal();
                },
                removeTableAdmin() {
                    $('#create').css('display', 'none');
                    $('#action').css('display', 'none');
                    $('#content-table').fadeOut();
                },
                showCreateForm() {
                    this.data = []
                    $('#back').css('display', 'inline-block');
                    $('#content-create').fadeIn();
                    $('#content-create').find('input,select,textarea').val("");

                    // REMOVE DROPIFY
                    if ($("#createDropify").length >= 1) { // CHECK IF THIS ID AVAILABLE IN PAGE
                        let dpf = $('.dropify#createDropify').dropify({
                            messages: {
                                'default': "@lang('default.alert.dropify.default')",
                                'replace': "@lang('default.alert.dropify.replace')",
                                'remove': "@lang('default.alert.dropify.remove')",
                                'error': "@lang('default.alert.dropify.error')"
                            },
                            error: {
                                'fileSize': "@lang('default.alert.dropify.fileSize')",
                                'minWidth': "@lang('default.alert.dropify.minWidth')",
                                'maxWidth': "@lang('default.alert.dropify.maxWidth')",
                                'minHeight': "@lang('default.alert.dropify.minHeight')",
                                'maxHeight': "@lang('default.alert.dropify.maxHeight')",
                                'imageFormat': "@lang('default.alert.dropify.imageFormat')",
                                'fileExtension': "@lang('default.alert.dropify.fileExtension')"
                            } // 'imageFormat': 'The image format is not allowed ({{ 2 }} only).'
                        });
                        dpf = dpf.data('dropify');
                        dpf.settings.defaultFile = '';
                        dpf.resetPreview();
                        dpf.clearElement();
                        dpf.destroy();
                        dpf.init();
                    }
                },
                removeCreateForm() {
                    $('#back').css('display', 'none');
                    $('#content-create').fadeOut();
                    $('#content-create').find('input,select,textarea').val("");

                    // SET CHECK TO FALSE
                    $(':input[type="checkbox"]').prop("checked", false);
                },
                showBtnImageModal() {
                    $('#image-management-modal').css('display', 'inline-block');
                },
                removeBtnImageModal() {
                    let imageModalCondition = $('#imageModalCondition').val()

                    if (imageModalCondition) {
                        $('#image-management-modal').css('display', 'none');
                    }
                },
                successCloseForm() {
                    this.removeCreateForm();
                    this.removeEditForm();
                    this.showTableAdmin();
                    this.removeBtnImageModal();

                    // SET TINY MCE TO ""
                    tinymce.activeEditor.setContent('');
                },
                showSuccessNotif(msg) {
                    iziToast.success({
                        title: "@lang('default.alert.success_text')",
                        message: msg,
                        position: 'topRight',
                    });
                },
                showDangerNotif(msg) {
                    iziToast.error({
                        title: "@lang('default.alert.failed_text')",
                        message: msg,
                        position: 'topRight',
                    });
                },
                fetchData(url) {
                    let self = this

                    axios.get(url + '/edit')
                        .then(function(response) {
                            self.data = response.data
                            self.removeTableAdmin();
                            self.removeCreateForm();
                            self.showEditForm();
                        })
                        .catch(function(error) {
                            self.showDangerNotif(error)
                        });
                },
                deleteData(url) {
                    let self = this

                    axios.post(url, {
                            _token: "{{ csrf_token() }}",
                            _method: "DELETE"
                        })
                        .then(function(response) {
                            if (response.data.error == true) {
                                self.showDangerNotif(response.data.message)
                            } else {
                                self.loadDatatable()
                                $("#datatable-detail").DataTable().ajax.reload()
                                self.showSuccessNotif(response.data.message)
                            }
                        })
                        .catch(function(error) {
                            self.showDangerNotif(error)
                        });
                },
                postData(url, object) {
                    let self = this

                    self.loading = true

                    axios.post(url, object)
                        .then(function(response) {
                            self.loading = false
                            if (response.data.error == true) {
                                self.showDangerNotif(response.data.message)
                            } else {
                                self.removeCreateForm()
                                self.removeEditForm()
                                self.showTableAdmin()
                                self.loadDatatable()
                                self.showSuccessNotif(response.data.message)
                            }
                        })
                        .catch(function(error) {
                            self.loading = false
                            self.showDangerNotif(error)
                        })
                },
                postDataMultipart(url, formData) {
                    let self = this

                    self.loading = true

                    axios.post(url,
                            formData, {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            })
                        .then(function(response) {
                            if (response.data.error == true) {
                                self.loading = false
                                self.showDangerNotif(response.data.message)
                            } else {
                                self.loading = false
                                self.removeCreateForm()
                                self.removeEditForm()
                                self.showTableAdmin()
                                self.loadDatatable()
                                self.showSuccessNotif(response.data.message)
                                $(".dropify-clear").trigger("click")
                            }
                        })
                        .catch(function(error) {
                            self.loading = false
                            self.showDangerNotif(error.message)
                        });
                },
                loadDatatable() {
                    $('#datatable').DataTable().ajax.reload()
                },
                initDropify(file) {
                    var drEvent = $('#editDropify').dropify({
                        messages: {
                            'default': "@lang('default.alert.dropify.default')",
                            'replace': "@lang('default.alert.dropify.replace')",
                            'remove': "@lang('default.alert.dropify.remove')",
                            'error': "@lang('default.alert.dropify.error')"
                        },
                        error: {
                            'fileSize': "@lang('default.alert.dropify.fileSize')",
                            'minWidth': "@lang('default.alert.dropify.minWidth')",
                            'maxWidth': "@lang('default.alert.dropify.maxWidth')",
                            'minHeight': "@lang('default.alert.dropify.minHeight')",
                            'maxHeight': "@lang('default.alert.dropify.maxHeight')",
                            'imageFormat': "@lang('default.alert.dropify.imageFormat')",
                            'fileExtension': "@lang('default.alert.dropify.fileExtension')"
                        } // 'imageFormat': 'The image format is not allowed ({{ 2 }} only).'
                    });
                    drEvent = drEvent.data('dropify');
                    drEvent.resetPreview();
                    drEvent.clearElement();
                    drEvent.settings.defaultFile = file;
                    drEvent.destroy();
                    drEvent.init();

                    // Init listener delete image
                    $('.dropify-clear').on('click', () => {
                        this.data.image = "";
                    })
                },
                convertToDate(date) {
                    let
                        year = date.substr(0, 4),
                        month = date.substr(5, 2),
                        day = date.substr(8, 2)

                    return year + '-' + month + '-' + day
                },
                convertToJapanDate(date) {
                    let dateSplit = date.split('-')
                    console.log({
                        dateSplit,
                        date
                    });

                    let dateJapan = dateSplit[0] + '日' + dateSplit[1] + '月' + dateSplit[2] + '年'
                    return dateJapan;
                },
                resetData() {
                    Object.assign(this.$data, this.$options.data());
                },
                multiDelete() {
                    let $table = $('#datatable'),
                        $selectAll = $('input[name="select-all"]'),
                        $actionBtn = $('.btn-table-action'),
                        self = this

                    $selectAll.on('click', function(e) {
                        let checked = $(this).prop('checked')

                        $table
                            .find('input[name="selection"]')
                            .prop('checked', checked)
                            .trigger('change')
                    })

                    $table.on('click', 'tbody tr', function(e) {
                        let input = $(this).find('input[name="selection"]'),
                            checked = input.prop('checked')

                        input
                            .prop('checked', !checked)
                            .trigger('change')
                    })

                    $table.on('change', 'input[name="selection"]', () => {
                        let inputs = $table.find('input[name="selection"]:checked')

                        $actionBtn.prop('disabled', (inputs.length == 0))
                    })

                    $table.on('preXhr.dt', function(e) {
                        $selectAll.prop('checked', false)
                        $actionBtn.prop('disabled', true)
                    })

                    $actionBtn.on('click', function(e) {
                        let url = $(this).data('url'),
                            message = "@lang('default.alert.confirmation.delete')",
                            inputs = $table.find('input[name="selection"]:checked'),
                            ids = [],
                            confirmation = confirm(message)

                        $.each(inputs, (i, item) => {
                            ids.push(item.value)
                        })

                        if (confirmation) {
                            $actionBtn.prop('disabled', true)
                            self.loading = true
                            $.ajax({
                                url: url,
                                method: 'POST',
                                data: {
                                    ids
                                },
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                                success: function(response) {
                                    self.showSuccessNotif(response.message)
                                    self.loading = false
                                },
                                error: function(data) {
                                    self.showDangerNotif(data.message)
                                    self.loading = false
                                }
                            }).always(() => {
                                $table.DataTable().ajax.reload()
                            })
                        }
                    })
                },
                validationMessage() {
                    document.addEventListener("DOMContentLoaded", function() {
                        var elements = document.getElementsByTagName("INPUT");
                        var select = document.getElementsByTagName("SELECT");
                        var textarea = document.getElementsByTagName("TEXTAREA");
                        for (var i = 0; i < elements.length; i++) {
                            elements[i].oninvalid = function(e) {
                                e.target.setCustomValidity("");
                                if (!e.target.validity.valid) {
                                    e.target.setCustomValidity("@lang('default.validation.required')");
                                }
                            };
                            elements[i].oninput = function(e) {
                                e.target.setCustomValidity("");
                            };
                        }
                        for (var i = 0; i < select.length; i++) {
                            select[i].oninvalid = function(e) {
                                e.target.setCustomValidity("");
                                if (!e.target.validity.valid) {
                                    e.target.setCustomValidity("@lang('default.validation.required')");
                                }
                            };
                            select[i].oninput = function(e) {
                                e.target.setCustomValidity("");
                            };
                        }
                        for (var i = 0; i < textarea.length; i++) {
                            textarea[i].oninvalid = function(e) {
                                e.target.setCustomValidity("");
                                if (!e.target.validity.valid) {
                                    e.target.setCustomValidity("@lang('default.validation.required')");
                                }
                            };
                            textarea[i].oninput = function(e) {
                                e.target.setCustomValidity("");
                            };
                        }
                    })
                },
                globalConfig() {
                    $('img').attr('alt', 'Image Not Found')


                    // GLOABLY REMOVE AUTOCOMPLETE
                    $('form').attr("autocomplete", "off")

                    // VALIDATE INPUT NUMBER
                    $(':input[type="number"]').keyup(function() {
                        this.value = this.value.replace(/[^0-9.]/g, '')
                        this.value = this.value.replace(/(\..*)\./g, '$1')
                    });

                    /**
                     * Lightcase init
                     */
                    //Datatable Init
                    $('#datatable').on('draw.dt', function() {
                        $('a[data-rel^=lightcase]').lightcase({
                            showCaption: false
                        });

                        // SET GLOBALY
                        $('img').attr('alt', 'Image Not Found')
                        $('.form-check').parent().css('padding', '10px')

                        $('.dt-buttons button').addClass('btn btn-primary')
                    });
                    //Global init
                    $('a[data-rel^=lightcase]').lightcase({
                        showCaption: false
                    });

                    // init pagination on image management
                    $('#tableManageImage').paginate({
                        limit: 5,
                        display: 5,
                        initialPage: 1,
                        first: false,
                        last: false
                    });
                },
                initDatepicker() {
                    // DATEPICKER GLOBAL
                    var clickedDate;
                    $('.datepicker-custom').click(function() {
                        // GET SELECTED DATE
                        clickedDate = $(this)
                    })

                    $('.datepicker-custom').datepicker({
                        language: '{{ Lang::locale() }}',
                        onSelect: function(fd, d, picker) {
                            if ('{{ Lang::locale() }}' == 'jp') {
                                let date = fd.split('/')
                                let dateJapan = date[2] + '年' + date[1] + '月' + date[0] + '日'
                                clickedDate.val(dateJapan)

                            } else {
                                let date = fd.split('/')
                                let dateFormat = date[2] + '-' + date[1] + '-' + date[0]

                                clickedDate.val(dateFormat)
                            }
                        }
                    })
                }
            },
            mounted() {
                var self = this,
                    $self = $(this.$el)

                //Form action
                var create = $('#create')
                var back = $('#back')
                var edit = $('.edit-action')

                //Global configuration
                self.globalConfig()

                //Initial datepicker
                self.initDatepicker()

                create.click(function() {
                    self.removeTableAdmin()
                    self.showBtnImageModal()
                    self.showCreateForm()
                    self.initDropify('')
                    $('textarea').html('')
                });

                back.click(function() {
                    self.removeCreateForm()
                    self.removeEditForm()
                    self.showTableAdmin()
                    self.removeBtnImageModal()

                    // SET TINY MCE TO ""
                    tinymce.activeEditor.setContent('')

                    // SET CHECK TO FALSE
                    $(':input[type="checkbox"]').prop("checked", false)

                });

                /**
                 * Delete action button handler
                 */
                $(document).on('click', '.delete-action', function(e) {
                    e.preventDefault();
                    var url = $(this).data('url');

                    bootbox.confirm({
                        message: "@lang('default.alert.confirmation.delete')",
                        className: 'font-weight-bold font-modal',
                        buttons: {
                            confirm: {
                                label: "@lang('default.text.yes')",
                                className: 'font-weight-bold btn-modal-yes font-modal'
                            },
                            cancel: {
                                label: "@lang('default.text.no')",
                                className: 'font-weight-bold btn-modal-no new-text-blue-color font-modal mr-modal-no'
                            }
                        },
                        callback: function(result) {
                            if (result == true) {
                                self.deleteData(url)
                            }
                        }
                    });
                });

                /**
                 * Edit button handler
                 */
                $(document).on('click', '.edit-action', function(e) {
                    e.preventDefault();
                    var url = $(this).data('url');

                    self.showBtnImageModal()

                    self.fetchData(url)
                });

                //Initial multi delete method
                self.multiDelete()

                //Initial validation form message multilangual
                self.validationMessage()

            }
        }
    </script>

    @stack('js')
</body>

</html>

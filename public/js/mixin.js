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
            if($("#createDropify").length >= 1){ // CHECK IF THIS ID AVAILABLE IN PAGE
                let dpf = $('.dropify#createDropify').dropify();
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
        showBtnImageModal(){
            $('#image-management-modal').css('display', 'inline-block');
        },
        removeBtnImageModal(){
            let imageModalCondition = $('#imageModalCondition').val()

            if(imageModalCondition){
                $('#image-management-modal').css('display', 'none');
            }
        },
        successCloseForm(){
            this.removeCreateForm();
            this.removeEditForm();
            this.showTableAdmin();
            this.removeBtnImageModal();

            // SET TINY MCE TO ""
            tinymce.activeEditor.setContent('');
        },
        showSuccessNotif(msg) {
            // NOTIFY
            var notifySetting = {
            type: 'success',
            timer: 1000,
            placement: {
                from: "top",
                align: "right"
            },
            }

            $.notify({	message: msg },{
            ...notifySetting
            });
        },
        showDangerNotif(msg) {
            // NOTIFY
            var notifySetting = {
                type: 'danger',
                timer: 1000,
                placement: {
                    from: "top",
                    align: "right"
                },
            }

            $.notify({	message: msg },{
            ...notifySetting
            });
        },
        fetchData(url){
            let self = this

            axios.get(url+'/edit')
            .then(function (response) {
                self.data = response.data
                self.removeTableAdmin();
                self.removeCreateForm();
                self.showEditForm();
            })
            .catch(function (error) {
                self.showDangerNotif(error)
            });
        },
        deleteData(url){
            let self = this

            axios.post(url, {
                _token: "{{csrf_token()}}",
                _method: "DELETE"
            })
            .then(function (response) {
                if(response.data.error == true){
                    self.showDangerNotif(response.data.message)
                } else {
                    self.loadDatatable()
                    $("#datatable-detail").DataTable().ajax.reload()
                    self.showSuccessNotif(response.data.message)
                }
            })
            .catch(function (error) {
                self.showDangerNotif(error)
            });
        },
        postData(url, object){
            let self = this

            self.loading = true

            axios.post(url, object)
                .then(function (response) {
                    self.loading = false
                    if(response.data.error == true){
                        self.showDangerNotif(response.data.message)
                    } else {
                        self.removeCreateForm()
                        self.removeEditForm()
                        self.showTableAdmin()
                        self.loadDatatable()
                        self.showSuccessNotif(response.data.message)
                    }
                })
                .catch(function (error) {
                    self.loading = false
                    self.showDangerNotif(error)
                })
        },
        loadDatatable(){
            $('#datatable').DataTable().ajax.reload()
        },
        initDropify(file){
            var drEvent = $('#editDropify').dropify();
            drEvent = drEvent.data('dropify');
            drEvent.resetPreview();
            drEvent.clearElement();
            drEvent.settings.defaultFile = file;
            drEvent.destroy();
            drEvent.init();

            $('.dropify#createDropify').dropify({
              defaultFile: file,
              messages: {
                    'default': "@lang('default.alert.dropify.default')",
                    'replace': "@lang('default.alert.dropify.replace')",
                    'remove':  "@lang('default.alert.dropify.remove')",
                    'error':   "@lang('default.alert.dropify.error')"
                },
                error: {
                    'fileSize': "@lang('default.alert.dropify.fileSize')",
                    'minWidth': "@lang('default.alert.dropify.minWidth')",
                    'maxWidth': "@lang('default.alert.dropify.maxWidth')",
                    'minHeight': "@lang('default.alert.dropify.minHeight')",
                    'maxHeight': "@lang('default.alert.dropify.maxHeight')",
                    'imageFormat': "@lang('default.alert.dropify.imageFormat')",
                    'fileExtension': "@lang('default.alert.dropify.fileExtension')"
                }
            });

            $('.dropify#editDropify').dropify({
                defaultFile: file,
                messages: {
                    'default': "@lang('default.alert.dropify.default')",
                    'replace': "@lang('default.alert.dropify.replace')",
                    'remove':  "@lang('default.alert.dropify.remove')",
                    'error':   "@lang('default.alert.dropify.error')"
                },
                error: {
                    'fileSize': "@lang('default.alert.dropify.fileSize')",
                    'minWidth': "@lang('default.alert.dropify.minWidth')",
                    'maxWidth': "@lang('default.alert.dropify.maxWidth')",
                    'minHeight': "@lang('default.alert.dropify.minHeight')",
                    'maxHeight': "@lang('default.alert.dropify.maxHeight')",
                    'imageFormat': "@lang('default.alert.dropify.imageFormat')",
                    'fileExtension': "@lang('default.alert.dropify.fileExtension')"
                }
            });

        },
        convertToDate(date){
            let
                year = date.substr(0, 4),
                month = date.substr(5, 2),
                day = date.substr(8,2)

            return year+'-'+month+'-'+day
        },
        convertToJapanDate(date){
                let dateSplit = date.split('-')
                console.log({dateSplit,date});

                let dateJapan = dateSplit[0]+'日'+dateSplit[1]+'月'+dateSplit[2]+'年'
                return dateJapan;
        },
        resetData(){
            Object.assign(this.$data, this.$options.data());
        },
        multiDelete(){
            let $table = $('#datatable'),
                $selectAll = $('input[name="select-all"]'),
                $actionBtn = $('.btn-table-action'),
                self = this

            $selectAll.on('click', function (e) {
                let checked = $(this).prop('checked')

                $table
                    .find('input[name="selection"]')
                    .prop('checked', checked)
                    .trigger('change')
            })

            $table.on('click', 'tbody tr', function (e) {
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

            $table.on('preXhr.dt', function (e) {
                $selectAll.prop('checked', false)
                $actionBtn.prop('disabled', true)
            })

            $actionBtn.on('click', function (e) {
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
                        data: { ids },
                        headers: {
                            'X-CSRF-TOKEN': "{{csrf_token()}}"
                        },
                        success: function(response){
                            self.showSuccessNotif(response.message)
                            self.loading = false
                        },
                        error: function(data){
                            self.showDangerNotif(data.message)
                            self.loading = false
                        }
                    }).always(() => {
                        $table.DataTable().ajax.reload()
                    })
                }
            })

        },
        validationMessage(){
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
        globalConfig(){
            $('img').attr('alt', 'Image Not Found')

            // GLOABLY REMOVE AUTOCOMPLETE
            $('form').attr("autocomplete", "off")

            // VALIDATE INPUT NUMBER
            $(':input[type="number"]').keyup(function () {
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
        initDatepicker(){
            // DATEPICKER GLOBAL
            var clickedDate;
            $('.datepicker-custom').click(function () {
                // GET SELECTED DATE
                clickedDate = $(this)
            })

            $('.datepicker-custom').datepicker({
                language: '{{Lang::locale()}}',
                onSelect: function (fd, d, picker) {
                    if('{{Lang::locale()}}'=='jp'){
                        let date = fd.split('/')
                        let dateJapan = date[2]+'年'+date[1]+'月'+date[0]+'日'
                        clickedDate.val(dateJapan)

                    }else{
                        let date = fd.split('/')
                        let dateFormat = date[2]+'-'+date[1]+'-'+date[0]

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

        create.click(function () {
            self.removeTableAdmin()
            self.showBtnImageModal()
            self.showCreateForm()
            self.initDropify('')
            $('textarea').html('')
        });

        back.click(function () {
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
                buttons: {
                    confirm: {
                        label: "@lang('default.text.yes')",
                        className: 'btn-success'
                    },
                    cancel: {
                        label: "@lang('default.text.no')",
                        className: 'btn-danger'
                    }
                },
                callback: function (result) {
                    if(result == true){
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

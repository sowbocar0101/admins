    var create = $('#create');
    var back = $('#back');
    var edit = $('.edit-action');

    var contentTable  = $('#content-table');
    var contentCreate = $('#content-create');
    var contentEdit   = $('#content-edit');

    create.click(function () {
        removeTableAdmin();
        showCreateForm();
    });

    back.click(function () {
        removeCreateForm();
        removeEditForm();
        showTableAdmin();
    });

    edit.click(function () {
        removeTableAdmin();
        removeCreateForm();
        showEditForm();
    });

    var showEditForm = function() {
        contentEdit.fadeIn();
        back.css('display', 'inline-block');
    }

    var removeEditForm = function () {
        contentEdit.fadeOut();
        back.css('display', 'none');
    }

    var showTableAdmin = function () {
        create.css('display', 'inline-block');
        contentTable.fadeIn();
    }

    var removeTableAdmin = function () {
        create.css('display', 'none');
        contentTable.fadeOut();
    }

    var showCreateForm = function () {
        back.css('display', 'inline-block');
        contentCreate.fadeIn();
        contentCreate.find('input,select,textarea').val("");
    }

    var removeCreateForm = function () {
        back.css('display', 'none');
        contentCreate.fadeOut();
        contentCreate.find('input,select,textarea').val("");
    } 
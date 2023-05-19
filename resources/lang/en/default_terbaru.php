<?php
// ====A+P+P+K+E+Y====
    return [
        'app_name' => 'TAXI APP',
        'login'=>[
            'welcome' => 'Log in to start',
            'info' => 'Please enter your email and password',
            'buttonlogin' => 'Log in'
        ],
        'sidenav'=>[
            'dashboard' => 'Dashboard',
            'admin' => 'Admin',
            'data_order' => 'Order',
            'driver' => 'Driver',
            'driver-tracking' => 'Driver tracking',
            'user' => 'User',
            'price-setting'  => 'Price setting',
            'about-us' => 'About Us'
        ],
        'text'=>[
            'edit_data' => 'Edit',
            'detail' => 'Detail',
            'add_data' => 'Add data',
            'yes' => 'Yes',
            'no' => 'Cancel',
            'note' => 'Note',
            'note-title' => 'You can enter up to 16 characters in the title. （However, please note that it may be displayed up to 10 characters when the smartphone monitor screen is small).',
            'note-sub-title' => 'You can enter up to 20 characters in the subtitle.(However, please note that it may be displayed up to 12 characters when the smartphone monitor screen is small).',
            'note-description' => 'You can enter up to 24 characters in the summary. （However, please note that if the smartphone monitor screen is small, it may display up to 18 characters or less).',
            'super-admin' => 'Super admin',
            'seller-admin' => 'Seller admin',
            'config' => 'Setting or configuration',
            'logout' => 'out ->Log out',
            'edit-profile' => 'Edit admin information',
            'show' => 'Show',
            'not-show' => 'Not show',
            'accept' => 'Accept',
            'not-accept' => 'Not accept',
            'required-form' => '<small class="text-danger">* </small> Field is required',
            'valid' => 'Valid',
            'expired' => 'Expired',
            'close' => 'Close',
            'select' => 'Select one item '
        ],
        // DEFAULT
        'action'=>[
            'create' => 'Create',
            'edit' => 'Edit',
            'delete' => 'Delete',
            'delete-all' => 'Delete all',
            'reset' => 'Reset',
            'back'  => 'Back',
            'save'  => 'Save',
            'image_max' => '*Images size can be up to 1 MB. You can post Jpeg, Jpg, Png and Gif images.
    *Insert new image and delete old image',
            'acc-and-publish' => 'Update',
            'detail' => 'Detail',
            'acc' => 'Approve',
            'reject' => 'Not approve',
            'choose_user' => 'Select user',
            'information_to_post' => 'Information to post',
            'announce' => 'Post',
            'all' => 'All',
            'copy' => 'Copy',
            'export' => [
                'copy' => 'Copy',
                'csv' => 'CSV',
                'excel' => 'Excel',
                'pdf' => 'PDF',
                'print' => 'Print',
            ]
        ],
        // USED FOR ALL TABLE
        'table'=>[
            'no' => 'No',
            'username' => 'Username',
            'email' => 'Email',
            'position' => 'Position',
            'active' => 'Active',
            'not-active' => 'Inactive',
            'date' => 'Date',
            'image' => 'Image',
            'url' => 'URL',
            'action' => 'Action',
            'password' => 'Password',
            'confirm_password' => 'Confirm Password',
            'old_password' => 'Old Password',
            'new_password' => 'New password',
            'title' => 'Title',
            'price' => 'Additional price',
            'description' => 'Description',
            'name' => 'Name',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'status' => 'Status',
            'birth_date' => 'Birth date',
            'join_date' => 'Join date',
            'destination' => 'Destination',
            'address' => 'Address',
            'pos_code' => 'Post code',
            'phone' => 'Telephone',
            'start_date' => 'Start date',
            'end_date' => 'End date',
            'created_date' => 'Create date',
            'message' => 'Message',
            'terms' => 'Clause',
            'pickup' => 'Pick up',
            'destination' => 'Destination',
            'full_name' => 'Full name',
            'driver_name' => 'Driver name',
            'distance' => 'Distance',
            'price_total' => 'Total fee',
            'order_time' => 'Order time',
            'plate_number' => 'Car License',
            'car_category' => 'Car categori',
            'car_model' => 'Car Model',
            'min-km' => 'Minimum distance（M）',
            'min-price' => 'Minimum price',
            'km' => 'Additional distance (M)',
            'seat' => 'Seat',
        ],
        //Validation
        'validation' => [
            'required' => 'Required',
            'required-description' => 'Description Required ',
            'required-image' => 'Image Required',
            'required-message' => 'Message Required',
            'required-content' => 'Content Required',
            'required-short_description' => 'Please enter a short description',
            'required-global' => 'The data entered is not complete. Please confirm your data once again',
            'length' => 'The text you entered is too long'
        ],
        'status' => [
            'driver_found' => 'Driver found',
            'onprogress' => 'On progress',
            'success' => 'Complete'
        ],
        // DASHBOARD PAGE
        'dashboard'=>[
            'title' => 'Dashboard',
            'info'=>[
                'driver' => 'Driver',
                'user' => 'User',
                'car_category' => 'Car category',
                'lates_order' => 'Latest order',
                'view_all_order' => 'View all order'
            ],
        ],
        // Alert PAGE
        'alert'=>[
            'success_text' => 'Success',
            'failed_text' => 'Failed',
            'success'=>[
                'create' => 'Update Data',
                'update' => 'Update Data',
                'delete' => 'Delete Data'
            ],
            'failed'=>[
                'create' => "Can't create data",
                'update' => "Can't update data",
                'delete' => "Can't delete data",
                'password' => 'Please enter the password correctly',
                'old_password' => 'Old password is wrong',
                'fetch' => 'Data not found',
                'login' => 'Incorrect username or password',
                'data-usage' => 'The data is already used'
            ],
            'confirmation' => [
                'delete' => 'Are you sure you want to delete this data？'
            ],
            'password' => '* Blank the space if you do not want to change the password',
            'file' => [
                'image' => '* Images size can be up to 1 MB. You can post Jpeg, Jpg, Png and Gif images。
                * Insert new image and delete old image.'
            ],
            'dropify' => [
                //Before upload
                'default' => 'Drag and drop files here',
                'replace' => 'Drag and drop files here to replace',
                'remove' => 'Remove',
                'error' => 'An error occurred',
                //After upload
                'fileSize' => 'File size too large (maximum {{ value }}).',
                'minWidth' => 'The image width is too small (minimum {{ value }}}px).',
                'maxWidth' => 'The image width is too large (maximum {{ value }}}px).',
                'minHeight' => 'The image height is too small (minimum {{ value }}}px).',
                'maxHeight' => 'The image height is too large (maximum {{ value }}px).',
                'imageFormat' => 'The image format is incorrect ({{ value }}only).',
                'fileExtension' => 'The file format is incorrect({{ value }}only).'
            ]
        ],

        // RE-DESIGN
        'new' => [
            'search' => 'Search',
            'status' => 'Status',
            'logout' => 'Log out',
            'save' => 'Save',
            'image' => 'Image',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'phone' => 'Phone number',
            'active' => 'Active',
            'inactive' => 'Inactive',
            'price' => 'Price',
            'profile' => [
                'edit' => 'Edit account',
            ],
            'button' => [
                'detail' => 'Detail',
                'edit' => 'Edit',
                'delete' => 'Delete',
            ],
            'login' => [
                'title' => 'TAXI APP',
            ],
            'table' => [
                'user-location' => 'User location',
                'destination' => 'Destination',
                'date-time' => 'Date time',
            ],
            'dashboard' => [
                'title' => 'Dashboard',
                'latest-order' => 'Latest order',
                'view-all' => 'View all',
            ],
            'admin' => [
                'index' => 'Admin',
                'title-create' => 'Admin create',
                'sub-title-create' => 'Admin create',

                'title-edit' => 'Edit Admin',
                'sub-title-edit' => 'Edit Admin',

                'add' => 'Add admin ',
            ],
            'driver' => [
                'index' => 'Driver',
                'title-create' => 'Add Driver',
                'sub-title-create' => 'Add Driver',

                'title-edit' => 'Edit driver information',
                'sub-title-edit' => 'Edit driver information',

                'add' => 'Add driver',

                'back-number' => 'Back number',
                'car-type' => 'Car type',
                'car-model' => 'Car model',

                'tracking' => [
                    'title' => 'Track the driver',
                    'sub-title' => 'Track the driver',
                ]
            ],
            'user' => [
                'index' => 'User',
                'title-create' => 'Add user',
                'sub-title-create' => 'Add user',

                'title-edit' => 'Edit user',
                'sub-title-edit' => 'Edit user',

                'add' => 'Add user',
            ],
            'card' => [
                'driver' => 'Driver',
                'user' => 'User',
                'type-taxi' => 'Taxi type',
                'type-taxi-text' => 'Type',
            ],
            'order' => [
                'distance' => 'Distance',
                'total-fee' => 'Total fee',
                'date-time' => 'Order Time',

                'pending' => 'Pending',
                'driver_accept' => 'Received Driver',
                'departure' => 'Depart',
                'departure-confirmation' => 'Depart Confirmation',
                'arrival' => 'Arrived at destination',
                'complete' => 'Done',
                'cancel' => 'Canceled',

                'title-detail' => 'Order detail',
            ],
            'price-setting' => [
                'index' => 'Price setting',
                'title-create' => 'Add price',
                'sub-title-create' => 'Add price',

                'title-edit' => 'Edit price',
                'sub-title-edit' => 'Edit price',

                'add' => 'Add price',
            ],
            'about-us' => [
                'index' => 'About Us',

                'title-edit' => 'Edit About Us',
                'sub-title-edit' => 'Edit About Us',
            ],
            'setting' => [
                'index' => 'Setting',
                'min-price-discount' => 'Minimum discount price',
                'discount' => 'Discount',
                'late-night-extra-price' => 'Late night extra price'
            ]
        ],
    ];

<?php
// ====A+P+P+K+E+Y====
    return [
        'app_name' => 'Motteko もってこ',
        'login'=>[
            'welcome' => 'Log in untuk memulai',
            'info' => 'Silahkan masukkan email dan password Anda',
            'buttonlogin' => 'Log in'
        ],
        'sidenav'=>[
            'dashboard' => 'Dashboard',
            'admin' => 'Admin',
            'data_order' => 'Order',
            'driver' => 'Driver',
            'driver-tracking' => 'Tracking driver',
            'user' => 'User',
            'price-setting'  => 'Pengaturan harga',
            'about-us' => 'Tentang Kami'
        ],
        'text'=>[
            'edit_data' => 'Edit',
            'detail' => 'Detail',
            'add_data' => 'Tambah data',
            'yes' => 'Ya',
            'no' => 'Batal',
            'note' => 'Catatan',
            'note-title' => 'Anda bisa memasukkan 16 karakter di judul. （Namun mohon dicatat, judul mungkin hanya bisa ditampilkan sampai 10 karakter pada smartphone dengan layar kecil).',
            'note-sub-title' => 'Anda bisa memasukkan 20 karakter di bagian subtitle.(Namun mohon dicatat, sub judul mungkin hanya bisa ditampilkan sampai 20 karakter pada smartphone dengan layar kecil).',
            'note-description' => 'Anda bisa memasukkan 24 karakter di bagian deskripsi. （Namun mohon dicatat, deskripsi mungkin hanya bisa ditampilkan sampai 18 karakter pada smartphone dengan layar kecil).',
            'super-admin' => 'Super admin',
            'seller-admin' => 'Admin penjual',
            'config' => 'Pengaturan dan konfigurasi',
            'logout' => 'Keluar',
            'edit-profile' => 'Edit Informasi Admin',
            'show' => 'Tampilan',
            'not-show' => 'Tidak ada tampilan',
            'accept' => 'Diterima',
            'not-accept' => 'Tidak diterima',
            'required-form' => '<small class="text-danger">* </small> File diperlukan',
            'valid' => 'Valid',
            'expired' => 'Kadaluwarsa',
            'close' => 'Tutup',
            'select' => 'Pilih satu item'
        ],
        // DEFAULT
        'action'=>[
            'create' => 'Tambah',
            'edit' => 'Edit',
            'delete' => 'Hapus',
            'delete-all' => 'Hapus Semua',
            'reset' => 'Reset',
            'back'  => 'Kembali',
            'save'  => 'Simpan',
            'image_max' => '*Ukuran gambar maksimal 1MB. Anda bisa post gambar dalam bentuk JPEG, JPG, PNG dan Gift.
    *Tambahkan gambar baru dan hapus gambar lama',
            'acc-and-publish' => 'Update',
            'detail' => 'Detail',
            'acc' => 'Persetujuan',
            'reject' => 'Tidak disetujui',
            'choose_user' => 'Pilih 1 user',
            'information_to_post' => 'Informasi',
            'announce' => 'Post',
            'all' => 'Semua',
            'copy' => 'Salin',
            'export' => [
                'copy' => 'Salin',
                'csv' => 'CSV',
                'excel' => 'Excel',
                'pdf' => 'PDF',
                'print' => 'Print',
            ]
        ],
        // USED FOR ALL TABLE
        'table'=>[
            'no' => 'No',
            'username' => 'Nama pengguna',
            'email' => 'Email',
            'position' => 'Posisi',
            'active' => 'Aktif',
            'not-active' => 'Tidak aktif',
            'date' => 'Tanggal',
            'image' => 'Gambar',
            'url' => 'URL',
            'action' => 'Aksi',
            'password' => 'Password',
            'confirm_password' => 'konfirmasi Password',
            'old_password' => 'Password lama',
            'new_password' => 'Password baru',
            'title' => 'Judul',
            'price' => 'Harga tambahan',
            'description' => 'Deskripsi',
            'name' => 'Nama',
            'first_name' => 'Nama depan',
            'last_name' => 'Nama belakang',
            'status' => 'Status',
            'birth_date' => 'Tanggal lahir',
            'join_date' => 'Tanggal bergabung',
            'destination' => 'Tujuan',
            'address' => 'Alamat',
            'pos_code' => 'Kode Pos',
            'phone' => 'Nomor telepon',
            'start_date' => 'Tanggal mulai',
            'end_date' => 'Tanggal berakhir',
            'created_date' => 'Tanggal dibuat',
            'message' => 'Pesan',
            'terms' => 'Keperluan',
            'pickup' => 'Penjemputan',
            'destination' => 'Tujuan',
            'full_name' => 'Nama lengkap',
            'driver_name' => 'Nama diver',
            'distance' => 'Jarak',
            'price_total' => 'Total Upah',
            'order_time' => 'Waktu pesan',
            'plate_number' => 'Lisensi mobil',
            'car_category' => 'Categori mobil',
            'car_model' => 'Model mobil',
            'min-km' => 'Jarak minimal (M)',
            'min-price' => 'Harga minimal',
            'km' => 'Jarak tambahan (M)',
            'seat' => 'Kursi',
        ],
        //Validation
        'validation' => [
            'required' => 'Keperluan',
            'required-description' => 'Deskripsi diperlukan',
            'required-image' => 'Gambar diperlukan',
            'required-message' => 'Pesan perlu diisi',
            'required-content' => 'Content diperlukan',
            'required-short_description' => 'Mohon memasukkan deskripsi singkat',
            'required-global' => 'Data yang masukkan belum lengkap. Mohon periksa kembali',
            'length' => 'Teks yang Anda masukkan terlalu panjang'
        ],
        'status' => [
            'driver_found' => 'Menemukan driver',
            'onprogress' => 'Sedang diproses',
            'success' => 'Sukses'
        ],
        // DASHBOARD PAGE
        'dashboard'=>[
            'title' => 'Dashboard',
            'info'=>[
                'driver' => 'Driver',
                'user' => 'User',
                'car_category' => 'Kategori mobil',
                'lates_order' => 'Pesanan terbaru',
                'view_all_order' => 'Lihat semua order'
            ],
        ],
        // Alert PAGE
        'alert'=>[
            'success_text' => 'Sukses',
            'failed_text' => 'Gagal',
            'success'=>[
                'create' => 'Perbarui data',
                'update' => 'Perbarui data',
                'delete' => 'Hapus data'
            ],
            'failed'=>[
                'create' => 'Tidak bisa membuat data',
                'update' => 'Tidak bisa merubah data',
                'delete' => 'Tidak bisa hapus data',
                'password' => 'Mohon masukkan password yang benar',
                'old_password' => 'Password lama salah',
                'fetch' => 'Data tidak ditemukan',
                'login' => 'Username atau password salah',
                'data-usage' => 'Data sudah digunakan'
            ],
            'confirmation' => [
                'delete' => 'Apakah Anda yakin ingin menghapus data ini?'
            ],
            'password' => '* Kosongkan jika Anda tidak ingin mengubah password',
            'file' => [
                'image' => '* Ukuran gambar maksimal 1MB. Anda bisa post Jpeg, Jpg, Png, dan Gif.
                * Tambahkan foto baru dan hapus foto lama.'
            ],
            'dropify' => [
                //Before upload
                'default' => 'Seret dan taruh file disini',
                'replace' => 'Seret dan taruh file disini untuk mengganti',
                'remove' => 'Menghapus',
                'error' => 'Terjadi kesalahan',
                //After upload
                'fileSize' => 'Ukuran file terlalu besar (maksimal {{ value }}).',
                'minWidth' => 'Lebar gambar terlalu kecil (minimal {{ value }}}px).',
                'maxWidth' => 'Lebar gambar terlalu besar(maksimal {{ value }}}px).',
                'minHeight' => 'Tinggi gambar terlalu kecil(minimal {{ value }}}px).',
                'maxHeight' => 'Tinggi gambar terlalu besar (maksimal {{ value }}px).',
                'imageFormat' => 'Format gambar salah({{ value }}saja).',
                'fileExtension' => 'File format salah({{ value }}saja).'
            ]
        ],

        // RE-DESIGN
        'new' => [
            'search' => 'Pencarian',
            'status' => 'Status',
            'logout' => 'Log out',
            'save' => 'Simpan',
            'image' => 'Gambar',
            'username' => 'Nama pengguna',
            'email' => 'Email',
            'password' => 'Password',
            'phone' => 'Nomor telepon',
            'active' => 'Aktif',
            'inactive' => 'Tidak aktif',
            'price' => 'Harga',
            'profile' => [
                'edit' => 'Edit akun',
            ],
            'button' => [
                'detail' => 'Detail',
                'edit' => 'Edit',
                'delete' => 'Hapus',
            ],
            'login' => [
                'title' => 'TAXI APP',
            ],
            'table' => [
                'user-location' => 'Lokasi pengguna',
                'destination' => 'Tujuan',
                'date-time' => 'Waktu-tanggal',
            ],
            'dashboard' => [
                'title' => 'Dashboard',
                'latest-order' => 'Pesanan terbaru',
                'view-all' => 'Lihat semua',
            ],
            'admin' => [
                'index' => 'Admin',
                'title-create' => 'Tambah Admin',
                'sub-title-create' => 'Tambah Admin',

                'title-edit' => 'Edit Admin',
                'sub-title-edit' => 'Edit admin',

                'add' => 'Tambah admin ',
            ],
            'driver' => [
                'index' => 'Driver',
                'title-create' => 'Tambah Driver',
                'sub-title-create' => 'Tambah driver',

                'title-edit' => 'Edit informasi driver',
                'sub-title-edit' => 'edit informasi driver',

                'add' => 'Tambah driver',

                'back-number' => 'Nomor belakang',
                'car-type' => 'Tipe mobil',
                'car-model' => 'Model mobil',

                'tracking' => [
                    'title' => 'Lacak driver',
                    'sub-title' => 'Lacak driver',
                ]
            ],
            'user' => [
                'index' => 'Pengguna',
                'title-create' => 'Tambah Pengguna',
                'sub-title-create' => 'Tambah Pengguna',

                'title-edit' => 'Edit Pengguna',
                'sub-title-edit' => 'Edit Pengguna',

                'add' => 'Tambah Pengguna',
            ],
            'card' => [
                'driver' => 'Driver',
                'user' => 'Pengguna',
                'type-taxi' => 'Tipe taxi',
                'type-taxi-text' => 'Tipe',
            ],
            'order' => [
                'distance' => 'Jarak',
                'total-fee' => 'Total biaya',
                'date-time' => 'Waktu pesanan',

                'title-detail' => 'Detail pesanan',

                'pending' => 'Menunggu Diterima Driver',
                'driver_accept' => 'Diterima Driver',
                'departure' => 'Berangkat',
                'departure-confirmation' => 'Konfirmasi Berangkat',
                'arrival' => 'Sampai di Tujuan',
                'complete' => 'Selesai',
                'cancel' => 'Dibatalkan',
            ],
            'price-setting' => [
                'index' => 'Pengaturan harga',
                'title-create' => 'Tambah harga',
                'sub-title-create' => 'Tambah harga',

                'title-edit' => 'Edit harga',
                'sub-title-edit' => 'Edit harga',

                'add' => 'Tambah harga',
            ],
            'about-us' => [
                'index' => 'Tentang Kami',

                'title-edit' => 'Edit Tentang Kami',
                'sub-title-edit' => 'Edit Tentang Kami',
            ],
            'setting' => [
                'index' => 'Pengaturan',
                'min-price-discount' => 'Harga minimal diskon',
                'discount' => 'Diskon',
                'late-night-extra-price' => 'Harga tambahan larut malam'
            ]
        ],
    ];

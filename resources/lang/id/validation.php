<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'The :attribute must be a valid email address.',
    'exists'               => 'The selected :attribute is invalid.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'The :attribute field must have a value.',
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => 'The :attribute may not be greater than :max characters.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'The :attribute must be at least :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'The :attribute must be at least :min characters.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => 'The :attribute field is required.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'The :attribute has already been taken.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'The :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'transfer_date' => [
            'required' => 'Tanggal Transfer harus diisi',
        ],
        'admin_bank_name' => [
            'required' => 'Tujuan Bank harus diisi'
        ],
        'user_bank_name' => [
            'required' => 'Nama Bank Pengirim harus diisi'
        ],
        'bank_account' => [
            'required' => 'Rekening Pengirim harus diisi',
            'numeric' => 'Format Rekening salah'
        ],
        'under_the_name' => [
            'required' => 'Atas Nama harus diisi'
        ],
        'amount' => [
            'required' => 'Total Transfer harus diisi',
            'numeric' => 'Total Transfer format salah'
        ],
        'image' => [
            'required' => 'Anda tidak menyertakan bukti transfer. harap diisi',
            'image' => 'Bukti Transfer harus berupa gambar/photo',
            'mimes' => 'Bukti Tranfer harus format jpeg/png',
            'max' => 'Bukti Transfer harus kurang dari 200kb'
        ],
        'store_name' => [
            'required' => 'Nama Toko harus diisi',
            'unique' => 'Nama toko sudah. Silahkan buat nama yang lain',
        ],
        'store_description' => [
            'required' => 'Deskripsi wajib diisi',
        ],
        'province_id' => [
            'required' => 'Provinsi wajib diisi',
        ],
        'city_id' => [
            'required' => 'Kota / Kabupaten wajib diisi',
        ],
        'address' => [
            'required' => 'Alamat wajib diisi',
        ],
        'postal_code' => [
            'required' => 'Kode Pos wajib diisi',
        ],
        'phone' => [
            'required' => 'Telpon wajib diisi',
            'numeric' => 'Telpon harus numerik, tidak boleh hurup',
        ],
        'ktp' => [
            'required' => 'Anda belum menyisipkan scan KTP',
            'image' => 'KTP harus berupa gambar/photo',
            'mimes' => 'KTP harus format jpeg/png',
            'max' => 'KTP harus kurang dari 200kb',
        ],

        //product_form
        'product_name' => [
            'required' => 'Nama Produk harus diisi',
            'max' => 'Nama Produk tidak boleh lebih dari 200 karakter',
        ],
        'category_id' => [
            'required' => 'Kategori harus diisi'
        ],
        'product_weight' => [
            'required' => 'Berat Produk harus diisi',
            'numeric' => 'Berat Produk harus berupa angka',
        ],
        'product_price' => [
            'required' => 'Harga Produk harus diisi',
            'numeric' => 'Harga Produk harus berupa angka',
        ],
        'product_image' => [
            'required' => 'Gambar Produk harus diisi',
            'image' => 'Gambar Produk harus berupa image / photo',
            'mimes' => 'Gambar Produk harus format jpg dan png',
            'max' => 'Gambar Produk tidak boleh lebih dari 200kb'
        ],
        'product_desc' => [
            'required' => 'Deskripsi Produk harus diisi',
            'min' => 'Deskripsi Produk harus lebih dari 100 karakter',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];

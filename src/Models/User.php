<?php

namespace darkgoldblade01\Paradox\Olivia\Models;

class User extends Model {

    protected $create_required_fields = [
        'name',
        'phone_number',
        'email',
    ];

    protected $update_required_fields = [
        'OID',
        'name',
        'phone_number',
        'email',
    ];


}
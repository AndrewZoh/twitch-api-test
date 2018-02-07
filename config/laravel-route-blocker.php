<?php

return [

    'whitelist' => [
        'first_group' => [
            '127.0.0.1',
            '192.168.10.1',
            '192.168.254.1',
        ],
    ],

    # RESPONSE SETTINGS
    'redirect_to'      => '',   # URL TO REDIRECT IF BLOCKED (LEAVE BLANK TO THROW STATUS)
    'response_status'  => 404,  # STATUS CODE (403, 404 ...)
    'response_message' => ''    # MESSAGE (COMBINED WITH STATUS CODE)

];
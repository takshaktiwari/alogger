<?php

return [
    'log'    =>  true,
    'record'    =>  [
        'user_id' =>    [
            'status'    =>  true,
            'except'    =>  [],
        ],
        'ip'    =>  [
            'status'    =>  true,
            'except'    =>  ['::1'],
        ],
        'url'   =>  [
            'status'    =>  true,
            'except'    =>  [],
        ],
        'method'    =>  [
            'status'    =>  true,
            'except'    =>  []
        ],
        'session'   =>  [
            'status'    =>  true,
            'except'    =>  [
                '_token'
            ],
        ],
        'request'   =>  [
            'status'    =>  true,
            'except'    =>  [
                '_token'
            ]
        ]
    ],
    'except'    =>  [
        'matches'   =>  [],
        'urls'  =>  []
    ],
    'max_rows'  =>  5000,
    'max_days'  =>  60,
];

<?php

return [
    /* Enable logger or not */
    'log'       =>  true,

    /* See logs using predefined route: https://example.com/aloggers */
    'routes'    =>  true,

    /* Record following items */
    'record'    =>  [
        'user_id' =>    [
            'status'    =>  true, /* If you want to record this or not */
            'except'    =>  [], /* Which user ids will not be stored */
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

    /* Logger will not record anything on these urls */
    'except'    =>  [
        'matches'   =>  [], /* URLs matching these keywords */
        'urls'  =>  [] /* Exact URLs which will not be logged */
    ],

    /*
     * Number of maximum row in database, older data can be pruned using
     * `alogger:prune command`
     */
    'max_rows'  =>  5000,

    /*
     * Number of days: logs older than these days will be pruned
     */
    'max_days'  =>  60,
];

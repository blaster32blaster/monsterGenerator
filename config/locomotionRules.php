<?php

return [

//    ["bipedal", "quadripedal", "slither", "flying", "swimming", "vacuum"];
//    ["arms", "legs", "wings", "tentacles", "none"];
    'not_allowed_attachments'
    =>[
        'bipedal' => [
            'legs'
        ],
        'quadripedal' => [
            'arms'
        ],
        'slither' => [

        ],
        'flying' => [

        ],
        'swimming' => [
            'legs'
        ],
        'vacuum' => [
            'legs'
        ]
    ]
];
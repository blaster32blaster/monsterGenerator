<?php

return [

//    ["bipedal", "quadripedal", "slither", "flying", "swimming", "vacuum"];
//    ["arms", "legs", "wings", "tentacles", "none"];
    'not_allowed_upper_torso_attachments'
    =>[
        'bipedal' => [
            'legs'
        ],
        'quadripedal' => [
            'arms'
        ],
        'slither' => [
            'legs'
        ],
        'flying' => [

        ],
        'swimming' => [
            'legs', 'wings'
        ],
        'vacuum' => [
            'legs', 'wings'
        ]
    ],
    'not_allowed_lower_torso_attachments'
    =>[
        'bipedal' => [
            "arms", "wings", "tentacles", "none"
        ],
        'quadripedal' => [
            "arms", "wings", "tentacles", "none"
        ],
        'slither' => [
            'legs'
        ],
        'flying' => [
            'arms'
        ],
        'swimming' => [
            'arms'
        ],
        'vacuum' => [
            'arms'
        ]
    ]
];
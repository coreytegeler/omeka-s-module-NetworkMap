<?php
return [
    'block_layouts' => [
        'invokables' => [
            'networkMap' => 'NetworkMap\Site\BlockLayout\NetworkMap'
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            OMEKA_PATH . '/modules/NetworkMap/view',
        ],
    ],
];

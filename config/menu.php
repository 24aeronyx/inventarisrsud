<?php

return [
    [
        'label' => 'Dashboard',
        'icon'  => 'mdi:view-dashboard',
        'url'   => '/dashboard',
    ],

    [
        'label' => 'Manajemen Staff',
        'icon'  => 'mdi:account-group',
        'url'   => '/dashboard/staff',
        'role'  => 'admin',
    ],

    [
        'label' => 'Komputer',
        'icon'  => 'mdi:monitor',
        'url'   => '/dashboard/komputer',
    ],
    [
        'label' => 'Printer',
        'icon'  => 'mdi:printer',
        'url'   => '/dashboard/printer',
    ],
    [
        'label' => 'UPS',
        'icon'  => 'mdi:flash',
        'url'   => '/dashboard/ups',
    ],
    [
        'label' => 'CCTV',
        'icon'  => 'mdi:cctv',
        'url'   => '/dashboard/cctv',
    ],
    [
        'label' => 'Switch',
        'icon'  => 'mdi:switch',
        'url'   => '/dashboard/switch',
    ],
    [
        'label' => 'Perbaikan',
        'icon'  => 'mdi:tools',
        'url'   => '/dashboard/perbaikan',
    ],

    [
        'label' => 'Laporan',
        'icon'  => 'mdi:file-document-outline',
        'children' => [
            ['label' => 'Komputer', 'icon' => 'mdi:monitor', 'url' => '/dashboard/laporan/komputer'],
            ['label' => 'Printer',  'icon' => 'mdi:printer', 'url' => '/dashboard/laporan/printer'],
            ['label' => 'UPS',      'icon' => 'mdi:flash',   'url' => '/dashboard/laporan/ups'],
            ['label' => 'CCTV',     'icon' => 'mdi:cctv',    'url' => '/dashboard/laporan/cctv'],
            ['label' => 'Switch',   'icon' => 'mdi:switch',  'url' => '/dashboard/laporan/switch'],
            ['label' => 'Perbaikan','icon' => 'mdi:tools',   'url' => '/dashboard/laporan/perbaikan'],
        ]
    ],

    [   
        'label' => 'Akun',
        'icon'  => 'mdi:account',
        'url'   => '/dashboard/akun',
    ],
];

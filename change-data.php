<?php

if (isset($_POST['province_id'])) {

    $data = [];
    if ($_POST['province_id'] == 1) {
        $data = [
            0 => [
                'id' => 1,
                'name' => 'Bandung',
            ],
            1 => [
                'id' => 2,
                'name' => 'Cimahi',
            ]
        ];
    }

    if ($_POST['province_id'] == 2) {
        $data = [
            3 => [
                'id' => 3,
                'name' => 'Kudus',
            ],
            4 => [
                'id' => 2,
                'name' => 'Cirebon',
            ]
        ];
    }

    echo json_encode($data);
}

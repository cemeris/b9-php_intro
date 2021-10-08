<?php
header('Content-type: application/json');

$output = [];

$entries = [
    [
        'author' => 'Vitālijs',
        'image_path' => 'images/IMG_2699.png',
        'fallowers' => 623,
        'created_at' => 1633111098,
        'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when.
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when.
            https://bit.ly/2RANHvl",
        'likes' => 153,
        'comment_count' => 57
    ],
    [
        'author' => 'Māris',
        'image_path' => 'images/nature.jpg',
        'fallowers' => 633,
        'created_at' => 1633111077,
        'content' => "LoreHei Heie printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when.
            https://bit.ly/2RANHvl",
        'likes' => 103,
        'comment_count' => 54
    ],
    [
        'author' => 'Anna',
        'image_path' => 'https://images.unsplash.com/photo-1632877558001-92e30f4a6b65?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1771&q=80',
        'fallowers' => 623,
        'created_at' => 1633111077,
        'content' => "Teksts trešajam ierakstam Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when.
            https://bit.ly/2RANHvl",
        'likes' => 102,
        'comment_count' => 54
    ]
];

$output['status'] = false;

if (true) {
    $output['status'] = true;
    $output['posts'] = $entries;
}



echo json_encode($output, JSON_PRETTY_PRINT);
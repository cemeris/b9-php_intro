<?php
header('Content-type: application/json');
define('PRIVATE_DIR', __DIR__ . "/../private");

include_once(PRIVATE_DIR . "/classes/Random.php");
$rand_generator = new Random();

$output = [];
//https://baconipsum.com/api/?type=meat-and-filler&paras=2&format=text
//https://dog.ceo/api/breeds/image/random
//https://api.fungenerators.com/name/categories.json?start=0&limit=1

$template = [
    'author' => 'Vitālijs',
    'image_path' => 'images/IMG_2699.png',
    'fallowers' => 623,
    'created_at' => 1633539244,
    'content' => "<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when.
        </p><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when.</p>
        <a href='https://bit.ly/2RANHvl'>bit.ly/2RANHvl</a>",
    'likes' => 153,
    'comment_count' => 57
];

$entries = [];
define('POSTS_COUNT', 10);

for ($i = 0; $i < POSTS_COUNT; $i++) {
    $template['fallowers'] = $rand_generator->getFallowerCount();
    $template['created_at'] = $rand_generator->getCreateAt();
    $template['likes'] = $rand_generator->getLikesCount();
    $template['comment_count'] = $rand_generator->getCommentCount();

    $template['content'] = $rand_generator->getContent();
    $template['image_path'] = $rand_generator->getImage();

    $entries[] = $template;
}

$output['status'] = false;

if (true) {
    $output['status'] = true;
    $output['posts'] = $entries;
}



echo json_encode($output, JSON_PRETTY_PRINT);
<?php
header('Content-type: application/json');
define('PRIVATE_DIR', __DIR__ . "/../private");

define('DEBUG_MODE', true);
if (DEBUG_MODE) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

$output = [
    'status' => false
];

if (isset($_GET['api-name']) && is_string($_GET['api-name'])) {
    if ($_GET['api-name'] == 'new_post') {

        $output['status'] = true;
    }
    elseif ($_GET['api-name'] == 'rand_post') {
        include_once(PRIVATE_DIR . "/classes/Random.php");
        $rand_generator = new Random();
        
        $template = [
            'author' => 'Vitālijs',
            'image_path' => 'images/IMG_2699.png',
            'fallowers' => 0,
            'created_at' => 0,
            'content' => "",
            'likes' => 0,
            'comment_count' => 0
        ];
        
        $entries = [];
        define('POSTS_COUNT', 10);
        
        $count = POSTS_COUNT;
        
        if (
            isset($_GET['count']) &&
            is_string($_GET['count']) &&
            (int)$_GET['count'] == $_GET['count']
        ) {
            $output['count'] = (int)$_GET['count'];
            $count = $output['count'];
        }
        
        for ($i = 0; $i < $count; $i++) {
            $template['fallowers'] = $rand_generator->getFallowerCount();
            $template['created_at'] = $rand_generator->getCreateAt();
            $template['likes'] = $rand_generator->getLikesCount();
            $template['comment_count'] = $rand_generator->getCommentCount();
        
            $template['content'] = $rand_generator->getContent();
            $template['image_path'] = $rand_generator->getImage();
        
            $template['author'] = $rand_generator->getName();
        
            $entries[] = $template;
        }
        
        
        $output['status'] = true;
        $output['posts'] = $entries;
    }
}



echo json_encode($output, JSON_PRETTY_PRINT);
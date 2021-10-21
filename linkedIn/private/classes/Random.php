<?php
include_once('Request.php');
class Random
{
    private $sec_in_day = 24 * 60 * 60;

    public function getFallowerCount() {
        return rand(30, 1000);
    }

    public function getCreateAt() {
        return time() - rand($this->sec_in_day, 25 * $this->sec_in_day);
    }

    public function getLikesCount() {
        return rand(2, 50);
    }

    public function getCommentCount() {
        return rand(1, 14);
    }

    public function getContent() {
        $paras = rand(1, 3);
        $output = Request::get("https://baconipsum.com/api/?type=meat-and-filler&paras=$paras&format=text");
        if ($output) {
            return $output;
        }
        else {
            return "This is post content";
        }

    }

    public function getImage() {
        $output = Request::get("https://dog.ceo/api/breeds/image/random");
        $data = json_decode($output, true);
        return $data['message'];
    }

    public function getName() {
        $output = Request::get("https://api.namefake.com/");
        $data = json_decode($output, true);
        return $data['name'];
    }

}
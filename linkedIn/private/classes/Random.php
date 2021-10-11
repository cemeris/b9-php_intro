<?php
include_once('Request.php');
class Random extends Request
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
        return $this->get("https://baconipsum.com/api/?type=meat-and-filler&paras=$paras&format=text");
    }

    public function getImage() {
        $output = $this->get("https://dog.ceo/api/breeds/image/random");
        $data = json_decode($output, true);
        return $data['message'];
    }


}
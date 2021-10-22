<?php
class Request
{
    static public function get(string $url) :string {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($response === false) {
           return curl_error($ch) . curl_errno($ch);
        }

        curl_close($ch);

        return ($httpcode == 200) ? $response : '';
    }
}
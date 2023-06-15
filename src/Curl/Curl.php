<?php

namespace App\Curl;

use App\Curl\AbstractCurl;

final class Curl extends AbstractCurl
{

    /**
     * @param string $url
     * @return array
     */
    public function getContent(string $url): array {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);

        $content = curl_exec($ch);
        curl_close($ch);

        if($error = $this->isError(curl_getinfo($ch, CURLINFO_RESPONSE_CODE), curl_getinfo($ch, CURLINFO_REDIRECT_URL))) {

           return [
               'error' => $error
           ];
        }

        return [
            'content' => $content
        ];
    }
}
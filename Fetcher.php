<?php

include 'ApiService.php';

class Fetcher
{
    const ROOT_URL = 'https://api.supermetrics.com/assignment';

    public function getToken($email, $name)
    {
        $jsonData = array(
            'email' => $email,
            'name' => $name,
            'client_id' => 'ju16a6m81mhid5ue1z3v2g0uh'
        );

        $jsonDataEncoded = json_encode($jsonData);

        $apiService = new ApiService();
        $result = $apiService->callAPI('POST', self::ROOT_URL.'/register', $jsonDataEncoded);
        $returnData = json_decode($result);
        $token = $returnData->data->sl_token;

        return $token;
    }

    public function fetchData($token)
    {
        $page = 1;
        $stop = false;

        while ($stop == false) {

            $apiService = new ApiService();
            $result = $apiService->callAPI('GET', self::ROOT_URL.'/posts', ['sl_token' => $token, 'page' => $page]);
            $returnData = json_decode($result);

            if ($page == $returnData->data->page) {
                foreach ($returnData->data->posts as $post) {
                    $postsArray[] = $post;
                }
                $page++;

            } else {
                $stop = true;
            }
        }
        return $postsArray;
    }
}
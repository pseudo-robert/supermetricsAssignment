<?php

class Calculations
{
    public function getPostsCount($weeklyData)
    {
        // - Total posts split by week
        foreach ($weeklyData as $week => $posts) {
            $weekArray[$week] = count($posts);
        }

        return (object)$weekArray;
    }

    public function getStatistic($sortedData)
    {
        //Show stats on the following:
        // - Average character length of a post / month
        // - Longest post by character length / month
        // - Average number of posts per user / month

        foreach ($sortedData as $monthkey => $monthValues) {
            $messagesLength = 0;
            $longestMessage = 0;
            $uniqueUsers = [];
            foreach ($monthValues as $post) {

                //calculate total month messages length
                $messagesLength = $messagesLength + strlen($post->message);

                //set the longest message of monnth
                (($newValue = strlen($post->message)) > $longestMessage) ? $longestMessage = $newValue : $longestMessage;

                //month unique users
                $uniqueUsers[$post->from_id] = null;
            }

            $monthAverageMessageLength[$monthkey] = round($messagesLength / count($monthValues));
            $monthLongestMessage[$monthkey] = $longestMessage;
            $monthAverageUserPosts[$monthkey] = count($monthValues) / count($uniqueUsers);

        }
        $response = [
            "monthAverageMessageLength" => (object)$monthAverageMessageLength,
            "monthLongestMessage" => (object)$monthLongestMessage,
            "monthAverageUserPosts" => (object)$monthAverageUserPosts
        ];
        return (object)$response;
    }
}
<?php

class Sorting
{
    public function sortByMonth($postsArray)
    {
        foreach ($postsArray as $post) {
            $date = new \DateTime($post->created_time);
            $formatedDate = $date->format('Y-m');
            $monthArray [$formatedDate][] = $post;
        }
        return $monthArray;
    }

    public function sortByWeek($postsArray)
    {
        foreach ($postsArray as $post) {
            $date = new \DateTime($post->created_time);
            $formatedDate = $date->format('W');
            $weekArray [$formatedDate][] = $post;
        }
        return $weekArray;
    }
}
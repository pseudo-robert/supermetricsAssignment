<?php

include 'Sorting.php';
include 'Calculations.php';
include 'Fetcher.php';

class SuperMetrics
{
    function solve($email, $name)
    {
        $fetcher = new Fetcher();
        $token = $fetcher->getToken($email, $name);
        $data = $fetcher->fetchData($token);

        $sorting = new Sorting();
        $sortedDataByMonth = $sorting->sortByMonth($data);
        $sortedDataByWeek = $sorting->sortByWeek($data);

        $calculation = new Calculations();
        $weeklyPostsCount = $calculation->getPostsCount($sortedDataByWeek);
        $statistic = $calculation->getStatistic($sortedDataByMonth);
        $statistic->weeklyPostsCount = $weeklyPostsCount;

        return json_encode($statistic);
    }
}

$email = "test@example.com";
$name = "test";

$supermetrics = new SuperMetrics();
$response = $supermetrics->solve($email, $name);
echo $response;

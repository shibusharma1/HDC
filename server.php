<?php
header('Content-Type: application/json');

$start_time = "09:00:00";
$end_time = "15:00:00";

// Simulated voting data
$votes = [
    "Candidate A" => 4,
    "Candidate B" => 5,
    "Candidate C" => 5
];

$response = [
    "start_time" => $start_time,
    "end_time" => $end_time,
    "votes" => $votes
];

echo json_encode($response);

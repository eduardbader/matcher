<?php

require __DIR__ . '/../src/Property.php';
require __DIR__ . '/../src/SearchProfile.php';
require __DIR__ . '/../src/Match.php';
require __DIR__ . '/../src/MatchResult.php';

//dummy props
$properties = require 'properties.php';
//dummy search profiles
$filters = require 'searchProfiles.php';

$myProperty = $properties[0];
$matcher = new Match($myProperty);
$matches = [];
foreach ($filters as $filter) {
    $matchResult = $matcher->match($filter);
    if ($matchResult->isMatch()) {
        $matches[] = $matchResult;
    }
}

$sortFunction = static function (MatchResult $a, MatchResult $b) {
    if ($a->getScore() === $b->getScore()) {
        return 0;
    }
    return ($a->getScore() > $b->getScore()) ? -1 : 1;
};

usort($matches, $sortFunction);

header('Content-type:application/json');

$data = [
    'data' => []
];

foreach ($matches as $match) {
    $data['data'][] = $match->getSummary();
}

echo json_encode($data);
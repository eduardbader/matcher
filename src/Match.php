<?php


class Match
{
    private int $score;
    private Property $property;
    private const LOOSE_MATCH_DEVIATION_FACTOR = 25;

    public function __construct(Property $property)
    {
        $this->property = $property;
        $this->score = 0;
    }

    public function match(SearchProfile $searchProfile): MatchResult
    {
        $matchResult = new MatchResult();
        $matchResult->setFilterId($searchProfile->getId());
        $propertyFields = $this->property->getPropertyFields();
        foreach ($searchProfile->getSearchProfileFields() as $field => $value) {

            if (isset($propertyFields[$field])) {
                if (is_array($value)) {
                    $match = $this->rangeMatch($value, $propertyFields[$field]);
                    $matchResult->setIsMatch($match);
                    if ($match) {
                        $matchResult->addStrictMatches(1);
                        //add more points for strict match
                        $matchResult->addScore(2);
                        continue;
                    }
                    //loose match
                    // expand range
                    $factor = (100 - self::LOOSE_MATCH_DEVIATION_FACTOR) / 100;
                    $value[0] *= $factor;

                    $factor = (100 + self::LOOSE_MATCH_DEVIATION_FACTOR) / 100;
                    $value[1] *= $factor;

                    $match = $this->rangeMatch($value, $propertyFields[$field]);
                    $matchResult->setIsMatch($match);
                    $matchResult->addLooseMatches(1);
                    //add less  points for loose match
                    $matchResult->addScore(1);
                } else {
                    $match = $this->directMatch($value, $propertyFields[$field]);
                    $matchResult->setIsMatch($match);
                    $matchResult->addStrictMatches(1);
                    $matchResult->addScore(2);
                }
                if (!$match) {
                    // miss matching
                    break;
                }
            }
        }
        return $matchResult;
    }

    private function rangeMatch($range, $value): bool
    {
        $minValue = is_null($range[0]) ? $value : $range[0];
        $maxValue = is_null($range[1]) ? $value : $range[1];


        $match = min($minValue, $value) === $minValue;
        $match = $match && max($maxValue, $value) === $maxValue;

        return $match;
    }

    private function directMatch(string $filter, string $value)
    {
        if (is_null($filter) || is_null($value)) {
            return true;
        }
        return $filter === $value;
    }
}

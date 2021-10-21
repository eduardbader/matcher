<?php


class MatchResult
{
    private int $score = 0;
    private bool $isMatch;
    protected int $strictMatches = 0;
    protected int $looseMatches = 0;
    protected int $filterId;


    /**
     * @return int
     */
    public function getStrictMatches(): int
    {
        return $this->strictMatches;
    }


    /**
     * @param int $strictMatches
     */
    public function addStrictMatches(int $strictMatches): void
    {
        if ($this->isMatch()) {
            $this->strictMatches += $strictMatches;
        }
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * @param int $score
     */
    public function addScore(int $score): void
    {
        if ($this->isMatch()) {
            $this->score += $score;
        }
    }

    /**
     * @return bool
     */
    public function isMatch(): bool
    {
        return $this->isMatch;
    }

    /**
     * @param bool $isMatch
     */
    public function setIsMatch(bool $isMatch): void
    {
        $this->isMatch = $isMatch;
    }

    /**
     * @return int
     */
    public function getLooseMatches(): int
    {
        return $this->looseMatches;
    }

    /**
     * @param int $looseMatches
     */
    public function addLooseMatches(int $looseMatches): void
    {
        if ($this->isMatch()) {
            $this->looseMatches += $looseMatches;
        }
    }

    /**
     * @param int $filterId
     */
    public function setFilterId(int $filterId): void
    {
        $this->filterId = $filterId;
    }

    public function getSummary(): array
    {
        $data = [
            'searchProfileId' => $this->filterId,
            'score' => $this->getScore(),
            'strictMatchesCount' => $this->getStrictMatches(),
            'looseMatchesCount' => $this->getLooseMatches(),
        ];
        return $data;
    }

}
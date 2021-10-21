<?php


use PHPUnit\Framework\TestCase;

class MatchTest extends TestCase
{
    public function getMatchedData (): array
    {
        return [
            [[0, 200]],
            [[null, 200]],
            [[100, 200]],
            [[100, null]],
            [[null, null]],
        ];
    }

    /**
     * @dataProvider getMatchedData
     * @param $range
     */
    public function testMatch ($range): void
    {
        $property = new Property();
        $property->setPropertyField('foo', 150);
        $filter = new SearchProfile(0);
        $filter->setSearchProfileField('foo', $range);
        $matcher = new Match($property);
        $res = $matcher->match($filter);
        $this->assertTrue($res->isMatch());
        $this->assertEquals(2, $res->getScore());
        $this->assertEquals(1, $res->getStrictMatches());
        $this->assertEquals(0, $res->getLooseMatches());
    }

    public function testLooseMatch (): void
    {
        $property = new Property();
        $property->setPropertyField('foo', 140);
        $filter = new SearchProfile(0);
        $filter->setSearchProfileField('foo', [150, 200]);
        $matcher = new Match($property);
        $res = $matcher->match($filter);
        $this->assertTrue($res->isMatch());
        $this->assertEquals(1, $res->getScore());
        $this->assertEquals(0, $res->getStrictMatches());
        $this->assertEquals(1, $res->getLooseMatches());
    }


    public function getNotMatchedData (): array
    {
        return [
            [[1000, 2000]],
            [[null, 20]],
            [[300, 700]],
            [[300, null]],
        ];
    }

    /**
     * @dataProvider getNotMatchedData
     * @param $range
     */
    public function testNotMatch ($range): void
    {
        $property = new Property();
        $property->setPropertyField('foo', 150);
        $filter = new SearchProfile(0);
        $filter->setSearchProfileField('foo', $range);
        $matcher = new Match($property);
        $res = $matcher->match($filter);
        $this->assertFalse($res->isMatch());
        $this->assertEquals(0, $res->getScore());
        $this->assertEquals(0, $res->getStrictMatches());
        $this->assertEquals(0, $res->getLooseMatches());
    }

    public function testNotMatchFirst(): void
    {
        $property = new Property();
        $property->setPropertyField('foo', 150);
        $property->setPropertyField('bar', 150);
        $filter = new SearchProfile(0);
        $filter->setSearchProfileField('foo', [10, 20]);
        $filter->setSearchProfileField('bar', [100, 200]);
        $matcher = new Match($property);
        $res = $matcher->match($filter);
        $this->assertFalse($res->isMatch());
    }

    public function testNotMatchSecond(): void
    {
        $property = new Property();
        $property->setPropertyField('foo', 150);
        $property->setPropertyField('bar', 150);
        $filter = new SearchProfile(0);
        $filter->setSearchProfileField('foo', [100, 200]);
        $filter->setSearchProfileField('bar', [10, 20]);
        $matcher = new Match($property);
        $res = $matcher->match($filter);
        $this->assertFalse($res->isMatch());
    }

    public function testDirect (): void
    {
        $property = new Property();
        $property->setPropertyField('foo', 150);
        $filter = new SearchProfile(0);
        $filter->setSearchProfileField('foo', 150);
        $matcher = new Match($property);
        $res = $matcher->match($filter);
        $this->assertTrue($res->isMatch());
        $this->assertEquals(2, $res->getScore());
        $this->assertEquals(1, $res->getStrictMatches());
        $this->assertEquals(0, $res->getLooseMatches());
    }

    public function testDirectNotMatch (): void
    {
        $property = new Property();
        $property->setPropertyField('foo', 150);
        $filter = new SearchProfile(0);
        $filter->setSearchProfileField('foo', 120);
        $matcher = new Match($property);
        $res = $matcher->match($filter);
        $this->assertFalse($res->isMatch());
        $this->assertEquals(0, $res->getScore());
        $this->assertEquals(0, $res->getStrictMatches());
        $this->assertEquals(0, $res->getLooseMatches());
    }
}

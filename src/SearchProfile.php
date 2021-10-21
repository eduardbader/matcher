<?php


class SearchProfile
{
    private int $id;
    private string $name = 'name';
    private string $propertyType = 'd44d0090-a2b5-47f7-80bb-d6e6f85fca90';
    private array $searchFields;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getSearchProfilePropertyType()
    {
    }

    public function getSearchProfileFields()
    {
        return $this->searchFields;
    }

    public function setSearchProfileField($field, $value){
        $this->searchFields[$field] = $value;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}

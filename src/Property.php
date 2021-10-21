<?php


class Property
{

    private string $name;
    private string $address;
    private string $propertyType = 'd44d0090-a2b5-47f7-80bb-d6e6f85fca90';
    private array $fields;

    public function getPropertyType()
    {
    }

    public function getPropertyFields()
    {
        return $this->fields;
    }

    public function setPropertyField($field, $value)
    {
        $this->fields[$field] = $value;
    }
}

<?php

$property = new Property();
$property->setPropertyField('area', 180);
$property->setPropertyField('yearOfConstruction', 2010);
$property->setPropertyField('rooms', 5);
$property->setPropertyField('heatingType', 'gas');
$property->setPropertyField('parking', true);
$property->setPropertyField('returnActual', 12.8);
$property->setPropertyField('rent', 3750);
$properties[] = $property;

$property = new Property();
$property->setPropertyField('area', 500);
$property->setPropertyField('yearOfConstruction', 150);
$property->setPropertyField('rooms', 15);
$property->setPropertyField('heatingType', 'no');
$property->setPropertyField('parking', true);
$property->setPropertyField('returnActual', 800);
$property->setPropertyField('rent', 15200);
$property->setPropertyField('price', 160000);
$properties[] = $property;


$property = new Property();
$property->setPropertyField('area', 120);
$property->setPropertyField('yearOfConstruction', 2015);
$property->setPropertyField('rooms', 4);
$property->setPropertyField('heatingType', 'lpg');
$property->setPropertyField('parking', true);
$property->setPropertyField('returnActual', 8);
$property->setPropertyField('rent', 1500);
//$property->setPropertyField('price', 450000);
$properties[] = $property;


$property = new Property();
$property->setPropertyField('area', 120);
$property->setPropertyField('yearOfConstruction', 2015);
$property->setPropertyField('rooms', 4);
$property->setPropertyField('heatingType', 'lpg');
$property->setPropertyField('parking', true);
$property->setPropertyField('returnActual', 8);
$property->setPropertyField('rent', 1500);
$properties[] = $property;


return $properties;
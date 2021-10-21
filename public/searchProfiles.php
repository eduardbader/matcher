<?php

$searchProfile = new SearchProfile(1);
$searchProfile->setSearchProfileField('price', [0, 2000000]);
$searchProfile->setSearchProfileField('area', [150,null]);
$searchProfile->setSearchProfileField('yearOfConstruction', [2010,null]);
$searchProfile->setSearchProfileField('rooms', [4,null]);
$searchProfile->setSearchProfileField('returnPotential', [15,null]);
$searchProfiles[] = $searchProfile;

$searchProfile = new SearchProfile(2);
$searchProfile->setSearchProfileField('price', [0, 150000]);
$searchProfile->setSearchProfileField('area', [60,90]);
$searchProfile->setSearchProfileField('yearOfConstruction', [2010,null]);
$searchProfile->setSearchProfileField('rooms', [4,5]);
$searchProfiles[] = $searchProfile;

$searchProfile = new SearchProfile(3);
$searchProfile->setSearchProfileField('price', [0, 5000]);
$searchProfile->setSearchProfileField('yearOfConstruction', [2010,null]);

$searchProfiles[] = $searchProfile;

return $searchProfiles;

<?php

use Sourceability\CodingStandard\Tests\PHPStan\Rules\data\Animal;
use Sourceability\CodingStandard\Tests\PHPStan\Rules\data\Car;
use Sourceability\CodingStandard\Tests\PHPStan\Rules\data\Cat;

/**
 * @return Animal|Car|null
 */
function getAnimalOrCar($a) {

}

// invalid
if (Animal::getAnimal(1) instanceof Animal) {
    echo 'instanceof Animal';
}

// valid
if (null !== Animal::getAnimal(2)) {
    echo 'instanceof Animal';
}

// valid
if (Animal::getAnimal(3) instanceof Cat) {
    echo 'instanceof Cat';
}

// valid
if (Animal::getAnimal(3) instanceof Cat) {
    echo 'instanceof Cat';
}

// valid
if (getAnimalOrCar(1) instanceof Animal) {
    echo 'instanceof Animal';
}

// valid
if (getAnimalOrCar(2) instanceof Car) {
    echo 'instanceof Car';
}

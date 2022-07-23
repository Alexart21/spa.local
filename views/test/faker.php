<?php

for ($i=0; $i < 10; $i++) {
    $faker = \Faker\Factory::create('ru_RU');
    echo $faker->name . "<br>"; //или echo $faker->firstName . " " . $faker->lastName . "<br>";
    echo $faker->phoneNumber . '<br>';
    echo $faker->dateTimeThisCentury->format('Y-m-d') . "<br>";
    echo "<hr>";
}
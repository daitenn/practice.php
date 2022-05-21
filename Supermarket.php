<?php

const TAX = 10;

const DISCOUNT_ONION_NUMBER1 = 3;
const DISCOUNT_ONION_PRICE1 = 50;
const DISCOUNT_ONION_NUMBER2 = 5;
const DISCOUNT_ONION_PRICE2 = 100;

const DISCOUNT_SET_PRICE = 20;

const DISCOUNT_TIME_BENTO = '20:00';


const PRICES = [
  1 => ['price' => 100, 'type' => ''],
  2 => ['price' => 150, 'type' => ''],
  3 => ['price' => 200, 'type' => ''],
  4 => ['price' => 350, 'type' => ''],
  5 => ['price' => 180, 'type' => 'drink'],
  6 => ['price' => 220, 'type' => ''],
  7 => ['price' => 440, 'type' => 'bento'],
  8 => ['price' => 380, 'type' => 'bento'],
  9 => ['price' => 80, 'type' => 'drink'],
  10 => ['price' => 100, 'type' => 'drink'],
];
function calc (string $time, array $items): int
{
  $totalAmount = 0;
  $drink = 0;
  $bento = 0;
  $bentoAmount = 0;
  foreach ($items as $item) {
  $totalAmount += PRICES[$item]['price'];
    if (PRICES[$item]['type'] === 'drink') {
        $drink++;
    }

    if (PRICES[$item]['type'] === 'bento') {
        $bento++;
        $bentoAmount += PRICES[$item]['price'];
    }
  }

  $totalAmount -= discountOnion (array_count_values($items)[1]);
  $totalAmount -= discountSet ($drink, $bento);
  $totalAmount -= discountTime($time, $bentoAmount);

  return (int) $totalAmount * (100 + TAX) / 100;
}

function discountOnion (int $number): int
{
  $discount = 0;
  if ($number >= DISCOUNT_ONION_NUMBER2) {
    $discount = DISCOUNT_ONION_PRICE2;
  }

  if ($number >= DISCOUNT_ONION_NUMBER1) {
    $discount = DISCOUNT_ONION_PRICE1;
  }
  return $discount;
}

function discountSet (int $drinkNumber, int $bentoNumber): int
{
  return DISCOUNT_SET_PRICE * min($drinkNumber, $bentoNumber);
}

function discountTime(string $time, int $bentoAmount): int
{
  if (strtotime(DISCOUNT_TIME_BENTO) > strtotime($time)) {
    return 0;
  }
  return (int) $bentoAmount / 2;
}

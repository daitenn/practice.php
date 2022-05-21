<?php

const SPIRITS_CHUNK = 2;

const BREADS = [
  1 => 100,
  2 => 120,
  3 => 150,
  4 => 250,
  5 => 80,
  6 => 120,
  7 => 100,
  8 => 180,
  9 => 50,
  10 => 300
];

const TAX = 10;
function chunkInput(array $argv): array
{
  $argument = array_slice($argv, 1);
  $args = array_chunk($argument, SPIRITS_CHUNK);
  $sales = [];
  foreach ($args as $arg) {
    $sales[$arg[0]] = (int) $arg[1];
  }
  return $sales;
}

function calculateSales(array $sales): int
{
  $sum = 0;

  foreach ($sales as $number => $unitsSold) {
    $sum += BREADS[$number] * (int) $unitsSold;
  }
  return (int) $sum * (100 + TAX) / 100;
}

function getNumberOfMaxSale($sales)
{
  if (empty($sales)) {
    return [];
  }
  $max = max(array_values($sales));
  return array_keys($sales, $max);
}

function getNumberOfMinSale($sales)
{
  if (empty($sales)) {
    return [];
  }
  $min = min(array_values($sales));
  return array_keys($sales, $min);
}

function displayResult (array ...$results): void
{
  foreach ($results as $result) {
    echo implode(' ', $result) . PHP_EOL;
  }
}



$sales = chunkInput($_SERVER['argv']);
$salesAmount = calculateSales($sales);
$numberOfMaxUnitsSold = getNumberOfMaxSale($sales);
$numberOfMinUnitsSold = getNumberOfMinSale($sales);
displayResult([$salesAmount], $numberOfMaxUnitsSold, $numberOfMinUnitsSold);

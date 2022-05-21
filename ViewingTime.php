<?php

const ARRAY_CHUNK_LENGTH = 2;

function getInput(array $argv): array
{
  $argument = array_slice($argv, 1);
  return array_chunk($argument, ARRAY_CHUNK_LENGTH);
}

function groupChannelViewingPeriods(array $inputs): array
{
  $channelViewingPeriods = [];
  foreach ($inputs as $input) {
    $chan = $input[0];
    $min = $input[1];
    $mins = [$min];

    if (array_key_exists($chan, $channelViewingPeriods)) {
      $mins = array_merge($channelViewingPeriods[$chan], $mins); //minsを上書き
    }

    $channelViewingPeriods[$chan] = $mins;
  }
  return $channelViewingPeriods;
}

function calculateTotalHour(array $channelViewingPeriods): float
{
  $viewingTotalMin = [];
  foreach ($channelViewingPeriods as $period) {
    $viewingTotalMin = array_merge($viewingTotalMin, $period);
  }
  $totalMin = array_sum($viewingTotalMin);

  return round($totalMin / 60, 1);
}

function display(array $channelViewingPeriods): void
{
  $totalHour = calculateTotalHour($channelViewingPeriods);
  echo $totalHour . PHP_EOL;
  foreach ($channelViewingPeriods as $chan => $mins) {
    echo $chan . ' ' . array_sum($mins) . ' ' . count($mins) . PHP_EOL;
  }
}

$inputs = getInput($_SERVER['argv']);
$channelViewingPeriods = groupChannelViewingPeriods($inputs);
display($channelViewingPeriods);

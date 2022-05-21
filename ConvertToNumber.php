<?php

// function convertToNumber(string ...$cards): array
// {
//   return array_map(function ($card) {
//     return substr($card, 1, strlen($card)-1);
//   }, $cards);
// }無名関数

//アロー関数

function convertToNumber(string ...$cards): array
{
  return array_map(fn ($card) => substr($card, 1, strlen($card)-1), $cards);
}

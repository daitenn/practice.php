<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../lib/Bakery.php');

final class BakeryTest extends TestCase
{
  public function testBakery(): void
  {
    $output = <<<EOD
    2464
    1
    5 10

    EOD;
    $this->expectOutputString($output);

    $sales = chunkInput(['file', '1', '10', '2', '3', '5', '1', '7', '5', '10', '1']);
    $salesAmount = calculateSales($sales);
  $numberOfMaxUnitsSold = getNumberOfMaxSale($sales);
  $numberOfMinUnitsSold = getNumberOfMinSale($sales);
  displayResult([$salesAmount], $numberOfMaxUnitsSold, $numberOfMinUnitsSold);
  }
}

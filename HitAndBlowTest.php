<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../lib/HitAndBlow.php');

final class HitAndBlowTest extends TestCase
{
    public function testJudge(): void
    {
      $this->assertSame([4, 0], judge(5678, 5678));
      $this->assertSame([1, 1], judge(5678, 7612));
      $this->assertSame([0, 4], judge(5678, 8756));
      $this->assertSame([0, 0], judge(5678, 1234));
    }
  }

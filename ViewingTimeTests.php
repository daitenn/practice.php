<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../lib/ViewingTime.php');

final class ViewingTimeTests extends TestCase
{
    public function ViewingTimeTest(): void
    {
        $output = <<<EOD
        1.7
        1 45 2
        5 25 1
        2 30 1

        EOD;
        $this->expectOutputString($output);

        $inputs = getInput(['file', '1', '30', '5', '25', '2', '30', '1', '15']);
        $channelViewingPeriods = groupChannelViewingPeriods($inputs);
        display($channelViewingPeriods);
    }
}

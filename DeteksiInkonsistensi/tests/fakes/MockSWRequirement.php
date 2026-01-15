<?php
namespace Tests\fakes;

use App\Models\SWRequirement;

class MockSWRequirement extends SWRequirement
{
public static $shouldWriteSucceed = true;

public static function writeNLPresult(array $processedSentences)
{
return self::$shouldWriteSucceed;
}
}
<?php

namespace Aternos\CurseForgeApi\Test\Client;

use Aternos\CurseForgeApi\Client\CursedFingerprintHelper;
use PHPUnit\Framework\TestCase;

class FingerprintHelperTest extends TestCase
{
    public function testRawString() {
        $this->assertEquals(1412061192, CursedFingerprintHelper::getFingerprint("foo", 123));
        $this->assertEquals(1777016281, CursedFingerprintHelper::getFingerprint("foobarbaz", 234));
    }

    public function testRawStringWithWhitespace() {
        $this->assertEquals(1412061192, CursedFingerprintHelper::getFingerprint("foo\n", 123));
        $this->assertEquals(1412061192, CursedFingerprintHelper::getFingerprint("fo o", 123));
        $this->assertEquals(1412061192, CursedFingerprintHelper::getFingerprint("fo o\n", 123));
    }

    public function testFile() {
        $this->assertEquals(3069266640, CursedFingerprintHelper::getFingerprintFromFile( __DIR__ . "/test.txt"));
    }
}
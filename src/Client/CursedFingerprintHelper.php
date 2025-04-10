<?php

namespace Aternos\CurseForgeApi\Client;

/**
 * Class CursedFingerprintHelper
 *
 * @package Aternos\CurseForgeApi\Client
 * @description A helper for generating murmur2 hashes for CurseForge
 */
class CursedFingerprintHelper
{
    public const int MAX_INT = 0xffffffff;

    public const int M = 0x5bd1e995;

    public const int R = 24;

    protected int $h;
    protected string $remainingBytes = "";

    /**
     * Create a new fingerprint helper
     * @param int $length the length of the total data (excluding whitespaces)
     * @param int $seed the seed to use (CurseForge uses 1)
     */
    public function __construct(int $length, int $seed = 1)
    {
        $this->h = $seed ^ $length & static::MAX_INT;
    }

    /**
     * Remove whitespaces from the given data
     * @param string $data
     * @return string
     */
    public static function stripWhiteSpaces(string $data): string
    {
        $result = "";
        foreach (str_split($data) as $char) {
            if (!static::isWhiteSpaceCharacter($char)) {
                $result .= $char;
            }
        }
        return $result;
    }

    /**
     * Is the given character a whitespace character?
     * @param string $char a single character string
     * @return bool
     */
    public static function isWhiteSpaceCharacter(string $char): bool
    {
        return $char === "\x09" || $char === "\x0a" || $char === "\x0d" || $char === "\x20";
    }

    /**
     * Calculate the fingerprint of a string
     * @param string $data the data to fingerprint
     * @param int $seed the seed to use for the fingerprint calculation (CurseForge uses 1)
     * @return int
     */
    public static function getFingerprint(string $data, int $seed = 1): int
    {
        $data = static::stripWhiteSpaces($data);
        $helper = new static(strlen($data), $seed);
        $helper->nextChunk($data);
        return $helper->finalize();
    }

    /**
     * Calculate the fingerprint of a file by reading it in chunks
     * @param string $path the path to the file
     * @param int $seed the seed to use for the fingerprint calculation (CurseForge uses 1)
     * @return int
     */
    public static function getFingerprintFromFile(string $path, int $seed = 1): int
    {
        $helper = new static(static::getFileSize($path), $seed);
        $file = fopen($path, 'r');
        $chunkSize = 1024;

        while(!feof($file)) {
            $chunk = fread($file, $chunkSize);
            $helper->nextChunk($chunk);
        }

        fclose($file);
        return $helper->finalize();
    }

    /**
     * Get the size of a file in bytes (excluding whitespaces).
     * This is used to calculate the length of the data for the fingerprint calculation.
     * @param string $path
     * @return int
     */
    public static function getFileSize(string $path): int
    {
        $fileSize = 0;

        $file = fopen($path, 'r');
        $chunkSize = 1024;

        while(!feof($file)) {
            $chunk = fread($file, $chunkSize);
            foreach (str_split($chunk) as $char) {
                if (!static::isWhiteSpaceCharacter($char)) {
                    $fileSize++;
                }
            }
        }

        fclose($file);
        return $fileSize;
    }

    /**
     * Add a chunk of data to the fingerprint calculation.
     * @param string $data the next chunk of data
     */
    public function nextChunk(string $data): void
    {
        $data = $this->remainingBytes . $data;
        $data = static::stripWhiteSpaces($data);

        $length = strlen($data);
        for ($index = 0; $index < $length - 3;) {
            $k = 0;
            for ($byte = 0; $byte < 4; $byte++) {
                $k |= ord($data[$index++]) << ($byte * 8);
            }
            $this->h = $this->mmix($this->h, $k);
        }

        $this->remainingBytes = substr($data, $index);
    }

    /**
     * Finalize the fingerprint calculation and return the fingerprint
     * @return int
     */
    public function finalize(): int
    {
        switch (strlen($this->remainingBytes)) {
            /** @noinspection PhpMissingBreakStatementInspection */
            case 3:
                $this->h ^= ord($this->remainingBytes[2]) << 16;
            /** @noinspection PhpMissingBreakStatementInspection */
            case 2:
                $this->h ^= ord($this->remainingBytes[1]) << 8;
            case 1:
                $this->h ^= ord($this->remainingBytes[0]);
                $this->h = ($this->h * static::M) & static::MAX_INT;
                $this->remainingBytes = "";
        }

        // Do a few final mixes of the hash to ensure the last few bytes are well incorporated
        $this->h ^= $this->h >> 13;
        $this->h = ($this->h * static::M) & static::MAX_INT;
        $this->h ^= $this->h >> 15;

        return $this->h;
    }

    /**
     * Mix the given values
     * @param int $h
     * @param int $k
     * @return int
     * @noinspection SpellCheckingInspection
     */
    protected function mmix(int $h, int $k): int
    {
        $k = ($k * static::M) & static::MAX_INT;
        $k ^= $k >> static::R;
        $k = ($k * static::M) & static::MAX_INT;
        $h = ($h * static::M) & static::MAX_INT;
        $h ^= $k;
        return $h;
    }
}

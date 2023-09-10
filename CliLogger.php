<?php
declare(strict_types=1);

namespace Logger;

use Logger\Contract\Logger;

use function fwrite;
use function str_replace;
use function strtoupper;

use const STDERR;
use const STDOUT;

final class CliLogger implements Logger
{
    public function emergency(string $message): void
    {
        $this->log(__FUNCTION__, $message, true);
    }

    public function alert(string $message): void
    {
        $this->log(__FUNCTION__, $message, true);
    }

    public function critical(string $message): void
    {
        $this->log(__FUNCTION__, $message, true);
    }

    public function error(string $message): void
    {
        $this->log(__FUNCTION__, $message, true);
    }

    public function warning(string $message): void
    {
        $this->log(__FUNCTION__, $message, true);
    }

    public function notice(string $message): void
    {
        $this->log(__FUNCTION__, $message);
    }

    public function info(string $message): void
    {
        $this->log(__FUNCTION__, $message);
    }

    public function debug(string $message): void
    {
        $this->log(__FUNCTION__, $message);
    }

    private function log(string $level, string $message, bool $stderr = false): void
    {
        $message = str_replace("\x00", ' ', $message);
        if ($level !== 'info') {
            $message = strtoupper($level) . ': ' . $message;
        }

        fwrite($stderr ? STDERR : STDOUT, $message . "\n");
    }
}

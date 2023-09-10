<?php
declare(strict_types=1);

namespace Logger;

use Logger\Contract\Logger;

use function error_log;
use function str_replace;
use function strtoupper;

final class SystemLogger implements Logger
{
    public function emergency(string $message): void
    {
        $this->log(__FUNCTION__, $message);
    }

    public function alert(string $message): void
    {
        $this->log(__FUNCTION__, $message);
    }

    public function critical(string $message): void
    {
        $this->log(__FUNCTION__, $message);
    }

    public function error(string $message): void
    {
        $this->log(__FUNCTION__, $message);
    }

    public function warning(string $message): void
    {
        $this->log(__FUNCTION__, $message);
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

    private function log(string $level, string $message): void
    {
        $message = str_replace("\x00", ' ', $message);

        error_log('[' . strtoupper($level) . '] ' . $message, 0);
    }
}

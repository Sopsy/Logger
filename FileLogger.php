<?php
declare(strict_types=1);

namespace Logger;

use HttpMessage\Contract\Request;
use Logger\Contract\Logger;

use function date;
use function error_log;
use function fclose;
use function fopen;
use function fwrite;
use function is_dir;
use function mkdir;
use function str_replace;
use function strtoupper;

final class FileLogger implements Logger
{
    public function __construct(
        private readonly Request $request,
        private readonly string $logDir
    ) {
    }

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

        $ip = $this->request->serverParam('REMOTE_ADDR');
        $ua = $this->request->serverParam('HTTP_USER_AGENT');
        $req = "{$this->request->method()} {$this->request->uri()}";
        $errorText = "[" . date('c') . "] {$ip} - {$req} - {$ua} - {$message}";

        if (!is_dir($this->logDir) && !mkdir($this->logDir, 0770, true) && !is_dir($this->logDir)) {
            // Fallback to error_log
            error_log(strtoupper($level) . ': ' . $errorText, 0);

            return;
        }

        $file = "{$this->logDir}/{$level}.log";
        $fp = fopen($file, 'ab');
        if ($fp === false) {
            // Fallback to error_log
            error_log(strtoupper($level) . ': ' . $errorText, 0);

            return;
        }

        fwrite($fp, $errorText . "\n");
        fclose($fp);
    }
}

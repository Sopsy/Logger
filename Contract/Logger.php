<?php
declare(strict_types=1);

namespace Logger\Contract;

interface Logger
{
    /**
     * System is unusable.
     *
     * @param string $message
     * @return void
     */
    public function emergency(string $message): void;

    /**
     * Action must be taken immediately.
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @return void
     */
    public function alert(string $message): void;

    /**
     * Critical conditions.
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @return void
     */
    public function critical(string $message): void;

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @return void
     */
    public function error(string $message): void;

    /**
     * Exceptional occurrences that are not errors.
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @return void
     */
    public function warning(string $message): void;

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @return void
     */
    public function notice(string $message): void;

    /**
     * Interesting events.
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @return void
     */
    public function info(string $message): void;

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @return void
     */
    public function debug(string $message): void;
}
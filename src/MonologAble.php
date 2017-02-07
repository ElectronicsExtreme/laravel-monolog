<?php

namespace ElectronicsExtreme\LaravelMonolog;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

trait MonologAble
{
    /**
     * Logger instance.
     *
     * @var Logger
     */
    private $logger;

    /**
     * Adds a log record at SPECIFIED level.
     *
     * @param  string $level
     * @param  array  $context
     *
     * @return bool
     */
    private function saveLog($level, array $context)
    {
        if (! $this->logger instanceof Logger) {
            $this->logger = $this->createLogger();
        }

        return $this->logger->$level($level, $this->addLoggerTrack($context));
    }

    /**
     * Create a new logger with handlers.
     *
     * @return Logger
     */
    private function createLogger()
    {
        return new Logger($this->getLoggerName(), $this->createLoggerHandlers());
    }

    /**
     * Generate logger name from self class name.
     *
     * @return string
     */
    private function getLoggerName()
    {
        return snake_case(class_basename(self::class));
    }

    /**
     * Create new handlers with separate file location.
     *
     * @return array
     */
    private function createLoggerHandlers()
    {
        $formatter = $this->getLoggerFormatter();

        return [
            (new StreamHandler($this->getLoggerStoragePath('debug'), Logger::DEBUG))->setFormatter($formatter),
            (new StreamHandler($this->getLoggerStoragePath('info'), Logger::INFO))->setFormatter($formatter),
            (new StreamHandler($this->getLoggerStoragePath('notice'), Logger::NOTICE))->setFormatter($formatter),
            (new StreamHandler($this->getLoggerStoragePath('warning'), Logger::WARNING))->setFormatter($formatter),
            (new StreamHandler($this->getLoggerStoragePath('error'), Logger::ERROR))->setFormatter($formatter),
            (new StreamHandler($this->getLoggerStoragePath('critical'), Logger::CRITICAL))->setFormatter($formatter),
            (new StreamHandler($this->getLoggerStoragePath('alert'), Logger::ALERT))->setFormatter($formatter),
            (new StreamHandler($this->getLoggerStoragePath('emergency'), Logger::EMERGENCY))->setFormatter($formatter),
        ];
    }

    /**
     * Get logger formatter.
     *
     * @return LineFormatter
     */
    private function getLoggerFormatter()
    {
        return new LineFormatter(null, null, false, true);
    }

    /**
     * Generate logger absolute storage path from self class name and level.
     *
     * @param  string $level
     *
     * @return string
     */
    private function getLoggerStoragePath($level)
    {
        $sectors = array_merge(['logs'], array_map('snake_case', explode('\\', self::class)));
        $path = sprintf('%s-%s.log', implode(DIRECTORY_SEPARATOR, $sectors), $level);

        return storage_path($path);
    }

    /**
     * Prepend track data to log.
     *
     * @param  array $context
     *
     * @return array
     */
    private function addLoggerTrack(array $context)
    {
        return array_merge(['track' => config('runtime.track', base_convert(microtime(false), 10, 36))], $context);
    }

    /**
     * Adds a log record at the DEBUG level.
     *
     * @param  array  $context
     *
     * @return bool
     */
    protected function debugLog(array $context)
    {
        return $this->saveLog('debug', $context);
    }

    /**
     * Adds a log record at the INFO level.
     *
     * @param  array  $context
     *
     * @return bool
     */
    protected function infoLog(array $context)
    {
        return $this->saveLog('info', $context);
    }

    /**
     * Adds a log record at the NOTICE level.
     *
     * @param  array  $context
     *
     * @return bool
     */
    protected function noticeLog(array $context)
    {
        return $this->saveLog('notice', $context);
    }

    /**
     * Adds a log record at the WARNING level.
     *
     * @param  array  $context
     *
     * @return bool
     */
    protected function warningLog(array $context)
    {
        return $this->saveLog('warning', $context);
    }

    /**
     * Adds a log record at the ERROR level.
     *
     * @param  array  $context
     *
     * @return bool
     */
    protected function errorLog(array $context)
    {
        return $this->saveLog('error', $context);
    }

    /**
     * Adds a log record at the CRITICAL level.
     *
     * @param  array  $context
     *
     * @return bool
     */
    protected function criticalLog(array $context)
    {
        return $this->saveLog('critical', $context);
    }

    /**
     * Adds a log record at the ALERT level.
     *
     * @param  array  $context
     *
     * @return bool
     */
    protected function alertLog(array $context)
    {
        return $this->saveLog('alert', $context);
    }

    /**
     * Adds a log record at the EMERGENCY level.
     *
     * @param  array  $context
     *
     * @return bool
     */
    protected function emergencyLog(array $context)
    {
        return $this->saveLog('emergency', $context);
    }
}

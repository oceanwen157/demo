<?php

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

function getLogger(string $name = ''): Logger
{
    static $loggers;

    if (empty($name)) {
        $name = 'debug';
    }

    if (!isset($loggers[$name])) {
        $logfile = storage_path() . "/logs/{$name}.log";
        @chmod($logfile, 0766);

        //设置日期格式
        $dateFormat = "Y-m-d H:i:s.u";
        $formatter = new LineFormatter(null, $dateFormat);
        $handler = new RotatingFileHandler($logfile, 10, Logger::INFO);
        $handler->setFormatter($formatter);

        $logger = new Logger($name);
        $logger->pushHandler($handler);
        $loggers[$name] = $logger;

        unset($formatter, $handler);
    }
    return $loggers[$name];
}

/**
 * 记录异常日志
 * @param mixed $e Exception或字符串
 */
function logException($e = null): void
{
    if (!empty($e)) {
        if (is_string($e)) {
            getLogger('exception')->warning($e);
        } elseif ($e instanceof Throwable) {
            $msg = $e->getMessage() . ' ##code:' . $e->getCode() . ' ##file:' . $e->getFile() . ' ##line:' . $e->getLine();
            getLogger('exception')->error($msg, $e->getTrace());
        }
    }
}

/**
 * 记录调试信息
 * @param string $msg
 * @param array $arr
 */
function logInfo(string $msg, array $arr = []): void
{
    getLogger('')->info($msg, $arr);
}

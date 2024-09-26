<?php
namespace App\Utils;

class TimerUtil {
    private static $startTimes = [];
    private static $measurements = [];

    public static function start($label) {
        self::$startTimes[$label] = microtime(true);
    }

    public static function stop($label) {
        if (!isset(self::$startTimes[$label])) {
            return;
        }
        $endTime = microtime(true);
        $duration = $endTime - self::$startTimes[$label];
        if (!isset(self::$measurements[$label])) {
            self::$measurements[$label] = [];
        }
        self::$measurements[$label][] = $duration;
        unset(self::$startTimes[$label]);
    }

    public static function getAverageDuration($label) {
        if (!isset(self::$measurements[$label]) || empty(self::$measurements[$label])) {
            return 0;
        }
        return array_sum(self::$measurements[$label]) / count(self::$measurements[$label]);
    }

    public static function getTotalDuration($label) {
        if (!isset(self::$measurements[$label])) {
            return 0;
        }
        return array_sum(self::$measurements[$label]);
    }

    public static function getCallCount($label) {
        return isset(self::$measurements[$label]) ? count(self::$measurements[$label]) : 0;
    }

    public static function getAllMeasurements() {
        $result = [];
        foreach (self::$measurements as $label => $durations) {
            $result[$label] = [
                'average' => self::getAverageDuration($label),
                'total' => self::getTotalDuration($label),
                'count' => self::getCallCount($label)
            ];
        }
        return $result;
    }
}
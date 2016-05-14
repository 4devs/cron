<?php

namespace FDevs\Cron\Model;

class Time
{
    const FORMAT = '%-4s %-4s %-4s %-4s %-4s';
    const WILDCARD = '*';

    /**
     * @var string
     */
    protected $minute = self::WILDCARD;

    /**
     * @var string
     */
    protected $hour = self::WILDCARD;

    /**
     * @var string
     */
    protected $day = self::WILDCARD;

    /**
     * @var string
     */
    protected $month = self::WILDCARD;

    /**
     * @var string
     */
    protected $dayOfWeek = self::WILDCARD;

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return sprintf(self::FORMAT, $this->minute, $this->hour, $this->day, $this->month, $this->dayOfWeek);
    }

    /**
     * @return string
     */
    public function getMinute()
    {
        return $this->minute;
    }

    /**
     * @param string $minute
     *
     * @return Time
     */
    public function setMinute($minute)
    {
        $this->minute = $minute;

        return $this;
    }

    /**
     * @return string
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * @param string $hour
     *
     * @return Time
     */
    public function setHour($hour)
    {
        $this->hour = $hour;

        return $this;
    }

    /**
     * @return string
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param string $day
     *
     * @return Time
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * @return string
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @param string $month
     *
     * @return Time
     */
    public function setMonth($month)
    {
        $this->month = $month;

        return $this;
    }

    /**
     * @return string
     */
    public function getDayOfWeek()
    {
        return $this->dayOfWeek;
    }

    /**
     * @param string $dayOfWeek
     *
     * @return Time
     */
    public function setDayOfWeek($dayOfWeek)
    {
        $this->dayOfWeek = $dayOfWeek;

        return $this;
    }
}

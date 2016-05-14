<?php

namespace FDevs\Cron\Model;

class Job
{
    /**
     * @var Time
     */
    protected $time;

    /**
     * @var string
     */
    protected $command;

    /**
     * @var Output
     */
    protected $output;

    /**
     * Job constructor.
     *
     * @param Time   $time
     * @param string $command
     * @param Output $output
     */
    public function __construct($command, Time $time = null, Output $output = null)
    {
        $this->command = $command;
        $this->time = $time ?: new Time();
        $this->output = $output ?: new Output();
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->time.' '.trim($this->command).' '.$this->output;
    }

    /**
     * @return Time
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param Time $time
     *
     * @return Job
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * @return string
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @param string $command
     *
     * @return Job
     */
    public function setCommand($command)
    {
        $this->command = $command;

        return $this;
    }

    /**
     * @return Output
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * @param Output $output
     *
     * @return Job
     */
    public function setOutput($output)
    {
        $this->output = $output;

        return $this;
    }
}

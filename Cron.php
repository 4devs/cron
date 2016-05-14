<?php

namespace FDevs\Cron;

use FDevs\Cron\Model\Job;

class Cron
{
    const HEADER_PATH = 'PATH';
    const HEADER_MAILTO = 'MAILTO';
    const HEADER_HOME = 'HOME';
    const HEADER_SHELL = 'SHELL';
    const HEADER_CONTENT_TYPE = 'CONTENT_TYPE';
    const HEADER_CONTENT_TRANSFER_ENCODING = 'CONTENT_TRANSFER_ENCODING';

    /**
     * @var array
     */
    protected $header = [];

    /**
     * @var array|Job[]
     */
    protected $jobList = [];

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        $cron = '';
        foreach ($this->header as $name => $value) {
            $cron .= sprintf('%s=%s', $name, $value).PHP_EOL;
        }
        foreach ($this->jobList as $job) {
            $cron .= strval($job).PHP_EOL;
        }

        return $cron;
    }

    /**
     * @return array
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @param array $header
     *
     * @return Cron
     */
    public function setHeader(array $header)
    {
        $this->header = [];
        foreach ($header as $key => $value) {
            $this->addHeader($key, $value);
        }

        return $this;
    }

    /**
     * @param string $name
     * @param string $value
     *
     * @return $this
     */
    public function addHeader($name, $value)
    {
        $this->header[$name] = $value;

        return $this;
    }

    /**
     * @return array|Job[]
     */
    public function getJobList()
    {
        return $this->jobList;
    }

    /**
     * @param array|Job[] $jobList
     *
     * @return Cron
     */
    public function setJobList($jobList)
    {
        $this->jobList = [];
        foreach ($jobList as $job) {
            $this->addJob($job);
        }

        return $this;
    }

    /**
     * @param Job $job
     *
     * @return $this
     */
    public function addJob(Job $job)
    {
        $this->jobList[] = $job;

        return $this;
    }
}

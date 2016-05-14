<?php

namespace FDevs\Cron\Model;

class Output
{
    /**
     * @var string
     */
    protected $outFile = '> /dev/null';

    /**
     * @var string
     */
    protected $errFile = '2> /dev/null';

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->outFile.' '.$this->errFile;
    }

    /**
     * @return string
     */
    public function getOutFile()
    {
        return trim(strstr(' ', $this->outFile));
    }

    /**
     * @param string $outFile
     * @param bool   $append append or rewrite log file
     *
     * @return Output
     */
    public function setOutFile($outFile, $append = true)
    {
        $this->outFile = ($append ? '>> ' : '> ').$outFile;

        return $this;
    }

    /**
     * @return string
     */
    public function getErrFile()
    {
        return trim(strstr(' ', $this->errFile));
    }

    /**
     * @param string $errFile
     * @param bool   $append append or rewrite log file
     *
     * @return Output
     */
    public function setErrFile($errFile, $append = true)
    {
        $this->errFile = ($append ? '>> ' : '> ').$errFile;

        return $this;
    }
}

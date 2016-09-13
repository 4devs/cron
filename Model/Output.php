<?php

namespace FDevs\Cron\Model;

class Output
{
    /**
     * @var string
     */
    protected $outFile = '/dev/null';

    /**
     * @var bool
     */
    protected $appendOutFile = false;

    /**
     * @var string
     */
    protected $errFile = '/dev/null';

    /**
     * @var bool
     */
    protected $appendErrFile = false;

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return sprintf(
            '%s %s %s %s',
            $this->appendOutFile ? '>>' : '>',
            $this->outFile,
            $this->appendErrFile ? '2>>' : '2>',
            $this->errFile
        );
    }

    /**
     * @return string
     */
    public function getOutFile()
    {
        return $this->outFile;
    }

    /**
     * @param string $outFile
     * @param bool   $append  append or rewrite log file
     *
     * @return Output
     */
    public function setOutFile($outFile, $append = true)
    {
        $this->outFile = $outFile;
        $this->appendOutFile = $append;

        return $this;
    }

    /**
     * @return string
     */
    public function getErrFile()
    {
        return $this->errFile;
    }

    /**
     * @param string $errFile
     * @param bool   $append  append or rewrite log file
     *
     * @return Output
     */
    public function setErrFile($errFile, $append = true)
    {
        $this->errFile = $errFile;
        $this->appendErrFile = $append;

        return $this;
    }
}

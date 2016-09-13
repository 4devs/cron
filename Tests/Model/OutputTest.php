<?php

namespace Fdevs\Cron\Tests\Model;

use FDevs\Cron\Model\Output;
use PHPUnit\Framework\TestCase;

class OutputTest extends TestCase
{
    /**
     * @var Output
     */
    private $output;

    public function testByDefaultOutputShouldBeTargetedToDevNull()
    {
        $this->assertEquals('/dev/null', $this->output->getOutFile());
        $this->assertEquals('/dev/null', $this->output->getErrFile());
        $this->assertEquals('> /dev/null 2> /dev/null', $this->output->__toString());
    }

    /**
     * @return array
     */
    public function getToStringProvider()
    {
        return [
            // log path, log append, error path, error append, expected result
            ['log.txt', false, 'error.txt', false, '> log.txt 2> error.txt'],
            ['log.txt', true, 'error.txt', false, '>> log.txt 2> error.txt'],
            ['log.txt', false, 'error.txt', true, '> log.txt 2>> error.txt'],
            ['log.txt', true, 'error.txt', true, '>> log.txt 2>> error.txt'],
        ];
    }

    public function testSetOutFileShouldReturnSelf()
    {
        $this->assertEquals($this->output, $this->output->setOutFile('test.txt'));
    }

    public function testGetAndSetOutFileShouldWorkTogether()
    {
        $file = 'test.txt';
        $this->output->setOutFile($file);
        $this->assertEquals($file, $this->output->getOutFile());
    }

    public function testSetErrFileShouldReturnSelf()
    {
        $this->assertEquals($this->output, $this->output->setErrFile('test.txt'));
    }

    public function testGetAndSetErrFileShouldWorkTogether()
    {
        $file = 'test.txt';
        $this->output->setErrFile($file);
        $this->assertEquals($file, $this->output->getErrFile());
    }

    /**
     * @dataProvider getToStringProvider
     *
     * @param string $outputFile
     * @param bool   $appendOutput
     * @param string $errorFile
     * @param bool   $appendErrors
     * @param string $expectedString
     */
    public function testToStringShouldHonorConfiguredValues($outputFile, $appendOutput, $errorFile, $appendErrors, $expectedString)
    {
        $this->assertInternalType('string', $this->output->__toString());

        $this->output->setOutFile($outputFile, $appendOutput);
        $this->output->setErrFile($errorFile, $appendErrors);

        $this->assertEquals($expectedString, $this->output->__toString());
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->output = new Output();
    }
}

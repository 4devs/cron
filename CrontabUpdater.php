<?php

namespace FDevs\Cron;

use Symfony\Component\Process\Process;

class CrontabUpdater
{
    const KEY_BEGIN = '# FDEVS_START %s';
    const KEY_END = '# FDEVS_END %s';
    const COMMAND = 'crontab';

    /**
     * @var string
     */
    private $key;

    /**
     * CronUpdater constructor.
     *
     * @param string $key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param Cron $cron
     *
     * @return bool
     */
    public function update(Cron $cron)
    {
        return $this->run(strval($cron));
    }

    /**
     * @return bool
     */
    public function delete()
    {
        return $this->run('');
    }

    /**
     * @param string $content
     *
     * @return bool
     */
    private function run($content)
    {
        $process = new Process(self::COMMAND.' -l');
        $process->run();

        $filePath = tempnam(sys_get_temp_dir(), 'cron');
        file_put_contents($filePath, $this->prepareContent($content, $process->getOutput()));
        $process = new Process(self::COMMAND.' '.$filePath);
        $process->run();

        return $process->isSuccessful();
    }

    /**
     * @param string $cron
     * @param string $content
     *
     * @return mixed|string
     */
    private function prepareContent($cron, $content)
    {
        $keyBegin = sprintf(self::KEY_BEGIN, $this->key);
        $keyEnd = sprintf(self::KEY_END, $this->key);
        $pattern = '/\r?\n'.sprintf(self::KEY_BEGIN, $this->key).PHP_EOL.'.*?'.sprintf(self::KEY_END, $this->key).'/s';
        $cron = PHP_EOL.$keyBegin.PHP_EOL.$cron.PHP_EOL.$keyEnd.PHP_EOL;

        $replacedContent = preg_replace($pattern, $cron, $content, -1, $count);

        return $count > 0 ? $replacedContent : $content.$cron;
    }
}

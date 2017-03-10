<?php

namespace DBSync\Commands;

use Symfony\Component\Yaml\Yaml;

class Command extends AbstractCommand
{

    /**
     * @var string
     */
    protected $config_file_name = 'dbsync.yml';

    /**
     * @var array
     */
    protected $config = [];

    protected function selectDB($question)
    {
        $environments_list = [];
        $environments_by_host = [];

        foreach ($this->config['environments'] as $name => $config) {
            $environments_list[] = $name;
            $environments_by_host[$name] = $config;
        }

        $environment_host = $this->choiceQuestion("$question\n", $environments_list);

        return $environments_by_host[$environment_host];
    }

    protected function dir_root()
    {
        return realpath(getcwd());
    }

    protected function checkConfigFile()
    {
        $file = $this->getConfigFile();
        if (file_exists($file)) {
            $this->config = Yaml::parse(file_get_contents($file));
            return $file;
        }
        return false;
    }

    protected function getConfigFile()
    {
        return $this->dir_root() . '/' . $this->config_file_name;
    }

    protected function getPath($name)
    {
        if (!isset($this->config['paths'][$name])) {
            $this->error("No esta definido el path $name");
            die;
        }
        $path = $this->dir_root() . '/' . $this->config['paths'][$name] . '/';
        $path = str_replace('//', '/', $path);
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        return $path;
    }

    protected function getConfigDefault()
    {
        return __DIR__ . '/../app/db.yml';
    }

    protected function fire()
    {

    }


}
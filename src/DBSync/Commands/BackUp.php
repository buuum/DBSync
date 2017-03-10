<?php

namespace DBSync\Commands;

class BackUp extends Command
{

    protected function configure()
    {
        $this
            ->setName('backup')
            ->setDescription('backup your database struct and data');
    }

    protected function fire()
    {
        if (!$this->checkConfigFile()) {
            $this->error("No has inicializado el archivo de configuración. Ejecuta el comando init");
            return;
        }

        $config_environment = $this->selectDB('¿De que base de datos quieres hacer el backup?');
        $backup = new \Buuum\Backup($config_environment['host'], $config_environment['username'],
            $config_environment['password'], $config_environment['database']);
        $backup->backup();
        $backup->save(time() . '_' . $config_environment['database'], substr($this->getPath('backup'), 0, -1));
        $this->success('Backup realizado correctamente.');
    }

}
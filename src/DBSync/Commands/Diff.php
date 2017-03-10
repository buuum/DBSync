<?php

namespace DBSync\Commands;

use Buuum\Backup;
use Buuum\StructDiff;

class Diff extends Command
{

    protected function configure()
    {
        $this
            ->setName('diff')
            ->setDescription('synch changes bewteen db');
    }

    protected function fire()
    {
        if (!$this->checkConfigFile()) {
            $this->error("No has inicializado el archivo de configuración. Ejecuta el comando init");
            return;
        }

        $option = $this->selectOption();

        $this->$option();

    }

    protected function selectOption()
    {
        $functions = [
            'viewchanges' => 'ver cambios entre DB',
            //'syncchanges' => 'subir cambios entr DB'
        ];

        $question = $this->choiceQuestion('Selecciona la acción a realizar.', array_values($functions));
        return array_search($question, $functions);
    }

    protected function viewchanges()
    {
        $config_base = $this->selectDB('¿Que base de datos quieres coger como base?');
        $config_remote = $this->selectDB('¿Con que base datos quieres comparar?');

        $backup = new Backup($config_base['host'], $config_base['username'],
            $config_base['password'], $config_base['database']);
        $backup->backup('*', true, false);
        $backup->save('_tmp_local', $this->getPath('migrations'));

        $db_connection = new Backup($config_remote['host'], $config_remote['username'],
            $config_remote['password'], $config_remote['database']);
        $db_connection->backup('*', true, false);
        $db_connection->save('_tmp_remote', $this->getPath('migrations'));

        $local = file_get_contents($this->getPath('migrations') . '_tmp_local.sql');
        $remote = file_get_contents($this->getPath('migrations') . '_tmp_remote.sql');

        $differ = new StructDiff($local, $remote);
        $diffs_up = $differ->getUpdates();

        if (!empty($diffs_up)) {
            $this->success("Cambios a realizar:\n");
            foreach ($diffs_up as $diff) {
                $this->comment($diff);
            }
        } else {
            $this->success('Las estructuras de las bbdds son iguales.');
        }

        unlink($this->getPath('migrations') . '_tmp_local.sql');
        unlink($this->getPath('migrations') . '_tmp_remote.sql');

        return $diffs_up;
    }
}
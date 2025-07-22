<?php

namespace Core;

use PDO;
use PDOException;

class Database
{
    private $db;

    public function __construct($config)
    {
        try {
            $dsn = $this->getDsn($config);
            $user = $config['user'] ?? null;
            $password = $config['password'] ?? null;

            $this->db = new PDO(
                $dsn,
                $user,
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]
            );
        } catch (PDOException $e) {
            exit('Erro de conexão com o banco de dados: '.$e->getMessage());
        }
    }

    private function getDsn($config)
    {
        $driver = $config['driver'];

        // Lógica específica para PostgreSQL
        if ($driver === 'postgres') {
            $dsnParts = [];
            if (isset($config['host'])) {
                $dsnParts[] = "host={$config['host']}";
            }
            if (isset($config['port'])) {
                $dsnParts[] = "port={$config['port']}";
            }
            if (isset($config['dbname'])) {
                $dsnParts[] = "dbname={$config['dbname']}";
            }

            return 'pgsql:'.implode(';', $dsnParts);
        } elseif ($driver === 'sqlite') {
            return 'sqlite:'.$config['database'];
        } else {
            unset($config['driver']);

            return $driver.':'.http_build_query($config, '', ';');
        }
    }

    public function query($query, $class = null, $params = [])
    {
        $prepare = $this->db->prepare($query);

        if ($class) {
            $prepare->setFetchMode(PDO::FETCH_CLASS, $class);
        }

        $prepare->execute($params);

        return $prepare;
    }
}

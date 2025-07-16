<?php
namespace Core;
use PDO;

class Database
{
    private $db;

    public function __construct($config)
    {
        $this->db = new PDO($this->getDsn($config));
    }

    private function getDsn($config)
    {
        $driver = $config['driver'];

        unset($config['driver']);

        $dsn = $driver . ":" . http_build_query($config, '', ';');

        if ($driver == 'sqlite') {

            $dsn = $driver . ":" . $config['database'];
        }

        return $dsn;
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

    // public function getAllBooks($search = '')
    // {

    //     $strCleaner = strToLower($search);
    //     $sql = "SELECT * FROM books
    //                  WHERE LOWER(`title`) like :search";
    //     $prepare = $this->db->prepare($sql);
    //     $prepare->bindValue(':search', "%$strCleaner%");
    //     $prepare->setFetchMode(PDO::FETCH_CLASS, Book::class);
    //     $prepare->execute();
    //     return $prepare->fetchAll();

    //     //return array_map(fn($item) => Book::make($item), $items);
    // }

    // public function getBook($id)
    // {

    //     $prepare = $this->db->prepare("SELECT * FROM books where id = :id");
    //     $prepare->bindParam('id', $id);
    //     $prepare->setFetchMode(PDO::FETCH_CLASS, Book::class);
    //     $prepare->execute();
    //     return $prepare->fetch();

    //     // $book = Book::make($item);

    //     // return $book;
    // }
}

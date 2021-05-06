<?php
declare(strict_types=1);

abstract class Model
{
    protected PDO $_instance;
    protected string $table;

    public function __construct() {
        try { $this->_instance = new PDO('mysql:host=localhost;dbname=rapide_plombier;charset=utf8',
                'root',
                'root',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete(int $id): void {
        try {
            $query = $this->_instance->prepare("Delete from {$this->table} where id = :id");
            $query->execute([':id' => $id]);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
    }
}
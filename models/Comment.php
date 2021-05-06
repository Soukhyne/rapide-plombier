<?php
declare(strict_types=1);
require_once 'Model.php';

class Comment extends Model
{
    protected string $table = 'comments';

    //return all comments
    public function findAll(): array {
        try {
            $query = $this->_instance->query("SELECT id, name, comment, date FROM {$this->table}");
            $res = $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
        return !$res ? [] : $res;
    }

    public function findAllDesc(): array {
        try {
            $query = $this->_instance->query("SELECT id, name, comment, date FROM {$this->table} ORDER BY date DESC");
            $res = $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
        return !$res ? [] : $res;
    }
    
    //insert new comment
    public function insertComment(string $lastName, string $comment, string $date): void {
        try {
            $query = $this->_instance->prepare("INSERT INTO `comments`(`name`, `comment`, `date`) VALUES (:name,:comment, NOW())");
            $query->execute(
                [
                    ':name' => $lastName,
                    ':comment' => $comment
                ]
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
    }
}
<?php
declare(strict_types=1);
require_once 'Model.php';

class User extends Model
{
    protected string $table = 'users';

    public function auth(string $userName, string $password): array {
        try {
            $query = $this->_instance->prepare("SELECT id, name, password, email FROM {$this->table} WHERE name = :name");
            $query->execute([':name' => $userName]);
            $user = $query->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
        return !$user ? [] : $user;
    }

    public function changePassword(string $id, string $password): void {
        try {
            $query = $this->_instance->prepare("UPDATE {$this->table} SET `password`=:password WHERE `id` = :id");
            $query->execute(
                [
                ':password' => password_hash($password, PASSWORD_DEFAULT),
                ':id' => $id
                ]
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
    }
    
    public function changeEmail(string $id, string $email): void {
        try {
            $query = $this->_instance->prepare("UPDATE {$this->table} SET `email`=:email WHERE `id` = :id");
            $query->execute(
                [
                ':email' => $email,
                ':id' => $id
                ]
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
    }

    public function changeUser(string $id, string $password, string $email): void {
        try {
            $query = $this->_instance->prepare("UPDATE {$this->table} SET `password`=:password, `email`=:email WHERE `id` = :id");
            $query->execute(
                [
                ':password' => password_hash($password, PASSWORD_DEFAULT), 
                ':email' => $email,
                ':id' => $id
                ]
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
    }
}
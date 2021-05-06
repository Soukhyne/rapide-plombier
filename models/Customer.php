<?php
declare(strict_types=1);
require_once 'Model.php';

class Customer extends Model
{
    protected string $table = 'customers';

    // find a customer by email
    public function findByEmail(string $email): array {
        try {
            $query = $this->_instance->prepare("SELECT id, lastname, firstname, email, phone FROM {$this->table} WHERE email = :email ");
            $query->execute([':email' => $email]);
            $res = $query->fetch();
            if ($res == false) {
                $res = [];
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
        return !$res ? [] : $res;
    }

    // find customers by lastname
    public function findByName(string $lastname): array {
        try {
            $query = $this->_instance->prepare("SELECT id, lastname, firstname, email, phone FROM {$this->table} WHERE lastname LIKE :lastname ");
            $query->execute([':lastname' => "%$lastname%"]);
            $res = $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
        return !$res ? [] : $res;
    }
    
    //insert new customer
    public function insertCustomer(string $lastName, string $firstname, string $email, string $phone): void {
        try {
            $query = $this->_instance->prepare("INSERT INTO {$this->table} (`lastname`, `firstname`, `email`, `phone`) VALUES (:lastname,:firstname, :email, :phone)");
            $query->execute(
                [
                    ':lastname' => $lastName,
                    ':firstname' => $firstname,
                    ':email' => $email,                    
                    ':phone' => $phone
                ]
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
    }

    //update email adress
    public function updateEmail(int $id, string $email): void {
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

    //update email adress without JS
    public function updateEmailNoJS(string $lastname, string $email): void {
        try {
            $query = $this->_instance->prepare("UPDATE {$this->table} SET `email`=:email WHERE `lastname` = :lastname");
            $query->execute(
                [
                ':email' => $email,
                ':lastname' => $lastname
                ]
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
    }

    //update phone
    public function updatePhone(int $id, string $phone): void {
        try {
            $query = $this->_instance->prepare("UPDATE {$this->table} SET `phone`=:phone WHERE `id` = :id");
            $query->execute(
                [
                ':phone' => $phone,
                ':id' => $id
                ]
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
    }

    //update phone without JS
    public function updatePhonenoJS(string $lastname, string $phone): void {
        try {
            $query = $this->_instance->prepare("UPDATE {$this->table} SET `phone`=:phone WHERE `lastname` = :lastname");
            $query->execute(
                [
                ':phone' => $phone,
                ':lastname' => $lastname
                ]
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
    }
}
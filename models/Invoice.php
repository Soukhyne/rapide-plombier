<?php
declare(strict_types=1);
require_once 'Model.php';

class Invoice extends Model
{
    protected string $table = 'invoices';

    //return latest invoices
    public function findLatest(): array {
        try {
            $query = $this->_instance->query("SELECT date, lastname, firstname FROM customers INNER JOIN {$this->table} ON id = customerId ORDER BY date DESC LIMIT 0,5");
            $res = $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
        return !$res ? [] : $res;
    }

    //return all invoices
    public function findAll(): array {
        try {
            $query = $this->_instance->query("SELECT date, lastname, firstname FROM customers INNER JOIN {$this->table} ON id = customerId ORDER BY date DESC");
            $res = $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
        return !$res ? [] : $res;
    }

    //find Invoice number
    public function findInvoices(string $name): array {
        try {
            $query = $this->_instance->prepare("SELECT idInvoice, lastname, firstname FROM {$this->table}, customers WHERE {$this->table}.customerId = customers.id AND lastname LIKE :lastname");
            $query->execute([':lastname' => "%$name%"]);
            $res = $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
        return !$res ? [] : $res;
    }

    // find customer by invoice Number
    public function customerInformations(int $invoiceNumber): array {
        try {
            $query = $this->_instance->prepare("SELECT lastname, firstname, email, phone, date FROM customers INNER JOIN {$this->table} ON id = customerId WHERE idInvoice = :id ");
            $query->execute([':id' => $invoiceNumber]);
            $res = $query->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
        return !$res ? [] : $res;
    }

    // find invoice by invoice Number
    public function invoiceInformations(int $invoiceNumber): array {
        try {
            $query = $this->_instance->prepare("SELECT productId, quantity, product, unitprice
            FROM invoicedetails 
            INNER JOIN {$this->table} ON {$this->table}.idInvoice = invoicedetails.id
            INNER JOIN pricing ON pricing.id = invoicedetails.productId
            WHERE idInvoice = :idInvoice ");
            $query->execute([':idInvoice' => $invoiceNumber]);
            $res = $query->fetchAll(); 
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
        return !$res ? [] : $res;
    }

    // find total amount / invoice by invoice Number
    public function total(int $invoiceNumber): array {
        try {
            $query = $this->_instance->prepare("SELECT SUM(unitprice*quantity) as total
            FROM invoicedetails 
            INNER JOIN {$this->table} ON {$this->table}.idInvoice = invoicedetails.id
            INNER JOIN pricing ON pricing.id = invoicedetails.productId
            WHERE idInvoice = :idInvoice ");
            $query->execute([':idInvoice' => $invoiceNumber]);
            $total = $query->fetch(); 
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
        return $total;
    }
}
<?php
namespace App\Seeders;

use App\Config\Database;

abstract class Seeder {
    protected $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    abstract public function run();

    protected function table($table) {
        return new class($this->db, $table) {
            private $db;
            private $table;
            private $data = [];

            public function __construct($db, $table) {
                $this->db = $db;
                $this->table = $table;
            }

            public function insert(array $data) {
                $this->data[] = $data;
                return $this;
            }

            public function execute() {
                if (empty($this->data)) {
                    return 0;
                }

                $columns = array_keys($this->data[0]);
                $placeholders = '(' . implode(', ', array_fill(0, count($columns), '?')) . ')';
                $sql = "INSERT INTO {$this->table} (" . implode(', ', $columns) . ") VALUES ";

                $allValues = [];
                $allPlaceholders = [];

                foreach ($this->data as $row) {
                    $allPlaceholders[] = $placeholders;
                    $allValues = array_merge($allValues, array_values($row));
                }

                $sql .= implode(', ', $allPlaceholders);

                $stmt = $this->db->prepare($sql);
                return $stmt->execute($allValues) ? count($this->data) : 0;
            }
        };
    }
}
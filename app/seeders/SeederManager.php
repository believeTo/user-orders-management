<?php
namespace App\Seeders;

class SeederManager {
    private $seeders = [
        UserSeeder::class,
        OrderSeeder::class
    ];

    public function run() {
        $results = [];

        foreach ($this->seeders as $seederClass) {
            $seeder = new $seederClass();
            $count = $seeder->run();

            $seederName = $this->getSeederName($seederClass);
            $results[$seederName] = $count;

            if ($count > 0) {
                error_log("Seeder executed: {$seederName} - {$count} records");
            }
        }

        return $results;
    }

    public function refresh() {
        $db = \App\Config\Database::getInstance()->getConnection();

        $db->exec("SET FOREIGN_KEY_CHECKS = 0");
        $db->exec("TRUNCATE TABLE orders");
        $db->exec("TRUNCATE TABLE users");
        $db->exec("SET FOREIGN_KEY_CHECKS = 1");

        // Запускаем сидеры
        return $this->run();
    }

    private function getSeederName($className) {
        return basename(str_replace('\\', '/', $className), '.php');
    }

    public function getSeedersList() {
        return array_map([$this, 'getSeederName'], $this->seeders);
    }
}
<?php
namespace App\Cli;

class MigrateCommand extends Command {
    public function run($args = []) {
        $this->say("Создаем таблицы...");

        $db = $this->getDB();

        try {
            $db->exec("CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL
            )");
            $this->success("Таблица 'users' создана");

            $db->exec("CREATE TABLE IF NOT EXISTS orders (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(200) NOT NULL,
                cost DECIMAL(10,2) NOT NULL,
                user_id INT NOT NULL,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
            )");
            $this->success("Таблица 'orders' создана");

            $this->success("Все таблицы созданы успешно!");

        } catch (\Exception $e) {
            $this->error("Ошибка: " . $e->getMessage());
        }

        return 0;
    }
}
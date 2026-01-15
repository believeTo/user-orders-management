<?php
namespace App\Cli;

class SeedCommand extends Command {
    public function run($args = []) {
        $this->say("Заполняем базу данных...");

        try {
            $usersCount = $this->seedUsers();
            $ordersCount = $this->seedOrders();

            $this->success("Готово! Добавлено:");
            $this->say("  - {$usersCount} пользователей");
            $this->say("  - {$ordersCount} заказов");

        } catch (\Exception $e) {
            $this->error("Ошибка при заполнении данных: " . $e->getMessage());
        }

        return 0;
    }

    private function seedUsers() {
        $db = $this->getDB();

        $users = [
            'Иван Петров',
            'Мария Сидорова',
            'Алексей Иванов',
            'Елена Смирнова',
            'Дмитрий Кузнецов',
            'Ольга Васильева',
            'Сергей Попов',
            'Анна Федорова',
            'Павел Морозов',
            'Татьяна Новикова',
            'Андрей Соколов',
            'Наталья Козлова',
            'Виктор Лебедев',
            'Юлия Зайцева',
            'Михаил Павлов'
        ];

        $stmt = $db->prepare("INSERT INTO users (name) VALUES (?)");

        foreach ($users as $name) {
            $stmt->execute([$name]);
        }

        return count($users);
    }

    private function seedOrders() {
        $db = $this->getDB();

        $stmt = $db->prepare("INSERT INTO orders (title, cost, user_id) VALUES (?, ?, ?)");
        $added = 0;

        $productTypes = ['Ноутбук', 'Телефон', 'Наушники', 'Монитор', 'Клавиатура'];

        for ($i = 0; $i < 50; $i++) {
            $type = $productTypes[array_rand($productTypes)];
            $title = "{$type} #" . ($i + 1);
            $cost = rand(1000, 50000);
            $user_id = rand(1, 15);

            $stmt->execute([$title, $cost, $user_id]);
            $added++;
        }

        return $added;
    }
}
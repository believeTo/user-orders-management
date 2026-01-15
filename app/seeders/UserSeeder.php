<?php
namespace App\Seeders;

class UserSeeder extends Seeder {
    public function run() {
        $count = $this->db->query("SELECT COUNT(*) FROM users")->fetchColumn();

        if ($count > 0) {
            echo "Пользователи уже существуют, пропускаем...\n";
            return 0;
        }

        $users = [
            ['name' => 'Администратор', 'email' => 'admin@example.com'],
            ['name' => 'Иван Петров', 'email' => 'ivan.petrov@example.com'],
            ['name' => 'Мария Сидорова', 'email' => 'maria.sidorova@example.com'],
            ['name' => 'Алексей Иванов', 'email' => 'alexey.ivanov@example.com'],
            ['name' => 'Елена Смирнова', 'email' => 'elena.smirnova@example.com'],
            ['name' => 'Дмитрий Кузнецов', 'email' => 'dmitry.kuznetsov@example.com'],
            ['name' => 'Ольга Васильева', 'email' => 'olga.vasilyeva@example.com'],
            ['name' => 'Сергей Алферов', 'email' => 'sergey.alferov@example.com'],
            ['name' => 'Анна Федорова', 'email' => 'anna.fedorova@example.com'],
            ['name' => 'Павел Морозов', 'email' => 'pavel.morozov@example.com'],
            ['name' => 'Татьяна Новикова', 'email' => 'tatiana.novikova@example.com'],
            ['name' => 'Андрей Соколов', 'email' => 'andrey.sokolov@example.com'],
            ['name' => 'Наталья Козлова', 'email' => 'natalya.kozlova@example.com'],
            ['name' => 'Виктор Лебедев', 'email' => 'viktor.lebedev@example.com'],
            ['name' => 'Юлия Зайцева', 'email' => 'yulia.zaytseva@example.com'],
            ['name' => 'Михаил Павлов', 'email' => 'mikhail.pavlov@example.com']
        ];

        $stmt = $this->db->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");

        $addedCount = 0;
        foreach ($users as $user) {
            try {
                $stmt->execute([
                    ':name' => $user['name'],
                    ':email' => $user['email']
                ]);
                $addedCount++;
            } catch (PDOException $e) {
                echo "Ошибка при добавлении пользователя {$user['email']}: " . $e->getMessage() . "\n";
            }
        }

        echo "Добавлено пользователей: $addedCount\n";
        return $addedCount;
    }
}
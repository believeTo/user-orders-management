<?php
namespace App\Seeders;

class OrderSeeder extends Seeder {
    public function run() {
        $count = $this->db->query("SELECT COUNT(*) FROM orders")->fetchColumn();

        if ($count > 0) {
            return 0;
        }

        $users = $this->db->query("SELECT id FROM users")->fetchAll(\PDO::FETCH_COLUMN);

        if (empty($users)) {
            return 0;
        }

        $products = [
            ['Ноутбук ASUS ROG Strix', 125000],
            ['Смартфон iPhone 15 Pro Max', 129900],
            ['Наушники Sony WH-1000XM5', 34900],
            ['Монитор Samsung Odyssey G7', 89900],
            ['Клавиатура Logitech MX Keys', 12900],
            ['Мышь Logitech MX Master 3S', 10900],
            ['Планшет iPad Pro 12.9"', 149900],
            ['Принтер HP LaserJet Pro', 45900],
            ['Веб-камера Logitech Brio 4K', 29900],
            ['Колонки JBL PartyBox 310', 65900],
            ['Внешний SSD Samsung T7 2TB', 18900],
            ['Роутер ASUS RT-AX86U Pro', 32900],
            ['ИБП APC Back-UPS Pro', 41900],
            ['Графический планшет Wacom Intuos Pro', 55900],
            ['Игровая консоль PlayStation 5', 79900],
            ['Смарт-часы Apple Watch Ultra', 89900],
            ['Электронная книга Amazon Kindle', 18900],
            ['Power Bank Xiaomi 20000mAh', 4900],
            ['Карта памяти SanDisk Extreme 1TB', 14900],
            ['Док-станция USB-C HyperDrive', 12900],
            ['Игровой монитор ASUS TUF Gaming', 78900],
            ['Ноутбук Apple MacBook Pro 16"', 249900],
            ['Смартфон Samsung Galaxy S24 Ultra', 119900],
            ['Наушники Apple AirPods Max', 79900],
            ['Игровая клавиатура Razer BlackWidow', 15900]
        ];

        $statuses = ['pending', 'processing', 'completed'];
        $orders = [];

        for ($i = 0; $i < 50; $i++) {
            $product = $products[array_rand($products)];
            $user_id = $users[array_rand($users)];
            $status = $statuses[array_rand($statuses)];

            $orders[] = [
                'title' => $product[0],
                'cost' => $product[1] + rand(-5000, 5000),
                'user_id' => $user_id,
                'status' => $status
            ];
        }

        $table = $this->table('orders');
        foreach ($orders as $order) {
            $table->insert($order);
        }

        return $table->execute();
    }
}
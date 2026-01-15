<?php

namespace App\Models;

use App\Core\Model;

class OrderModel extends Model {

    public function getAllOrders($sort = 'orders.id', $order = 'DESC', $search = '') {
        $allowedSort = ['orders.id', 'orders.title', 'orders.cost', 'users.name', 'orders.created_at'];

        $sort = in_array($sort, $allowedSort) ? $sort : 'orders.id';
        $order = in_array(strtoupper($order), ['ASC', 'DESC']) ? strtoupper($order) : 'DESC';

        $sql = "SELECT orders.*, users.name as user_name 
                FROM orders 
                JOIN users ON orders.user_id = users.id";

        $params = [];

        if (!empty($search)) {
            $sql .= " WHERE users.name LIKE :search";
            $params[':search'] = "%$search%";
        }

        $sql .= " ORDER BY $sort $order";

        return $this->fetchAll($sql, $params);
    }

    public function getStats() {
        $sql = "SELECT 
                    COUNT(*) as total_orders,
                    SUM(cost) as total_cost,
                    AVG(cost) as avg_cost,
                    COUNT(DISTINCT user_id) as unique_users
                FROM orders";

        return $this->fetch($sql);
    }
}
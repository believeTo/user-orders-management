<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\OrderModel;

class OrderController extends Controller {
    protected $model;

    public function __construct() {
        parent::__construct();
        $this->model = new OrderModel();
    }

    public function index() {
        $sort = $this->getParam('sort', 'orders.id');
        $order = $this->getParam('order', 'ASC');
        $search = $this->getParam('search', '');

        $orders = $this->model->getAllOrders($sort, $order, $search);
        $stats = $this->model->getStats();

        $data = [
            'orders' => $orders,
            'stats' => $stats,
            'sort' => $sort,
            'order' => $order,
            'search' => $search
        ];

        $this->view->render('order/index', $data);
    }

}
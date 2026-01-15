<div class="container">

    <div class="row mb-4">
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Всего заказов</h6>
                            <h2 class="mb-0"><?= $stats['total_orders'] ?></h2>
                        </div>
                        <i class="fas fa-shopping-bag fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card text-white bg-success h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Общая сумма</h6>
                            <h2 class="mb-0"><?= $this->formatPrice($stats['total_cost']) ?> BYN</h2>
                        </div>
                        <i class="fas fa-money-bill-wave fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card text-white bg-info h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Средний чек</h6>
                            <h2 class="mb-0"><?= $this->formatPrice($stats['avg_cost']) ?> BYN</h2>
                        </div>
                        <i class="fas fa-chart-line fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Пользователей</h6>
                            <h2 class="mb-0"><?= $stats['unique_users'] ?></h2>
                        </div>
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">
                <i class="fas fa-filter me-2"></i>Поиск по пользователю
            </h5>

            <form method="GET" action="" id="searchForm" class="row g-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text"
                               class="form-control"
                               id="searchInput"
                               name="search"
                               placeholder="Поиск по имени пользователя..."
                               value="<?= $this->escape($search) ?>"
                               autocomplete="off">
                    </div>
                </div>

                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search me-1"></i>Применить
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-list me-2"></i>Список заказов
                    <span class="badge bg-secondary ms-2"><?= count($orders) ?></span>
                </h5>

                <div class="d-none d-md-block">
                    <span class="text-muted">
                        Сортировка:
                        <strong>
                            <?= $sort == 'orders.id' ? 'ID' :
                                ($sort == 'orders.title' ? 'Название' :
                                    ($sort == 'orders.cost' ? 'Стоимость' :
                                        ($sort == 'users.name' ? 'Пользователь' : 'Дата'))) ?>
                        </strong>
                        <span class="text-<?= $order == 'ASC' ? 'success' : 'danger' ?>">
                            (<?= $order == 'ASC' ? '↑ по возрастанию' : '↓ по убыванию' ?>)
                        </span>
                    </span>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                    <tr>
                        <th>
                            <a href="?<?php
                            $params = ['sort' => 'orders.id', 'order' => ($sort == 'orders.id' && $order == 'ASC') ? 'DESC' : 'ASC'];
                            if (!empty($search)) $params['search'] = $search;
                            echo http_build_query($params);
                            ?>" class="text-decoration-none text-dark d-flex justify-content-between align-items-center">
                                <span>ID</span>
                                <?php if ($sort == 'orders.id'): ?>
                                    <i class="fas fa-sort-<?= $order == 'ASC' ? 'up' : 'down' ?> text-primary"></i>
                                <?php else: ?>
                                    <i class="fas fa-sort text-muted"></i>
                                <?php endif; ?>
                            </a>
                        </th>
                        <th>
                            <a href="?<?php
                            $params = ['sort' => 'orders.title', 'order' => ($sort == 'orders.title' && $order == 'ASC') ? 'DESC' : 'ASC'];
                            if (!empty($search)) $params['search'] = $search;
                            echo http_build_query($params);
                            ?>" class="text-decoration-none text-dark d-flex justify-content-between align-items-center">
                                <span>Название заказа</span>
                                <?php if ($sort == 'orders.title'): ?>
                                    <i class="fas fa-sort-<?= $order == 'ASC' ? 'up' : 'down' ?> text-primary"></i>
                                <?php else: ?>
                                    <i class="fas fa-sort text-muted"></i>
                                <?php endif; ?>
                            </a>
                        </th>
                        <th>
                            <a href="?<?php
                            $params = ['sort' => 'orders.cost', 'order' => ($sort == 'orders.cost' && $order == 'ASC') ? 'DESC' : 'ASC'];
                            if (!empty($search)) $params['search'] = $search;
                            echo http_build_query($params);
                            ?>" class="text-decoration-none text-dark d-flex justify-content-between align-items-center">
                                <span>Стоимость</span>
                                <?php if ($sort == 'orders.cost'): ?>
                                    <i class="fas fa-sort-<?= $order == 'ASC' ? 'up' : 'down' ?> text-primary"></i>
                                <?php else: ?>
                                    <i class="fas fa-sort text-muted"></i>
                                <?php endif; ?>
                            </a>
                        </th>
                        <th>
                            <a href="?<?php
                            $params = ['sort' => 'users.name', 'order' => ($sort == 'users.name' && $order == 'ASC') ? 'DESC' : 'ASC'];
                            if (!empty($search)) $params['search'] = $search;
                            echo http_build_query($params);
                            ?>" class="text-decoration-none text-dark d-flex justify-content-between align-items-center">
                                <span>Пользователь</span>
                                <?php if ($sort == 'users.name'): ?>
                                    <i class="fas fa-sort-<?= $order == 'ASC' ? 'up' : 'down' ?> text-primary"></i>
                                <?php else: ?>
                                    <i class="fas fa-sort text-muted"></i>
                                <?php endif; ?>
                            </a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($orders)): ?>
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <h5>Заказы не найдены</h5>
                                    <?php if (!empty($searchTerm)): ?>
                                        <p>Попробуйте изменить условия поиска</p>
                                    <?php else: ?>
                                        <p>Нет данных для отображения</p>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td>
                                    <span class="badge bg-secondary">#<?= $order['id'] ?></span>
                                </td>
                                <td><?= $this->escape($order['title']) ?></td>
                                <td>
                                    <span class="badge bg-success">
                                        <?= $this->formatPrice($order['cost']) ?> BYN
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar me-2">
                                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                                 style="width: 32px; height: 32px;">
                                                <?= strtoupper(substr($order['user_name'], 0, 1)) ?>
                                            </div>
                                        </div>
                                        <span><?= $this->escape($order['user_name']) ?></span>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if (!empty($orders)): ?>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted">
                        Показано <strong><?= count($orders) ?></strong> заказов
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
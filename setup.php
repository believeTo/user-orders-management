<?php
echo "<h1>Установка системы</h1>";

$configPath = __DIR__ . '/app/config/Config.php';
if (!file_exists($configPath)) {
    copy(__DIR__ . '/app/config/Config.example.php', $configPath);
    echo "<p>Создан config.php из примера</p>";
}

exec('php console migrate 2>&1', $output, $returnCode);

echo "<h2>Результат миграций:</h2>";
echo "<pre>" . implode("\n", $output) . "</pre>";

if ($returnCode === 0) {
    echo "<p>Таблицы созданы успешно!</p>";

    exec('php console seed 2>&1', $output2, $returnCode2);
    echo "<h2>Результат заполнения данных:</h2>";
    echo "<pre>" . implode("\n", $output2) . "</pre>";

    if ($returnCode2 === 0) {
        echo "<p>Тестовые данные добавлены!</p>";
        echo "<p><a href='/' style='font-size: 20px; color: green;'> ПЕРЕЙТИ К ПРИЛОЖЕНИЮ</a></p>";
    }
} else {
    echo "<p style='color: red;'>Ошибка при создании таблиц</p>";
    echo "<p>Проверьте настройки БД в app/config/Config.php</p>";
}

<!DOCTYPE html>
<?php
require_once 'script.php';

$database = new Database();
$services = $database->getServices();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>IT Company</title>
</head>

<body>
    <header>
        <div class="container">
            <div id="logo">
                <a href="index.html">
                    <img src="images/logo.png" alt="Логотип" style="height: 50px;">
                </a>
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="index.html">Главная</a></li>
                    <li><a href="our_services.php">Наши услуги</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="content">
        <div class="container">
            <h1>Наши услуги</h1>
            <div class="table-container">
                <table class="services-table">
                    <thead>
                        <tr>
                            <th>Услуга</th>
                            <th>Описание</th>
                            <th>Сроки</th>
                            <th>Цена от</th>
                            <th>Подробнее</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($services as $service): ?>
                            <?php
                                $service_links = [
                                    'Мобильная разработка' => 'mobile',
                                    'Веб-разработка' => 'web',
                                    'UX/UI-дизайн' => 'design',
                                    'Чат-боты и автоматизация' => 'chat_bots',
                                    'Техническая поддержка' => 'help'
                                ];
                                
                                $service_id = $service_links[$service['service_name'] ?? strtolower(preg_replace('/[^a-zA-Zа-яА-Я0-9]/u', '_', $service['service_name']))];
                            ?>
                        <tr>
                            <td><?php echo htmlspecialchars($service['service_name']); ?></td>
                            <td><?php echo htmlspecialchars($service['description']); ?></td>
                            <td><?php echo htmlspecialchars($service['duration']); ?></td>
                            <td><?php echo htmlspecialchars($service['price']); ?></td>
                            <td>
                                <a href="more_detailed_<?php echo $service_id; ?>.html" class="info-btn">Info</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <footer class="footer">
        © 2025 Ваш сайт
    </footer>
</body>

</html>

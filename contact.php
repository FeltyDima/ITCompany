<!DOCTYPE html>
<?php
$message = '';
$notificationType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'script.php';

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    if (empty($name) || empty($email) || empty($phone)) {
        $message = 'Пожалуйста, заполните все поля';
        $notificationType = 'error';
    } else {
        $database = new Database();
        $result = $database->saveContact($name, $email, $phone);

        if ($result) {
            $message = 'Спасибо! Ваша заявка успешно отправлена. Мы свяжемся с вами в ближайшее время.';
            $notificationType = 'success';
        } else {
            $message = 'Ошибка при отправке заявки. Пожалуйста, попробуйте позже.';
            $notificationType = 'error';
        }
    }
}
?>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>IT Company</title>
    <link rel="stylesheet" href="css/style.css?version=53"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php if (!empty($message)): ?>
    <div class="floating-notification <?php echo $notificationType; ?>">
        <div><?php echo htmlspecialchars($message); ?></div>
        <span class="close-btn">&times;</span>
    </div>
    <?php endif; ?>

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
            <h1>Оставьте заявку и мы с вами свяжемся</h1>
            <div class="contact-form-container">
                <form id="contactForm" class="contact-form">
                    <label for="name">ФИО:</label>
                    <input type="text" id="name" name="name" required>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                    <label for="phone">Телефон:</label>
                    <input type="tel" id="phone" name="phone" required>
                    <button type="submit">Отправить</button>
                </form>
                <div class="contacts-list mt-4">
                    <button id="refreshContacts" class="btn btn-primary">Обновить список</button>
                    <ul id="contactsList" class="list-group mt-2"></ul>
                </div>
                <div class="modal fade" id="successModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">Заявка успешно отправлена!</div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="errorModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">Ошибка при отправке.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        © 2025 Ваш сайт
    </footer>

    <script src="script.js?version=52"></script>
</body>

</html>

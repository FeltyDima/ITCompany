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
    <link rel="stylesheet" href="css/style.css?version=52"/>
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
                <form action="contact.php" method="POST" class="contact-form">
                    <label for="name">ФИО:</label>
                    <input type="text" id="name" name="name" placeholder="Иван Иванов" required
                        value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="example@email.com" required
                        value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">

                    <label for="phone">Номер телефона:</label>
                    <input type="tel" id="phone" name="phone" placeholder="+7 (900) 000-00-00" required
                        value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">

                    <button type="submit">Отправить</button>
                </form>
            </div>
        </div>
    </section>

    <footer class="footer">
        © 2025 Ваш сайт
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const notification = document.querySelector('.floating-notification');
            const closeBtn = document.querySelector('.floating-notification .close-btn');

            if (closeBtn) {
                closeBtn.addEventListener('click', () => {
                    notification.style.display = 'none';
                });
            }

            if (notification) {
                setTimeout(() => {
                    notification.style.opacity = '0';
                    notification.style.transition = 'opacity 0.5s';
                    setTimeout(() => {
                        notification.style.display = 'none';
                    }, 500);
                }, 5000);
            }
        });
    </script>
</body>

</html>

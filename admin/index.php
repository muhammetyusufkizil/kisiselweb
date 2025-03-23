<?php
require_once 'config.php';

// Form gönderildiğinde çalışacak kod
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (!empty($username) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Şifreyi doğrula
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                header("Location: dashboard.php");
                exit;
            } else {
                $error = "Şifre yanlış!";
            }
        } else {
            $error = "Kullanıcı bulunamadı!";
        }
    } else {
        $error = "Kullanıcı adı ve şifre alanları boş bırakılamaz!";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yönetim Paneli Giriş</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body class="login-body">
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h2>Yönetim Paneli Giriş</h2>
                <p>Panele erişmek için lütfen giriş yapın</p>
            </div>
            <?php if (isset($error)): ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <form method="POST" action="" class="login-form">
                <div class="form-group">
                    <label for="username"><i class="fas fa-user"></i> Kullanıcı Adı</label>
                    <input type="text" id="username" name="username" placeholder="Kullanıcı Adı" required value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> Şifre</label>
                    <input type="password" id="password" name="password" placeholder="Şifre" required>
                </div>
                <button type="submit" class="login-btn">Giriş Yap</button>
            </form>
            <div class="login-footer">
                <a href="#">Şifremi Unuttum</a>
            </div>
        </div>
    </div>
</body>
</html>

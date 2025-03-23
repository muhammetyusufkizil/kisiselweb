<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Admin profil bilgilerini çekme
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

// Admin profil güncelleme
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_photo = $_POST['admin_photo'];

    $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, photo = ? WHERE id = ?");
    $stmt->execute([$admin_name, $admin_email, $admin_photo, $_SESSION['user_id']]);
    header("Location: dashboard.php?tab=profile");
    exit;
}

// İçerik güncelleme
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_content'])) {
    $section = $_POST['section'];
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $image = $_POST['image'];

    $stmt = $pdo->prepare("INSERT INTO content (section, title, subtitle, image) 
                           VALUES (?, ?, ?, ?) 
                           ON DUPLICATE KEY UPDATE title = ?, subtitle = ?, image = ?");
    $stmt->execute([$section, $title, $subtitle, $image, $title, $subtitle, $image]);
}

// Hizmet ekleme
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_service'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $icon = $_POST['icon'];

    $stmt = $pdo->prepare("INSERT INTO services (title, description, icon) VALUES (?, ?, ?)");
    $stmt->execute([$title, $description, $icon]);
}

// Hizmet silme
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_service'])) {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM services WHERE id = ?");
    $stmt->execute([$id]);
}

// Portfolyo ekleme
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_portfolio'])) {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $image = $_POST['image'];

    $stmt = $pdo->prepare("INSERT INTO portfolio (title, category, image) VALUES (?, ?, ?)");
    $stmt->execute([$title, $category, $image]);
}

// Portfolyo silme
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_portfolio'])) {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM portfolio WHERE id = ?");
    $stmt->execute([$id]);
}

// Verileri çekme
$content = $pdo->query("SELECT * FROM content")->fetchAll(PDO::FETCH_ASSOC);
$services = $pdo->query("SELECT * FROM services")->fetchAll(PDO::FETCH_ASSOC);
$portfolio = $pdo->query("SELECT * FROM portfolio")->fetchAll(PDO::FETCH_ASSOC);

// Aktif sekme kontrolü
$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'content';
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yönetim Paneli</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <div class="admin-sidebar">
            <div class="logo">Yönetim Paneli</div>
            <ul>
                <li class="<?php echo $active_tab === 'content' ? 'active' : ''; ?>">
                    <a href="?tab=content"><i class="fas fa-file-alt"></i> İçerik Yönetimi</a>
                </li>
                <li class="<?php echo $active_tab === 'about' ? 'active' : ''; ?>">
                    <a href="?tab=about"><i class="fas fa-user"></i> Hakkımda</a>
                </li>
                <li class="<?php echo $active_tab === 'services' ? 'active' : ''; ?>">
                    <a href="?tab=services"><i class="fas fa-cogs"></i> Hizmetler</a>
                </li>
                <li class="<?php echo $active_tab === 'portfolio' ? 'active' : ''; ?>">
                    <a href="?tab=portfolio"><i class="fas fa-briefcase"></i> Portfolyo</a>
                </li>
                <li class="<?php echo $active_tab === 'profile' ? 'active' : ''; ?>">
                    <a href="?tab=profile"><i class="fas fa-user-circle"></i> Profil</a>
                </li>
                <li>
                    <a href="../index.php" target="_blank"><i class="fas fa-eye"></i> Siteyi Görüntüle</a>
                </li>
                <li>
                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Çıkış Yap</a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="admin-content">
            <!-- Header -->
            <div class="admin-header">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Ara...">
                    <div class="search-results" id="searchResults"></div>
                </div>
                <div class="user-info">
                    <i class="fas fa-bell"></i>
                    <i class="fas fa-envelope"></i>
                    <img src="<?php echo htmlspecialchars($admin['photo'] ?? 'https://via.placeholder.com/40'); ?>" alt="User">
                </div>
            </div>

            <!-- Main -->
            <div class="admin-main">
                <h2><i class="fas fa-tachometer-alt"></i> Yönetim Paneli</h2>

                <?php if ($active_tab === 'content'): ?>
                    <!-- İçerik Yönetimi -->
                    <div class="admin-section">
                        <h3><i class="fas fa-file-alt"></i> İçerik Yönetimi</h3>
                        <?php foreach ($content as $item): ?>
                            <form method="POST">
                                <input type="hidden" name="section" value="<?php echo $item['section']; ?>">
                                <input type="hidden" name="update_content" value="1">
                                <div class="form-group">
                                    <label><?php echo ucfirst($item['section']); ?> Başlık</label>
                                    <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($item['title']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label><?php echo ucfirst($item['section']); ?> Alt Başlık</label>
                                    <textarea name="subtitle" class="form-control"><?php echo htmlspecialchars($item['subtitle']); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label><?php echo ucfirst($item['section']); ?> Görsel (URL)</label>
                                    <input type="text" name="image" class="form-control" value="<?php echo htmlspecialchars($item['image']); ?>">
                                </div>
                                <button type="submit" class="btn">Güncelle</button>
                            </form>
                            <hr>
                        <?php endforeach; ?>
                    </div>

                <?php elseif ($active_tab === 'about'): ?>
                    <!-- Hakkımda -->
                    <div class="admin-section">
                        <h3><i class="fas fa-user"></i> Hakkımda Düzenleme</h3>
                        <?php
                        $about = array_filter($content, function($item) {
                            return $item['section'] === 'about';
                        });
                        $about = reset($about);
                        ?>
                        <form method="POST">
                            <input type="hidden" name="section" value="about">
                            <input type="hidden" name="update_content" value="1">
                            <div class="form-group">
                                <label>Hakkımda Başlık</label>
                                <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($about['title']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Hakkımda Açıklama</label>
                                <textarea name="subtitle" class="form-control"><?php echo htmlspecialchars($about['subtitle']); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Görsel (URL)</label>
                                <input type="text" name="image" class="form-control" value="<?php echo htmlspecialchars($about['image']); ?>">
                            </div>
                            <button type="submit" class="btn">Güncelle</button>
                        </form>
                    </div>

                <?php elseif ($active_tab === 'services'): ?>
                    <!-- Hizmetler -->
                    <div class="admin-section">
                        <h3><i class="fas fa-cogs"></i> Yeni Hizmet Ekle</h3>
                        <form method="POST">
                            <input type="hidden" name="add_service" value="1">
                            <div class="form-group">
                                <label>Hizmet Başlığı</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Açıklama</label>
                                <textarea name="description" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Font Awesome İkon (ör: fas fa-laptop-code)</label>
                                <input type="text" name="icon" class="form-control" required>
                            </div>
                            <button type="submit" class="btn">Ekle</button>
                        </form>
                        <h3><i class="fas fa-list"></i> Mevcut Hizmetler</h3>
                        <ul>
                            <?php foreach ($services as $service): ?>
                                <li>
                                    <?php echo htmlspecialchars($service['title']); ?> - <?php echo htmlspecialchars($service['description']); ?>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="id" value="<?php echo $service['id']; ?>">
                                        <input type="hidden" name="delete_service" value="1">
                                        <button type="submit" class="delete-btn">Sil</button>
                                    </form>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                <?php elseif ($active_tab === 'portfolio'): ?>
                    <!-- Portfolyo -->
                    <div class="admin-section">
                        <h3><i class="fas fa-briefcase"></i> Yeni Portfolyo Ekle</h3>
                        <form method="POST">
                            <input type="hidden" name="add_portfolio" value="1">
                            <div class="form-group">
                                <label>Proje Başlığı</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Kategori</label>
                                <input type="text" name="category" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Görsel URL</label>
                                <input type="text" name="image" class="form-control">
                            </div>
                            <button type="submit" class="btn">Ekle</button>
                        </form>
                        <h3><i class="fas fa-list"></i> Mevcut Portfolyo</h3>
                        <ul>
                            <?php foreach ($portfolio as $item): ?>
                                <li>
                                    <?php echo htmlspecialchars($item['title']); ?> - <?php echo htmlspecialchars($item['category']); ?>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                        <input type="hidden" name="delete_portfolio" value="1">
                                        <button type="submit" class="delete-btn">Sil</button>
                                    </form>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                <?php elseif ($active_tab === 'profile'): ?>
                    <!-- Profil Düzenleme -->
                    <div class="admin-section profile-form">
                        <h3><i class="fas fa-user-circle"></i> Profil Düzenleme</h3>
                        <form method="POST">
                            <input type="hidden" name="update_profile" value="1">
                            <div class="form-group">
                                <label>Admin Adı</label>
                                <input type="text" name="admin_name" class="form-control" value="<?php echo htmlspecialchars($admin['username']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>E-posta</label>
                                <input type="email" name="admin_email" class="form-control" value="<?php echo htmlspecialchars($admin['email'] ?? ''); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Profil Fotoğrafı (URL)</label>
                                <input type="text" name="admin_photo" class="form-control" value="<?php echo htmlspecialchars($admin['photo'] ?? ''); ?>">
                            </div>
                            <button type="submit" class="btn">Güncelle</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Arama İşlevselliği için JavaScript -->
    <script>
        const searchInput = document.getElementById('searchInput');
        const searchResults = document.getElementById('searchResults');
        const menuItems = [
            { name: 'İçerik Yönetimi', url: '?tab=content' },
            { name: 'Hakkımda', url: '?tab=about' },
            { name: 'Hizmetler', url: '?tab=services' },
            { name: 'Portfolyo', url: '?tab=portfolio' },
            { name: 'Profil', url: '?tab=profile' },
            { name: 'Çıkış Yap', url: 'logout.php' }
        ];

        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            searchResults.innerHTML = '';

            if (query) {
                const filteredItems = menuItems.filter(item => item.name.toLowerCase().includes(query));
                filteredItems.forEach(item => {
                    const link = document.createElement('a');
                    link.href = item.url;
                    link.textContent = item.name;
                    searchResults.appendChild(link);
                });
                searchResults.classList.add('active');
            } else {
                searchResults.classList.remove('active');
            }
        });

        searchResults.addEventListener('click', function() {
            searchInput.value = '';
            searchResults.classList.remove('active');
        });
    </script>
</body>
</html>

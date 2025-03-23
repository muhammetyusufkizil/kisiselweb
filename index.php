<?php
require_once 'admin/config.php';

// İçerik ve diğer verileri çekme
$content = $pdo->query("SELECT * FROM content")->fetchAll(PDO::FETCH_ASSOC);
$services = $pdo->query("SELECT * FROM services")->fetchAll(PDO::FETCH_ASSOC);
$portfolio = $pdo->query("SELECT * FROM portfolio")->fetchAll(PDO::FETCH_ASSOC);

// Bölümleri diziye çevirme
$content_map = array_column($content, null, 'section');
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($content_map['hero']['title']); ?> - Kişisel Web Sitesi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <nav class="navbar">
                <a href="#" class="logo">Yusuf<span> Kızıl</span></a>
                <ul class="nav-menu">
                    <li><a href="#home" class="nav-link active">Ana Sayfa</a></li>
                    <li><a href="#about" class="nav-link">Hakkımda</a></li>
                    <li><a href="#services" class="nav-link">Hizmetler</a></li>
                    <li><a href="#portfolio" class="nav-link">Portfolyo</a></li>
                    <li><a href="#contact" class="nav-link">İletişim</a></li>
                </ul>
                <button class="mobile-toggle"><i class="fas fa-bars"></i></button>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1><?php echo htmlspecialchars($content_map['hero']['title']); ?></h1>
                    <p><?php echo htmlspecialchars($content_map['hero']['subtitle']); ?></p>
                    <div class="hero-btns">
                        <a href="#contact" class="btn">İletişime Geç</a>
                        <a href="#portfolio" class="btn btn-outline">Projelerimi Gör</a>
                    </div>
                    <div class="hero-social">
                        <a href="#" class="hero-social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="hero-social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="hero-social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="hero-social-link"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="hero-social-link"><i class="fab fa-github"></i></a>
                    </div>
                </div>
                <div class="hero-image">
                    <img src="<?php echo htmlspecialchars($content_map['hero']['image']); ?>" alt="Profil Fotoğrafı" class="hero-img animate-float">
                    <div class="hero-img-bg"></div>
                    <div class="experience-card">
                        <div class="experience-years">5+</div>
                        <div class="experience-text">Yıllık Deneyim</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about section">
        <div class="container">
            <div class="about-content">
                <div class="about-img-container">
                    <img src="<?php echo htmlspecialchars($content_map['about']['image']); ?>" alt="Hakkımda" class="about-img">
                    <div class="about-img-bg"></div>
                </div>
                <div class="about-text">
                    <h2 class="section-title"><?php echo htmlspecialchars($content_map['about']['title']); ?></h2>
                    <p><?php echo htmlspecialchars($content_map['about']['subtitle']); ?></p>
                    <a href="#" class="btn">CV'mi İndir</a>
                    <div class="about-numbers">
                        <div class="about-number">
                            <div class="about-number-value">100+</div>
                            <div class="about-number-text">Tamamlanan Proje</div>
                        </div>
                        <div class="about-number">
                            <div class="about-number-value">80+</div>
                            <div class="about-number-text">Mutlu Müşteri</div>
                        </div>
                        <div class="about-number">
                            <div class="about-number-value">15+</div>
                            <div class="about-number-text">Ödül & Sertifika</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services section">
        <div class="container">
            <div class="text-center">
                <h2 class="section-title"><?php echo htmlspecialchars($content_map['services']['title']); ?></h2>
                <p class="section-subtitle"><?php echo htmlspecialchars($content_map['services']['subtitle']); ?></p>
            </div>
            <div class="services-grid">
                <?php foreach ($services as $service): ?>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="<?php echo htmlspecialchars($service['icon']); ?>"></i>
                    </div>
                    <h3 class="service-title"><?php echo htmlspecialchars($service['title']); ?></h3>
                    <p class="service-text"><?php echo htmlspecialchars($service['description']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">
        <div class="container">
            <div class="text-center">
                <h2 class="section-title"><?php echo htmlspecialchars($content_map['portfolio']['title']); ?></h2>
                <p class="section-subtitle"><?php echo htmlspecialchars($content_map['portfolio']['subtitle']); ?></p>
            </div>
            <div class="portfolio-filter">
                <button class="portfolio-filter-btn active">Tümü</button>
                <button class="portfolio-filter-btn">Web Tasarım</button>
                <button class="portfolio-filter-btn">UI/UX</button>
                <button class="portfolio-filter-btn">Mobil Uygulama</button>
            </div>
            <div class="portfolio-grid">
                <?php foreach ($portfolio as $item): ?>
                <div class="portfolio-card">
                    <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" class="portfolio-img">
                    <div class="portfolio-overlay">
                        <h3 class="portfolio-title"><?php echo htmlspecialchars($item['title']); ?></h3>
                        <p class="portfolio-category"><?php echo htmlspecialchars($item['category']); ?></p>
                        <a href="#" class="portfolio-btn">Detayları Gör</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact section">
        <div class="container">
            <div class="text-center">
                <h2 class="section-title"><?php echo htmlspecialchars($content_map['contact']['title']); ?></h2>
                <p class="section-subtitle"><?php echo htmlspecialchars($content_map['contact']['subtitle']); ?></p>
            </div>
            <div class="contact-container">
                <div class="contact-info">
                    <h2>Benimle İletişime Geçin</h2>
                    <ul class="contact-details">
                        <li class="contact-detail">
                            <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="contact-text"><h4>Adres</h4><p>Adres bilgileriniz, İlçe/Şehir</p></div>
                        </li>
                        <li class="contact-detail">
                            <div class="contact-icon"><i class="fas fa-phone-alt"></i></div>
                            <div class="contact-text"><h4>Telefon</h4><p><a href="tel:+901234567890">+90 123 456 78 90</a></p></div>
                        </li>
                        <li class="contact-detail">
                            <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                            <div class="contact-text"><h4>E-posta</h4><p><a href="mailto:ornek@mail.com">ornek@mail.com</a></p></div>
                        </li>
                    </ul>
                    <div class="hero-social">
                        <a href="#" class="hero-social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="hero-social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="hero-social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="hero-social-link"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="hero-social-link"><i class="fab fa-github"></i></a>
                    </div>
                </div>
                <div class="contact-form">
                    <h3>Mesaj Gönder</h3>
                    <form action="#" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Adınız Soyadınız" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="E-posta Adresiniz" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Konu" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Mesajınız" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-block">Mesaj Gönder</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-about">
                    <a href="#" class="footer-logo">Yusuf<span> Kızıl</span></a>
                    <p>Profesyonel hizmetleriniz hakkında kısa bir tanıtım ve iletişim bilgileriniz.</p>
                    <div class="footer-social">
                        <a href="#" class="footer-social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="footer-social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="footer-social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="footer-social-link"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="footer-social-link"><i class="fab fa-github"></i></a>
                    </div>
                </div>
                <div class="footer-links-container">
                    <h3 class="footer-title">Hızlı Linkler</h3>
                    <ul class="footer-links">
                        <li class="footer-link"><a href="#home">Ana Sayfa</a></li>
                        <li class="footer-link"><a href="#about">Hakkımda</a></li>
                        <li class="footer-link"><a href="#services">Hizmetler</a></li>
                        <li class="footer-link"><a href="#portfolio">Portfolyo</a></li>
                        <li class="footer-link"><a href="#contact">İletişim</a></li>
                    </ul>
                </div>
                <div class="footer-links-container">
                    <h3 class="footer-title">Hizmetler</h3>
                    <ul class="footer-links">
                        <?php foreach ($services as $service): ?>
                        <li class="footer-link"><a href="#"><?php echo htmlspecialchars($service['title']); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="footer-subscribe">
                    <h3 class="footer-title">Bültene Abone Olun</h3>
                    <p class="footer-subscribe-text">Yeni projeler ve güncellemeler için bültenime abone olun.</p>
                    <form class="footer-subscribe-form">
                        <input type="email" placeholder="E-posta Adresiniz" class="footer-subscribe-input">
                        <button type="submit" class="footer-subscribe-btn">Abone Ol</button>
                    </form>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2025 <a href="#">Yusuf Kızıl</a>. Tüm Hakları Saklıdır.</p>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top"><i class="fas fa-arrow-up"></i></a>

    <!-- Menu Overlay -->
    <div class="menu-overlay"></div>

    <!-- JavaScript -->
    <script src="assets/script.js"></script>
</body>
</html>

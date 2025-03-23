CREATE DATABASE personal_website;
USE personal_website;

-- Kullanıcılar tablosu (Yönetim paneli girişi için)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    photo VARCHAR(255)
);

-- İçerik tablosu (Bölüm bazlı içerik yönetimi)
CREATE TABLE content (
    id INT AUTO_INCREMENT PRIMARY KEY,
    section VARCHAR(50) NOT NULL UNIQUE,
    title VARCHAR(255),
    subtitle TEXT,
    image VARCHAR(255),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Hizmetler tablosu
CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    icon VARCHAR(50) NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Portfolyo tablosu
CREATE TABLE portfolio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    image VARCHAR(255),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Örnek kullanıcı (şifre: "admin123")
INSERT INTO users (username, password, email, photo) 
VALUES ('admin', '$2y$10$KZ5sG8zX9Qw5pG7vT8zX8e8Qz8zX9Qw5pG7vT8zX8e8Qz8zX9Qw5p', 'yusuf.kizil@example.com', 'https://via.placeholder.com/40');

-- Örnek içerik
INSERT INTO content (section, title, subtitle, image) VALUES
('hero', 'Merhaba, Ben Yusuf Kızıl', 'Profesyonel Web Geliştirici', 'https://r.resimlink.com/R4LFplaQir7.jpg'),
('about', 'Hakkımda Biraz', 'Buraya kendiniz, eğitiminiz, deneyimleriniz ve becerileriniz hakkında bilgi yazabilirsiniz.', 'https://r.resimlink.com/R4LFplaQir7.jpg'),
('services', 'Sunduğum Hizmetler', 'Müşterilerime sunduğum profesyonel hizmetler', NULL),
('portfolio', 'Son Projelerim', 'Tamamladığım bazı seçkin projeler', NULL),
('contact', 'İletişime Geçin', 'Projeleriniz için benimle iletişime geçmekten çekinmeyin', NULL);

-- Örnek hizmetler
INSERT INTO services (title, description, icon) VALUES
('Web Tasarımı', 'Modern, kullanıcı dostu ve mobil uyumlu web siteleri tasarlıyorum.', 'fas fa-laptop-code'),
('Mobil Uygulama', 'iOS ve Android için yüksek performanslı mobil uygulamalar geliştiriyorum.', 'fas fa-mobile-alt'),
('UI/UX Tasarım', 'Kullanıcı deneyimini ön planda tutan modern arayüz tasarımları oluşturuyorum.', 'fas fa-paint-brush');

-- Örnek portfolyo
INSERT INTO portfolio (title, category, image) VALUES
('Proje Adı 1', 'Web Tasarım', 'https://via.placeholder.com/400x300'),
('Proje Adı 2', 'UI/UX Tasarım', 'https://via.placeholder.com/400x300'),
('Proje Adı 3', 'Mobil Uygulama', 'https://via.placeholder.com/400x300');

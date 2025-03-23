# Yusuf Kızıl - Kişisel Web Sitesi ve Yönetim Paneli

![Proje Banner]()  
*Modern, dinamik ve yönetilebilir bir kişisel web sitesi projesi.*

---

## 📖 Proje Hakkında

Bu proje, **Yusuf Kızıl** adında bir profesyonel için tasarlanmış, modern bir kişisel web sitesidir. Web sitesi, ziyaretçilere hizmetler, portfolyo, hakkımda ve iletişim bölümleri sunarken, aynı zamanda bir **yönetim paneli** ile dinamik içerik yönetimi sağlar. PHP ve MySQL kullanılarak geliştirilen bu proje, hem frontend hem de backend geliştirmeyi öğrenmek isteyenler için harika bir örnektir.

### ✨ Özellikler
- **Modern Tasarım**: Responsive ve kullanıcı dostu bir arayüz.
- **Dinamik İçerik**: Yönetim paneli üzerinden tüm bölümler (Hakkımda, Hizmetler, Portfolyo) düzenlenebilir.
- **Yönetim Paneli**: Güvenli giriş, içerik güncelleme, hizmet/portfolyo ekleme/silme.
- **Profil Yönetimi**: Admin profil bilgileri (ad, e-posta, fotoğraf) düzenlenebilir.
- **Arama İşlevselliği**: Yönetim panelinde hızlı navigasyon için arama çubuğu.
- **Profesyonel Login Ekranı**: Modern ve şık bir giriş ekranı.

---

## 🛠️ Teknolojiler
- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Veritabanı**: MySQL
- **Kütüphaneler**:
  - Font Awesome (İkonlar)

---

## 📸 Ekran Görüntüleri

### Ana Sayfa
![Ana Sayfa]()

### Yönetim Paneli
![Yönetim Paneli]()

### Giriş Ekranı
![Giriş Ekranı]()

---

## 🚀 Kurulum

### Gereksinimler
- XAMPP/WAMP veya benzeri bir yerel sunucu
- PHP 7.4+
- MySQL
- Web tarayıcısı (Chrome, Firefox, vb.)

### Adım Adım Kurulum
1. **Dosyaları İndirin**:
   - Bu depoyu indirin veya ZIP olarak yükleyin.
2. **Dosyaları Sunucuya Taşıyın**:
   - Dosyaları `htdocs` klasörüne (örneğin, `D:\xamp\htdocs\yusuf-kizil-personal-website`) taşıyın.
3. **Veritabanını Oluşturun**:
   - `db.sql` dosyasını MySQL’e import edin:
     ```sql
     CREATE DATABASE personal_website;
     ```
   - PHPMyAdmin üzerinden `personal_website` veritabanına `db.sql` dosyasını yükleyin.
4. **Veritabanı Bağlantısını Yapılandırın**:
   - `admin/config.php` dosyasını açın ve bağlantı bilgilerini güncelleyin:
     ```php
     $host = "localhost";
     $dbname = "personal_website";
     $username = "root";
     $password = "";
     ```
5. **Sunucuyu Başlatın**:
   - XAMPP/WAMP üzerinde Apache ve MySQL servislerini başlatın.
6. **Projeyi Çalıştırın**:
   - Tarayıcıda `http://localhost/yusuf-kizil-personal-website/admin/index.php` adresine gidin.
   - Varsayılan giriş bilgileri:
     - Kullanıcı Adı: `admin`
     - Şifre: `admin123`

---

## 🖥️ Kullanım

### Yönetim Paneli
- **Giriş Yapın**: Varsayılan kullanıcı adı ve şifre ile giriş yapın.
- **İçerik Yönetimi**: Ana sayfa, hakkımda, hizmetler ve portfolyo bölümlerini düzenleyin.
- **Hizmet ve Portfolyo Yönetimi**: Yeni hizmet/portfolyo ekleyin veya mevcut olanları silin.
- **Profil Düzenleme**: Admin adını, e-postasını ve profil fotoğrafını güncelleyin.
- **Siteyi Görüntüle**: Sidebar’daki “Siteyi Görüntüle” butonu ile ana siteyi yeni sekmede açın.

### Ana Site
- **Ana Sayfa**: Profesyonel bir tanıtım bölümü.
- **Hakkımda**: Kişisel bilgiler ve istatistikler.
- **Hizmetler**: Sunulan hizmetlerin listesi.
- **Portfolyo**: Tamamlanan projeler.
- **İletişim**: İletişim formu ve bilgiler.

---

## 🤝 Katkıda Bulunma

Bu projeye katkıda bulunmak isterseniz, lütfen bir Pull Request gönderin. Önerileriniz ve katkılarınız her zaman bekleniyor!

---

## 📜 Lisans

Bu proje [MIT Lisansı](LICENSE) altında lisanslanmıştır. Daha fazla bilgi için `LICENSE` dosyasına göz atabilirsiniz.

---

## 📬 İletişim

- **Yusuf Kızıl**
- E-posta: 
- GitHub: [github.com/[muhammetyusufkizill]](https://github.com/[muhammetyusufkizill])

---

⭐ **Bu projeyi beğendiyseniz, lütfen bir yıldız bırakmayı unutmayın!** ⭐

# 🏆 Sporcuyuz.com.tr (Arşiv)

Bu proje, Mersin Üniversitesi **Bilgisayar Programcılığı** bölümü, **"Web İçerik Editörü"** dersi kapsamında final ödevi olarak geliştirilmiştir. 

Proje, dersin öğretim görevlisi tarafından **sınıfın en başarılı projesi** seçilmiş, hem teknik derinliği hem de SEO (Arama Motoru Optimizasyonu) konusundaki yetkinliği ile takdir edilmiştir.

> **📢 Önemli Not:** Bu proje 2024 yılında, henüz **1. Sınıf öğrencisiyken** geliştirilmiştir. Tasarım dili ve kod yapısı, o dönemin öğrenme sürecini ve teknik yetkinliklerini yansıtmaktadır. Şu anki güncel yetkinliklerimi ve gelişimimi görmek için diğer repolarıma göz atabilirsiniz.

## 🎯 Projenin Amacı
Sporcular için kapsamlı bir rehber oluşturmak; antrenman, beslenme, kalori hesabı ve supplementler hakkında doğru bilgiyi, arama motorlarında bulunabilir (SEO uyumlu) ve interaktif bir yapıda sunmaktır.

## 💻 Teknik Özellikler ve Detaylar

Bu proje sadece statik bir web sitesi değil, arka planda veri işleyen, kullanıcıyı tanıyan dinamik bir yapıdır.

### ⚙️ Backend (PHP & SQLite)
* **Özel Admin Paneli:** Site trafiğini ve logları izlemek için geliştirilen, **Session** tabanlı ve şifreli yönetim paneli.
* **IP & Lokasyon Takibi:** Ziyaretçilerin IP adresini, ülkesini ve şehrini algılayıp `data.db` (SQLite) veritabanına kaydeden özel loglama algoritması.
* **Güvenlik:** SQL Injection açıklarına karşı temel önlemler ve oturum güvenliği.
* **AJAX İletişim Formu:** Sayfa yenilenmeden (`fetch` API kullanılarak) form gönderimi ve kullanıcıya anlık bildirim verilmesi.

### 🔍 SEO ve Dijital Pazarlama (Önemli Kazanımlar)
Bu proje sayesinde bir web sitesinin sadece kodlanmasını değil, internette nasıl "var olduğunu" da deneyimledim:
* **Google Search Console (GSC):** Mülk doğrulama, URL denetimi ve dizine ekleme (indexing) süreçlerinin yönetimi.
* **Sitemap (Site Haritası):** `sitemap.xml` oluşturularak Google botlarının siteyi doğru taramasının sağlanması.
* **Meta Tag Stratejisi:** Her sayfa için özelleştirilmiş `description`, `keywords` ve sosyal medya paylaşımları için `Open Graph` protokolü kullanımı.

### 🎨 Frontend (HTML5, CSS3, JS)
* **Responsive Tasarım:** `@media` sorguları ile mobil ve masaüstü için değişen reklam alanları ve "Hamburger Menü" yapısı.
* **Kalori Hesaplayıcı:** JavaScript ile kodlanmış, **Mifflin-St Jeor** formülünü kullanan interaktif hesaplama aracı.
* **Modern UI:** CSS Grid/Flexbox kullanımı, hover efektleri ve modal (açılır pencere) yapıları.

## 📸 Projeden Görüntüler
<img width="1215" height="592" alt="image" src="https://github.com/user-attachments/assets/41e95d30-28b4-4fc6-8051-82210b9f2dce" />
<img width="1344" height="607" alt="image" src="https://github.com/user-attachments/assets/f94d8406-0e03-453d-862b-25135f662169" />
<img width="334" height="541" alt="image" src="https://github.com/user-attachments/assets/e6d57a3b-2f9c-4efb-abe3-0caaa6ee99e7" />
<img width="1354" height="608" alt="image" src="https://github.com/user-attachments/assets/defb09aa-7701-4d55-9274-57a3c89084ab" />


## 📚 Neler Öğrendim?

Bu proje benim için web dünyasına atılan ilk büyük adımdı:
* **Full Stack Mantığı:** Bir verinin formdan alınıp, PHP ile işlenip, SQLite veritabanına yazılma serüvenini yönetmek.
* **Sunucu Yönetimi:** Localhost ortamından canlı sunucuya (Hosting) geçiş, Domain yönetimi ve **FileZilla (FTP)** kullanımı.
* **Hata Yönetimi:** Kod çalışmadığında pes etmek yerine logları okuyup çözüm üretmek.

---
*Geliştirici: Efehan*

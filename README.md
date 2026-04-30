# Perla Glow — Phase 1

Aplikacion web e-commerce kozmetike i ndërtuar në PHP, i inspiruar nga Sephora.com.
Zhvilluar si projekt grupor për lëndën **Programimi në Web nga ana e Serverit** — FIEK, UP.

---

## Teknologjitë

- PHP 8.2
- HTML5 / CSS3
- JavaScript (ES6+)
- Apache (Ubuntu/LAMP) ose XAMPP (Windows)
- Git / GitHub

---

## Udhëzimet për Ekzekutim

### Ubuntu — LAMP

```bash
# 1. Starto Apache
sudo service apache2 start

# 2. Klono projektin
cd /var/www/html
sudo git clone https://github.com/AltinMulajj/Projekti-WEB2-PHP.git
sudo cp -r /var/www/html/Projekti-WEB2-PHP/phase1/ /var/www/html/phase1/
sudo chown -R www-data:www-data /var/www/html/phase1/

# 3. Hap browser
http://localhost/phase1
```

### Windows — XAMPP

```
1. Starto XAMPP Control Panel → Apache: Start

2. Klono projektin (CMD):
   cd C:\xampp\htdocs
   git clone https://github.com/AltinMulajj/Projekti-WEB2-PHP.git

3. Ndrysho BASE_URL lokalisht (MOS BËNI PUSH):
   Hap: C:\xampp\htdocs\Projekti-WEB2-PHP\phase1\config\constants.php
   Ndrysho: define('BASE_URL', '/Projekti-WEB2-PHP/phase1/');

4. Hap browser:
   http://localhost/Projekti-WEB2-PHP/phase1
```

---

## Kredencialet

| Roli  | Email              | Fjalëkalimi |
|-------|--------------------|-------------|
| Admin | admin@perla.com    | admin123    |
| User  | ariel@perla.com    | eli123      |

> Mund të krijoni llogari të re me Sign Up — ruhet si cookie pa databazë.

---

## Struktura e Projektit

```
phase1/
├── assets/
│   ├── css/style.css         ← Stilizimi i plotë
│   ├── js/main.js            ← Carousel, Cart, Popup
│   └── images/               ← 28 imazhe produktesh
├── classes/
│   ├── Product.php           ← OOP — Klasa e produktit
│   ├── User.php              ← OOP — Klasa e userit
│   ├── Cart.php              ← OOP — Menaxhimi i shportës
│   ├── Category.php          ← OOP — Klasa e kategorisë
│   └── Validator.php         ← RegEx — Validim email + telefon
├── config/
│   ├── constants.php         ← BASE_URL dhe konstantet globale
│   └── session-config.php    ← Konfigurim i sesionit
├── data/
│   ├── products-data.php     ← 28 produkte (dummy data)
│   └── user-data.php         ← 2 users statik
├── includes/
│   ├── header.php            ← HTML head + top-bar
│   ├── footer.php            ← Footer + script loading
│   ├── navigation.php        ← Nav-menu me dropdown
│   ├── auth.php              ← Funksione autentifikimi
│   └── functions.php         ← Helper functions globale
├── pages/
│   ├── products.php          ← Listim me filtrim dhe sortim
│   ├── product-detail.php    ← Detaje + related products
│   ├── category.php          ← Produkte sipas kategorisë
│   ├── login.php             ← Login me users statik
│   ├── logout.php            ← Logout + pastrim cookies
│   ├── signup.php            ← Regjistrim (ruhet në cookie)
│   ├── cart.php              ← Shporta (localStorage)
│   ├── checkout.php          ← Forma e blerjes
│   ├── contactus.php         ← Form me validim RegEx
│   ├── profile.php           ← Profili i userit
│   ├── admin-dashboard.php   ← Panel administrimi
│   └── category.php          ← Filtrim sipas kategorisë
└── index.php                 ← Homepage me carousel
```

---

## Funksionalitetet

- **Homepage** — Hero image + carousel Most Used Products + Week Offers
- **Products** — Listim i 28 produkteve me filtrim (kategori) dhe sortim (çmim, emër)
- **Product Detail** — Detaje + On Sale badge + Related Products
- **Login/Logout** — Autentifikim me role (admin/user)
- **Sign Up** — Regjistrim i ruajtur në cookie
- **Cart** — Shportë me localStorage (add, remove, quantity)
- **Checkout** — Forma e blerjes me order summary
- **Contact** — Validim server-side me RegEx (email + telefon kosovar)
- **Profile** — Të dhënat e userit + preferencat nga cookies
- **Admin Dashboard** — Statistika, tabela produktesh dhe users


## Shënime të Rëndësishme

> **BASE_URL:** Nëse projekti nuk hapet si duhet, kontrollo `config/constants.php` dhe ndrysho `BASE_URL` sipas server-it tënd. Mos bëni push të këtij ndryshimi.

> **Faza 2:** Do të integrojë MySQL, CRUD të plotë, AJAX dhe Web API.

---

*Perla Glow — FIEK, Universiteti i Prishtinës | Prill 2026*

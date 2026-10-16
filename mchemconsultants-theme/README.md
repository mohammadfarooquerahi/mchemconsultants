# MChem Consultants — Custom WordPress Theme

A production-grade custom WordPress theme built for **MChem Consultants** (Chemical Engineering Consultancy, BIC MUET Jamshoro, Pakistan).

Designed with the **NIW (niwnet.com)** design system:
- **Floating Island Glassmorphism Header** with WhatsApp quick action, responsive menu, and smooth scroll
- **Cinematic Dark Navy & Gold Theme** (`#0D1B3E`, `#C9982A`, `#0EA5A0`)
- **Animated Infinite Service Flow Ticker** (dual-row smooth scrolling with pause on hover/touch)
- **6 Core Chemical Engineering Services** (Custom Post Types + ACF support + Aspen/HAZOP tags)
- **MUET Department of Chemical Engineering & BIC Incubation Showcase**
- **5-Member Leadership Team Section** with role badges, bio, and LinkedIn/Email links
- **Interactive WhatsApp Booking & Triage Form** (saves to WP database, emails admin, and launches pre-filled WhatsApp message)
- **Full Customizer Controls** + **Elementor Pro / Free Compatibility**

---

## 📁 Theme Directory Structure

```text
mchemconsultants-theme/
├── style.css                      # Theme identification header
├── functions.php                  # Theme loader bootstrap
├── header.php                     # Floating island header & navigation
├── footer.php                     # Site footer & sticky WhatsApp trigger
├── front-page.php                 # Homepage composition
├── index.php                      # Blog listing template
├── page.php                       # Standard page template
├── single.php                     # Single blog post template
├── archive.php                    # Archive template
├── search.php                     # Search results template
├── 404.php                        # 404 error page
├── template-elementor-fullwidth.php # Elementor template with header/footer
├── template-elementor-canvas.php    # Blank Elementor canvas
├── inc/
│   ├── theme-setup.php            # Menus, theme supports, sidebars
│   ├── enqueue.php                # Scripts, styles, font enqueues (filemtime cache-busting)
│   ├── customizer.php             # WP Customizer settings (contact, hero, colors)
│   ├── custom-post-types.php      # Services & Team CPTs + auto-seeding
│   ├── acf-fields.php             # ACF field groups (with native meta fallback)
│   ├── whatsapp-form.php          # AJAX form processor & admin booking table
│   └── helpers.php                # SVG icons, logo, and WhatsApp URL helpers
├── template-parts/
│   ├── components/
│   │   └── post-card.php          # Blog post card component
│   └── sections/
│       ├── hero.php               # Hero section with dual CTA & stats
│       ├── trust-bar.php          # MUET & BIC credibility bar
│       ├── services-ticker.php    # Infinite dual-row service cards ticker
│       ├── services-grid.php      # 6 core services cards with outcome metrics
│       ├── about.php              # About story & affiliation cards
│       ├── team.php               # 5-member team showcase
│       └── booking-form.php       # WhatsApp problem triage form
└── assets/
    ├── css/                       # Modular CSS (base, header, hero, services, team, form, footer)
    ├── js/                        # Vanilla JS (main, ticker, whatsapp-form, customizer-preview)
    └── images/                    # Bundled MChem logos (transparent & original)
```

---

## 🚀 How to Install

1. **ZIP the theme folder**: Compress `mchemconsultants-theme` into `mchemconsultants-theme.zip`.
2. **Upload to WordPress**: Go to **WP Admin → Appearance → Themes → Add New → Upload Theme**.
3. **Activate**: Click **Activate**.
4. **Auto-Data Seeding**: Upon activation, the theme automatically populates:
   - The **6 Core Chemical Engineering Services** (Aspen HYSYS, Sustainable Solutions, HAZOP, Plant Design, Energy Recovery, Training).
   - The **5 Leadership Team Members** (Muhsin Ali, Sardar Ali, Muhammad Hassan, Zuhaib Ali, Muhammad Usman).

---

## ⚙️ Editing Content in WordPress Admin

### 1. WP Customizer (Appearance → Customize → MChem Theme Options)
- **Contact & WhatsApp**: Update WhatsApp number (e.g. `923320386271`), email, phone, office address, working hours, and response time promise.
- **Hero Section**: Edit eyebrow tagline, main heading, highlighted words, subtext, and CTA button labels.
- **Social Media**: Add LinkedIn, Facebook, Instagram, and YouTube links.
- **Brand Colors**: Customize primary navy, gold accent, teal highlight, and background color.

### 2. Services Management (WP Admin → Services)
- Add, edit, or reorder services.
- Set software badges (e.g., *Aspen HYSYS*, *HAZOP*), service numbers (01–06), and key outcome phrases.

### 3. Team Members (WP Admin → Team)
- Edit profiles, titles, bio excerpts, expertise tags (pipe-separated), LinkedIn links, and upload profile pictures.

### 4. Booking Submissions (WP Admin → Bookings)
- View all consultation inquiries and problem descriptions submitted by clients in a clean administrative table.

### 5. Menus (WP Admin → Appearance → Menus)
- Assign menus to **Primary Navigation** and **Footer Menu**.

---

## 🎨 Elementor Usage

- When creating or editing pages with Elementor, select **Elementor Full Width** in Page Attributes → Template to keep the floating header and footer, or **Elementor Canvas** for complete blank page design.

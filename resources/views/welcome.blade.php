<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-5">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FARMAVIDA — Sistema de Gestión Farmacéutica</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy-950: #060d1a;
            --navy-900: #0a1628;
            --navy-800: #0e1f3a;
            --navy-700: #142b50;
            --navy-600: #1a3566;
            --blue-500: #1a5fb4;
            --blue-400: #2170d8;
            --blue-300: #4d8fe8;
            --blue-200: #8ab8f5;
            --blue-100: #c8dffb;
            --blue-glow: rgba(26, 95, 180, 0.18);
            --white: #ffffff;
            --white-80: rgba(255,255,255,0.80);
            --white-60: rgba(255,255,255,0.60);
            --white-30: rgba(255,255,255,0.30);
            --white-10: rgba(255,255,255,0.08);
            --white-05: rgba(255,255,255,0.04);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background-color: var(--navy-900);
            color: var(--white);
            font-family: 'Inter', sans-serif;
            font-size: 15px;
            line-height: 1.65;
            -webkit-font-smoothing: antialiased;
        }

        /* ── NAV ── */
        .fv-nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 200;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 52px;
            background: rgba(10, 22, 40, 0.88);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--white-10);
        }

        .fv-nav-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .fv-nav-logo {
            width: 38px; height: 38px;
            background: var(--blue-500);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }

        .fv-nav-logo svg { width: 20px; height: 20px; stroke: white; fill: none; stroke-width: 2; }

        .fv-nav-name {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 17px;
            font-weight: 700;
            color: var(--white);
            letter-spacing: 0.4px;
        }

        .fv-nav-sub {
            font-size: 11px;
            color: var(--blue-200);
            font-weight: 500;
        }

        .fv-nav-links {
            display: flex;
            align-items: center;
            gap: 32px;
            list-style: none;
        }

        .fv-nav-links a {
            color: var(--white-60);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.2s;
        }

        .fv-nav-links a:hover { color: var(--white); }

        .fv-btn-nav {
            background: var(--blue-500);
            color: white;
            border: none;
            padding: 9px 22px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.2s, transform 0.15s;
        }

        .fv-btn-nav:hover {
            background: var(--blue-400);
            transform: translateY(-1px);
            color: white;
        }

        /* ── HERO ── */
        .fv-hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding: 130px 52px 90px;
            background:
                radial-gradient(ellipse 55% 60% at 75% 45%, rgba(26,95,180,0.16) 0%, transparent 65%),
                radial-gradient(ellipse 40% 40% at 10% 80%, rgba(14,31,58,0.9) 0%, transparent 70%),
                var(--navy-900);
        }

        .fv-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 52px 52px;
            pointer-events: none;
        }

        .fv-hero-inner {
            position: relative;
            max-width: 1140px;
            margin: 0 auto;
            width: 100%;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            align-items: center;
            gap: 72px;
        }

        .fv-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(26,95,180,0.15);
            border: 1px solid rgba(26,95,180,0.4);
            color: var(--blue-200);
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            padding: 5px 14px;
            border-radius: 100px;
            margin-bottom: 26px;
        }

        .fv-badge-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--blue-300);
            animation: blink 2.4s infinite;
        }

        @keyframes blink { 0%,100%{opacity:1} 50%{opacity:0.3} }

        .fv-hero-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(38px, 5.5vw, 62px);
            font-weight: 700;
            line-height: 1.08;
            letter-spacing: -1.5px;
            margin-bottom: 10px;
        }

        .fv-hero-title .hi { color: var(--blue-300); }

        .fv-hero-sub {
            font-size: 14px;
            color: var(--blue-200);
            font-weight: 500;
            letter-spacing: 0.4px;
            margin-bottom: 22px;
        }

        .fv-hero-desc {
            color: var(--white-60);
            font-size: 15.5px;
            line-height: 1.8;
            margin-bottom: 40px;
            max-width: 460px;
        }

        .fv-hero-actions {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 52px;
        }

        .fv-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--blue-500);
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            padding: 13px 28px;
            border-radius: 10px;
            border: none;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
        }

        .fv-btn-primary:hover {
            background: var(--blue-400);
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(26,95,180,0.4);
            color: white;
        }

        .fv-btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            color: var(--white-60);
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            padding: 13px 20px;
            border-radius: 10px;
            border: 1px solid var(--white-30);
            transition: border-color 0.2s, color 0.2s;
        }

        .fv-btn-ghost:hover {
            border-color: var(--white-60);
            color: var(--white);
        }

        /* Stats row */
        .fv-stats {
            display: flex;
            gap: 36px;
            padding-top: 28px;
            border-top: 1px solid var(--white-10);
        }

        .fv-stat-num {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 26px;
            font-weight: 700;
            color: var(--white);
            line-height: 1;
            margin-bottom: 4px;
        }

        .fv-stat-num span { color: var(--blue-300); }

        .fv-stat-label {
            font-size: 12px;
            color: var(--white-60);
            font-weight: 400;
        }

        /* Feature list (right col) */
        .fv-feat-list { display: flex; flex-direction: column; gap: 14px; }

        .fv-feat-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            background: var(--white-05);
            border: 1px solid var(--white-10);
            border-radius: 12px;
            padding: 16px 18px;
            transition: border-color 0.2s, background 0.2s;
        }

        .fv-feat-item:hover {
            border-color: rgba(26,95,180,0.45);
            background: rgba(26,95,180,0.07);
        }

        .fv-feat-icon {
            width: 34px; height: 34px;
            flex-shrink: 0;
            background: var(--blue-500);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
        }

        .fv-feat-icon svg { width: 17px; height: 17px; stroke: white; fill: none; stroke-width: 2.2; stroke-linecap: round; stroke-linejoin: round; }

        .fv-feat-title { font-size: 14px; font-weight: 600; color: var(--white); margin-bottom: 3px; }
        .fv-feat-desc { font-size: 12px; color: var(--blue-200); margin: 0; }

        /* ── SECTION SHARED ── */
        .fv-sec {
            padding: 100px 52px;
        }

        .fv-sec-inner {
            max-width: 1140px;
            margin: 0 auto;
        }

        .fv-sec-eyebrow {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--blue-300);
            margin-bottom: 12px;
        }

        .fv-sec-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(28px, 4vw, 42px);
            font-weight: 700;
            color: var(--white);
            letter-spacing: -0.6px;
            margin-bottom: 14px;
        }

        .fv-sec-desc {
            color: var(--white-60);
            font-size: 15px;
            max-width: 540px;
            margin-bottom: 56px;
            line-height: 1.75;
        }

        /* ── MODULES CARDS ── */
        .fv-modules-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .fv-mod-card {
            background: var(--navy-800);
            border: 1px solid var(--white-10);
            border-radius: 14px;
            padding: 28px 22px 24px;
            transition: transform 0.25s, border-color 0.25s, box-shadow 0.25s;
            position: relative;
            overflow: hidden;
        }

        .fv-mod-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: var(--blue-500);
            transform: scaleX(0);
            transition: transform 0.3s;
            transform-origin: left;
        }

        .fv-mod-card:hover {
            transform: translateY(-6px);
            border-color: rgba(26,95,180,0.45);
            box-shadow: 0 20px 48px rgba(0,0,0,0.35);
        }

        .fv-mod-card:hover::before { transform: scaleX(1); }

        .fv-mod-icon {
            width: 46px; height: 46px;
            background: rgba(26,95,180,0.15);
            border: 1px solid rgba(26,95,180,0.3);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 18px;
        }

        .fv-mod-icon svg { width: 22px; height: 22px; stroke: var(--blue-300); fill: none; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; }

        .fv-mod-card h4 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 16px;
            font-weight: 600;
            color: var(--white);
            margin-bottom: 10px;
        }

        .fv-mod-card p {
            font-size: 13px;
            color: var(--white-60);
            margin: 0 0 16px;
            line-height: 1.65;
        }

        .fv-mod-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .fv-mod-list li {
            font-size: 12px;
            color: var(--white-60);
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .fv-mod-list li::before {
            content: '';
            width: 5px; height: 5px;
            border-radius: 50%;
            background: var(--blue-400);
            flex-shrink: 0;
        }

        /* ── ROLES SECTION ── */
        .fv-roles-section {
            background: var(--navy-800);
            border-top: 1px solid var(--white-10);
            border-bottom: 1px solid var(--white-10);
            padding: 100px 52px;
        }

        .fv-roles-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .fv-role-card {
            background: var(--navy-900);
            border: 1px solid var(--white-10);
            border-radius: 14px;
            padding: 30px 26px;
            transition: border-color 0.2s;
        }

        .fv-role-card:hover { border-color: rgba(26,95,180,0.4); }

        .fv-role-avatar {
            width: 50px; height: 50px;
            border-radius: 50%;
            background: rgba(26,95,180,0.15);
            border: 2px solid rgba(26,95,180,0.35);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 18px;
        }

        .fv-role-avatar svg { width: 24px; height: 24px; stroke: var(--blue-300); fill: none; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; }

        .fv-role-card h4 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 17px;
            font-weight: 700;
            color: var(--white);
            margin-bottom: 6px;
        }

        .fv-role-tag {
            display: inline-block;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: var(--blue-200);
            background: rgba(26,95,180,0.12);
            border: 1px solid rgba(26,95,180,0.25);
            padding: 3px 10px;
            border-radius: 100px;
            margin-bottom: 16px;
        }

        .fv-role-perms {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .fv-role-perms li {
            font-size: 13px;
            color: var(--white-60);
            display: flex;
            align-items: flex-start;
            gap: 9px;
        }

        .fv-perm-ok { color: var(--blue-300); font-size: 14px; flex-shrink: 0; margin-top: 1px; }
        .fv-perm-no { color: var(--white-30); font-size: 14px; flex-shrink: 0; margin-top: 1px; }

        /* ── BENEFITS ── */
        .fv-benefits-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .fv-benefit-card {
            background: var(--navy-800);
            border: 1px solid var(--white-10);
            border-radius: 12px;
            padding: 22px 20px;
            display: flex;
            align-items: flex-start;
            gap: 14px;
            transition: border-color 0.2s;
        }

        .fv-benefit-card:hover { border-color: rgba(26,95,180,0.35); }

        .fv-benefit-num {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: rgba(26,95,180,0.4);
            line-height: 1;
            flex-shrink: 0;
            width: 36px;
        }

        .fv-benefit-card h5 {
            font-size: 14px;
            font-weight: 600;
            color: var(--white);
            margin-bottom: 5px;
        }

        .fv-benefit-card p {
            font-size: 13px;
            color: var(--white-60);
            margin: 0;
            line-height: 1.6;
        }

        /* ── TECH SECTION ── */
        .fv-tech-section {
            background: var(--navy-800);
            border-top: 1px solid var(--white-10);
            border-bottom: 1px solid var(--white-10);
            padding: 100px 52px;
        }

        .fv-tech-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .fv-tech-card {
            background: var(--navy-900);
            border: 1px solid var(--white-10);
            border-radius: 12px;
            padding: 22px 20px;
            text-align: center;
            transition: border-color 0.2s;
        }

        .fv-tech-card:hover { border-color: rgba(26,95,180,0.4); }

        .fv-tech-icon {
            font-size: 28px;
            margin-bottom: 12px;
        }

        .fv-tech-card h5 {
            font-size: 14px;
            font-weight: 600;
            color: var(--white);
            margin-bottom: 6px;
        }

        .fv-tech-card p {
            font-size: 12px;
            color: var(--white-60);
            margin: 0;
        }

        /* ── CTA FINAL ── */
        .fv-cta-section {
            padding: 110px 52px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .fv-cta-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 60% 70% at 50% 110%, rgba(26,95,180,0.18) 0%, transparent 65%),
                var(--navy-900);
            pointer-events: none;
        }

        .fv-cta-inner { position: relative; z-index: 1; max-width: 600px; margin: 0 auto; }

        .fv-cta-section h2 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(30px, 4.5vw, 48px);
            font-weight: 700;
            margin-bottom: 18px;
            letter-spacing: -0.8px;
        }

        .fv-cta-section p {
            color: var(--white-60);
            font-size: 16px;
            margin-bottom: 38px;
            line-height: 1.75;
        }

        /* ── FOOTER ── */
        .fv-footer {
            background: var(--navy-950);
            border-top: 1px solid var(--white-10);
            padding: 40px 52px 28px;
        }

        .fv-footer-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding-bottom: 32px;
            margin-bottom: 28px;
            border-bottom: 1px solid var(--white-10);
        }

        .fv-footer-brand-name {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: var(--white);
            margin-bottom: 6px;
        }

        .fv-footer-brand-desc {
            font-size: 13px;
            color: var(--white-60);
        }

        .fv-footer-cols {
            display: flex;
            gap: 64px;
        }

        .fv-footer-col h6 {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--blue-200);
            margin-bottom: 14px;
        }

        .fv-footer-col ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .fv-footer-col ul li a {
            font-size: 13px;
            color: var(--white-60);
            text-decoration: none;
            transition: color 0.2s;
        }

        .fv-footer-col ul li a:hover { color: var(--white); }

        .fv-footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .fv-footer-bottom p {
            font-size: 13px;
            color: var(--white-30);
            margin: 0;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) {
            .fv-nav { padding: 16px 28px; }
            .fv-nav-links { display: none; }
            .fv-hero { padding: 110px 28px 72px; }
            .fv-hero-inner { grid-template-columns: 1fr; gap: 52px; }
            .fv-hero-desc { max-width: 100%; }
            .fv-sec, .fv-roles-section, .fv-tech-section, .fv-cta-section { padding: 72px 28px; }
            .fv-modules-grid { grid-template-columns: repeat(2, 1fr); }
            .fv-roles-grid { grid-template-columns: 1fr; gap: 16px; }
            .fv-benefits-grid { grid-template-columns: repeat(2, 1fr); }
            .fv-tech-grid { grid-template-columns: repeat(2, 1fr); }
            .fv-footer { padding: 32px 28px 24px; }
            .fv-footer-top { flex-direction: column; gap: 32px; }
        }

        @media (max-width: 600px) {
            .fv-modules-grid, .fv-benefits-grid, .fv-tech-grid { grid-template-columns: 1fr; }
            .fv-stats { gap: 24px; flex-wrap: wrap; }
            .fv-hero-actions { flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>
<body>

<!-- ══ NAV ══ -->
<nav class="fv-nav">
    <a href="#" class="fv-nav-brand">
        <div class="fv-nav-logo">
            <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 3H5a2 2 0 0 0-2 2v4m6-6h10a2 2 0 0 1 2 2v4M9 3v18m0 0h10a2 2 0 0 0 2-2v-4M9 21H5a2 2 0 0 1-2-2v-4m0 0h18"/>
            </svg>
        </div>
        <div>
            <div class="fv-nav-name">FARMAVIDA</div>
            <div class="fv-nav-sub">Sistema de Gestión Farmacéutica</div>
        </div>
    </a>
    <ul class="fv-nav-links">
        <li><a href="#modulos">Módulos</a></li>
        <li><a href="#roles">Roles</a></li>
        <li><a href="#beneficios">Beneficios</a></li>
    </ul>
    <a href="{{ route('login') }}" class="fv-btn-nav">Iniciar sesión</a>
</nav>

<!-- ══ HERO ══ -->
<section class="fv-hero">
    <div class="fv-hero-inner">
        <div>
            <div class="fv-badge">
                <span class="fv-badge-dot"></span>
                Sistema activo · Lima, Perú
            </div>
            <h1 class="fv-hero-title">
                Confianza · Salud<br>
                <span class="hi">· Tecnología</span>
            </h1>
            <p class="fv-hero-sub">Sistema Integral de Gestión Farmacéutica</p>
            <p class="fv-hero-desc">
                Plataforma web diseñada para farmacias modernas. Gestione
                medicamentos, recetas controladas, clientes, médicos y ventas
                desde un solo sistema, con trazabilidad completa y control de
                inventario en tiempo real.
            </p>
            <div class="fv-hero-actions">
                <a href="{{ route('login') }}" class="fv-btn-primary">
                    Acceder al sistema
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
                <a href="#modulos" class="fv-btn-ghost">Ver módulos</a>
            </div>
            <div class="fv-stats">
                <div>
                    <div class="fv-stat-num">5<span>+</span></div>
                    <div class="fv-stat-label">Módulos integrados</div>
                </div>
                <div>
                    <div class="fv-stat-num">3<span> roles</span></div>
                    <div class="fv-stat-label">Control de acceso</div>
                </div>
                <div>
                    <div class="fv-stat-num">100<span>%</span></div>
                    <div class="fv-stat-label">Trazabilidad</div>
                </div>
            </div>
        </div>

        <div class="fv-feat-list">
            <div class="fv-feat-item">
                <div class="fv-feat-icon">
                    <svg viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <div>
                    <div class="fv-feat-title">Control de inventario en tiempo real</div>
                    <p class="fv-feat-desc">Stock actualizado automáticamente con cada transacción</p>
                </div>
            </div>
            <div class="fv-feat-item">
                <div class="fv-feat-icon">
                    <svg viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2z"/></svg>
                </div>
                <div>
                    <div class="fv-feat-title">Validación de recetas controladas</div>
                    <p class="fv-feat-desc">Requiere autorización del Químico Farmacéutico</p>
                </div>
            </div>
            <div class="fv-feat-item">
                <div class="fv-feat-icon">
                    <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <div>
                    <div class="fv-feat-title">Acceso diferenciado por rol</div>
                    <p class="fv-feat-desc">Administrador, Químico Farmacéutico y Cajero</p>
                </div>
            </div>
            <div class="fv-feat-item">
                <div class="fv-feat-icon">
                    <svg viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                </div>
                <div>
                    <div class="fv-feat-title">Reportes y trazabilidad</div>
                    <p class="fv-feat-desc">Historial completo de ventas, stock y recetas</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══ MÓDULOS ══ -->
<section class="fv-sec" id="modulos">
    <div class="fv-sec-inner">
        <p class="fv-sec-eyebrow">Módulos del sistema</p>
        <h2 class="fv-sec-title">Todo lo que necesita su farmacia</h2>
        <p class="fv-sec-desc">
            Cada módulo está diseñado para cubrir un área clave de la operación
            farmacéutica, integrándose de forma fluida para centralizar toda
            la información en un solo lugar.
        </p>

        <div class="fv-modules-grid">
            <div class="fv-mod-card">
                <div class="fv-mod-icon">
                    <svg viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <h4>Medicamentos</h4>
                <p>Registro completo del catálogo de productos farmacéuticos con control de stock y alertas de vencimiento.</p>
                <ul class="fv-mod-list">
                    <li>Registro con código, principio activo y presentación</li>
                    <li>Alertas de stock mínimo</li>
                    <li>Control de fecha de vencimiento</li>
                    <li>Clasificación por categorías y laboratorio</li>
                </ul>
            </div>
            <div class="fv-mod-card">
                <div class="fv-mod-icon">
                    <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <h4>Clientes</h4>
                <p>Gestión centralizada de todos los clientes con historial de compras y seguimiento de recetas.</p>
                <ul class="fv-mod-list">
                    <li>Registro con DNI y datos de contacto</li>
                    <li>Historial de compras y recetas</li>
                    <li>Búsqueda rápida por DNI o nombre</li>
                    <li>Perfil de consumo por cliente</li>
                </ul>
            </div>
            <div class="fv-mod-card">
                <div class="fv-mod-icon">
                    <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <h4>Médicos</h4>
                <p>Registro de médicos habilitados para emitir recetas de medicamentos controlados y de venta restringida.</p>
                <ul class="fv-mod-list">
                    <li>Número de colegiatura y especialidad</li>
                    <li>Validación ante el Colegio Médico</li>
                    <li>Vinculación con recetas emitidas</li>
                    <li>Historial de prescripciones</li>
                </ul>
            </div>
            <div class="fv-mod-card">
                <div class="fv-mod-icon">
                    <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                </div>
                <h4>Ventas</h4>
                <p>Proceso de venta seguro y controlado con validación automática de recetas cuando es requerido.</p>
                <ul class="fv-mod-list">
                    <li>Venta de mostrador y con receta</li>
                    <li>Comprobante electrónico (boleta/factura)</li>
                    <li>Descuento automático del stock</li>
                    <li>Reporte de caja por turno</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- ══ ROLES ══ -->
<section class="fv-roles-section" id="roles">
    <div class="fv-sec-inner">
        <p class="fv-sec-eyebrow">Control de acceso</p>
        <h2 class="fv-sec-title">Tres roles, una plataforma</h2>
        <p class="fv-sec-desc">
            Cada usuario accede únicamente a las funciones correspondientes
            a su responsabilidad dentro de la farmacia.
        </p>

        <div class="fv-roles-grid">
            <div class="fv-role-card">
                <div class="fv-role-avatar">
                    <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h4>Administrador</h4>
                <span class="fv-role-tag">Acceso total</span>
                <ul class="fv-role-perms">
                    <li><span class="fv-perm-ok">✓</span> Gestión de usuarios y roles</li>
                    <li><span class="fv-perm-ok">✓</span> Configuración del sistema</li>
                    <li><span class="fv-perm-ok">✓</span> Reportes y estadísticas completas</li>
                    <li><span class="fv-perm-ok">✓</span> Alta de medicamentos y proveedores</li>
                    <li><span class="fv-perm-ok">✓</span> Control de inventario general</li>
                </ul>
            </div>
            <div class="fv-role-card">
                <div class="fv-role-avatar">
                    <svg viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2z"/></svg>
                </div>
                <h4>Químico Farmacéutico</h4>
                <span class="fv-role-tag">Acceso clínico</span>
                <ul class="fv-role-perms">
                    <li><span class="fv-perm-ok">✓</span> Validación de recetas controladas</li>
                    <li><span class="fv-perm-ok">✓</span> Registro de médicos autorizados</li>
                    <li><span class="fv-perm-ok">✓</span> Supervisión de ventas con receta</li>
                    <li><span class="fv-perm-ok">✓</span> Control de medicamentos especiales</li>
                    <li><span class="fv-perm-no">✗</span> Administración de usuarios</li>
                </ul>
            </div>
            <div class="fv-role-card">
                <div class="fv-role-avatar">
                    <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                </div>
                <h4>Cajero</h4>
                <span class="fv-role-tag">Acceso operativo</span>
                <ul class="fv-role-perms">
                    <li><span class="fv-perm-ok">✓</span> Registro de ventas de mostrador</li>
                    <li><span class="fv-perm-ok">✓</span> Consulta de stock disponible</li>
                    <li><span class="fv-perm-ok">✓</span> Emisión de comprobantes</li>
                    <li><span class="fv-perm-no">✗</span> Venta de medicamentos controlados</li>
                    <li><span class="fv-perm-no">✗</span> Modificación de inventario</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- ══ BENEFICIOS ══ -->
<section class="fv-sec" id="beneficios">
    <div class="fv-sec-inner">
        <p class="fv-sec-eyebrow">Por qué elegir FARMAVIDA</p>
        <h2 class="fv-sec-title">Beneficios concretos para su negocio</h2>
        <p class="fv-sec-desc">
            Diseñado para reducir errores, acelerar los procesos y dar
            visibilidad total sobre la operación de su farmacia.
        </p>

        <div class="fv-benefits-grid">
            <div class="fv-benefit-card">
                <div class="fv-benefit-num">01</div>
                <div>
                    <h5>Control eficiente del stock</h5>
                    <p>Inventario actualizado en tiempo real con cada venta. Sin discrepancias entre lo físico y el sistema.</p>
                </div>
            </div>
            <div class="fv-benefit-card">
                <div class="fv-benefit-num">02</div>
                <div>
                    <h5>Reducción de errores operativos</h5>
                    <p>Validaciones automáticas que previenen despachos incorrectos y ventas sin receta cuando son requeridas.</p>
                </div>
            </div>
            <div class="fv-benefit-card">
                <div class="fv-benefit-num">03</div>
                <div>
                    <h5>Mayor rapidez en ventas</h5>
                    <p>Búsqueda de productos, clientes y médicos en segundos. El proceso de venta se completa en pocos pasos.</p>
                </div>
            </div>
            <div class="fv-benefit-card">
                <div class="fv-benefit-num">04</div>
                <div>
                    <h5>Información centralizada</h5>
                    <p>Toda la data de su farmacia en un solo sistema: ventas, inventario, clientes y recetas integrados.</p>
                </div>
            </div>
            <div class="fv-benefit-card">
                <div class="fv-benefit-num">05</div>
                <div>
                    <h5>Cumplimiento normativo</h5>
                    <p>Trazabilidad de recetas controladas y registro de autorizaciones del Químico Farmacéutico por cada despacho.</p>
                </div>
            </div>
            <div class="fv-benefit-card">
                <div class="fv-benefit-num">06</div>
                <div>
                    <h5>Reportes en tiempo real</h5>
                    <p>Estadísticas de ventas, productos más vendidos y alertas de vencimiento disponibles al instante.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══ CTA FINAL ══ -->
<section class="fv-cta-section">
    <div class="fv-cta-inner">
        <p class="fv-sec-eyebrow" style="text-align:center;">Listo para comenzar</p>
        <h2>Gestione su farmacia hoy mismo</h2>
        <p>
            Acceda al sistema con sus credenciales y comience a optimizar
            el inventario, las ventas y el control de recetas desde el
            primer día.
        </p>
        <a href="{{ route('login') }}" class="fv-btn-primary" style="display:inline-flex; font-size:16px; padding:15px 32px;">
            Ingresar al sistema
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
    </div>
</section>

<!-- ══ FOOTER ══ -->
<footer class="fv-footer">
    <div class="fv-footer-top">
        <div>
            <div class="fv-footer-brand-name">FARMAVIDA</div>
            <div class="fv-footer-brand-desc">Sistema de Gestión Farmacéutica</div>
        </div>
        <div class="fv-footer-cols">
            <div class="fv-footer-col">
                <h6>Sistema</h6>
                <ul>
                    <li><a href="#modulos">Módulos</a></li>
                    <li><a href="#roles">Roles de acceso</a></li>
                    <li><a href="#beneficios">Beneficios</a></li>
                </ul>
            </div>
            <div class="fv-footer-col">
                <h6>Acceso</h6>
                <ul>
                    <li><a href="{{ route('login') }}">Iniciar sesión</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="fv-footer-bottom">
        <p>© 2026 FARMAVIDA · Sistema de Gestión Farmacéutica · Lima, Perú</p>
        <p>Desarrollado con Laravel 11 · PHP 8.3</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
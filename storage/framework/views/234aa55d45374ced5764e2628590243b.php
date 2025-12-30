<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EINCODE — Ehsan Ghaffar's Digital Laboratory</title>
    <meta name="description"
        content="A digital workshop where code meets curiosity. Experiments, prototypes, and open-source artifacts by Ehsan Ghaffar.">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/styles.css')); ?>">
    <style>
:root {
  --accent: #10b981;
  --bg-glass: rgba(255,255,255,0.65);
  --text: #111;
}

[data-bs-theme="dark"] {
  --bg-glass: rgba(0,0,0,0.6);
  --text: #fff;
}

/* Glass header */
.glass-nav {
  backdrop-filter: blur(16px);
  background: var(--bg-glass);
  border-bottom: 1px solid rgba(255,255,255,0.2);
}

/* ===== Brand (logo) – border only ===== */
.brand-icon {
  background: transparent;
  border: 2px solid var(--accent);
  padding: 6px 10px;
  border-radius: 10px;
  color: var(--accent);
  transition: .3s;
}

.brand-icon:hover {
  background: transparent;
  box-shadow: 0 0 0 3px rgba(0,0,0,0.06);
}

[data-bs-theme="dark"] .brand-icon:hover {
  box-shadow: 0 0 0 3px rgba(255,255,255,0.15);
}

.brand-text { 
  font-weight: 700; 
  color: var(--text); 
}
.brand-accent { 
  color: var(--accent); 
}

/* ===== Menu hover – arrow + small line only ===== */
.nav-link {
  color: var(--text) !important;
  position: relative;
  padding: 6px 14px;
  transition: .3s;
}

.nav-link:hover {
  color: var(--text) !important; /* keep same */
}

.nav-link::before {
  content: ">";
  position: absolute;
  left: -6px;
  top: 50%;
  transform: translateY(-50%);
  color: var(--accent);
  opacity: 0;
  transition: .3s;
}

.nav-link::after {
  content: "";
  position: absolute;
  left: 50%;
  bottom: -6px;
  transform: translateX(-50%);
  width: 0;
  height: 2px;
  background: var(--accent);
  border-radius: 10px;
  transition: .3s;
}

.nav-link:hover::before,
.nav-link.active::before { 
  opacity: 1; 
}

.nav-link:hover::after,
.nav-link.active::after { 
  width: 18px; 
}

/* ===== Icons – bg highlight only ===== */
.icon-wrap {
  width: 38px;
  height: 38px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-radius: 12px;
  color: var(--accent);
  cursor: pointer;
  position: relative;
  transition: .3s;
}

.icon-wrap:hover {
  background: rgba(0,0,0,0.06);
  color: var(--accent); /* no change */
}

[data-bs-theme="dark"] .icon-wrap:hover {
  background: rgba(255,255,255,0.12);
  color: var(--accent);
}

/* icon label */
.icon-wrap::after {
  content: attr(data-label);
  position: absolute;
  bottom: -34px;
  left: 50%;
  transform: translateX(-50%);
  background: #fff;
  color: #000;
  padding: 4px 10px;
  border-radius: 10px;
  font-size: .75rem;
  opacity: 0;
  pointer-events: none;
  transition: .25s;
  white-space: nowrap;
}

.icon-wrap:hover::after { 
  opacity: 1; 
}

/* ===== Theme dropdown – border highlight only ===== */
.theme-menu {
  background: var(--bg-glass);
  backdrop-filter: blur(14px);
  border-radius: 16px;
  padding: 10px;
  border: 1px solid rgba(255,255,255,0.2);
}

.theme-menu .dropdown-item {
  border-radius: 12px;
  padding: 10px 12px;
  color: var(--text);
}

.theme-menu .dropdown-item:hover {
  background: rgba(0,0,0,0.05);
  color: var(--text);
}

[data-bs-theme="dark"] .theme-menu .dropdown-item:hover {
  background: rgba(255,255,255,0.12);
  color: var(--text);
}

.theme-menu .dropdown-item.active {
  border: 1px solid var(--accent);
  background: transparent;
  color: var(--text);
}

/* ===== Status ===== */
.status-badge {
  border: 1px solid var(--accent);
  color: var(--accent);
  border-radius: 20px;
  padding: 5px 12px;
  font-size: .85rem;
  background: transparent;
}

.status-dot {
  width: 8px;
  height: 8px;
  background: var(--accent);
  border-radius: 50%;
  display: inline-block;
  margin-right: 6px;
}

/* ===== Mobile ===== */
@media (max-width: 991px) {
  .navbar-nav {
    text-align: center;
    gap: 14px;
  }
}

    </style>
   

</head>

<body>
    <!-- Header -->
 <header id="header" class="fixed-top">
<nav class="navbar navbar-expand-lg glass-nav">
  <div class="container-fluid px-4 d-flex align-items-center">

    <!-- LEFT: Logo -->
    <a class="navbar-brand d-flex align-items-center gap-2 me-4" href="#">
      <div class="brand-icon">⚡</div>
      <span class="brand-text">EIN<span class="brand-accent">CODE</span></span>
    </a>

    <button class="navbar-toggler ms-auto" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">

      <!-- CENTER: Menu + Theme -->
      <ul class="navbar-nav mx-auto align-items-center gap-3">

        <li class="nav-item"><a class="nav-link" href="#projects">Projects</a></li>
        <li class="nav-item"><a class="nav-link" href="#notes">Notes</a></li>
        <li class="nav-item"><a class="nav-link" href="#workbench">Workbench</a></li>
        <li class="nav-item"><a class="nav-link" href="#connect">Connect</a></li>

        <!-- Theme -->
        <li class="nav-item dropdown">
          <a class="icon-wrap" data-label="Colors" data-bs-toggle="dropdown">🎨</a>
          <ul class="dropdown-menu theme-menu dropdown-menu-end">
            <li><button class="dropdown-item active" onclick="setTheme('golden',this)">🟡 Golden</button></li>
            <li><button class="dropdown-item" onclick="setTheme('cyan',this)">🔵 Cyan</button></li>
            <li><button class="dropdown-item" onclick="setTheme('purple',this)">🟣 Purple</button></li>
            <li><button class="dropdown-item" onclick="setTheme('emerald',this)">🟢 Emerald</button></li>
            <li><button class="dropdown-item" onclick="setTheme('rose',this)">🌸 Rose</button></li>
          </ul>
        </li>

        <!-- Mode -->
        <li class="nav-item">
          <button id="modeToggle" class="icon-wrap" data-label="Mode">🌙</button>
        </li>
      </ul>

      <!-- RIGHT: Social + Status -->
      <ul class="navbar-nav align-items-center gap-2 ms-auto">
        <li class="nav-item d-none d-lg-block">
          <a href="#" class="icon-wrap" data-label="GitHub"><i class="bi bi-github"></i></a>
        </li>
        <li class="nav-item d-none d-lg-block">
          <a href="#" class="icon-wrap" data-label="Twitter"><i class="bi bi-twitter"></i></a>
        </li>
        <li class="nav-item d-none d-lg-block">
          <a href="#" class="icon-wrap" data-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
        </li>

        <li class="nav-item d-none d-lg-block ms-2">
          <span class="status-badge">
            <span class="status-dot"></span> status: building
          </span>
        </li>
      </ul>

    </div>
  </div>
</nav>
</header>





    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="script.js"></script>
    <script>
      const themes = {
  golden: "#f5b301",
  cyan: "#00e5ff",
  purple: "#a855f7",
  emerald: "#10b981",
  rose: "#f43f5e"
};

function setTheme(name, el) {
  document.documentElement.style.setProperty('--accent', themes[name]);
  localStorage.setItem('accent', name);

  document.querySelectorAll('.theme-menu .dropdown-item')
    .forEach(i => i.classList.remove('active'));
  if (el) el.classList.add('active');
}

// Dark / Light
const toggle = document.getElementById('modeToggle');
toggle.addEventListener('click', () => {
  const html = document.documentElement;
  const mode = html.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark';
  html.setAttribute('data-bs-theme', mode);
  toggle.textContent = mode === 'dark' ? '🌙' : '☀️';
  localStorage.setItem('mode', mode);
});

// Load saved
window.addEventListener('DOMContentLoaded', () => {
  const t = localStorage.getItem('accent');
  const m = localStorage.getItem('mode');
  if (t) setTheme(t);
  if (m) {
    document.documentElement.setAttribute('data-bs-theme', m);
    toggle.textContent = m === 'dark' ? '🌙' : '☀️';
  }
});

    </script>
</body>

</html>
<?php /**PATH C:\Users\binstellar\OneDrive\Desktop\portfolioSatyajeet\resources\views/layouts/webpage.blade.php ENDPATH**/ ?>
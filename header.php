
<?php include __DIR__ . '/includes/supabase.php'; ?>

<style>
.user-menu{position:relative;display:none;}
.user-button{border:1px solid #e2e8f0;background:white;padding:8px 16px;border-radius:50px;cursor:pointer;font-size:14px;font-weight:500;color:var(--text-main);transition:all 0.3s;display:flex;align-items:center;gap:8px;}
.user-button:hover{background:#f8fafc;border-color:var(--toori-blue);}
.user-button::before{content:'\F4DA';font-family:'bootstrap-icons';font-size:1rem;color:var(--toori-blue);}
.user-dropdown{display:none;position:absolute;right:0;top:45px;background:white;border:1px solid #e2e8f0;border-radius:14px;min-width:180px;box-shadow:0 10px 30px rgba(0,0,0,0.1);overflow:hidden;z-index:1100;}
.user-dropdown a{display:flex;align-items:center;gap:10px;padding:12px 16px;text-decoration:none;color:#333;font-size:14px;font-weight:500;transition:all 0.2s;}
.user-dropdown a:hover{background:#f0f7ff;color:var(--toori-blue);}
.user-dropdown.show{display:block;}
.nav-menu {
  display: flex;
  gap: 24px;
  align-items: center;
}

@media (max-width: 768px) {
  .nav-menu {
    display: none;
    flex-direction: column;
    position: fixed;
    top: 0;
    right: -100%;
    width: 280px;
    height: 100vh;
    background: rgba(255,255,255,0.98);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-left: 1px solid rgba(0,0,0,0.06);
    padding: 80px 24px 40px;
    gap: 8px;
    z-index: 1000;
    transition: right 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: -10px 0 40px rgba(0,0,0,0.08);
  }

  .nav-menu.show {
    display: flex;
    right: 0;
  }

  .nav-menu .nav-link {
    font-size: 1.05rem;
    padding: 12px 16px;
    border-radius: 12px;
    width: 100%;
    transition: background 0.2s;
  }

  .nav-menu .nav-link:hover {
    background: rgba(59, 168, 224, 0.06);
  }

  .mobile-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.3);
    z-index: 999;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s;
  }

  .mobile-overlay.show {
    opacity: 1;
    pointer-events: all;
  }
}
</style>

<div class="mobile-overlay" id="mobile-overlay"></div>

<header class="navbar navbar--sticky">
  <div class="container-header">
    <a href="index.php" class="logo" style="margin-right:auto;">
      <img src="assets/logo.png" alt="Toori Logo" style="height: 55px;">
      <span>Toori ServiciosYa</span>
    </a>
    <div class="menu-toggle" id="mobile-menu-btn">
      <i class="bi bi-list"></i>
    </div>
    <nav class="nav-menu" id="nav-menu">
      <a href="index.php" class="nav-link">Inicio</a>
      <a href="index.php#como-funciona" class="nav-link">Como funciona</a>
      <a href="ofertas.php" class="nav-link">Ofertas</a>
      <a href="registro.php" class="nav-link" id="nav-worker-link">Soy Trabajador</a>
      <a href="PerfileProfesionales.php" class="nav-link">Profesionales</a>
      <a href="login.php" class="nav-link" id="nav-login-link" style="background:var(--toori-blue);color:white;padding:10px 24px;border-radius:50px;font-weight:600;transition:all 0.3s;">Ingresa</a>

      <!-- Usuario logueado -->
      <div id="user-menu" class="user-menu">
        <button id="user-button" class="user-button"></button>
        <div id="user-dropdown" class="user-dropdown">
          <a href="perfil.php"><i class="bi bi-person"></i> Perfil</a>
          <a href="#" id="logout-btn" style="color:#ef4444;"><i class="bi bi-box-arrow-right"></i> Cerrar sesion</a>
        </div>
      </div>
    </nav>
  </div>
</header>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const mobileBtn = document.getElementById("mobile-menu-btn");
  const navMenu = document.getElementById("nav-menu");
  const overlay = document.getElementById("mobile-overlay");

  mobileBtn.addEventListener("click", () => {
    navMenu.classList.toggle("show");
    overlay.classList.toggle("show");
  });

  if (overlay) {
    overlay.addEventListener("click", () => {
      navMenu.classList.remove("show");
      overlay.classList.remove("show");
    });
  }

  // Cerrar menu al hacer click en un link (mobile)
  navMenu.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', () => {
      if (window.innerWidth <= 768) {
        navMenu.classList.remove("show");
        if (overlay) overlay.classList.remove("show");
      }
    });
  });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", async () => {
  const supabaseClient = window.supabaseClient;

  const loginLink = document.getElementById("nav-login-link");
  const workerLink = document.getElementById("nav-worker-link");
  const userMenu = document.getElementById("user-menu");
  const userButton = document.getElementById("user-button");
  const userDropdown = document.getElementById("user-dropdown");
  const logoutBtn = document.getElementById("logout-btn");

  const updateUI = (session) => {
    if (session) {
      loginLink.style.display = "none";
      workerLink.style.display = "none";
      userMenu.style.display = "block";
      const email = session.user.email;
      userButton.textContent = email.length > 20 ? email.substring(0, 18) + '...' : email;
    } else {
      loginLink.style.display = "block";
      workerLink.style.display = "block";
      userMenu.style.display = "none";
    }
  };

  const { data: { session }, error } = await supabaseClient.auth.getSession();
  if (error) console.error("Error obteniendo sesion:", error);
  updateUI(session);

  supabaseClient.auth.onAuthStateChange((event, session) => {
    updateUI(session);
  });

  userButton.addEventListener("click", (e) => {
    userDropdown.classList.toggle("show");
  });

  document.addEventListener("click", (e) => {
    if (!userMenu.contains(e.target)) {
      userDropdown.classList.remove("show");
    }
  });

  logoutBtn.addEventListener("click", async (e) => {
    e.preventDefault();
    await supabaseClient.auth.signOut();
    updateUI(null);
    window.location.href = "index.php";
  });
});
</script>

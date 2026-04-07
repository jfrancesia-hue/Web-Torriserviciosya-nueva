<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todas las Categorías - Toori ServiciosYa</title>
    <meta name="description" content="Explorá todas las categorías de servicios disponibles en Toori ServiciosYa.">
<script>
const supabaseUrl = "https://dhhhftzdfpqthzvkrqoz.supabase.co"
const supabaseKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImRoaGhmdHpkZnBxdGh6dmtycW96Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NDQ2OTQyODUsImV4cCI6MjA2MDI3MDI4NX0.-atBYl9Uica9quKZQzqmgWQ8wNd1PFB4ivLrSNv89OQ'

window.supabase = window.supabase.createClient(supabaseUrl, supabaseKey)
</script>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/logo.png">
    <script src="script.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" crossorigin href="./assets/main-D3W1u2cc.css">
</head>

<body>

    <!-- Navbar reutilizable -->
    <div id="header-include"></div>
    <script>
      fetch('header.php').then(r => r.text()).then(html => {
        document.getElementById('header-include').innerHTML = html;
      });
    </script>

    <!-- Categories Section -->
    <section class="section" style="background-color: var(--bg-soft); min-height: 80vh; padding-top: 120px;">
        <div class="container text-center">
            <h2 class="mb-3" style="font-size: 2.5rem; font-weight: bold; color: var(--text-main);">Todas las Categorías</h2>
            <p class="mb-5" style="color: var(--text-muted); font-size: 1.1rem;">Elegí el servicio que necesitás y comenzá tu gestión</p>

            <div id="all-categories-container"
                style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; max-width: 1000px; margin: 0 auto;">
                
                <!-- Loading state -->
                <div class="text-center w-100" style="padding: 40px;">
                    <div class="spinner-border" role="status" style="color: var(--toori-purple);">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                    <p style="margin-top: 15px; color: var(--text-muted);">Cargando categorías...</p>
                </div>

            </div>

            <!-- Back button -->
            <div style="margin-top: 40px;">
                <a href="./" class="btn btn-secondary" style="padding: 12px 30px; border-radius: 50px;">
                    <i class="bi bi-arrow-left"></i> Volver al inicio
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer style="background-color: var(--toori-dark); color: white; padding: 40px 0 20px;">
        <div class="container text-center">
            <img src="assets/logo.png" alt="Toori Logo" style="height: 60px; margin-bottom: 15px;">
            <p style="color: rgba(255,255,255,0.8); font-size: 0.9rem; margin: 0;">
                © 2023 Toori Servicios all rights reserved
            </p>
        </div>
    </footer>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/5493512139046?text=Hola!%20Necesito%20ayuda%20con%20Toori" class="floating-wa"
        target="_blank" rel="noopener noreferrer" title="Contactate con nuestro Bot">
        <i class="bi bi-whatsapp"></i>
    </a>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Mobile Menu Toggle -->
    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('nav-menu').classList.toggle('active');
        });
    </script>

    <!-- Load Categories from Supabase -->
    <script type="module">
        import { createClient } from 'https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2/+esm';
        
        const supabaseUrl = 'https://dhhhftzdfpqthzvkrqoz.supabase.co';
        const supabaseKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImRoaGhmdHpkZnBxdGh6dmtycW96Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NDQ2OTQyODUsImV4cCI6MjA2MDI3MDI4NX0.-atBYl9Uica9quKZQzqmgWQ8wNd1PFB4ivLrSNv89OQ';
        const supabase = createClient(supabaseUrl, supabaseKey);

        const WHATSAPP_PHONE = "5493512139046";
        const container = document.getElementById('all-categories-container');

        // Icon mapping function
        function getIcon(nombre) {
            const c = nombre.toLowerCase();
            if (c.includes('limp') || c.includes('doméstico')) return 'bi-house-heart';
            if (c.includes('plom')) return 'bi-tools';
            if (c.includes('elec')) return 'bi-plug-fill';
            if (c.includes('gas')) return 'bi-fire';
            if (c.includes('pint')) return 'bi-droplet-fill';
            if (c.includes('jard')) return 'bi-tree-fill';
            if (c.includes('alba')) return 'bi-bricks';
            if (c.includes('mantenimiento')) return 'bi-wrench-adjustable';
            if (c.includes('refrigeración') || c.includes('refrigeracion') || c.includes('aire')) return 'bi-snow';
            if (c.includes('carpint')) return 'bi-hammer';
            if (c.includes('cerraj')) return 'bi-key';
            if (c.includes('mudanza') || c.includes('flete')) return 'bi-truck';
            if (c.includes('tecnico') || c.includes('técnico') || c.includes('comput') || c.includes('pc')) return 'bi-pc-display';
            if (c.includes('niñera') || c.includes('ninera') || c.includes('cuidado')) return 'bi-people';
            return 'bi-star';
        }

        async function loadCategories() {
            try {
                const { data, error } = await supabase
                    .from('categorias')
                    .select('id, nombre')
                    .order('nombre');

                if (error) throw error;

                if (data && data.length > 0) {
                    // Deduplicate by name
                    const uniqueNames = new Set();
                    const uniqueCategories = data.filter(cat => {
                        if (!cat.nombre) return false;
                        const lowerName = cat.nombre.trim().toLowerCase();
                        if (uniqueNames.has(lowerName)) return false;
                        uniqueNames.add(lowerName);
                        return true;
                    });

                    container.innerHTML = '';

                    uniqueCategories.forEach(cat => {
                        const card = document.createElement('div');
                        card.className = 'card-premium text-center';
                        card.style.cssText = 'width: 180px; padding: 25px 15px; display: flex; flex-direction: column; align-items: center; justify-content: center;';

                        const icon = getIcon(cat.nombre);

                        card.innerHTML = `
                            <i class="bi ${icon}" style="font-size: 2.5rem; color: var(--toori-purple); margin-bottom: 0.8rem;"></i>
                            <h4 style="margin-bottom: 0.5rem; font-size: 1rem;">${cat.nombre}</h4>
                            <button class="btn btn-primary whatsapp-btn" data-category="${cat.nombre}"
                                style="padding: 8px 16px; font-size: 0.85rem; margin-top: 0.5rem;">Iniciar gestión</button>
                        `;
                        container.appendChild(card);
                    });
                } else {
                    container.innerHTML = '<p class="text-center w-100" style="color: #666;">No hay categorías disponibles en este momento.</p>';
                }
            } catch (err) {
                console.error('Error loading categories:', err);
                container.innerHTML = '<p class="text-center w-100" style="color: red;">Error al cargar las categorías. Por favor, recargá la página.</p>';
            }
        }

        // WhatsApp click handler
        document.addEventListener('click', function(e) {
            var btn = e.target.closest('.whatsapp-btn');
            if (btn) {
                e.preventDefault();
                e.stopImmediatePropagation();
                var category = btn.getAttribute('data-category') || 'Servicio General';
                window.open('https://wa.me/' + WHATSAPP_PHONE + '?text=' + encodeURIComponent('Busco un servicio de ' + category), '_blank');
            }
        }, true);

        // Load on page ready
        loadCategories();
    </script>

    <!-- Refuerzo: asegurar logout en navbar -->
    <script type="module">
        import { createClient } from 'https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2/+esm';
        const supabase = createClient('https://dhhhftzdfpqthzvkrqoz.supabase.co', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImRoaGhmdHpkZnBxdGh6dmtycW96Iiwicm9zZSI6ImFub24iLCJpYXQiOjE3NDQ2OTQyODUsImV4cCI6MjA2MDI3MDI4NX0.-atBYl9Uica9quKZQzqmgWQ8wNd1PFB4ivLrSNv89OQ');
        document.addEventListener('DOMContentLoaded', () => {
          const btnLogout = document.getElementById('btn-navbar-logout');
          if (btnLogout) {
            btnLogout.addEventListener('click', async (e) => {
              e.preventDefault();
              try {
                await supabase.auth.signOut();
                window.location.href = './login.php';
              } catch (err) {
                alert('Error al cerrar sesión: ' + (err.message || err));
              }
            });
          }
        });
    </script>

    <!-- Refuerzo robusto: observer para logout en dropdown -->
    <script type="module">
    import { createClient } from 'https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2/+esm';
    const supabase = createClient('https://dhhhftzdfpqthzvkrqoz.supabase.co', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImRoaGhmdHpkZnBxdGh6dmtycW96Iiwicm9zZSI6ImFub24iLCJpYXQiOjE3NDQ2OTQyODUsImV4cCI6MjA2MDI3MDI4NX0.-atBYl9Uica9quKZQzqmgWQ8wNd1PFB4ivLrSNv89OQ');

    function attachLogout() {
      const btnLogout = document.getElementById('btn-navbar-logout');
      if (btnLogout && !btnLogout.dataset.logoutBound) {
        btnLogout.dataset.logoutBound = '1';
        btnLogout.addEventListener('click', async (e) => {
          e.preventDefault();
          try {
            await supabase.auth.signOut();
            window.location.href = './login.php';
          } catch (err) {
            alert('Error al cerrar sesión: ' + (err.message || err));
          }
        });
      }
    }

    // Intenta enganchar el evento varias veces por si el navbar es dinámico
    const observer = new MutationObserver(attachLogout);
    observer.observe(document.body, { childList: true, subtree: true });
    document.addEventListener('DOMContentLoaded', attachLogout);
    setTimeout(attachLogout, 1000);
    </script>

</body>

</html>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todas las Categorias - Toori ServiciosYa</title>
    <meta name="description" content="Explora todas las categorias de servicios disponibles en Toori ServiciosYa.">
    <link rel="icon" type="image/png" href="assets/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" crossorigin href="./assets/main-D3W1u2cc.css">
    <link rel="stylesheet" href="./assets/toori-enhanced.css">

    <style>
        /* Buscador */
        .search-wrapper {
            max-width: 560px;
            margin: 0 auto 40px;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 16px 24px 16px 52px;
            border-radius: 50px;
            border: 2px solid #e2e8f0;
            font-size: 1rem;
            font-family: var(--font-body);
            background: white;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            transition: all 0.3s;
            outline: none;
        }

        .search-input:focus {
            border-color: var(--toori-blue);
            box-shadow: 0 4px 24px rgba(59,168,224,0.15);
        }

        .search-input::placeholder {
            color: #aab;
        }

        .search-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--toori-blue);
            font-size: 1.2rem;
            pointer-events: none;
        }

        .search-clear {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #999;
            font-size: 1.2rem;
            cursor: pointer;
            display: none;
            transition: color 0.2s;
        }

        .search-clear:hover {
            color: #333;
        }

        .search-clear.visible {
            display: block;
        }

        /* Resultado count */
        .results-count {
            text-align: center;
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-bottom: 24px;
            transition: opacity 0.3s;
        }

        /* No results */
        .no-results {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
        }

        .no-results i {
            font-size: 3rem;
            color: #ddd;
            margin-bottom: 16px;
            display: block;
        }

        .no-results p {
            font-size: 1.1rem;
            margin-bottom: 8px;
        }

        .no-results small {
            color: #aaa;
        }

        /* Grid de categorias */
        .cat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
            max-width: 1000px;
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            .cat-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .category-card-img {
                height: 110px;
            }

            .search-input {
                padding: 14px 20px 14px 46px;
                font-size: 0.95rem;
            }
        }

        @media (max-width: 480px) {
            .cat-grid {
                gap: 10px;
            }

            .category-card-img {
                height: 90px;
            }

            .category-card-body {
                padding: 12px;
            }

            .category-card-body h4 {
                font-size: 0.82rem;
            }
        }

        /* Skeleton para carga */
        .cat-skeleton {
            border-radius: 20px;
            overflow: hidden;
        }

        .cat-skeleton .skel-img {
            height: 160px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e8e8e8 50%, #f0f0f0 75%);
            background-size: 200px 100%;
            animation: shimmer 1.5s infinite;
        }

        .cat-skeleton .skel-body {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .cat-skeleton .skel-line {
            height: 14px;
            border-radius: 7px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e8e8e8 50%, #f0f0f0 75%);
            background-size: 200px 100%;
            animation: shimmer 1.5s infinite;
        }

        .cat-skeleton .skel-btn {
            height: 34px;
            width: 120px;
            border-radius: 50px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e8e8e8 50%, #f0f0f0 75%);
            background-size: 200px 100%;
            animation: shimmer 1.5s infinite;
            margin-top: 4px;
        }
    </style>
</head>

<body>

    <?php include 'header.php'; ?>

    <section class="section" style="background-color: var(--bg-soft); min-height: 80vh; padding-top: 120px;">
        <div class="container text-center">
            <h2 class="section-title reveal">Todas las Categorias</h2>
            <p class="section-subtitle reveal">Elegi el servicio que necesitas y empeza tu gestion</p>

            <!-- Buscador -->
            <div class="search-wrapper reveal">
                <i class="bi bi-search search-icon"></i>
                <input type="text" class="search-input" id="cat-search" placeholder="Buscar categoria... ej: plomeria, electricidad" autocomplete="off">
                <button class="search-clear" id="search-clear" title="Limpiar busqueda">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>

            <!-- Resultado count -->
            <div class="results-count reveal" id="results-count"></div>

            <!-- Grid -->
            <div class="cat-grid stagger-children" id="all-categories-container">
                <!-- Skeleton loading -->
                <div class="cat-skeleton"><div class="skel-img"></div><div class="skel-body"><div class="skel-line" style="width:40px;height:40px;border-radius:10px;"></div><div class="skel-line" style="width:80%;"></div><div class="skel-btn"></div></div></div>
                <div class="cat-skeleton"><div class="skel-img"></div><div class="skel-body"><div class="skel-line" style="width:40px;height:40px;border-radius:10px;"></div><div class="skel-line" style="width:70%;"></div><div class="skel-btn"></div></div></div>
                <div class="cat-skeleton"><div class="skel-img"></div><div class="skel-body"><div class="skel-line" style="width:40px;height:40px;border-radius:10px;"></div><div class="skel-line" style="width:75%;"></div><div class="skel-btn"></div></div></div>
                <div class="cat-skeleton"><div class="skel-img"></div><div class="skel-body"><div class="skel-line" style="width:40px;height:40px;border-radius:10px;"></div><div class="skel-line" style="width:65%;"></div><div class="skel-btn"></div></div></div>
                <div class="cat-skeleton"><div class="skel-img"></div><div class="skel-body"><div class="skel-line" style="width:40px;height:40px;border-radius:10px;"></div><div class="skel-line" style="width:72%;"></div><div class="skel-btn"></div></div></div>
                <div class="cat-skeleton"><div class="skel-img"></div><div class="skel-body"><div class="skel-line" style="width:40px;height:40px;border-radius:10px;"></div><div class="skel-line" style="width:68%;"></div><div class="skel-btn"></div></div></div>
            </div>

            <!-- Back button -->
            <div style="margin-top: 40px;" class="reveal">
                <a href="./" class="btn btn-secondary btn-ripple" style="padding: 12px 30px; border-radius: 50px;">
                    <i class="bi bi-arrow-left"></i> Volver al inicio
                </a>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/5493512139046?text=Hola!%20Necesito%20ayuda%20con%20Toori" class="floating-wa"
        target="_blank" rel="noopener noreferrer" title="Contactate con nuestro Bot">
        <i class="bi bi-whatsapp"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Load Categories from Supabase -->
    <script type="module">
        import { createClient } from 'https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2/+esm';

        const supabaseUrl = 'https://dhhhftzdfpqthzvkrqoz.supabase.co';
        const supabaseKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImRoaGhmdHpkZnBxdGh6dmtycW96Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NDQ2OTQyODUsImV4cCI6MjA2MDI3MDI4NX0.-atBYl9Uica9quKZQzqmgWQ8wNd1PFB4ivLrSNv89OQ';
        const supabase = createClient(supabaseUrl, supabaseKey);

        const WHATSAPP_PHONE = "5493512139046";
        const container = document.getElementById('all-categories-container');
        const searchInput = document.getElementById('cat-search');
        const searchClear = document.getElementById('search-clear');
        const resultsCount = document.getElementById('results-count');

        // Mapeo de iconos
        function getIcon(nombre) {
            const c = nombre.toLowerCase();
            if (c.includes('limp') || c.includes('doméstico') || c.includes('domestico')) return 'bi-stars';
            if (c.includes('plom')) return 'bi-wrench';
            if (c.includes('elec')) return 'bi-lightbulb';
            if (c.includes('gas')) return 'bi-fire';
            if (c.includes('pint')) return 'bi-brush';
            if (c.includes('jard')) return 'bi-tree';
            if (c.includes('alba')) return 'bi-bricks';
            if (c.includes('mantenimiento')) return 'bi-wrench-adjustable';
            if (c.includes('refrigeración') || c.includes('refrigeracion') || c.includes('aire')) return 'bi-snow';
            if (c.includes('carpint')) return 'bi-hammer';
            if (c.includes('cerraj')) return 'bi-key';
            if (c.includes('mudanza') || c.includes('flete')) return 'bi-truck';
            if (c.includes('tecnico') || c.includes('técnico') || c.includes('comput') || c.includes('pc')) return 'bi-pc-display';
            if (c.includes('niñera') || c.includes('ninera') || c.includes('cuidado')) return 'bi-people';
            if (c.includes('herreria') || c.includes('herrería') || c.includes('soldad')) return 'bi-gear';
            if (c.includes('vidri')) return 'bi-window';
            if (c.includes('fumigar') || c.includes('fumig') || c.includes('plaga')) return 'bi-bug';
            if (c.includes('tapiz') || c.includes('cortina')) return 'bi-palette';
            if (c.includes('seguridad') || c.includes('cámara') || c.includes('camara') || c.includes('alarma')) return 'bi-shield-lock';
            if (c.includes('pilet') || c.includes('piscin')) return 'bi-water';
            return 'bi-star';
        }

        // Mapeo de imagenes reales por categoria
        function getImage(nombre) {
            const c = nombre.toLowerCase();
            if (c.includes('limp') || c.includes('doméstico') || c.includes('domestico'))
                return 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?w=400&h=300&fit=crop&q=80';
            if (c.includes('plom'))
                return 'https://images.unsplash.com/photo-1585704032915-c3400ca199e7?w=400&h=300&fit=crop&q=80';
            if (c.includes('elec'))
                return 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?w=400&h=300&fit=crop&q=80';
            if (c.includes('gas'))
                return 'https://images.unsplash.com/photo-1585771724684-38269d6639fd?w=400&h=300&fit=crop&q=80';
            if (c.includes('pint'))
                return 'https://images.unsplash.com/photo-1562259929-b4e1fd3aef09?w=400&h=300&fit=crop&q=80';
            if (c.includes('jard'))
                return 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=400&h=300&fit=crop&q=80';
            if (c.includes('alba'))
                return 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=400&h=300&fit=crop&q=80';
            if (c.includes('refrigeración') || c.includes('refrigeracion') || c.includes('aire'))
                return 'https://images.unsplash.com/photo-1631545806609-3c480b5aa990?w=400&h=300&fit=crop&q=80';
            if (c.includes('carpint'))
                return 'https://images.unsplash.com/photo-1558618666-fcd25c85f82e?w=400&h=300&fit=crop&q=80';
            if (c.includes('cerraj'))
                return 'https://images.unsplash.com/photo-1558000143-a78f8299c40b?w=400&h=300&fit=crop&q=80';
            if (c.includes('mudanza') || c.includes('flete'))
                return 'https://images.unsplash.com/photo-1600518464441-9154a4dea21b?w=400&h=300&fit=crop&q=80';
            if (c.includes('tecnico') || c.includes('técnico') || c.includes('comput') || c.includes('pc'))
                return 'https://images.unsplash.com/photo-1587620962725-abab7fe55159?w=400&h=300&fit=crop&q=80';
            if (c.includes('niñera') || c.includes('ninera') || c.includes('cuidado'))
                return 'https://images.unsplash.com/photo-1587654780291-39c9404d7dd0?w=400&h=300&fit=crop&q=80';
            if (c.includes('herreria') || c.includes('herrería') || c.includes('soldad'))
                return 'https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=400&h=300&fit=crop&q=80';
            if (c.includes('vidri'))
                return 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=400&h=300&fit=crop&q=80';
            if (c.includes('fumigar') || c.includes('fumig') || c.includes('plaga'))
                return 'https://images.unsplash.com/photo-1632923057155-1be0cfa1bca0?w=400&h=300&fit=crop&q=80';
            if (c.includes('seguridad') || c.includes('cámara') || c.includes('camara') || c.includes('alarma'))
                return 'https://images.unsplash.com/photo-1558002038-1055907df827?w=400&h=300&fit=crop&q=80';
            if (c.includes('pilet') || c.includes('piscin'))
                return 'https://images.unsplash.com/photo-1576013551627-0cc20b96c2a7?w=400&h=300&fit=crop&q=80';
            if (c.includes('mantenimiento'))
                return 'https://images.unsplash.com/photo-1581092921461-eab62e97a780?w=400&h=300&fit=crop&q=80';
            // Default
            return 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=400&h=300&fit=crop&q=80';
        }

        let allCategories = [];

        function renderCategories(categories) {
            if (!categories || categories.length === 0) {
                container.innerHTML = `
                    <div class="no-results" style="grid-column: 1/-1;">
                        <i class="bi bi-search"></i>
                        <p>No se encontraron categorias</p>
                        <small>Proba con otro termino de busqueda</small>
                    </div>`;
                resultsCount.textContent = '';
                return;
            }

            resultsCount.textContent = categories.length + ' categoria' + (categories.length !== 1 ? 's' : '') + ' encontrada' + (categories.length !== 1 ? 's' : '');

            container.innerHTML = categories.map((cat, i) => {
                const icon = getIcon(cat.nombre);
                const image = getImage(cat.nombre);
                return `
                    <div class="category-card reveal visible" style="animation-delay: ${i * 0.05}s;">
                        <div class="category-card-img-wrapper">
                            <img class="category-card-img" src="${image}" alt="${cat.nombre}" loading="lazy"
                                onerror="this.src='https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=400&h=300&fit=crop&q=80'">
                        </div>
                        <div class="category-card-body">
                            <i class="bi ${icon} icon-hover-bounce"></i>
                            <h4>${cat.nombre}</h4>
                            <button class="btn btn-primary btn-ripple whatsapp-btn" data-category="${cat.nombre}">
                                Iniciar gestion
                            </button>
                        </div>
                    </div>`;
            }).join('');
        }

        function filterCategories(query) {
            const q = query.trim().toLowerCase();
            if (!q) {
                renderCategories(allCategories);
                return;
            }
            const filtered = allCategories.filter(cat =>
                cat.nombre.toLowerCase().includes(q)
            );
            renderCategories(filtered);
        }

        async function loadCategories() {
            try {
                const { data, error } = await supabase
                    .from('categorias')
                    .select('id, nombre')
                    .order('nombre');

                if (error) throw error;

                if (data && data.length > 0) {
                    const uniqueNames = new Set();
                    allCategories = data.filter(cat => {
                        if (!cat.nombre) return false;
                        const lowerName = cat.nombre.trim().toLowerCase();
                        if (uniqueNames.has(lowerName)) return false;
                        uniqueNames.add(lowerName);
                        return true;
                    });
                    renderCategories(allCategories);
                } else {
                    container.innerHTML = '<p class="text-center" style="grid-column:1/-1;color:#666;">No hay categorias disponibles en este momento.</p>';
                }
            } catch (err) {
                console.error('Error loading categories:', err);
                container.innerHTML = '<p class="text-center" style="grid-column:1/-1;color:red;">Error al cargar las categorias. Recarga la pagina.</p>';
            }
        }

        // Buscador
        searchInput.addEventListener('input', () => {
            const val = searchInput.value;
            searchClear.classList.toggle('visible', val.length > 0);
            filterCategories(val);
        });

        searchClear.addEventListener('click', () => {
            searchInput.value = '';
            searchClear.classList.remove('visible');
            filterCategories('');
            searchInput.focus();
        });

        // WhatsApp click handler
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.whatsapp-btn');
            if (btn) {
                e.preventDefault();
                e.stopImmediatePropagation();
                const category = btn.getAttribute('data-category') || 'Servicio General';
                window.open('https://wa.me/' + WHATSAPP_PHONE + '?text=' + encodeURIComponent('Busco un servicio de ' + category), '_blank');
            }
        }, true);

        // Ripple
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.btn-ripple');
            if (!btn) return;
            const ripple = document.createElement('span');
            ripple.className = 'ripple';
            const rect = btn.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
            ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';
            btn.appendChild(ripple);
            ripple.addEventListener('animationend', () => ripple.remove());
        });

        // Scroll reveal
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('visible');
            });
        }, { threshold: 0.1 });

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
        });

        loadCategories();
    </script>

</body>

</html>

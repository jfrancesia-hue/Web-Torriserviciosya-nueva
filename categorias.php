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

        // Mapeo EXHAUSTIVO - Pexels IDs unicos para TODAS las 90+ categorias de Supabase
        function getImage(nombre) {
            const c = nombre.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '');
            const px = (id) => `https://images.pexels.com/photos/${id}/pexels-photo-${id}.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop`;

            const map = {
                'albanil': 2219024,
                'plomero': 6419128,
                'electricista': 8005397,
                'gasista': 6492108,
                'pintor': 6474471,
                'jardinero': 1301856,
                'carpintero': 1094767,
                'cerrajero': 279810,
                'herrero': 2381463,
                'soldador': 2381463,
                'tapicero': 276583,
                'montador de muebles': 5710150,
                'montador de estructuras': 2760243,
                'reparaciones en el hogar': 5691622,
                'limpieza': 4107120,
                'limpieza comercial': 3768914,
                'servicio de limpieza': 4107120,
                'personal de limpieza': 3768914,
                'empleada domestica': 4108715,
                'tecnico en refrigeracion': 5463576,
                'instalador de aire': 5463576,
                'mudanzas': 4246120,
                'fletes': 2199293,
                'delivery': 4393426,
                'chofer privado': 3849167,
                'tecnico de pc': 3825527,
                'reparacion de celulares': 1092644,
                'desarrollador web': 1181467,
                'desarrollador de apps': 1181244,
                'programador': 546819,
                'tester qa': 5483077,
                'community manager': 607812,
                'marketing': 905163,
                'asistente virtual': 4064840,
                'enfermero': 3259629,
                'medico': 4173239,
                'kinesiologo': 5473182,
                'nutricionista': 1640777,
                'psicologo': 5699475,
                'terapista ocupacional': 5699456,
                'masajista': 3757942,
                'profesor de yoga': 3822906,
                'cuidado de ninos': 3662770,
                'cuidado de ancianos': 7551667,
                'animador infantil': 3661193,
                'estilista': 3993449,
                'manicurista': 3997391,
                'maquillador profesional': 457701,
                'chef': 2544829,
                'chef personal': 3338497,
                'cocinero': 3338681,
                'ayudante de cocina': 2544829,
                'panadero': 1775043,
                'pastelero': 1291712,
                'camarero': 3201762,
                'mozos para eventos': 3201762,
                'organizador de eventos': 2306281,
                'decoraciones para eventos': 1616113,
                'dj para eventos': 2111015,
                'fotografo': 1264210,
                'camarografo': 2873486,
                'paseador de perros': 1390361,
                'peluqueria de mascotas': 6816860,
                'veterinario': 6235233,
                'mecanico': 3807517,
                'gomeria': 3806249,
                'lavado de autos': 6872573,
                'abogado': 5669619,
                'contador': 6863183,
                'asistente contable': 6863183,
                'arquitecto': 3760529,
                'ingeniero': 3862632,
                'consultor de negocios': 3183150,
                'gestor de tramites': 5668858,
                'profesor particular': 5212345,
                'profesor de musica': 4709822,
                'instructor de manejo': 3422964,
                'cursos': 4145190,
                'coach de vida': 3184611,
                'personal de seguridad': 430208,
                'instalador de camaras': 430208,
                'instalador de paneles solares': 9875441,
                'disenador grafico': 1779487,
                'disenador industrial': 3913025,
                'editor de video': 2510428,
                'redactor de contenidos': 261662,
                'ilustrador': 3094218,
                'guionista': 3059747,
                'traductor': 256417,
                'traductor jurado': 159711,
                'modista': 3738088,
                'reparador de electrodomesticos': 5691622,
                'electromecanico': 5691622,
                'entrenador personal': 841130,
                'encargado de deposito': 4483610,
                'mi primer trabajo': 3184405,
                'servicio': 3184325,
                'atencion al cliente': 8867434,
                'general': 1249611,
            };

            // Normalizar nombre para comparar (quitar acentos)
            const normalize = (s) => s.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '');

            // Match exacto
            for (const [key, id] of Object.entries(map)) {
                if (c === normalize(key)) return px(id);
            }

            // Match parcial (el nombre contiene la key o viceversa)
            for (const [key, id] of Object.entries(map)) {
                const nk = normalize(key);
                if (c.includes(nk) || nk.includes(c)) return px(id);
            }

            // Default
            return px(1249611);
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

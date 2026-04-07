<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Agentes - ServiciosYa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
            height: 100vh;
            overflow: hidden;
        }
        
        .container {
            display: flex;
            height: 100vh;
        }

        /* --- Responsive para móvil --- */
        @media (max-width: 700px) {
            .container {
                flex-direction: column;
            }
            .sidebar, .main {
                width: 100vw !important;
                min-width: 0;
                max-width: 100vw;
                height: 100dvh !important;
                max-height: 100dvh;
            }
            .sidebar {
                display: block;
            }
            .main {
                display: none;
            }
            .container.show-chat .sidebar {
                display: none !important;
            }
            .container.show-chat .main {
                display: block !important;
            }
            .main-header {
                flex-direction: row;
                align-items: center;
            }
            .btn-volver {
                display: inline-block;
                background: none;
                border: none;
                font-size: 22px;
                margin-right: 10px;
                color: #075e54;
                cursor: pointer;
            }
        }
        @media (min-width: 701px) {
            .btn-volver {
                display: none !important;
            }
            .container {
                flex-direction: row !important;
            }
            .sidebar {
                display: flex !important;
                width: 350px;
                min-width: 250px;
                max-width: 400px;
                height: 100vh !important;
                border-right: 1px solid #e0e0e0;
            }
            .main {
                display: flex !important;
                flex: 1;
                height: 100vh !important;
            }
        }
        
        /* Sidebar - Lista de chats */
        .sidebar {
            width: 350px;
            background: white;
            border-right: 1px solid #e0e0e0;
            display: flex;
            flex-direction: column;
        }
        
        .sidebar-header {
            padding: 15px 20px;
            background: #075e54;
            color: white;
        }
        
        .sidebar-header h1 {
            font-size: 18px;
            font-weight: 500;
        }
        
        .sidebar-header p {
            font-size: 12px;
            opacity: 0.8;
            margin-top: 5px;
        }
        
        .chat-list {
            flex: 1;
            overflow-y: auto;
        }
        
        .chat-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
            transition: background 0.2s;
        }
        
        .chat-item:hover {
            background: #f5f5f5;
        }
        
        .chat-item.active {
            background: #ebebeb;
        }
        
        .chat-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: #dfe5e7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #fff;
            margin-right: 12px;
        }
        
        .chat-avatar.ia { background: #25d366; }
        .chat-avatar.agente { background: #ff9800; }
        
        .chat-info {
            flex: 1;
            overflow: hidden;
        }
        
        .chat-name {
            font-weight: 500;
            font-size: 15px;
            color: #111;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .chat-name .badge {
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 10px;
            font-weight: normal;
        }
        
        .badge.ia { background: #e8f5e9; color: #2e7d32; }
        .badge.agente { background: #fff3e0; color: #e65100; }
        
        .chat-preview {
            font-size: 13px;
            color: #667781;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-top: 3px;
        }
        
        .chat-time {
            font-size: 11px;
            color: #667781;
        }
        
        /* Main chat area */
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #e5ddd5;
        }
        
        .main-header {
            padding: 10px 20px;
            background: #ededed;
            border-bottom: 1px solid #d0d0d0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .main-header-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .media-preview {
            display: flex;
            gap: 8px;
            margin-top: 8px;
        }
        .media-preview img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #e0e0e0;
        }
        
        .main-header-info h2 {
            font-size: 16px;
            font-weight: 500;
        }
        
        .main-header-info p {
            font-size: 12px;
            color: #667781;
        }
        
        .main-header-actions {
            display: flex;
            gap: 10px;
        }
        
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
            transition: opacity 0.2s;
        }
        
        .btn:hover {
            opacity: 0.9;
        }
        
        .btn-intervenir {
            background: #ff9800;
            color: white;
        }
        
        .btn-devolver {
            background: #25d366;
            color: white;
        }
        
        .btn-enviar {
            background: #075e54;
            color: white;
        }
        
        /* Messages area */
        .messages {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23d4d4d4' fill-opacity='0.15'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zM36 0V4h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        
        .message {
            max-width: 65%;
            padding: 8px 12px;
            border-radius: 8px;
            margin-bottom: 10px;
            position: relative;
            word-wrap: break-word;
        }
        
        .message.user {
            background: white;
            margin-right: auto;
            border-bottom-left-radius: 0;
        }
        
        .message.assistant {
            background: #dcf8c6;
            margin-left: auto;
            border-bottom-right-radius: 0;
        }
        
        .message.assistant.agente {
            background: #fff3e0;
            border-left: 3px solid #ff9800;
        }
        
        .message-content {
            font-size: 14px;
            line-height: 1.4;
            color: #111;
        }
        
        .message-time {
            font-size: 10px;
            color: #667781;
            text-align: right;
            margin-top: 4px;
        }
        
        .message-sender {
            font-size: 11px;
            font-weight: 600;
            margin-bottom: 4px;
        }
        
        .message.user .message-sender { color: #075e54; }
        .message.assistant .message-sender { color: #25d366; }
        .message.assistant.agente .message-sender { color: #ff9800; }
        
        /* Input area */
        .input-area {
            padding: 15px 20px;
            background: #f0f0f0;
            display: flex;
            gap: 10px;
            align-items: center;
        }
        
        .input-area input {
            flex: 1;
            padding: 12px 15px;
            border: none;
            border-radius: 25px;
            font-size: 14px;
            outline: none;
        }
        
        .input-area input:focus {
            box-shadow: 0 0 0 2px rgba(7, 94, 84, 0.2);
        }
        
        /* Empty state */
        .empty-state {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #667781;
        }
        
        .empty-state svg {
            width: 200px;
            height: 200px;
            opacity: 0.5;
            margin-bottom: 20px;
        }
        
        .empty-state h3 {
            font-size: 24px;
            font-weight: 300;
            margin-bottom: 10px;
        }
        
        .empty-state p {
            font-size: 14px;
        }
        
        /* Status indicator */
        .status-indicator {
            padding: 8px 15px;
            background: #fff3e0;
            color: #e65100;
            font-size: 13px;
            text-align: center;
            border-bottom: 1px solid #ffcc80;
        }
        
        .status-indicator.ia {
            background: #e8f5e9;
            color: #2e7d32;
            border-bottom-color: #a5d6a7;
        }
        
        /* Loading */
        .loading {
            text-align: center;
            padding: 20px;
            color: #667781;
        }
        
        /* Refresh indicator */
        .refresh-indicator {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #075e54;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 12px;
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        .refresh-indicator.visible {
            opacity: 1;
        }

        /* Mostrar chat en móvil */
        .container.show-chat {
            flex-direction: column;
        }
        
        .sidebar {
            width: 100%;
            height: 60vh;
            border-right: none;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .main {
            width: 100%;
            height: 40vh;
            overflow-y: auto;
        }
        
        .main-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .main-header-info {
            margin-bottom: 10px;
        }
        
        .btn-volver {
            background: #f0f0f0;
            color: #075e54;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.2s;
        }
        
        .btn-volver:hover {
            background: #e0e0e0;
        }


        /* Tabs del chat */
.chat-tabs {
    display: flex;
    background: #f5f5f5;
    border-bottom: 1px solid #d0d0d0;
}
.chat-tab {
    padding: 8px 18px;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    border-bottom: 3px solid transparent;
    color: #667781;
    transition: all 0.2s;
    user-select: none;
}
.chat-tab.active {
    color: #075e54;
    border-bottom-color: #075e54;
    background: white;
}
.chat-tab:hover:not(.active) {
    background: #ebebeb;
}

/* Tab de profesionales */
.notif-list {
    flex: 1;
    overflow-y: auto;
    padding: 16px 20px;
    background: #f8f9fa;
}
.notif-item {
    background: white;
    border-radius: 8px;
    padding: 12px 14px;
    margin-bottom: 10px;
    border-left: 4px solid #25d366;
    box-shadow: 0 1px 3px rgba(0,0,0,0.07);
}
.notif-item.error {
    border-left-color: #e53935;
}
.notif-nombre {
    font-weight: 600;
    font-size: 14px;
    color: #111;
}
.notif-celular {
    font-size: 12px;
    color: #667781;
    margin-top: 2px;
}
.notif-estado {
    display: inline-block;
    margin-top: 6px;
    font-size: 11px;
    padding: 2px 8px;
    border-radius: 10px;
    font-weight: 500;
}
.notif-estado.ok { background: #e8f5e9; color: #2e7d32; }
.notif-estado.error { background: #ffebee; color: #c62828; }
.notif-estado.desconocido { background: #f5f5f5; color: #999; }
.notif-ts {
    font-size: 10px;
    color: #aaa;
    text-align: right;
    margin-top: 4px;
}
.notif-empty {
    text-align: center;
    color: #aaa;
    padding: 40px 0;
    font-size: 14px;
}
    </style>
</head>
<body>
    <div class="container" id="mainContainer">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h1>📱 Panel de Agentes</h1>
                <p>ServiciosYa - Conversaciones activas</p>
            </div>
            <div class="chat-list" id="chatList">
                <div class="loading">Cargando conversaciones...</div>
            </div>
        </div>
        
        <!-- Main area -->
        <div class="main" id="mainArea">
            <div class="empty-state">
                <svg viewBox="0 0 303 172" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#DFE5E7" d="M229.565 160.229c32.647-16.253 54.392-48.613 54.392-85.96C283.957 33.19 250.768 0 209.686 0c-27.54 0-51.603 14.905-64.55 37.06C132.193 14.905 108.13 0 80.59 0 39.507 0 6.32 33.19 6.32 74.27c0 37.347 21.745 69.707 54.392 85.96H.003v11.412h303.83v-11.412H229.565z"/>
                </svg>
                <h3>Panel de Agentes</h3>
                <p>Seleccioná una conversación para ver los mensajes</p>
            </div>
        </div>
    </div>
    
    <div class="refresh-indicator" id="refreshIndicator">🔄 Actualizando...</div>
    <audio id="audioNoti" src="notificacion.mp3" preload="auto"></audio>
    <script>
        let currentChatId = null;
        let autoRefreshInterval = null;
        let lastMessageIds = {};
        
        // Cargar lista de chats y notificar si hay mensajes nuevos o chats nuevos
        let knownChats = {};
        async function cargarChats() {
    try {
        const response = await fetch('api_panel.php?action=listar_chats');
        
        // ← Agregá esto para debuggear:
        const text = await response.text();
        console.log('[DEBUG] Respuesta cruda:', text);
        
        if (!text || text.trim() === '') {
            console.error('[ERROR] Respuesta vacía del servidor');
            return;
        }
        
        let data;
        try {
            data = JSON.parse(text);
        } catch (e) {
            console.error('[ERROR] JSON inválido:', text);
            return;
        }
        
        if (data.success) {

                    const nuevosChats = data.data;
                    nuevosChats.forEach(chat => {
                        // Detectar chat nuevo
                        if (!knownChats[chat.id]) {
                            knownChats[chat.id] = chat.ultimo_timestamp;
                            if (chat.ultimo_mensaje && chat.ultimo_timestamp) {
                                reproducirBeep();
                                if (document.hidden) {
                                    mostrarNotificacion(chat.nombre || 'Nuevo chat', chat.ultimo_mensaje);
                                }
                                console.log('[NOTI] Nuevo chat detectado:', chat);
                            }
                        } else {
                            // Detectar mensaje nuevo en chat existente
                            if (chat.ultimo_timestamp && knownChats[chat.id] !== chat.ultimo_timestamp) {
                                // Para saber si es del usuario, hay que pedir el historial
                                fetch(`api_panel.php?action=obtener_chat&id=${chat.id}`)
                                    .then(r => r.json())
                                    .then(res => {
                                        if (res.success && res.data && res.data.mensajes && res.data.mensajes.length > 0) {
                                            const lastMsg = res.data.mensajes[res.data.mensajes.length - 1];
                                            console.log('[NOTI][GLOBAL] Último mensaje en chat', chat.id, lastMsg);
                                            if (lastMsg.role === 'user') {
                                                reproducirBeep();
                                                if (document.hidden) {
                                                    mostrarNotificacion(chat.nombre || 'Cliente', lastMsg.content || 'Nuevo mensaje');
                                                }
                                            }
                                        }
                                    });
                                knownChats[chat.id] = chat.ultimo_timestamp;
                            }
                        }
                    });
                    renderizarChats(nuevosChats);
                }
            } catch (error) {
                console.error('Error cargando chats:', error);
            }
        }
        
        // Renderizar lista de chats
        function renderizarChats(chats) {
            // Ordenar por timestamp del último mensaje (desc), si existe
            chats = chats.slice().sort((a, b) => {
                if (a.ultimo_timestamp && b.ultimo_timestamp) {
                    return b.ultimo_timestamp.localeCompare(a.ultimo_timestamp);
                } else if (a.ultimo_timestamp) {
                    return -1;
                } else if (b.ultimo_timestamp) {
                    return 1;
                } else {
                    return 0;
                }
            });
            const container = document.getElementById('chatList');
            container.innerHTML = chats.map(chat => {
                const inicial = (chat.nombre || 'U')[0].toUpperCase();
                const badgeClass = chat.modo_agente ? 'agente' : 'ia';
                const badgeText = chat.modo_agente ? '👤 Agente' : '🤖 Mica';
                const activeClass = chat.id === currentChatId ? 'active' : '';
                return `
                    <div class="chat-item ${activeClass}" onclick="abrirChat(${chat.id}, event)">
                        <div class="chat-avatar ${badgeClass}">${inicial}</div>
                        <div class="chat-info">
                            <div class="chat-name">
                                ${chat.nombre || 'Sin nombre'}
                                <span class="badge ${badgeClass}">${badgeText}</span>
                            </div>
                            <div class="chat-preview">${chat.ultimo_mensaje || 'Sin mensajes'}</div>
                        </div>
                    </div>
                `;
            }).join('');
        }
        
        // Abrir un chat
        async function abrirChat(id, event) {
            currentChatId = id;
            cargarChats(); // Actualizar lista para marcar activo
            // En móvil, mostrar solo el chat
            if (window.innerWidth <= 700) {
                document.getElementById('mainContainer').classList.add('show-chat');
            }
            try {
                const response = await fetch(`api_panel.php?action=obtener_chat&id=${id}`);
                const data = await response.json();
                
                if (data.success) {
                    renderizarChat(data.data);
                }
            } catch (error) {
                console.error('Error cargando chat:', error);
            }
        }
        

        // Reproducir notificacion.mp3 (debe haber interacción previa para desbloquear audio en algunos navegadores)
        let audioDesbloqueado = false;
        function desbloquearAudio() {
            if (audioDesbloqueado) return;
            const audio = document.getElementById('audioNoti');
            if (audio) {
                audio.play().then(() => {
                    console.log('[NOTI] Audio desbloqueado y reproducido por interacción.');
                }).catch((err) => {
                    console.warn('[NOTI] Error al desbloquear audio:', err);
                });
                audioDesbloqueado = true;
            } else {
                console.warn('[NOTI] No se encontró el elemento audioNoti para desbloquear.');
            }
        }
        document.addEventListener('click', desbloquearAudio, { once: true });

        function reproducirBeep() {
            const audio = document.getElementById('audioNoti');
            if (audio) {
                audio.currentTime = 0;
                audio.play().then(() => {
                    console.log('[NOTI] Sonido de notificación reproducido.');
                }).catch((err) => {
                    console.warn('[NOTI] Error al reproducir sonido:', err);
                });
            } else {
                console.warn('[NOTI] No se encontró el elemento audioNoti para reproducir.');
            }
        }


// ---- NOTIFICACIONES del sistema ----
function pedirPermisoNotificaciones() {
    if ('Notification' in window && Notification.permission === 'default') {
        Notification.requestPermission();
    }
}

function mostrarNotificacion(nombre, mensaje) {
    if ('Notification' in window && Notification.permission === 'granted') {
        new Notification(`💬 Nuevo mensaje de ${nombre}`, {
            body: mensaje,
            // icon opcional: 'icono.png'
        });
    }
}

// ---- Notificación sonora y visual ----
function notificarSonido(chat) {
    if (chat.mensajes && chat.mensajes.length > 0) {
        const lastMsg = chat.mensajes[chat.mensajes.length - 1];
        const lastId = lastMsg.id || lastMsg.timestamp || JSON.stringify(lastMsg);
        console.log('[NOTI][DEBUG] Último mensaje recibido:', lastMsg);
        if (lastMessageIds[chat.id] !== lastId) {
            // Solo notificar mensajes del cliente (no los de Mica ni del agente)
            if (lastMsg.role === 'user') {
                console.log('[NOTI] Nuevo mensaje de usuario detectado:', lastMsg);
                reproducirBeep();
                if (document.hidden) {
                    console.log('[NOTI] Pestaña en segundo plano, mostrando notificación del sistema.');
                    mostrarNotificacion(chat.nombre || 'Cliente', lastMsg.content || 'Nuevo mensaje');
                }
            } else {
                console.log('[NOTI] Mensaje nuevo no es de usuario, no se reproduce sonido.');
            }
            lastMessageIds[chat.id] = lastId;
        }
    }
}

        // Renderizar área de chat
        // si soloMensajes == true, solo actualiza el contenedor de mensajes y preserva scroll
        function renderizarChat(chat, soloMensajes = false) {

            // Detectar si el último mensaje del cliente fue hace más de 24hs
let fuera24hs = false;
if (chat.mensajes && chat.mensajes.length > 0) {
    // Buscar el último mensaje del cliente (role === 'user')
    const mensajesCliente = chat.mensajes.filter(m => m.role === 'user');
    if (mensajesCliente.length > 0) {
        const ultimo = mensajesCliente[mensajesCliente.length - 1];
        if (ultimo.timestamp) {
            const fechaUltimo = new Date(ultimo.timestamp);
            const ahora = new Date();
            const diffHoras = (ahora - fechaUltimo) / (1000 * 60 * 60);
            fuera24hs = diffHoras > 24;
        }
    } else {
        // Nunca escribió el cliente
        fuera24hs = true;
    }
}

            const container = document.getElementById('mainArea');
            const statusClass = chat.modo_agente ? '' : 'ia';
            const statusText = chat.modo_agente 
                ? '👤 Modo AGENTE - Mica está pausada, vos estás respondiendo' 
                : '🤖 Modo IA - Mica está respondiendo automáticamente';
            
            const btnIntervenir = chat.modo_agente
                ? `<button class="btn btn-devolver" onclick="devolverIA(${chat.id})">🤖 Devolver a Mica</button>`
                : `<button class="btn btn-intervenir" onclick="intervenir(${chat.id})">👤 Intervenir</button>`;
            
            // Pasar media_url al renderizador de mensajes
            let mediaUrls = [];
            if (chat.media_url && chat.media_url.trim() !== '') {
                mediaUrls = chat.media_url.split(',').map(u => u.trim()).filter(u => u);
            }
            window.currentChatMediaUrls = mediaUrls;
            // Construir HTML de preview de media (thumbnails) si hay mediaUrls
            let previewHtml = '';
            if (mediaUrls.length > 0) {
                previewHtml = '<div class="media-preview">' + mediaUrls.map(u => {
                    const urlEnc = encodeURIComponent(u);
                    const proxy = `media_proxy.php?url=${urlEnc}`;
                    return `<a href="${proxy}" target="_blank"><img src="${proxy}" alt="media"></a>`;
                }).join('') + '</div>';
            }

            // PRESERVAR SCROLL: antes de reemplazar, capturamos el contenedor de mensajes
            const existingMessagesContainer = document.getElementById('messagesContainer');
            let prevScrollTop = 0;
            let prevScrollHeight = 0;
            let atBottom = true;
            if (existingMessagesContainer) {
                prevScrollTop = existingMessagesContainer.scrollTop;
                prevScrollHeight = existingMessagesContainer.scrollHeight;
                atBottom = (prevScrollHeight - prevScrollTop - existingMessagesContainer.clientHeight) < 150; // umbral
            }

            // Renderizar el HTML de mensajes por separado (útil para soloMensajes)
            const messagesHtml = renderizarMensajes(chat.mensajes, mediaUrls);

            // Si pedimos solo actualizar mensajes, reemplazamos únicamente ese contenedor y preservamos scroll
            if (soloMensajes && existingMessagesContainer) {
                existingMessagesContainer.innerHTML = messagesHtml;
                // Restaurar scroll: si estaba pegado al final, mantener abajo; si no, intentar mantener misma posición
                if (atBottom) {
                    existingMessagesContainer.scrollTop = existingMessagesContainer.scrollHeight;
                } else {
                    existingMessagesContainer.scrollTop = prevScrollTop;
                }
                return;
            }
            // Guardar valor y foco del input antes de refrescar
            let prevInput = '';
            let wasFocused = false;
            const oldInput = document.getElementById('mensajeInput');
            if (oldInput) {
                prevInput = oldInput.value;
                wasFocused = document.activeElement === oldInput;
            }

            container.innerHTML = `
    <div class="main-header">
        <button class="btn-volver" onclick="volverALista(event)">&#8592;</button>
                <div class="main-header-info">
            <div>
                <h2>${chat.nombre || 'Sin nombre'}</h2>
                <p>${chat.telefono} • ${chat.categoria || 'Sin categoría'} • ${chat.zona || 'Sin zona'}</p>
                ${previewHtml}
            </div>
        </div>
        <div class="main-header-actions">
            ${btnIntervenir}
        </div>
    </div>
    <div class="status-indicator ${statusClass}">${statusText}</div>
    <div class="chat-tabs">
        <div class="chat-tab active" id="tabMensajes" onclick="mostrarTab('mensajes', ${chat.id})">💬 Mensajes</div>
        <div class="chat-tab" id="tabProfesionales" onclick="mostrarTab('profesionales', ${chat.id})">🔔 Profesionales</div>
    </div>
    <div id="panelMensajes" style="display:flex; flex-direction:column; flex:1; overflow:hidden;">
        <div class="messages" id="messagesContainer">
            ${messagesHtml}
        </div>
        ${fuera24hs ? `
    <div style="background:#fff3e0; color:#e65100; padding:10px 16px; font-size:13px; border-top:1px solid #ffcc80; text-align:center;">
        ⚠️ El cliente no escribió en las últimas 24hs. No podés enviarle mensajes libres por WhatsApp.
    </div>
` : ''}
<div class="input-area">
    <input type="text" id="mensajeInput" 
        placeholder="${fuera24hs ? 'Sin sesión activa (más de 24hs)' : 'Escribí un mensaje...'}" 
        onkeypress="handleKeyPress(event, ${chat.id})"
        ${fuera24hs ? 'disabled' : ''}>
    <button class="btn btn-enviar" onclick="enviarMensaje(${chat.id})" 
        ${fuera24hs ? 'disabled style="opacity:0.4;cursor:not-allowed;"' : ''}>
        📤 Enviar
    </button>
</div>
    </div>
    <div id="panelProfesionales" class="notif-list" style="display:none;">
        <div class="notif-empty">⏳ Cargando...</div>
    </div>
`;
            notificarSonido(chat);



            

            // Restaurar valor y foco del input
            const newInput = document.getElementById('mensajeInput');
            if (newInput) {
                newInput.value = prevInput;
                if (wasFocused) {
                    newInput.focus();
                }
            }

            // Restaurar/ajustar scroll según estado previo
            const messagesContainer = document.getElementById('messagesContainer');
            if (messagesContainer) {
                if (atBottom) {
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                } else {
                    messagesContainer.scrollTop = prevScrollTop;
                }
            }
        }
        

// ---- Tabs del chat ----
let tabActiva = 'mensajes';

function mostrarTab(tab, chatId) {
    tabActiva = tab;
    document.getElementById('tabMensajes').classList.toggle('active', tab === 'mensajes');
    document.getElementById('tabProfesionales').classList.toggle('active', tab === 'profesionales');
    document.getElementById('panelMensajes').style.display = tab === 'mensajes' ? 'flex' : 'none';
    document.getElementById('panelProfesionales').style.display = tab === 'profesionales' ? 'block' : 'none';

    if (tab === 'profesionales') {
        cargarNotifProfesionales(chatId);
    }
}

async function cargarNotifProfesionales(chatId) {
    const panel = document.getElementById('panelProfesionales');
    panel.innerHTML = '<div class="notif-empty">⏳ Cargando...</div>';
    try {
        const res = await fetch(`api_panel.php?action=notif_profesionales&id=${chatId}`);
        const data = await res.json();
        if (!data.success || data.data.length === 0) {
            panel.innerHTML = '<div class="notif-empty">📭 No se enviaron notificaciones a profesionales aún.</div>';
            return;
        }
        panel.innerHTML = data.data.map(n => `
            <div class="notif-item ${n.estado === 'error' ? 'error' : ''}">
                <div class="notif-nombre">👷 ${escapeHtml(n.nombre)}</div>
                <div class="notif-celular">📱 ${escapeHtml(n.celular)}</div>
                ${n.categoria ? `<div class="notif-celular">🔧 ${escapeHtml(n.categoria)}</div>` : ''}
                <span class="notif-estado ${n.estado}">
                    ${n.estado === 'ok' ? '✅ Enviado' : n.estado === 'error' ? '❌ Error' : '❓ Desconocido'}
                </span>
                ${n.timestamp ? `<div class="notif-ts">${n.timestamp}</div>` : ''}
            </div>
        `).join('');
    } catch (e) {
        panel.innerHTML = '<div class="notif-empty">❌ Error al cargar.</div>';
    }
}

        // Renderizar mensajes
      function renderizarMensajes(mensajes, mediaUrls = []) {
    // Dominios que SÍ son media real (Twilio, Supabase storage)
    const MEDIA_DOMINIOS = ['api.twilio.com', 'media.twilio.com', 'supabase.co/storage'];

    let mediaIndex = 0;
    return mensajes.map(msg => {
        const isUser = msg.role === 'user';
        const isAgente = msg.agente === true;
        const senderName = isUser ? '👤 Cliente' : (isAgente ? '👤 Agente' : '🤖 Mica');
        const agenteClass = isAgente ? 'agente' : '';

        let time = '';
        if (msg.timestamp) {
            let date;
            if (msg.timestamp.includes('T')) {
                date = new Date(msg.timestamp);
            } else {
                const iso = msg.timestamp.replace(' ', 'T') + 'Z';
                date = new Date(iso);
            }
            if (!isNaN(date.getTime())) {
                time = date.toLocaleString('es-AR', {
                    day: '2-digit', month: '2-digit', year: 'numeric',
                    hour: '2-digit', minute: '2-digit'
                });
            }
        }

        let contentHtml = '';

        if (msg.content === '[Envió imagen/video]' && mediaUrls[mediaIndex]) {
            // Caso 1: marcador de media con URL real de la oferta
            const proxyUrl = `media_proxy.php?url=${encodeURIComponent(mediaUrls[mediaIndex])}`;
            contentHtml = `<a href="${proxyUrl}" target="_blank">
                <img src="${proxyUrl}" style="max-width:180px;max-height:180px;border-radius:8px;border:1px solid #ccc;">
            </a>`;
            mediaIndex++;

        } else if (msg.content && typeof msg.content === 'string') {
            // Caso 2: texto normal — separar URLs de media real de URLs de texto
            const urlRegex = /https?:\/\/[\w\-\.\/:\?\=\&\%\#\@\+]+/g;
            let resultado = msg.content;
            const urlsMedia = [];

            // Detectar solo URLs que son de almacenamiento/media real
            const matches = [...msg.content.matchAll(urlRegex)];
            matches.forEach(m => {
                const url = m[0];
                const esMedia = MEDIA_DOMINIOS.some(d => url.includes(d));
                if (esMedia) {
                    urlsMedia.push(url);
                    resultado = resultado.replace(url, ''); // sacar del texto solo las de media
                }
                // Las URLs de texto (mercadopago, tooriserviciosya, play.google, etc.) 
                // se dejan en el texto y se convierten en links clicables
            });

            // Convertir URLs de texto en links clicables (sin sacarlas del texto)
            resultado = escapeHtml(resultado.trim());
            resultado = resultado.replace(
                /https?:\/\/[\w\-\.\/:\?\=\&amp;\%\#\@\+]+/g,
                url => `<a href="${url.replace(/&amp;/g, '&')}" target="_blank" style="color:#075e54;">${url}</a>`
            );

            contentHtml = resultado;

            // Agregar miniaturas solo de las URLs de media real
            urlsMedia.forEach(u => {
                const proxy = 'media_proxy.php?url=' + encodeURIComponent(u);
                contentHtml += `<div style="margin-top:6px;">
                    <a href="${proxy}" target="_blank">
                        <img src="${proxy}" style="max-width:240px;max-height:240px;border-radius:8px;border:1px solid #ccc;">
                    </a>
                </div>`;
            });
        }

        return `
            <div class="message ${msg.role} ${agenteClass}">
                <div class="message-sender">${senderName}</div>
                <div class="message-content">${contentHtml}</div>
                ${time ? `<div class="message-time">${time}</div>` : ''}
            </div>
        `;
    }).join('');
}

// Función auxiliar para escapar HTML y reemplazar saltos de línea
function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML.replace(/\n/g, '<br>');
}
        
        
    
        async function enviarMensaje(chatId) {
            const input = document.getElementById('mensajeInput');
            const mensaje = input.value.trim();
            
            if (!mensaje) return;
            
            input.value = '';
            input.disabled = true;
            
            try {
                const formData = new FormData();
                formData.append('action', 'enviar_mensaje');
                formData.append('id', chatId);
                formData.append('mensaje', mensaje);
                
                const response = await fetch('api_panel.php', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    abrirChat(chatId); // Recargar chat
                } else {
                    alert('Error: ' + data.error);
                }
            } catch (error) {
                console.error('Error enviando mensaje:', error);
                alert('Error al enviar mensaje');
            }
            
            input.disabled = false;
            input.focus();
        }
        
        // Intervenir
        async function intervenir(chatId) {
            try {
                const formData = new FormData();
                formData.append('action', 'intervenir');
                formData.append('id', chatId);
                
                const response = await fetch('api_panel.php', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    abrirChat(chatId);
                    cargarChats();
                }
            } catch (error) {
                console.error('Error:', error);
            }
        }
        
        // Devolver a IA
        async function devolverIA(chatId) {
            try {
                const formData = new FormData();
                formData.append('action', 'devolver_ia');
                formData.append('id', chatId);
                
                const response = await fetch('api_panel.php', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    abrirChat(chatId);
                    cargarChats();
                }
            } catch (error) {
                console.error('Error:', error);
            }
        }
        
        // Handle Enter key
        function handleKeyPress(event, chatId) {
            if (event.key === 'Enter') {
                enviarMensaje(chatId);
            }
        }
        
        // Auto-refresh mejorado: solo actualiza mensajes del chat abierto
        function iniciarAutoRefresh() {
            autoRefreshInterval = setInterval(async () => {
                await cargarChats();
                if (currentChatId) {
                    try {
                        const response = await fetch(`api_panel.php?action=obtener_chat&id=${currentChatId}`);
                        const data = await response.json();
                        if (data.success) {
                            renderizarChat(data.data, true); // soloMensajes = true
                        }
                    } catch (e) {}
                }
            }, 5000);
        }
        
        // Botón volver en móvil
        function volverALista(e) {
            if (e) e.preventDefault(); // Evita navegación por defecto
            document.getElementById('mainContainer').classList.remove('show-chat');
            return false;
        }
        
        // Inicializar
        document.addEventListener('DOMContentLoaded', () => {
    cargarChats();
    iniciarAutoRefresh();
    pedirPermisoNotificaciones(); // Pide permiso al cargar
});
        document.addEventListener('visibilitychange', () => {
            // Limpiar para evitar noti duplicada al volver a primer plano
            if (!document.hidden) lastMessageIds = {};
        });
    </script>
</body>
</html>

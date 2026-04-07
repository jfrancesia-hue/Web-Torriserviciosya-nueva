/**
 * TOORI GLOBAL JS
 * - Toast notifications (reemplaza alert())
 * - Scroll progress bar
 * - WhatsApp tooltip animado
 */

// ===================== TOAST NOTIFICATIONS =====================
(function() {
    // Crear contenedor de toasts
    const container = document.createElement('div');
    container.id = 'toori-toast-container';
    container.style.cssText = `
        position: fixed;
        top: 24px;
        right: 24px;
        z-index: 99999;
        display: flex;
        flex-direction: column;
        gap: 10px;
        pointer-events: none;
    `;
    document.body.appendChild(container);

    // Estilos de toast
    const style = document.createElement('style');
    style.textContent = `
        .toori-toast {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            border-radius: 14px;
            background: white;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            border-left: 4px solid #3ba8e0;
            max-width: 380px;
            pointer-events: all;
            animation: toastIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            font-family: var(--font-body, 'Lexend Deca', sans-serif);
            font-size: 0.92rem;
            color: #333;
            line-height: 1.4;
        }

        .toori-toast.toast-out {
            animation: toastOut 0.3s ease-in forwards;
        }

        .toori-toast.toast-success { border-left-color: #27ae60; }
        .toori-toast.toast-error   { border-left-color: #e74c3c; }
        .toori-toast.toast-warning { border-left-color: #f59e0b; }
        .toori-toast.toast-info    { border-left-color: #3ba8e0; }

        .toori-toast-icon {
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .toori-toast.toast-success .toori-toast-icon { color: #27ae60; }
        .toori-toast.toast-error .toori-toast-icon   { color: #e74c3c; }
        .toori-toast.toast-warning .toori-toast-icon  { color: #f59e0b; }
        .toori-toast.toast-info .toori-toast-icon     { color: #3ba8e0; }

        .toori-toast-close {
            margin-left: auto;
            background: none;
            border: none;
            color: #aaa;
            font-size: 1.1rem;
            cursor: pointer;
            padding: 0 0 0 8px;
            flex-shrink: 0;
            transition: color 0.2s;
        }

        .toori-toast-close:hover { color: #333; }

        @keyframes toastIn {
            from { opacity: 0; transform: translateX(40px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        @keyframes toastOut {
            from { opacity: 1; transform: translateX(0); }
            to   { opacity: 0; transform: translateX(40px); }
        }

        @media (max-width: 480px) {
            #toori-toast-container {
                top: auto !important;
                bottom: 80px !important;
                right: 12px !important;
                left: 12px !important;
            }
            .toori-toast { max-width: 100%; }
        }

        /* ===================== SCROLL PROGRESS BAR ===================== */
        #scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--toori-blue, #3ba8e0), var(--toori-green, #aecd5a), var(--toori-purple, #874e99));
            z-index: 100000;
            width: 0%;
            transition: width 0.1s linear;
            border-radius: 0 2px 2px 0;
        }

        /* ===================== WHATSAPP TOOLTIP ===================== */
        .wa-tooltip {
            position: fixed;
            bottom: 90px;
            right: 25px;
            background: white;
            color: #333;
            padding: 10px 16px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.12);
            font-size: 0.85rem;
            font-weight: 500;
            z-index: 999;
            opacity: 0;
            transform: translateY(10px) scale(0.9);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            pointer-events: none;
            white-space: nowrap;
            font-family: var(--font-body, 'Lexend Deca', sans-serif);
        }

        .wa-tooltip::after {
            content: '';
            position: absolute;
            bottom: -6px;
            right: 20px;
            width: 12px;
            height: 12px;
            background: white;
            transform: rotate(45deg);
            box-shadow: 2px 2px 4px rgba(0,0,0,0.05);
        }

        .wa-tooltip.visible {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    `;
    document.head.appendChild(style);

    // Iconos por tipo
    const icons = {
        success: 'bi-check-circle-fill',
        error: 'bi-x-circle-fill',
        warning: 'bi-exclamation-triangle-fill',
        info: 'bi-info-circle-fill'
    };

    /**
     * Muestra un toast
     * @param {string} message - Texto del toast
     * @param {string} type - 'success' | 'error' | 'warning' | 'info'
     * @param {number} duration - ms antes de ocultar (default 4000)
     */
    window.tooriToast = function(message, type, duration) {
        type = type || 'info';
        duration = duration || 4000;

        const toast = document.createElement('div');
        toast.className = 'toori-toast toast-' + type;
        toast.innerHTML = `
            <i class="bi ${icons[type] || icons.info} toori-toast-icon"></i>
            <span>${message}</span>
            <button class="toori-toast-close">&times;</button>
        `;

        container.appendChild(toast);

        // Close button
        toast.querySelector('.toori-toast-close').addEventListener('click', () => removeToast(toast));

        // Auto remove
        setTimeout(() => removeToast(toast), duration);
    };

    function removeToast(toast) {
        if (toast.classList.contains('toast-out')) return;
        toast.classList.add('toast-out');
        setTimeout(() => toast.remove(), 300);
    }

    // Reemplazar alert global
    const originalAlert = window.alert;
    window.alert = function(msg) {
        if (typeof msg === 'string') {
            const type = msg.toLowerCase().includes('error') ? 'error'
                       : msg.toLowerCase().includes('exito') || msg.toLowerCase().includes('éxito') ? 'success'
                       : 'info';
            window.tooriToast(msg, type);
        } else {
            originalAlert(msg);
        }
    };
})();

// ===================== SCROLL PROGRESS BAR =====================
(function() {
    const bar = document.createElement('div');
    bar.id = 'scroll-progress';
    document.body.prepend(bar);

    window.addEventListener('scroll', () => {
        const scrollTop = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        if (docHeight > 0) {
            bar.style.width = (scrollTop / docHeight * 100) + '%';
        }
    }, { passive: true });
})();

// ===================== WHATSAPP TOOLTIP =====================
(function() {
    document.addEventListener('DOMContentLoaded', () => {
        const waBtn = document.querySelector('.floating-wa');
        if (!waBtn) return;

        const tooltip = document.createElement('div');
        tooltip.className = 'wa-tooltip';
        tooltip.textContent = 'Necesitas ayuda? Escribinos!';
        document.body.appendChild(tooltip);

        // Mostrar tooltip despues de 5 segundos
        let tooltipShown = false;
        setTimeout(() => {
            tooltip.classList.add('visible');
            tooltipShown = true;

            // Ocultar despues de 6 segundos
            setTimeout(() => {
                tooltip.classList.remove('visible');
            }, 6000);
        }, 5000);

        // Mostrar/ocultar en hover
        waBtn.addEventListener('mouseenter', () => {
            tooltip.classList.add('visible');
        });

        waBtn.addEventListener('mouseleave', () => {
            tooltip.classList.remove('visible');
        });
    });
})();

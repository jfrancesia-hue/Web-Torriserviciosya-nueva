/**
 * TOORI SERVICIOYA 360
 * JavaScript principal
 */

document.addEventListener('DOMContentLoaded', function() {
    initSidebar();
    initModals();
    initTabs();
});

// Sidebar toggle (mobile)
function initSidebar() {
    const toggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar');
    if (toggle && sidebar) {
        toggle.addEventListener('click', function() {
            sidebar.classList.toggle('open');
        });
        // Close sidebar on click outside (mobile)
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 768 && sidebar.classList.contains('open')) {
                if (!sidebar.contains(e.target) && !toggle.contains(e.target)) {
                    sidebar.classList.remove('open');
                }
            }
        });
    }
}

// Modal handling
function initModals() {
    document.querySelectorAll('[data-modal]').forEach(function(trigger) {
        trigger.addEventListener('click', function() {
            const modalId = this.getAttribute('data-modal');
            const modal = document.getElementById(modalId);
            if (modal) modal.classList.add('active');
        });
    });
    document.querySelectorAll('.modal-close, .modal-cancel').forEach(function(btn) {
        btn.addEventListener('click', function() {
            this.closest('.modal-overlay').classList.remove('active');
        });
    });
    document.querySelectorAll('.modal-overlay').forEach(function(overlay) {
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) overlay.classList.remove('active');
        });
    });
}

// Tabs
function initTabs() {
    document.querySelectorAll('.tabs').forEach(function(tabGroup) {
        tabGroup.querySelectorAll('.tab-item').forEach(function(tab) {
            tab.addEventListener('click', function() {
                tabGroup.querySelectorAll('.tab-item').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                const target = this.getAttribute('data-tab');
                if (target) {
                    const container = tabGroup.parentElement;
                    container.querySelectorAll('.tab-content').forEach(c => c.style.display = 'none');
                    const panel = container.querySelector('#' + target);
                    if (panel) panel.style.display = 'block';
                }
            });
        });
    });
}

// Notification bell dropdown (simulated)
function toggleNotifications() {
    alert('Panel de notificaciones - En desarrollo');
}

// Search (simulated)
function globalSearch(value) {
    if (value.length > 2) {
        console.log('Buscando:', value);
    }
}

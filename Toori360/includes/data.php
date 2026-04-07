<?php
/**
 * TOORI SERVICIOYA 360
 * Archivo de datos hardcodeados
 * Todos los arrays asociativos del sistema
 */

// ============================================
// EMPRESAS / INMOBILIARIAS
// ============================================
$empresas = [
    ['id' => 1, 'nombre' => 'Inmobiliaria Del Valle', 'razon_social' => 'Del Valle S.R.L.', 'cuit' => '30-71234567-8', 'direccion' => 'Av. Güemes 450, Catamarca', 'telefono' => '383-4421000', 'email' => 'info@delvalle.com.ar', 'logo' => 'delvalle.png', 'plan' => 'Premium', 'estado' => 'Activa', 'sucursales' => 3, 'usuarios' => 12, 'propiedades' => 45, 'fecha_alta' => '2022-03-15', 'observaciones' => 'Cliente fundador de la plataforma'],
    ['id' => 2, 'nombre' => 'Córdoba Properties', 'razon_social' => 'Córdoba Properties S.A.', 'cuit' => '30-71345678-9', 'direccion' => 'Bv. San Juan 1200, Córdoba', 'telefono' => '351-4567890', 'email' => 'contacto@cordobaprop.com.ar', 'logo' => 'cordobaprop.png', 'plan' => 'Business', 'estado' => 'Activa', 'sucursales' => 2, 'usuarios' => 8, 'propiedades' => 32, 'fecha_alta' => '2022-06-20', 'observaciones' => 'Especialistas en barrios cerrados'],
    ['id' => 3, 'nombre' => 'Buenos Aires Real Estate', 'razon_social' => 'BA Real Estate S.A.S.', 'cuit' => '30-71456789-0', 'direccion' => 'Av. Corrientes 3500, CABA', 'telefono' => '11-45678901', 'email' => 'info@barealestate.com.ar', 'logo' => 'barealestate.png', 'plan' => 'Enterprise', 'estado' => 'Activa', 'sucursales' => 5, 'usuarios' => 25, 'propiedades' => 120, 'fecha_alta' => '2021-11-10', 'observaciones' => 'Mayor cartera de propiedades'],
    ['id' => 4, 'nombre' => 'Norte Propiedades', 'razon_social' => 'Norte Prop S.R.L.', 'cuit' => '30-71567890-1', 'direccion' => 'Av. Belgrano 800, S.M. de Tucumán', 'telefono' => '381-4234567', 'email' => 'info@norteprop.com.ar', 'logo' => 'norteprop.png', 'plan' => 'Starter', 'estado' => 'Activa', 'sucursales' => 1, 'usuarios' => 4, 'propiedades' => 18, 'fecha_alta' => '2023-01-05', 'observaciones' => 'Plan inicial, en crecimiento'],
    ['id' => 5, 'nombre' => 'Patagonia Inmuebles', 'razon_social' => 'Patagonia Inmuebles S.A.', 'cuit' => '30-71678901-2', 'direccion' => 'Av. Roca 340, Neuquén', 'telefono' => '299-4345678', 'email' => 'ventas@patagoniaInm.com.ar', 'logo' => 'patagonia.png', 'plan' => 'Business', 'estado' => 'Suspendida', 'sucursales' => 2, 'usuarios' => 6, 'propiedades' => 22, 'fecha_alta' => '2022-09-18', 'observaciones' => 'Suspendida por falta de pago'],
];

// ============================================
// SUCURSALES
// ============================================
$sucursales = [
    ['id' => 1, 'empresa_id' => 1, 'nombre' => 'Central Catamarca', 'ciudad' => 'San Fernando del Valle de Catamarca', 'direccion' => 'Av. Güemes 450', 'gerente' => 'María López', 'telefono' => '383-4421000', 'agentes' => 4, 'propiedades' => 25, 'estado' => 'Activa'],
    ['id' => 2, 'empresa_id' => 1, 'nombre' => 'Sucursal Valle Viejo', 'ciudad' => 'Valle Viejo', 'direccion' => 'Ruta 33 km 5', 'gerente' => 'Carlos Ruiz', 'telefono' => '383-4421001', 'agentes' => 2, 'propiedades' => 12, 'estado' => 'Activa'],
    ['id' => 3, 'empresa_id' => 1, 'nombre' => 'Sucursal Fray M. Esquiú', 'ciudad' => 'Fray Mamerto Esquiú', 'direccion' => 'San Martín 120', 'gerente' => 'Ana Herrera', 'telefono' => '383-4421002', 'agentes' => 2, 'propiedades' => 8, 'estado' => 'Activa'],
    ['id' => 4, 'empresa_id' => 2, 'nombre' => 'Central Córdoba', 'ciudad' => 'Córdoba Capital', 'direccion' => 'Bv. San Juan 1200', 'gerente' => 'Roberto Paz', 'telefono' => '351-4567890', 'agentes' => 3, 'propiedades' => 20, 'estado' => 'Activa'],
    ['id' => 5, 'empresa_id' => 2, 'nombre' => 'Sucursal Nueva Córdoba', 'ciudad' => 'Córdoba Capital', 'direccion' => 'Av. Hipólito Yrigoyen 350', 'gerente' => 'Laura Gómez', 'telefono' => '351-4567891', 'agentes' => 2, 'propiedades' => 12, 'estado' => 'Activa'],
    ['id' => 6, 'empresa_id' => 3, 'nombre' => 'Central CABA', 'ciudad' => 'CABA', 'direccion' => 'Av. Corrientes 3500', 'gerente' => 'Fernando Díaz', 'telefono' => '11-45678901', 'agentes' => 8, 'propiedades' => 55, 'estado' => 'Activa'],
    ['id' => 7, 'empresa_id' => 3, 'nombre' => 'Sucursal Palermo', 'ciudad' => 'CABA', 'direccion' => 'Honduras 4800', 'gerente' => 'Valentina Torres', 'telefono' => '11-45678902', 'agentes' => 5, 'propiedades' => 35, 'estado' => 'Activa'],
    ['id' => 8, 'empresa_id' => 3, 'nombre' => 'Sucursal Belgrano', 'ciudad' => 'CABA', 'direccion' => 'Av. Cabildo 2100', 'gerente' => 'Diego Morales', 'telefono' => '11-45678903', 'agentes' => 4, 'propiedades' => 30, 'estado' => 'Activa'],
];

// ============================================
// ROLES
// ============================================
$roles = [
    ['id' => 1, 'nombre' => 'Super Admin', 'descripcion' => 'Acceso total al sistema', 'color' => '#e74c3c'],
    ['id' => 2, 'nombre' => 'Admin Inmobiliaria', 'descripcion' => 'Administra su inmobiliaria', 'color' => '#8e44ad'],
    ['id' => 3, 'nombre' => 'Gerente Sucursal', 'descripcion' => 'Gestiona una sucursal', 'color' => '#2980b9'],
    ['id' => 4, 'nombre' => 'Corredor', 'descripcion' => 'Agente comercial', 'color' => '#27ae60'],
    ['id' => 5, 'nombre' => 'Asesor Comercial', 'descripcion' => 'Asesoramiento al cliente', 'color' => '#f39c12'],
    ['id' => 6, 'nombre' => 'Administrativo', 'descripcion' => 'Gestión administrativa', 'color' => '#1abc9c'],
    ['id' => 7, 'nombre' => 'Operador', 'descripcion' => 'Operaciones diarias', 'color' => '#95a5a6'],
    ['id' => 8, 'nombre' => 'Soporte', 'descripcion' => 'Atención y soporte', 'color' => '#e67e22'],
];

// ============================================
// USUARIOS
// ============================================
$usuarios = [
    ['id' => 1, 'nombre' => 'Jorge Francesia', 'email' => 'jorge@toori.com.ar', 'rol_id' => 1, 'rol' => 'Super Admin', 'sucursal_id' => null, 'sucursal' => 'Todas', 'estado' => 'Activo', 'avatar' => 'JF', 'ultimo_acceso' => '2025-06-10 09:15:00'],
    ['id' => 2, 'nombre' => 'María López', 'email' => 'maria.lopez@delvalle.com.ar', 'rol_id' => 2, 'rol' => 'Admin Inmobiliaria', 'sucursal_id' => 1, 'sucursal' => 'Central Catamarca', 'estado' => 'Activo', 'avatar' => 'ML', 'ultimo_acceso' => '2025-06-10 08:45:00'],
    ['id' => 3, 'nombre' => 'Carlos Ruiz', 'email' => 'carlos.ruiz@delvalle.com.ar', 'rol_id' => 3, 'rol' => 'Gerente Sucursal', 'sucursal_id' => 2, 'sucursal' => 'Sucursal Valle Viejo', 'estado' => 'Activo', 'avatar' => 'CR', 'ultimo_acceso' => '2025-06-09 17:30:00'],
    ['id' => 4, 'nombre' => 'Ana Herrera', 'email' => 'ana.herrera@delvalle.com.ar', 'rol_id' => 3, 'rol' => 'Gerente Sucursal', 'sucursal_id' => 3, 'sucursal' => 'Sucursal Fray M. Esquiú', 'estado' => 'Activo', 'avatar' => 'AH', 'ultimo_acceso' => '2025-06-10 07:20:00'],
    ['id' => 5, 'nombre' => 'Roberto Paz', 'email' => 'roberto@cordobaprop.com.ar', 'rol_id' => 2, 'rol' => 'Admin Inmobiliaria', 'sucursal_id' => 4, 'sucursal' => 'Central Córdoba', 'estado' => 'Activo', 'avatar' => 'RP', 'ultimo_acceso' => '2025-06-10 10:00:00'],
    ['id' => 6, 'nombre' => 'Luciano Martínez', 'email' => 'luciano.m@delvalle.com.ar', 'rol_id' => 4, 'rol' => 'Corredor', 'sucursal_id' => 1, 'sucursal' => 'Central Catamarca', 'estado' => 'Activo', 'avatar' => 'LM', 'ultimo_acceso' => '2025-06-10 09:50:00'],
    ['id' => 7, 'nombre' => 'Valentina Torres', 'email' => 'valentina@barealestate.com.ar', 'rol_id' => 3, 'rol' => 'Gerente Sucursal', 'sucursal_id' => 7, 'sucursal' => 'Sucursal Palermo', 'estado' => 'Activo', 'avatar' => 'VT', 'ultimo_acceso' => '2025-06-10 08:10:00'],
    ['id' => 8, 'nombre' => 'Diego Morales', 'email' => 'diego@barealestate.com.ar', 'rol_id' => 3, 'rol' => 'Gerente Sucursal', 'sucursal_id' => 8, 'sucursal' => 'Sucursal Belgrano', 'estado' => 'Activo', 'avatar' => 'DM', 'ultimo_acceso' => '2025-06-09 18:00:00'],
    ['id' => 9, 'nombre' => 'Sofía Peralta', 'email' => 'sofia.p@delvalle.com.ar', 'rol_id' => 4, 'rol' => 'Corredor', 'sucursal_id' => 1, 'sucursal' => 'Central Catamarca', 'estado' => 'Activo', 'avatar' => 'SP', 'ultimo_acceso' => '2025-06-10 09:30:00'],
    ['id' => 10, 'nombre' => 'Martín Acosta', 'email' => 'martin.a@cordobaprop.com.ar', 'rol_id' => 4, 'rol' => 'Corredor', 'sucursal_id' => 4, 'sucursal' => 'Central Córdoba', 'estado' => 'Activo', 'avatar' => 'MA', 'ultimo_acceso' => '2025-06-10 07:45:00'],
    ['id' => 11, 'nombre' => 'Camila Vega', 'email' => 'camila@barealestate.com.ar', 'rol_id' => 4, 'rol' => 'Corredor', 'sucursal_id' => 6, 'sucursal' => 'Central CABA', 'estado' => 'Activo', 'avatar' => 'CV', 'ultimo_acceso' => '2025-06-10 10:15:00'],
    ['id' => 12, 'nombre' => 'Facundo Ríos', 'email' => 'facundo@barealestate.com.ar', 'rol_id' => 4, 'rol' => 'Corredor', 'sucursal_id' => 7, 'sucursal' => 'Sucursal Palermo', 'estado' => 'Activo', 'avatar' => 'FR', 'ultimo_acceso' => '2025-06-09 16:00:00'],
    ['id' => 13, 'nombre' => 'Laura Gómez', 'email' => 'laura@cordobaprop.com.ar', 'rol_id' => 5, 'rol' => 'Asesor Comercial', 'sucursal_id' => 5, 'sucursal' => 'Sucursal Nueva Córdoba', 'estado' => 'Activo', 'avatar' => 'LG', 'ultimo_acceso' => '2025-06-10 08:30:00'],
    ['id' => 14, 'nombre' => 'Fernando Díaz', 'email' => 'fernando@barealestate.com.ar', 'rol_id' => 2, 'rol' => 'Admin Inmobiliaria', 'sucursal_id' => 6, 'sucursal' => 'Central CABA', 'estado' => 'Activo', 'avatar' => 'FD', 'ultimo_acceso' => '2025-06-10 09:00:00'],
    ['id' => 15, 'nombre' => 'Gabriela Sánchez', 'email' => 'gabriela@delvalle.com.ar', 'rol_id' => 6, 'rol' => 'Administrativo', 'sucursal_id' => 1, 'sucursal' => 'Central Catamarca', 'estado' => 'Activo', 'avatar' => 'GS', 'ultimo_acceso' => '2025-06-10 07:55:00'],
    ['id' => 16, 'nombre' => 'Pablo Mendoza', 'email' => 'pablo@barealestate.com.ar', 'rol_id' => 4, 'rol' => 'Corredor', 'sucursal_id' => 8, 'sucursal' => 'Sucursal Belgrano', 'estado' => 'Activo', 'avatar' => 'PM', 'ultimo_acceso' => '2025-06-09 15:20:00'],
    ['id' => 17, 'nombre' => 'Natalia Romero', 'email' => 'natalia@norteprop.com.ar', 'rol_id' => 4, 'rol' => 'Corredor', 'sucursal_id' => null, 'sucursal' => 'Norte Propiedades', 'estado' => 'Activo', 'avatar' => 'NR', 'ultimo_acceso' => '2025-06-10 10:30:00'],
    ['id' => 18, 'nombre' => 'Ignacio Flores', 'email' => 'ignacio@delvalle.com.ar', 'rol_id' => 7, 'rol' => 'Operador', 'sucursal_id' => 1, 'sucursal' => 'Central Catamarca', 'estado' => 'Activo', 'avatar' => 'IF', 'ultimo_acceso' => '2025-06-09 14:00:00'],
    ['id' => 19, 'nombre' => 'Julieta Castro', 'email' => 'julieta@barealestate.com.ar', 'rol_id' => 6, 'rol' => 'Administrativo', 'sucursal_id' => 6, 'sucursal' => 'Central CABA', 'estado' => 'Inactivo', 'avatar' => 'JC', 'ultimo_acceso' => '2025-05-20 11:00:00'],
    ['id' => 20, 'nombre' => 'Tomás Aguirre', 'email' => 'tomas@toori.com.ar', 'rol_id' => 8, 'rol' => 'Soporte', 'sucursal_id' => null, 'sucursal' => 'Todas', 'estado' => 'Activo', 'avatar' => 'TA', 'ultimo_acceso' => '2025-06-10 10:45:00'],
    ['id' => 21, 'nombre' => 'Rocío Navarro', 'email' => 'rocio@cordobaprop.com.ar', 'rol_id' => 5, 'rol' => 'Asesor Comercial', 'sucursal_id' => 4, 'sucursal' => 'Central Córdoba', 'estado' => 'Activo', 'avatar' => 'RN', 'ultimo_acceso' => '2025-06-10 09:20:00'],
    ['id' => 22, 'nombre' => 'Emiliano Quiroga', 'email' => 'emiliano@delvalle.com.ar', 'rol_id' => 4, 'rol' => 'Corredor', 'sucursal_id' => 2, 'sucursal' => 'Sucursal Valle Viejo', 'estado' => 'Activo', 'avatar' => 'EQ', 'ultimo_acceso' => '2025-06-10 08:00:00'],
];

// ============================================
// AGENTES / CORREDORES
// ============================================
$agentes = [
    ['id' => 1, 'usuario_id' => 6, 'nombre' => 'Luciano Martínez', 'sucursal' => 'Central Catamarca', 'propiedades' => 12, 'ventas' => 8, 'alquileres' => 15, 'leads' => 22, 'visitas' => 45, 'comision_acumulada' => 2850000, 'rating' => 4.8, 'estado' => 'Activo', 'telefono' => '383-154112233'],
    ['id' => 2, 'usuario_id' => 9, 'nombre' => 'Sofía Peralta', 'sucursal' => 'Central Catamarca', 'propiedades' => 10, 'ventas' => 6, 'alquileres' => 12, 'leads' => 18, 'visitas' => 38, 'comision_acumulada' => 2100000, 'rating' => 4.7, 'estado' => 'Activo', 'telefono' => '383-154223344'],
    ['id' => 3, 'usuario_id' => 10, 'nombre' => 'Martín Acosta', 'sucursal' => 'Central Córdoba', 'propiedades' => 8, 'ventas' => 5, 'alquileres' => 10, 'leads' => 15, 'visitas' => 30, 'comision_acumulada' => 1750000, 'rating' => 4.5, 'estado' => 'Activo', 'telefono' => '351-155334455'],
    ['id' => 4, 'usuario_id' => 11, 'nombre' => 'Camila Vega', 'sucursal' => 'Central CABA', 'propiedades' => 15, 'ventas' => 12, 'alquileres' => 20, 'leads' => 35, 'visitas' => 60, 'comision_acumulada' => 5200000, 'rating' => 4.9, 'estado' => 'Activo', 'telefono' => '11-156445566'],
    ['id' => 5, 'usuario_id' => 12, 'nombre' => 'Facundo Ríos', 'sucursal' => 'Sucursal Palermo', 'propiedades' => 11, 'ventas' => 7, 'alquileres' => 14, 'leads' => 20, 'visitas' => 42, 'comision_acumulada' => 3100000, 'rating' => 4.6, 'estado' => 'Activo', 'telefono' => '11-157556677'],
    ['id' => 6, 'usuario_id' => 16, 'nombre' => 'Pablo Mendoza', 'sucursal' => 'Sucursal Belgrano', 'propiedades' => 9, 'ventas' => 4, 'alquileres' => 8, 'leads' => 12, 'visitas' => 25, 'comision_acumulada' => 1450000, 'rating' => 4.3, 'estado' => 'Activo', 'telefono' => '11-158667788'],
    ['id' => 7, 'usuario_id' => 17, 'nombre' => 'Natalia Romero', 'sucursal' => 'Norte Propiedades', 'propiedades' => 6, 'ventas' => 3, 'alquileres' => 5, 'leads' => 10, 'visitas' => 18, 'comision_acumulada' => 890000, 'rating' => 4.4, 'estado' => 'Activo', 'telefono' => '381-159778899'],
    ['id' => 8, 'usuario_id' => 22, 'nombre' => 'Emiliano Quiroga', 'sucursal' => 'Sucursal Valle Viejo', 'propiedades' => 7, 'ventas' => 3, 'alquileres' => 6, 'leads' => 8, 'visitas' => 20, 'comision_acumulada' => 980000, 'rating' => 4.2, 'estado' => 'Activo', 'telefono' => '383-150889900'],
    ['id' => 9, 'usuario_id' => 13, 'nombre' => 'Laura Gómez', 'sucursal' => 'Sucursal Nueva Córdoba', 'propiedades' => 5, 'ventas' => 2, 'alquileres' => 7, 'leads' => 11, 'visitas' => 22, 'comision_acumulada' => 720000, 'rating' => 4.5, 'estado' => 'Activo', 'telefono' => '351-150990011'],
    ['id' => 10, 'usuario_id' => 21, 'nombre' => 'Rocío Navarro', 'sucursal' => 'Central Córdoba', 'propiedades' => 6, 'ventas' => 2, 'alquileres' => 4, 'leads' => 9, 'visitas' => 16, 'comision_acumulada' => 650000, 'rating' => 4.1, 'estado' => 'Activo', 'telefono' => '351-151001122'],
];

// ============================================
// PROPIETARIOS
// ============================================
$propietarios = [
    ['id' => 1, 'nombre' => 'Ricardo Gutiérrez', 'dni' => '22345678', 'telefono' => '383-154001122', 'email' => 'ricardo.g@gmail.com', 'propiedades' => 4, 'ciudad' => 'Catamarca', 'estado' => 'Activo'],
    ['id' => 2, 'nombre' => 'Marta Bustos', 'dni' => '18567890', 'telefono' => '383-154002233', 'email' => 'marta.bustos@yahoo.com', 'propiedades' => 3, 'ciudad' => 'Catamarca', 'estado' => 'Activo'],
    ['id' => 3, 'nombre' => 'Inversiones NOA S.A.', 'dni' => '30-70123456-7', 'telefono' => '383-4430001', 'email' => 'admin@inversionesnoa.com.ar', 'propiedades' => 8, 'ciudad' => 'Catamarca', 'estado' => 'Activo'],
    ['id' => 4, 'nombre' => 'Alejandro Bustos', 'dni' => '25678901', 'telefono' => '351-155003344', 'email' => 'alejandro.b@hotmail.com', 'propiedades' => 2, 'ciudad' => 'Córdoba', 'estado' => 'Activo'],
    ['id' => 5, 'nombre' => 'Construcciones Sur S.R.L.', 'dni' => '30-71234000-5', 'telefono' => '351-4440002', 'email' => 'info@construccionessur.com.ar', 'propiedades' => 6, 'ciudad' => 'Córdoba', 'estado' => 'Activo'],
    ['id' => 6, 'nombre' => 'Patricia Méndez', 'dni' => '20456789', 'telefono' => '11-154004455', 'email' => 'patricia.m@gmail.com', 'propiedades' => 3, 'ciudad' => 'CABA', 'estado' => 'Activo'],
    ['id' => 7, 'nombre' => 'Grupo Inmobiliario Austral', 'dni' => '30-72345678-9', 'telefono' => '11-4450003', 'email' => 'contacto@grupoaustral.com.ar', 'propiedades' => 10, 'ciudad' => 'CABA', 'estado' => 'Activo'],
    ['id' => 8, 'nombre' => 'Daniel Figueroa', 'dni' => '23890123', 'telefono' => '383-154005566', 'email' => 'daniel.fig@gmail.com', 'propiedades' => 2, 'ciudad' => 'Valle Viejo', 'estado' => 'Activo'],
    ['id' => 9, 'nombre' => 'Silvia Acuña', 'dni' => '21234567', 'telefono' => '381-155006677', 'email' => 'silvia.acuna@hotmail.com', 'propiedades' => 1, 'ciudad' => 'Tucumán', 'estado' => 'Activo'],
    ['id' => 10, 'nombre' => 'Fideicomiso Torres del Sol', 'dni' => '30-73456789-0', 'telefono' => '351-4460004', 'email' => 'admin@torresdelsol.com.ar', 'propiedades' => 12, 'ciudad' => 'Córdoba', 'estado' => 'Activo'],
    ['id' => 11, 'nombre' => 'Hugo Villalba', 'dni' => '19678901', 'telefono' => '383-154007788', 'email' => 'hugo.v@gmail.com', 'propiedades' => 2, 'ciudad' => 'Catamarca', 'estado' => 'Inactivo'],
    ['id' => 12, 'nombre' => 'Elena Correa', 'dni' => '24567890', 'telefono' => '11-155008899', 'email' => 'elena.correa@outlook.com', 'propiedades' => 5, 'ciudad' => 'CABA', 'estado' => 'Activo'],
    ['id' => 13, 'nombre' => 'Desarrollos Andinos S.A.', 'dni' => '30-74567890-1', 'telefono' => '383-4470005', 'email' => 'info@desarrollosandinos.com.ar', 'propiedades' => 7, 'ciudad' => 'Catamarca', 'estado' => 'Activo'],
    ['id' => 14, 'nombre' => 'Osvaldo Ramos', 'dni' => '17890123', 'telefono' => '351-156009900', 'email' => 'osvaldo.ramos@gmail.com', 'propiedades' => 1, 'ciudad' => 'Córdoba', 'estado' => 'Activo'],
    ['id' => 15, 'nombre' => 'Marcela Ibáñez', 'dni' => '26789012', 'telefono' => '11-156110011', 'email' => 'marcela.i@gmail.com', 'propiedades' => 3, 'ciudad' => 'CABA', 'estado' => 'Activo'],
];

// ============================================
// TIPOS DE PROPIEDADES
// ============================================
$tipos_propiedades = [
    ['id' => 1, 'nombre' => 'Casa', 'icono' => 'fa-house', 'cantidad' => 18],
    ['id' => 2, 'nombre' => 'Departamento', 'icono' => 'fa-building', 'cantidad' => 22],
    ['id' => 3, 'nombre' => 'Lote', 'icono' => 'fa-vector-square', 'cantidad' => 8],
    ['id' => 4, 'nombre' => 'Local Comercial', 'icono' => 'fa-store', 'cantidad' => 5],
    ['id' => 5, 'nombre' => 'Oficina', 'icono' => 'fa-briefcase', 'cantidad' => 3],
    ['id' => 6, 'nombre' => 'Galpón', 'icono' => 'fa-warehouse', 'cantidad' => 2],
    ['id' => 7, 'nombre' => 'Cochera', 'icono' => 'fa-car', 'cantidad' => 4],
    ['id' => 8, 'nombre' => 'Campo', 'icono' => 'fa-tractor', 'cantidad' => 1],
    ['id' => 9, 'nombre' => 'PH', 'icono' => 'fa-house-chimney', 'cantidad' => 3],
    ['id' => 10, 'nombre' => 'Dúplex', 'icono' => 'fa-house-flag', 'cantidad' => 2],
    ['id' => 11, 'nombre' => 'Edificio', 'icono' => 'fa-city', 'cantidad' => 1],
    ['id' => 12, 'nombre' => 'Depósito', 'icono' => 'fa-boxes-stacked', 'cantidad' => 1],
];

// ============================================
// UBICACIONES
// ============================================
$ubicaciones = [
    ['pais' => 'Argentina', 'provincia' => 'Catamarca', 'ciudad' => 'San Fernando del Valle de Catamarca', 'zonas' => ['Centro', 'Norte', 'Sur', 'Parque Adán Quiroga', 'Villa Cubas', 'Polcos']],
    ['pais' => 'Argentina', 'provincia' => 'Catamarca', 'ciudad' => 'Valle Viejo', 'zonas' => ['Centro', 'Polcos', 'Santa Rosa']],
    ['pais' => 'Argentina', 'provincia' => 'Catamarca', 'ciudad' => 'Fray Mamerto Esquiú', 'zonas' => ['Centro', 'San José']],
    ['pais' => 'Argentina', 'provincia' => 'Córdoba', 'ciudad' => 'Córdoba Capital', 'zonas' => ['Centro', 'Nueva Córdoba', 'Güemes', 'Cerro de las Rosas', 'Chateau Carreras']],
    ['pais' => 'Argentina', 'provincia' => 'Buenos Aires', 'ciudad' => 'CABA', 'zonas' => ['Palermo', 'Belgrano', 'Recoleta', 'Caballito', 'Núñez', 'Puerto Madero']],
    ['pais' => 'Argentina', 'provincia' => 'Tucumán', 'ciudad' => 'San Miguel de Tucumán', 'zonas' => ['Centro', 'Yerba Buena', 'Barrio Sur']],
];

// ============================================
// PROPIEDADES (60+)
// ============================================
$propiedades = [
    ['id' => 1, 'codigo' => 'DV-001', 'titulo' => 'Casa 3 ambientes con pileta', 'tipo' => 'Casa', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 85000, 'moneda' => 'USD', 'direccion' => 'Los Aromos 450', 'ciudad' => 'Catamarca', 'zona' => 'Norte', 'mt2_cubiertos' => 120, 'mt2_totales' => 300, 'ambientes' => 3, 'banos' => 2, 'cochera' => true, 'propietario_id' => 1, 'agente_id' => 1, 'fecha_pub' => '2025-01-15', 'destacada' => true],
    ['id' => 2, 'codigo' => 'DV-002', 'titulo' => 'Depto 2 amb. en centro', 'tipo' => 'Departamento', 'operacion' => 'Alquiler', 'estado' => 'Alquilada', 'precio' => 280000, 'moneda' => 'ARS', 'direccion' => 'Rivadavia 320 3°B', 'ciudad' => 'Catamarca', 'zona' => 'Centro', 'mt2_cubiertos' => 55, 'mt2_totales' => 55, 'ambientes' => 2, 'banos' => 1, 'cochera' => false, 'propietario_id' => 2, 'agente_id' => 1, 'fecha_pub' => '2024-11-20', 'destacada' => false],
    ['id' => 3, 'codigo' => 'DV-003', 'titulo' => 'Lote 600m² zona residencial', 'tipo' => 'Lote', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 32000, 'moneda' => 'USD', 'direccion' => 'Loteo Las Acacias Mz.C Lt.12', 'ciudad' => 'Valle Viejo', 'zona' => 'Polcos', 'mt2_cubiertos' => 0, 'mt2_totales' => 600, 'ambientes' => 0, 'banos' => 0, 'cochera' => false, 'propietario_id' => 3, 'agente_id' => 8, 'fecha_pub' => '2025-03-01', 'destacada' => true],
    ['id' => 4, 'codigo' => 'DV-004', 'titulo' => 'Casa 4 amb. con quincho', 'tipo' => 'Casa', 'operacion' => 'Venta', 'estado' => 'Reservada', 'precio' => 120000, 'moneda' => 'USD', 'direccion' => 'Av. Los Pinos 890', 'ciudad' => 'Catamarca', 'zona' => 'Parque Adán Quiroga', 'mt2_cubiertos' => 180, 'mt2_totales' => 450, 'ambientes' => 4, 'banos' => 2, 'cochera' => true, 'propietario_id' => 1, 'agente_id' => 2, 'fecha_pub' => '2025-02-10', 'destacada' => true],
    ['id' => 5, 'codigo' => 'DV-005', 'titulo' => 'Depto 1 amb. amoblado', 'tipo' => 'Departamento', 'operacion' => 'Alquiler', 'estado' => 'Disponible', 'precio' => 200000, 'moneda' => 'ARS', 'direccion' => 'Sarmiento 150 2°A', 'ciudad' => 'Catamarca', 'zona' => 'Centro', 'mt2_cubiertos' => 35, 'mt2_totales' => 35, 'ambientes' => 1, 'banos' => 1, 'cochera' => false, 'propietario_id' => 11, 'agente_id' => 2, 'fecha_pub' => '2025-04-05', 'destacada' => false],
    ['id' => 6, 'codigo' => 'CP-001', 'titulo' => 'Depto 3 amb. Nueva Córdoba', 'tipo' => 'Departamento', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 95000, 'moneda' => 'USD', 'direccion' => 'Av. Vélez Sársfield 560 8°C', 'ciudad' => 'Córdoba Capital', 'zona' => 'Nueva Córdoba', 'mt2_cubiertos' => 85, 'mt2_totales' => 85, 'ambientes' => 3, 'banos' => 2, 'cochera' => true, 'propietario_id' => 4, 'agente_id' => 3, 'fecha_pub' => '2025-01-20', 'destacada' => true],
    ['id' => 7, 'codigo' => 'CP-002', 'titulo' => 'Casa en Cerro de las Rosas', 'tipo' => 'Casa', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 185000, 'moneda' => 'USD', 'direccion' => 'Av. Rafael Núñez 4500', 'ciudad' => 'Córdoba Capital', 'zona' => 'Cerro de las Rosas', 'mt2_cubiertos' => 220, 'mt2_totales' => 500, 'ambientes' => 5, 'banos' => 3, 'cochera' => true, 'propietario_id' => 5, 'agente_id' => 3, 'fecha_pub' => '2024-12-15', 'destacada' => true],
    ['id' => 8, 'codigo' => 'BA-001', 'titulo' => 'Depto 2 amb. Palermo Soho', 'tipo' => 'Departamento', 'operacion' => 'Alquiler', 'estado' => 'Alquilada', 'precio' => 650000, 'moneda' => 'ARS', 'direccion' => 'Honduras 4900 5°D', 'ciudad' => 'CABA', 'zona' => 'Palermo', 'mt2_cubiertos' => 48, 'mt2_totales' => 52, 'ambientes' => 2, 'banos' => 1, 'cochera' => false, 'propietario_id' => 6, 'agente_id' => 4, 'fecha_pub' => '2024-10-05', 'destacada' => false],
    ['id' => 9, 'codigo' => 'BA-002', 'titulo' => 'Oficina premium Belgrano', 'tipo' => 'Oficina', 'operacion' => 'Alquiler', 'estado' => 'Disponible', 'precio' => 1200000, 'moneda' => 'ARS', 'direccion' => 'Av. Cabildo 2350 Of. 4B', 'ciudad' => 'CABA', 'zona' => 'Belgrano', 'mt2_cubiertos' => 95, 'mt2_totales' => 95, 'ambientes' => 4, 'banos' => 2, 'cochera' => true, 'propietario_id' => 7, 'agente_id' => 6, 'fecha_pub' => '2025-02-28', 'destacada' => false],
    ['id' => 10, 'codigo' => 'BA-003', 'titulo' => 'Penthouse Recoleta 200m²', 'tipo' => 'Departamento', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 380000, 'moneda' => 'USD', 'direccion' => 'Av. Alvear 1800 PH', 'ciudad' => 'CABA', 'zona' => 'Recoleta', 'mt2_cubiertos' => 200, 'mt2_totales' => 250, 'ambientes' => 5, 'banos' => 3, 'cochera' => true, 'propietario_id' => 7, 'agente_id' => 4, 'fecha_pub' => '2025-03-15', 'destacada' => true],
    ['id' => 11, 'codigo' => 'DV-006', 'titulo' => 'Local comercial s/ Av. Güemes', 'tipo' => 'Local Comercial', 'operacion' => 'Alquiler', 'estado' => 'Disponible', 'precio' => 450000, 'moneda' => 'ARS', 'direccion' => 'Av. Güemes 780', 'ciudad' => 'Catamarca', 'zona' => 'Centro', 'mt2_cubiertos' => 60, 'mt2_totales' => 60, 'ambientes' => 1, 'banos' => 1, 'cochera' => false, 'propietario_id' => 3, 'agente_id' => 1, 'fecha_pub' => '2025-04-10', 'destacada' => false],
    ['id' => 12, 'codigo' => 'DV-007', 'titulo' => 'Dúplex en barrio privado', 'tipo' => 'Dúplex', 'operacion' => 'Venta', 'estado' => 'Vendida', 'precio' => 145000, 'moneda' => 'USD', 'direccion' => 'Barrio Solar de la Villa Lt.8', 'ciudad' => 'Valle Viejo', 'zona' => 'Santa Rosa', 'mt2_cubiertos' => 160, 'mt2_totales' => 250, 'ambientes' => 3, 'banos' => 2, 'cochera' => true, 'propietario_id' => 8, 'agente_id' => 8, 'fecha_pub' => '2024-09-01', 'destacada' => false],
    ['id' => 13, 'codigo' => 'BA-004', 'titulo' => 'Monoambiente Caballito', 'tipo' => 'Departamento', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 52000, 'moneda' => 'USD', 'direccion' => 'Av. Rivadavia 5200 1°F', 'ciudad' => 'CABA', 'zona' => 'Caballito', 'mt2_cubiertos' => 32, 'mt2_totales' => 32, 'ambientes' => 1, 'banos' => 1, 'cochera' => false, 'propietario_id' => 12, 'agente_id' => 5, 'fecha_pub' => '2025-05-01', 'destacada' => false],
    ['id' => 14, 'codigo' => 'CP-003', 'titulo' => 'Lote en Chateau Carreras', 'tipo' => 'Lote', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 68000, 'moneda' => 'USD', 'direccion' => 'Country Chateau Lt.45', 'ciudad' => 'Córdoba Capital', 'zona' => 'Chateau Carreras', 'mt2_cubiertos' => 0, 'mt2_totales' => 800, 'ambientes' => 0, 'banos' => 0, 'cochera' => false, 'propietario_id' => 10, 'agente_id' => 10, 'fecha_pub' => '2025-04-18', 'destacada' => true],
    ['id' => 15, 'codigo' => 'DV-008', 'titulo' => 'PH 3 amb. reciclado', 'tipo' => 'PH', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 72000, 'moneda' => 'USD', 'direccion' => 'Esquiú 430', 'ciudad' => 'Catamarca', 'zona' => 'Sur', 'mt2_cubiertos' => 90, 'mt2_totales' => 110, 'ambientes' => 3, 'banos' => 1, 'cochera' => false, 'propietario_id' => 2, 'agente_id' => 2, 'fecha_pub' => '2025-05-10', 'destacada' => false],
    ['id' => 16, 'codigo' => 'BA-005', 'titulo' => 'Local gastronómico Palermo', 'tipo' => 'Local Comercial', 'operacion' => 'Alquiler', 'estado' => 'Disponible', 'precio' => 1800000, 'moneda' => 'ARS', 'direccion' => 'Thames 1650', 'ciudad' => 'CABA', 'zona' => 'Palermo', 'mt2_cubiertos' => 120, 'mt2_totales' => 150, 'ambientes' => 2, 'banos' => 2, 'cochera' => false, 'propietario_id' => 15, 'agente_id' => 5, 'fecha_pub' => '2025-03-25', 'destacada' => true],
    ['id' => 17, 'codigo' => 'DV-009', 'titulo' => 'Casa 2 amb. economica', 'tipo' => 'Casa', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 38000, 'moneda' => 'USD', 'direccion' => 'Pasaje Los Laureles 120', 'ciudad' => 'Catamarca', 'zona' => 'Villa Cubas', 'mt2_cubiertos' => 65, 'mt2_totales' => 180, 'ambientes' => 2, 'banos' => 1, 'cochera' => false, 'propietario_id' => 13, 'agente_id' => 1, 'fecha_pub' => '2025-05-20', 'destacada' => false],
    ['id' => 18, 'codigo' => 'BA-006', 'titulo' => 'Depto 4 amb. Núñez premium', 'tipo' => 'Departamento', 'operacion' => 'Venta', 'estado' => 'Reservada', 'precio' => 210000, 'moneda' => 'USD', 'direccion' => 'Av. Del Libertador 7800 10°A', 'ciudad' => 'CABA', 'zona' => 'Núñez', 'mt2_cubiertos' => 130, 'mt2_totales' => 145, 'ambientes' => 4, 'banos' => 2, 'cochera' => true, 'propietario_id' => 12, 'agente_id' => 4, 'fecha_pub' => '2025-02-01', 'destacada' => true],
    ['id' => 19, 'codigo' => 'CP-004', 'titulo' => 'Galpón zona industrial', 'tipo' => 'Galpón', 'operacion' => 'Alquiler', 'estado' => 'Disponible', 'precio' => 800000, 'moneda' => 'ARS', 'direccion' => 'Ruta 19 km 8.5', 'ciudad' => 'Córdoba Capital', 'zona' => 'Zona Industrial', 'mt2_cubiertos' => 450, 'mt2_totales' => 800, 'ambientes' => 1, 'banos' => 1, 'cochera' => true, 'propietario_id' => 5, 'agente_id' => 3, 'fecha_pub' => '2025-04-01', 'destacada' => false],
    ['id' => 20, 'codigo' => 'DV-010', 'titulo' => 'Depto 3 amb. vista al parque', 'tipo' => 'Departamento', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 78000, 'moneda' => 'USD', 'direccion' => 'Av. Gobernador Galíndez 600 6°E', 'ciudad' => 'Catamarca', 'zona' => 'Norte', 'mt2_cubiertos' => 80, 'mt2_totales' => 85, 'ambientes' => 3, 'banos' => 1, 'cochera' => true, 'propietario_id' => 13, 'agente_id' => 2, 'fecha_pub' => '2025-05-25', 'destacada' => false],
    // Más propiedades
    ['id' => 21, 'codigo' => 'BA-007', 'titulo' => 'Cochera en Recoleta', 'tipo' => 'Cochera', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 28000, 'moneda' => 'USD', 'direccion' => 'Juncal 1500 Subsuelo', 'ciudad' => 'CABA', 'zona' => 'Recoleta', 'mt2_cubiertos' => 15, 'mt2_totales' => 15, 'ambientes' => 0, 'banos' => 0, 'cochera' => true, 'propietario_id' => 6, 'agente_id' => 4, 'fecha_pub' => '2025-05-15', 'destacada' => false],
    ['id' => 22, 'codigo' => 'DV-011', 'titulo' => 'Casa quinta con pileta', 'tipo' => 'Casa', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 155000, 'moneda' => 'USD', 'direccion' => 'Camino a Chumbicha km 3', 'ciudad' => 'Valle Viejo', 'zona' => 'Santa Rosa', 'mt2_cubiertos' => 200, 'mt2_totales' => 1200, 'ambientes' => 4, 'banos' => 3, 'cochera' => true, 'propietario_id' => 8, 'agente_id' => 8, 'fecha_pub' => '2025-03-10', 'destacada' => true],
    ['id' => 23, 'codigo' => 'CP-005', 'titulo' => 'Depto 2 amb. Güemes', 'tipo' => 'Departamento', 'operacion' => 'Alquiler', 'estado' => 'Disponible', 'precio' => 380000, 'moneda' => 'ARS', 'direccion' => 'Achával Rodríguez 200 4°B', 'ciudad' => 'Córdoba Capital', 'zona' => 'Güemes', 'mt2_cubiertos' => 52, 'mt2_totales' => 55, 'ambientes' => 2, 'banos' => 1, 'cochera' => false, 'propietario_id' => 14, 'agente_id' => 9, 'fecha_pub' => '2025-06-01', 'destacada' => false],
    ['id' => 24, 'codigo' => 'BA-008', 'titulo' => 'Casa en Belgrano R', 'tipo' => 'Casa', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 420000, 'moneda' => 'USD', 'direccion' => 'Melián 2300', 'ciudad' => 'CABA', 'zona' => 'Belgrano', 'mt2_cubiertos' => 280, 'mt2_totales' => 350, 'ambientes' => 6, 'banos' => 4, 'cochera' => true, 'propietario_id' => 7, 'agente_id' => 6, 'fecha_pub' => '2025-01-10', 'destacada' => true],
    ['id' => 25, 'codigo' => 'DV-012', 'titulo' => 'Depósito 200m²', 'tipo' => 'Depósito', 'operacion' => 'Alquiler', 'estado' => 'Disponible', 'precio' => 350000, 'moneda' => 'ARS', 'direccion' => 'Ruta 38 km 2', 'ciudad' => 'Catamarca', 'zona' => 'Sur', 'mt2_cubiertos' => 200, 'mt2_totales' => 300, 'ambientes' => 1, 'banos' => 1, 'cochera' => true, 'propietario_id' => 3, 'agente_id' => 1, 'fecha_pub' => '2025-04-20', 'destacada' => false],
    ['id' => 26, 'codigo' => 'NP-001', 'titulo' => 'Casa 3 amb. Yerba Buena', 'tipo' => 'Casa', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 95000, 'moneda' => 'USD', 'direccion' => 'Av. Aconquija 2500', 'ciudad' => 'San Miguel de Tucumán', 'zona' => 'Yerba Buena', 'mt2_cubiertos' => 140, 'mt2_totales' => 350, 'ambientes' => 3, 'banos' => 2, 'cochera' => true, 'propietario_id' => 9, 'agente_id' => 7, 'fecha_pub' => '2025-05-05', 'destacada' => false],
    ['id' => 27, 'codigo' => 'BA-009', 'titulo' => 'Depto 3 amb. Puerto Madero', 'tipo' => 'Departamento', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 320000, 'moneda' => 'USD', 'direccion' => 'Juana Manso 1200 15°B', 'ciudad' => 'CABA', 'zona' => 'Puerto Madero', 'mt2_cubiertos' => 110, 'mt2_totales' => 120, 'ambientes' => 3, 'banos' => 2, 'cochera' => true, 'propietario_id' => 7, 'agente_id' => 4, 'fecha_pub' => '2025-04-15', 'destacada' => true],
    ['id' => 28, 'codigo' => 'DV-013', 'titulo' => 'Lote en Polcos', 'tipo' => 'Lote', 'operacion' => 'Venta', 'estado' => 'Vendida', 'precio' => 18000, 'moneda' => 'USD', 'direccion' => 'Loteo Don Julio Lt.23', 'ciudad' => 'Catamarca', 'zona' => 'Polcos', 'mt2_cubiertos' => 0, 'mt2_totales' => 400, 'ambientes' => 0, 'banos' => 0, 'cochera' => false, 'propietario_id' => 13, 'agente_id' => 1, 'fecha_pub' => '2024-08-15', 'destacada' => false],
    ['id' => 29, 'codigo' => 'CP-006', 'titulo' => 'Oficina centro Córdoba', 'tipo' => 'Oficina', 'operacion' => 'Alquiler', 'estado' => 'Alquilada', 'precio' => 550000, 'moneda' => 'ARS', 'direccion' => 'Deán Funes 350 Of.12', 'ciudad' => 'Córdoba Capital', 'zona' => 'Centro', 'mt2_cubiertos' => 45, 'mt2_totales' => 45, 'ambientes' => 2, 'banos' => 1, 'cochera' => false, 'propietario_id' => 10, 'agente_id' => 10, 'fecha_pub' => '2024-11-01', 'destacada' => false],
    ['id' => 30, 'codigo' => 'DV-014', 'titulo' => 'Casa 5 amb. con jardín amplio', 'tipo' => 'Casa', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 165000, 'moneda' => 'USD', 'direccion' => 'Barrio La Granja Mz.D Lt.5', 'ciudad' => 'Catamarca', 'zona' => 'Norte', 'mt2_cubiertos' => 230, 'mt2_totales' => 600, 'ambientes' => 5, 'banos' => 3, 'cochera' => true, 'propietario_id' => 1, 'agente_id' => 2, 'fecha_pub' => '2025-06-01', 'destacada' => true],
    // 30 más propiedades resumidas
    ['id' => 31, 'codigo' => 'BA-010', 'titulo' => 'Depto 1 amb. Palermo Hollywood', 'tipo' => 'Departamento', 'operacion' => 'Alquiler', 'estado' => 'Disponible', 'precio' => 480000, 'moneda' => 'ARS', 'direccion' => 'Bonpland 1700 3°C', 'ciudad' => 'CABA', 'zona' => 'Palermo', 'mt2_cubiertos' => 38, 'mt2_totales' => 38, 'ambientes' => 1, 'banos' => 1, 'cochera' => false, 'propietario_id' => 15, 'agente_id' => 5, 'fecha_pub' => '2025-05-28', 'destacada' => false],
    ['id' => 32, 'codigo' => 'DV-015', 'titulo' => 'Cochera cubierta centro', 'tipo' => 'Cochera', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 12000, 'moneda' => 'USD', 'direccion' => 'República 280 Subsuelo', 'ciudad' => 'Catamarca', 'zona' => 'Centro', 'mt2_cubiertos' => 14, 'mt2_totales' => 14, 'ambientes' => 0, 'banos' => 0, 'cochera' => true, 'propietario_id' => 3, 'agente_id' => 1, 'fecha_pub' => '2025-06-05', 'destacada' => false],
    ['id' => 33, 'codigo' => 'CP-007', 'titulo' => 'Depto 3 amb. Cerro Rosas', 'tipo' => 'Departamento', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 115000, 'moneda' => 'USD', 'direccion' => 'Av. Rafael Núñez 3800 5°A', 'ciudad' => 'Córdoba Capital', 'zona' => 'Cerro de las Rosas', 'mt2_cubiertos' => 95, 'mt2_totales' => 100, 'ambientes' => 3, 'banos' => 2, 'cochera' => true, 'propietario_id' => 10, 'agente_id' => 3, 'fecha_pub' => '2025-03-20', 'destacada' => false],
    ['id' => 34, 'codigo' => 'DV-016', 'titulo' => 'Casa a estrenar 3 amb.', 'tipo' => 'Casa', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 92000, 'moneda' => 'USD', 'direccion' => 'B° Parque América Mz.F Lt.1', 'ciudad' => 'Catamarca', 'zona' => 'Sur', 'mt2_cubiertos' => 105, 'mt2_totales' => 250, 'ambientes' => 3, 'banos' => 2, 'cochera' => true, 'propietario_id' => 13, 'agente_id' => 2, 'fecha_pub' => '2025-05-30', 'destacada' => false],
    ['id' => 35, 'codigo' => 'BA-011', 'titulo' => 'Edificio completo Caballito', 'tipo' => 'Edificio', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 1200000, 'moneda' => 'USD', 'direccion' => 'Av. Pedro Goyena 1400', 'ciudad' => 'CABA', 'zona' => 'Caballito', 'mt2_cubiertos' => 1800, 'mt2_totales' => 1800, 'ambientes' => 24, 'banos' => 12, 'cochera' => true, 'propietario_id' => 7, 'agente_id' => 4, 'fecha_pub' => '2025-02-20', 'destacada' => true],
    ['id' => 36, 'codigo' => 'DV-017', 'titulo' => 'Depto 2 amb. amoblado temporal', 'tipo' => 'Departamento', 'operacion' => 'Alquiler', 'estado' => 'Disponible', 'precio' => 320000, 'moneda' => 'ARS', 'direccion' => 'San Martín 600 4°D', 'ciudad' => 'Catamarca', 'zona' => 'Centro', 'mt2_cubiertos' => 50, 'mt2_totales' => 50, 'ambientes' => 2, 'banos' => 1, 'cochera' => false, 'propietario_id' => 11, 'agente_id' => 1, 'fecha_pub' => '2025-06-08', 'destacada' => false],
    ['id' => 37, 'codigo' => 'CP-008', 'titulo' => 'Casa 4 amb. barrio Jardín', 'tipo' => 'Casa', 'operacion' => 'Alquiler', 'estado' => 'Disponible', 'precio' => 550000, 'moneda' => 'ARS', 'direccion' => 'Los Platanos 890', 'ciudad' => 'Córdoba Capital', 'zona' => 'Cerro de las Rosas', 'mt2_cubiertos' => 170, 'mt2_totales' => 400, 'ambientes' => 4, 'banos' => 2, 'cochera' => true, 'propietario_id' => 5, 'agente_id' => 9, 'fecha_pub' => '2025-04-25', 'destacada' => false],
    ['id' => 38, 'codigo' => 'BA-012', 'titulo' => 'Galpón depósito Núñez', 'tipo' => 'Galpón', 'operacion' => 'Alquiler', 'estado' => 'Disponible', 'precio' => 2500000, 'moneda' => 'ARS', 'direccion' => 'Congreso 2800', 'ciudad' => 'CABA', 'zona' => 'Núñez', 'mt2_cubiertos' => 600, 'mt2_totales' => 800, 'ambientes' => 1, 'banos' => 2, 'cochera' => true, 'propietario_id' => 7, 'agente_id' => 6, 'fecha_pub' => '2025-03-05', 'destacada' => false],
    ['id' => 39, 'codigo' => 'DV-018', 'titulo' => 'Lote 300m² céntrico', 'tipo' => 'Lote', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 45000, 'moneda' => 'USD', 'direccion' => 'Maipú y Tucumán', 'ciudad' => 'Catamarca', 'zona' => 'Centro', 'mt2_cubiertos' => 0, 'mt2_totales' => 300, 'ambientes' => 0, 'banos' => 0, 'cochera' => false, 'propietario_id' => 3, 'agente_id' => 2, 'fecha_pub' => '2025-06-06', 'destacada' => false],
    ['id' => 40, 'codigo' => 'BA-013', 'titulo' => 'Depto 2 amb. balcón Belgrano', 'tipo' => 'Departamento', 'operacion' => 'Venta', 'estado' => 'Vendida', 'precio' => 98000, 'moneda' => 'USD', 'direccion' => 'Echeverría 1800 7°B', 'ciudad' => 'CABA', 'zona' => 'Belgrano', 'mt2_cubiertos' => 55, 'mt2_totales' => 60, 'ambientes' => 2, 'banos' => 1, 'cochera' => false, 'propietario_id' => 12, 'agente_id' => 6, 'fecha_pub' => '2024-10-20', 'destacada' => false],
    ['id' => 41, 'codigo' => 'CP-009', 'titulo' => 'Local centro Córdoba', 'tipo' => 'Local Comercial', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 75000, 'moneda' => 'USD', 'direccion' => 'San Martín 450', 'ciudad' => 'Córdoba Capital', 'zona' => 'Centro', 'mt2_cubiertos' => 80, 'mt2_totales' => 80, 'ambientes' => 2, 'banos' => 1, 'cochera' => false, 'propietario_id' => 5, 'agente_id' => 10, 'fecha_pub' => '2025-05-12', 'destacada' => false],
    ['id' => 42, 'codigo' => 'DV-019', 'titulo' => 'Casa 3 amb. Fray M. Esquiú', 'tipo' => 'Casa', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 55000, 'moneda' => 'USD', 'direccion' => 'Av. 25 de Mayo 340', 'ciudad' => 'Fray Mamerto Esquiú', 'zona' => 'Centro', 'mt2_cubiertos' => 95, 'mt2_totales' => 220, 'ambientes' => 3, 'banos' => 1, 'cochera' => true, 'propietario_id' => 2, 'agente_id' => 2, 'fecha_pub' => '2025-04-08', 'destacada' => false],
    ['id' => 43, 'codigo' => 'BA-014', 'titulo' => 'Depto temp. Puerto Madero', 'tipo' => 'Departamento', 'operacion' => 'Alquiler', 'estado' => 'Alquilada', 'precio' => 1500000, 'moneda' => 'ARS', 'direccion' => 'Azucena Villaflor 500 22°A', 'ciudad' => 'CABA', 'zona' => 'Puerto Madero', 'mt2_cubiertos' => 75, 'mt2_totales' => 90, 'ambientes' => 2, 'banos' => 1, 'cochera' => true, 'propietario_id' => 7, 'agente_id' => 5, 'fecha_pub' => '2025-01-05', 'destacada' => false],
    ['id' => 44, 'codigo' => 'DV-020', 'titulo' => 'PH 2 amb. luminoso', 'tipo' => 'PH', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 48000, 'moneda' => 'USD', 'direccion' => 'Ayacucho 560', 'ciudad' => 'Catamarca', 'zona' => 'Sur', 'mt2_cubiertos' => 60, 'mt2_totales' => 80, 'ambientes' => 2, 'banos' => 1, 'cochera' => false, 'propietario_id' => 13, 'agente_id' => 1, 'fecha_pub' => '2025-05-18', 'destacada' => false],
    ['id' => 45, 'codigo' => 'CP-010', 'titulo' => 'Campo 50 has. uso agrícola', 'tipo' => 'Campo', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 350000, 'moneda' => 'USD', 'direccion' => 'Ruta Prov. 10 km 45', 'ciudad' => 'Córdoba Capital', 'zona' => 'Zona Rural', 'mt2_cubiertos' => 120, 'mt2_totales' => 500000, 'ambientes' => 1, 'banos' => 1, 'cochera' => true, 'propietario_id' => 10, 'agente_id' => 3, 'fecha_pub' => '2025-02-15', 'destacada' => false],
    ['id' => 46, 'codigo' => 'BA-015', 'titulo' => 'Depto 3 amb. Caballito lum.', 'tipo' => 'Departamento', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 89000, 'moneda' => 'USD', 'direccion' => 'Av. Directorio 1200 5°A', 'ciudad' => 'CABA', 'zona' => 'Caballito', 'mt2_cubiertos' => 72, 'mt2_totales' => 72, 'ambientes' => 3, 'banos' => 1, 'cochera' => false, 'propietario_id' => 6, 'agente_id' => 4, 'fecha_pub' => '2025-06-02', 'destacada' => false],
    ['id' => 47, 'codigo' => 'DV-021', 'titulo' => 'Dúplex 3 amb. a estrenar', 'tipo' => 'Dúplex', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 98000, 'moneda' => 'USD', 'direccion' => 'Barrio Los Alamos Mz.B Lt.3', 'ciudad' => 'Catamarca', 'zona' => 'Norte', 'mt2_cubiertos' => 130, 'mt2_totales' => 200, 'ambientes' => 3, 'banos' => 2, 'cochera' => true, 'propietario_id' => 13, 'agente_id' => 8, 'fecha_pub' => '2025-06-07', 'destacada' => true],
    ['id' => 48, 'codigo' => 'BA-016', 'titulo' => 'Cochera fija Recoleta', 'tipo' => 'Cochera', 'operacion' => 'Alquiler', 'estado' => 'Disponible', 'precio' => 120000, 'moneda' => 'ARS', 'direccion' => 'Av. Pueyrredón 1600 SS', 'ciudad' => 'CABA', 'zona' => 'Recoleta', 'mt2_cubiertos' => 12, 'mt2_totales' => 12, 'ambientes' => 0, 'banos' => 0, 'cochera' => true, 'propietario_id' => 15, 'agente_id' => 5, 'fecha_pub' => '2025-05-22', 'destacada' => false],
    ['id' => 49, 'codigo' => 'CP-011', 'titulo' => 'PH reciclado centro', 'tipo' => 'PH', 'operacion' => 'Alquiler', 'estado' => 'Disponible', 'precio' => 420000, 'moneda' => 'ARS', 'direccion' => 'Caseros 650', 'ciudad' => 'Córdoba Capital', 'zona' => 'Centro', 'mt2_cubiertos' => 75, 'mt2_totales' => 90, 'ambientes' => 2, 'banos' => 1, 'cochera' => false, 'propietario_id' => 14, 'agente_id' => 9, 'fecha_pub' => '2025-06-03', 'destacada' => false],
    ['id' => 50, 'codigo' => 'DV-022', 'titulo' => 'Local sobre Av. Güemes', 'tipo' => 'Local Comercial', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 62000, 'moneda' => 'USD', 'direccion' => 'Av. Güemes 1200', 'ciudad' => 'Catamarca', 'zona' => 'Centro', 'mt2_cubiertos' => 75, 'mt2_totales' => 75, 'ambientes' => 1, 'banos' => 1, 'cochera' => false, 'propietario_id' => 3, 'agente_id' => 1, 'fecha_pub' => '2025-05-08', 'destacada' => false],
    ['id' => 51, 'codigo' => 'BA-017', 'titulo' => 'Depto estudio Palermo', 'tipo' => 'Departamento', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 68000, 'moneda' => 'USD', 'direccion' => 'Gorriti 4200 2°E', 'ciudad' => 'CABA', 'zona' => 'Palermo', 'mt2_cubiertos' => 42, 'mt2_totales' => 42, 'ambientes' => 1, 'banos' => 1, 'cochera' => false, 'propietario_id' => 15, 'agente_id' => 5, 'fecha_pub' => '2025-06-04', 'destacada' => false],
    ['id' => 52, 'codigo' => 'DV-023', 'titulo' => 'Casa 2 amb. con terreno', 'tipo' => 'Casa', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 42000, 'moneda' => 'USD', 'direccion' => 'B° San Antonio Mz.G Lt.8', 'ciudad' => 'Catamarca', 'zona' => 'Sur', 'mt2_cubiertos' => 70, 'mt2_totales' => 300, 'ambientes' => 2, 'banos' => 1, 'cochera' => false, 'propietario_id' => 2, 'agente_id' => 2, 'fecha_pub' => '2025-06-09', 'destacada' => false],
    ['id' => 53, 'codigo' => 'CP-012', 'titulo' => 'Depto 2 amb. amoblado temp.', 'tipo' => 'Departamento', 'operacion' => 'Alquiler', 'estado' => 'Alquilada', 'precio' => 450000, 'moneda' => 'ARS', 'direccion' => 'Bv. Chacabuco 700 6°C', 'ciudad' => 'Córdoba Capital', 'zona' => 'Nueva Córdoba', 'mt2_cubiertos' => 48, 'mt2_totales' => 48, 'ambientes' => 2, 'banos' => 1, 'cochera' => false, 'propietario_id' => 4, 'agente_id' => 10, 'fecha_pub' => '2025-01-25', 'destacada' => false],
    ['id' => 54, 'codigo' => 'BA-018', 'titulo' => 'Local Belgrano C', 'tipo' => 'Local Comercial', 'operacion' => 'Alquiler', 'estado' => 'Disponible', 'precio' => 900000, 'moneda' => 'ARS', 'direccion' => 'Av. Cabildo 1850', 'ciudad' => 'CABA', 'zona' => 'Belgrano', 'mt2_cubiertos' => 65, 'mt2_totales' => 65, 'ambientes' => 1, 'banos' => 1, 'cochera' => false, 'propietario_id' => 12, 'agente_id' => 6, 'fecha_pub' => '2025-05-15', 'destacada' => false],
    ['id' => 55, 'codigo' => 'DV-024', 'titulo' => 'Depto 3 amb. con cochera', 'tipo' => 'Departamento', 'operacion' => 'Alquiler', 'estado' => 'Disponible', 'precio' => 300000, 'moneda' => 'ARS', 'direccion' => 'Prado 240 3°A', 'ciudad' => 'Catamarca', 'zona' => 'Norte', 'mt2_cubiertos' => 75, 'mt2_totales' => 80, 'ambientes' => 3, 'banos' => 1, 'cochera' => true, 'propietario_id' => 1, 'agente_id' => 1, 'fecha_pub' => '2025-06-10', 'destacada' => false],
    ['id' => 56, 'codigo' => 'NP-002', 'titulo' => 'Depto 2 amb. centro Tucumán', 'tipo' => 'Departamento', 'operacion' => 'Alquiler', 'estado' => 'Disponible', 'precio' => 250000, 'moneda' => 'ARS', 'direccion' => 'San Martín 800 2°B', 'ciudad' => 'San Miguel de Tucumán', 'zona' => 'Centro', 'mt2_cubiertos' => 50, 'mt2_totales' => 50, 'ambientes' => 2, 'banos' => 1, 'cochera' => false, 'propietario_id' => 9, 'agente_id' => 7, 'fecha_pub' => '2025-06-08', 'destacada' => false],
    ['id' => 57, 'codigo' => 'BA-019', 'titulo' => 'Oficina Recoleta cowork', 'tipo' => 'Oficina', 'operacion' => 'Alquiler', 'estado' => 'Disponible', 'precio' => 750000, 'moneda' => 'ARS', 'direccion' => 'Av. Santa Fe 2100 3°', 'ciudad' => 'CABA', 'zona' => 'Recoleta', 'mt2_cubiertos' => 60, 'mt2_totales' => 60, 'ambientes' => 3, 'banos' => 1, 'cochera' => false, 'propietario_id' => 6, 'agente_id' => 4, 'fecha_pub' => '2025-05-20', 'destacada' => false],
    ['id' => 58, 'codigo' => 'DV-025', 'titulo' => 'Lote esquina 500m²', 'tipo' => 'Lote', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 55000, 'moneda' => 'USD', 'direccion' => 'Los Ceibos y Av. San Martín', 'ciudad' => 'Catamarca', 'zona' => 'Norte', 'mt2_cubiertos' => 0, 'mt2_totales' => 500, 'ambientes' => 0, 'banos' => 0, 'cochera' => false, 'propietario_id' => 13, 'agente_id' => 2, 'fecha_pub' => '2025-06-09', 'destacada' => false],
    ['id' => 59, 'codigo' => 'CP-013', 'titulo' => 'Cochera cubierta centro', 'tipo' => 'Cochera', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 15000, 'moneda' => 'USD', 'direccion' => 'Av. Colón 600 SS', 'ciudad' => 'Córdoba Capital', 'zona' => 'Centro', 'mt2_cubiertos' => 14, 'mt2_totales' => 14, 'ambientes' => 0, 'banos' => 0, 'cochera' => true, 'propietario_id' => 10, 'agente_id' => 3, 'fecha_pub' => '2025-04-30', 'destacada' => false],
    ['id' => 60, 'codigo' => 'BA-020', 'titulo' => 'Casa 4 amb. Núñez jardín', 'tipo' => 'Casa', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 295000, 'moneda' => 'USD', 'direccion' => 'Cuba 3200', 'ciudad' => 'CABA', 'zona' => 'Núñez', 'mt2_cubiertos' => 200, 'mt2_totales' => 300, 'ambientes' => 4, 'banos' => 3, 'cochera' => true, 'propietario_id' => 7, 'agente_id' => 6, 'fecha_pub' => '2025-05-10', 'destacada' => true],
    ['id' => 61, 'codigo' => 'DV-026', 'titulo' => 'Lote 400m² Valle Viejo', 'tipo' => 'Lote', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 22000, 'moneda' => 'USD', 'direccion' => 'Loteo Nuevo Horizonte Lt.7', 'ciudad' => 'Valle Viejo', 'zona' => 'Centro', 'mt2_cubiertos' => 0, 'mt2_totales' => 400, 'ambientes' => 0, 'banos' => 0, 'cochera' => false, 'propietario_id' => 8, 'agente_id' => 8, 'fecha_pub' => '2025-06-10', 'destacada' => false],
    ['id' => 62, 'codigo' => 'CP-014', 'titulo' => 'Lote Güemes 350m²', 'tipo' => 'Lote', 'operacion' => 'Venta', 'estado' => 'Disponible', 'precio' => 48000, 'moneda' => 'USD', 'direccion' => 'Laprida 1200', 'ciudad' => 'Córdoba Capital', 'zona' => 'Güemes', 'mt2_cubiertos' => 0, 'mt2_totales' => 350, 'ambientes' => 0, 'banos' => 0, 'cochera' => false, 'propietario_id' => 10, 'agente_id' => 9, 'fecha_pub' => '2025-06-05', 'destacada' => false],
    ['id' => 63, 'codigo' => 'DV-027', 'titulo' => 'Casa 4 amb. pileta quincho', 'tipo' => 'Casa', 'operacion' => 'Alquiler', 'estado' => 'Disponible', 'precio' => 500000, 'moneda' => 'ARS', 'direccion' => 'Los Algarrobos 320', 'ciudad' => 'Catamarca', 'zona' => 'Parque Adán Quiroga', 'mt2_cubiertos' => 160, 'mt2_totales' => 400, 'ambientes' => 4, 'banos' => 2, 'cochera' => true, 'propietario_id' => 1, 'agente_id' => 1, 'fecha_pub' => '2025-06-10', 'destacada' => true],
];

// ============================================
// CLIENTES (50+)
// ============================================
$clientes = [
    ['id' => 1, 'nombre' => 'Juan Pérez', 'tipo' => 'Comprador', 'telefono' => '383-155001122', 'email' => 'juan.perez@gmail.com', 'preferencia' => 'Casa 3 amb.', 'presupuesto' => 'USD 80.000-120.000', 'zona_interes' => 'Catamarca Norte', 'estado' => 'Activo', 'agente_id' => 1],
    ['id' => 2, 'nombre' => 'Carolina Figueroa', 'tipo' => 'Inquilino', 'telefono' => '383-155002233', 'email' => 'caro.fig@hotmail.com', 'preferencia' => 'Depto 2 amb.', 'presupuesto' => 'ARS 250.000-350.000', 'zona_interes' => 'Catamarca Centro', 'estado' => 'Activo', 'agente_id' => 1],
    ['id' => 3, 'nombre' => 'Marcos Sosa', 'tipo' => 'Inversor', 'telefono' => '11-156003344', 'email' => 'marcos.sosa@outlook.com', 'preferencia' => 'Lotes y departamentos', 'presupuesto' => 'USD 50.000-200.000', 'zona_interes' => 'CABA / Córdoba', 'estado' => 'Activo', 'agente_id' => 4],
    ['id' => 4, 'nombre' => 'Analía Cortez', 'tipo' => 'Comprador', 'telefono' => '351-156004455', 'email' => 'analia.c@gmail.com', 'preferencia' => 'Casa 4+ amb.', 'presupuesto' => 'USD 150.000-250.000', 'zona_interes' => 'Cerro de las Rosas', 'estado' => 'Activo', 'agente_id' => 3],
    ['id' => 5, 'nombre' => 'Sebastián Luna', 'tipo' => 'Inquilino', 'telefono' => '11-157005566', 'email' => 'seba.luna@yahoo.com', 'preferencia' => 'Depto 1-2 amb.', 'presupuesto' => 'ARS 400.000-600.000', 'zona_interes' => 'Palermo', 'estado' => 'Activo', 'agente_id' => 5],
    ['id' => 6, 'nombre' => 'Florencia Medina', 'tipo' => 'Comprador', 'telefono' => '383-155006677', 'email' => 'flor.medina@gmail.com', 'preferencia' => 'Lote residencial', 'presupuesto' => 'USD 25.000-50.000', 'zona_interes' => 'Valle Viejo', 'estado' => 'Potencial', 'agente_id' => 8],
    ['id' => 7, 'nombre' => 'Adrián Molina', 'tipo' => 'Comprador', 'telefono' => '11-158007788', 'email' => 'adrian.m@gmail.com', 'preferencia' => 'Depto 3 amb.', 'presupuesto' => 'USD 90.000-130.000', 'zona_interes' => 'Belgrano / Núñez', 'estado' => 'Activo', 'agente_id' => 6],
    ['id' => 8, 'nombre' => 'Daniela Soria', 'tipo' => 'Inquilino', 'telefono' => '351-159008899', 'email' => 'dani.soria@hotmail.com', 'preferencia' => 'Depto 2 amb.', 'presupuesto' => 'ARS 300.000-450.000', 'zona_interes' => 'Nueva Córdoba', 'estado' => 'Activo', 'agente_id' => 9],
    ['id' => 9, 'nombre' => 'Roberto Cáceres', 'tipo' => 'Inversor', 'telefono' => '383-155009900', 'email' => 'r.caceres@empresas.com.ar', 'preferencia' => 'Locales y oficinas', 'presupuesto' => 'USD 50.000-100.000', 'zona_interes' => 'Catamarca Centro', 'estado' => 'Activo', 'agente_id' => 2],
    ['id' => 10, 'nombre' => 'María Eugenia Valle', 'tipo' => 'Comprador', 'telefono' => '11-150110011', 'email' => 'meuge.v@gmail.com', 'preferencia' => 'Depto 4 amb.', 'presupuesto' => 'USD 180.000-250.000', 'zona_interes' => 'Recoleta', 'estado' => 'Activo', 'agente_id' => 4],
    ['id' => 11, 'nombre' => 'Lucas Villagra', 'tipo' => 'Comprador', 'telefono' => '383-155111122', 'email' => 'lucas.v@gmail.com', 'preferencia' => 'Casa 3 amb.', 'presupuesto' => 'USD 60.000-90.000', 'zona_interes' => 'Catamarca Sur', 'estado' => 'Potencial', 'agente_id' => 2],
    ['id' => 12, 'nombre' => 'Verónica Paz', 'tipo' => 'Inquilino', 'telefono' => '351-155112233', 'email' => 'vero.paz@outlook.com', 'preferencia' => 'Casa 3 amb.', 'presupuesto' => 'ARS 400.000-600.000', 'zona_interes' => 'Cerro de las Rosas', 'estado' => 'Activo', 'agente_id' => 3],
    ['id' => 13, 'nombre' => 'Gastón Herrera', 'tipo' => 'Comprador', 'telefono' => '11-155113344', 'email' => 'gaston.h@gmail.com', 'preferencia' => 'Cochera', 'presupuesto' => 'USD 20.000-35.000', 'zona_interes' => 'Recoleta / Belgrano', 'estado' => 'Potencial', 'agente_id' => 5],
    ['id' => 14, 'nombre' => 'Natalia Bustos', 'tipo' => 'Comprador', 'telefono' => '383-155114455', 'email' => 'nata.b@yahoo.com', 'preferencia' => 'Dúplex', 'presupuesto' => 'USD 85.000-110.000', 'zona_interes' => 'Valle Viejo / Catamarca', 'estado' => 'Activo', 'agente_id' => 8],
    ['id' => 15, 'nombre' => 'Empresa TechNOA S.A.', 'tipo' => 'Inversor', 'telefono' => '383-4440050', 'email' => 'inversiones@technoa.com.ar', 'preferencia' => 'Oficinas y locales', 'presupuesto' => 'USD 100.000-500.000', 'zona_interes' => 'Catamarca / Tucumán', 'estado' => 'Activo', 'agente_id' => 1],
    ['id' => 16, 'nombre' => 'Cecilia Ramos', 'tipo' => 'Inquilino', 'telefono' => '11-155115566', 'email' => 'ceci.ramos@gmail.com', 'preferencia' => 'Depto 1 amb.', 'presupuesto' => 'ARS 350.000-500.000', 'zona_interes' => 'Palermo', 'estado' => 'Activo', 'agente_id' => 5],
    ['id' => 17, 'nombre' => 'Diego Arce', 'tipo' => 'Comprador', 'telefono' => '351-155116677', 'email' => 'diego.arce@hotmail.com', 'preferencia' => 'Casa 5 amb.', 'presupuesto' => 'USD 160.000-220.000', 'zona_interes' => 'Cerro de las Rosas', 'estado' => 'Activo', 'agente_id' => 3],
    ['id' => 18, 'nombre' => 'Paula Benítez', 'tipo' => 'Inquilino', 'telefono' => '383-155117788', 'email' => 'paula.b@gmail.com', 'preferencia' => 'Depto 2 amb.', 'presupuesto' => 'ARS 200.000-300.000', 'zona_interes' => 'Catamarca Centro', 'estado' => 'Activo', 'agente_id' => 1],
    ['id' => 19, 'nombre' => 'Facundo Torres', 'tipo' => 'Comprador', 'telefono' => '11-155118899', 'email' => 'facundo.t@outlook.com', 'preferencia' => 'Depto 2 amb.', 'presupuesto' => 'USD 50.000-80.000', 'zona_interes' => 'Caballito', 'estado' => 'Potencial', 'agente_id' => 4],
    ['id' => 20, 'nombre' => 'Romina Castro', 'tipo' => 'Comprador', 'telefono' => '383-155119900', 'email' => 'romina.c@gmail.com', 'preferencia' => 'Casa 3 amb. con pileta', 'presupuesto' => 'USD 80.000-130.000', 'zona_interes' => 'Catamarca Norte', 'estado' => 'Activo', 'agente_id' => 2],
    // Más clientes
    ['id' => 21, 'nombre' => 'Hernán Juárez', 'tipo' => 'Inversor', 'telefono' => '11-155220011', 'email' => 'hernan.j@inversiones.com', 'preferencia' => 'Departamentos chicos', 'presupuesto' => 'USD 40.000-80.000', 'zona_interes' => 'CABA', 'estado' => 'Activo', 'agente_id' => 5],
    ['id' => 22, 'nombre' => 'Mariana Ledesma', 'tipo' => 'Inquilino', 'telefono' => '351-155221122', 'email' => 'mari.led@gmail.com', 'preferencia' => 'PH 2 amb.', 'presupuesto' => 'ARS 350.000-500.000', 'zona_interes' => 'Córdoba Centro', 'estado' => 'Activo', 'agente_id' => 10],
    ['id' => 23, 'nombre' => 'Ezequiel Ponce', 'tipo' => 'Comprador', 'telefono' => '383-155222233', 'email' => 'eze.ponce@yahoo.com', 'preferencia' => 'Lote', 'presupuesto' => 'USD 15.000-30.000', 'zona_interes' => 'Catamarca', 'estado' => 'Potencial', 'agente_id' => 1],
    ['id' => 24, 'nombre' => 'Soledad Ríos', 'tipo' => 'Comprador', 'telefono' => '11-155223344', 'email' => 'sole.rios@gmail.com', 'preferencia' => 'Depto 3 amb.', 'presupuesto' => 'USD 85.000-120.000', 'zona_interes' => 'Belgrano', 'estado' => 'Activo', 'agente_id' => 6],
    ['id' => 25, 'nombre' => 'Ricardo Ojeda', 'tipo' => 'Comprador', 'telefono' => '351-155224455', 'email' => 'r.ojeda@hotmail.com', 'preferencia' => 'Local comercial', 'presupuesto' => 'USD 60.000-90.000', 'zona_interes' => 'Córdoba Centro', 'estado' => 'Activo', 'agente_id' => 10],
    ['id' => 26, 'nombre' => 'Andrea Lescano', 'tipo' => 'Inquilino', 'telefono' => '383-155225566', 'email' => 'andrea.l@gmail.com', 'preferencia' => 'Depto 1 amb.', 'presupuesto' => 'ARS 150.000-220.000', 'zona_interes' => 'Catamarca Centro', 'estado' => 'Activo', 'agente_id' => 2],
    ['id' => 27, 'nombre' => 'Ariel Domínguez', 'tipo' => 'Inversor', 'telefono' => '11-155226677', 'email' => 'ariel.dom@inversiones.com.ar', 'preferencia' => 'Edificios completos', 'presupuesto' => 'USD 800.000-1.500.000', 'zona_interes' => 'CABA', 'estado' => 'Activo', 'agente_id' => 4],
    ['id' => 28, 'nombre' => 'Micaela Quiroga', 'tipo' => 'Comprador', 'telefono' => '383-155227788', 'email' => 'mica.q@outlook.com', 'preferencia' => 'Casa 2-3 amb.', 'presupuesto' => 'USD 40.000-65.000', 'zona_interes' => 'Fray M. Esquiú', 'estado' => 'Potencial', 'agente_id' => 2],
    ['id' => 29, 'nombre' => 'Tomás Fuentes', 'tipo' => 'Comprador', 'telefono' => '351-155228899', 'email' => 'tomas.f@gmail.com', 'preferencia' => 'Depto 3 amb.', 'presupuesto' => 'USD 90.000-130.000', 'zona_interes' => 'Nueva Córdoba', 'estado' => 'Activo', 'agente_id' => 9],
    ['id' => 30, 'nombre' => 'Agustina Varela', 'tipo' => 'Inquilino', 'telefono' => '11-155229900', 'email' => 'agus.varela@gmail.com', 'preferencia' => 'Depto 2 amb.', 'presupuesto' => 'ARS 500.000-700.000', 'zona_interes' => 'Palermo / Belgrano', 'estado' => 'Activo', 'agente_id' => 5],
    ['id' => 31, 'nombre' => 'Claudio Pereyra', 'tipo' => 'Comprador', 'telefono' => '383-155330011', 'email' => 'claudio.p@hotmail.com', 'preferencia' => 'Campo', 'presupuesto' => 'USD 200.000-400.000', 'zona_interes' => 'Interior Catamarca', 'estado' => 'Potencial', 'agente_id' => 1],
    ['id' => 32, 'nombre' => 'Virginia Salas', 'tipo' => 'Comprador', 'telefono' => '11-155331122', 'email' => 'virginia.s@gmail.com', 'preferencia' => 'Penthouse', 'presupuesto' => 'USD 300.000-500.000', 'zona_interes' => 'Puerto Madero / Recoleta', 'estado' => 'Activo', 'agente_id' => 4],
    ['id' => 33, 'nombre' => 'Ignacio Tapia', 'tipo' => 'Inquilino', 'telefono' => '351-155332233', 'email' => 'nacho.tapia@yahoo.com', 'preferencia' => 'Oficina', 'presupuesto' => 'ARS 400.000-700.000', 'zona_interes' => 'Córdoba Centro', 'estado' => 'Activo', 'agente_id' => 3],
    ['id' => 34, 'nombre' => 'Ludmila Ortíz', 'tipo' => 'Comprador', 'telefono' => '383-155333344', 'email' => 'ludmi.ortiz@gmail.com', 'preferencia' => 'PH reciclado', 'presupuesto' => 'USD 45.000-75.000', 'zona_interes' => 'Catamarca', 'estado' => 'Activo', 'agente_id' => 2],
    ['id' => 35, 'nombre' => 'Bruno Costa', 'tipo' => 'Comprador', 'telefono' => '11-155334455', 'email' => 'bruno.costa@outlook.com', 'preferencia' => 'Depto 2 amb. luminoso', 'presupuesto' => 'USD 60.000-95.000', 'zona_interes' => 'Caballito / Palermo', 'estado' => 'Potencial', 'agente_id' => 5],
    ['id' => 36, 'nombre' => 'Carla Montenegro', 'tipo' => 'Inversor', 'telefono' => '351-155335566', 'email' => 'carla.m@inversiones.com.ar', 'preferencia' => 'Lotes y casas', 'presupuesto' => 'USD 100.000-300.000', 'zona_interes' => 'Córdoba', 'estado' => 'Activo', 'agente_id' => 3],
    ['id' => 37, 'nombre' => 'Federico Mansilla', 'tipo' => 'Comprador', 'telefono' => '383-155336677', 'email' => 'fede.m@gmail.com', 'preferencia' => 'Galpón', 'presupuesto' => 'USD 80.000-150.000', 'zona_interes' => 'Catamarca Sur', 'estado' => 'Potencial', 'agente_id' => 1],
    ['id' => 38, 'nombre' => 'Yamila Aguirre', 'tipo' => 'Inquilino', 'telefono' => '11-155337788', 'email' => 'yami.aguirre@gmail.com', 'preferencia' => 'Depto 1 amb.', 'presupuesto' => 'ARS 300.000-450.000', 'zona_interes' => 'Belgrano', 'estado' => 'Activo', 'agente_id' => 6],
    ['id' => 39, 'nombre' => 'Nicolás Barrios', 'tipo' => 'Comprador', 'telefono' => '381-155338899', 'email' => 'nico.barrios@hotmail.com', 'preferencia' => 'Casa 3 amb.', 'presupuesto' => 'USD 70.000-100.000', 'zona_interes' => 'Tucumán', 'estado' => 'Activo', 'agente_id' => 7],
    ['id' => 40, 'nombre' => 'Belén Moreno', 'tipo' => 'Comprador', 'telefono' => '383-155339900', 'email' => 'belen.moreno@gmail.com', 'preferencia' => 'Depto 3 amb. con cochera', 'presupuesto' => 'USD 70.000-90.000', 'zona_interes' => 'Catamarca Norte', 'estado' => 'Activo', 'agente_id' => 2],
    ['id' => 41, 'nombre' => 'Gonzalo Páez', 'tipo' => 'Inversor', 'telefono' => '11-155440011', 'email' => 'gonzalo.paez@fund.com.ar', 'preferencia' => 'Locales comerciales', 'presupuesto' => 'USD 50.000-150.000', 'zona_interes' => 'CABA / Córdoba', 'estado' => 'Activo', 'agente_id' => 4],
    ['id' => 42, 'nombre' => 'Celeste Ruiz Díaz', 'tipo' => 'Inquilino', 'telefono' => '351-155441122', 'email' => 'celeste.rd@yahoo.com', 'preferencia' => 'Depto 2 amb.', 'presupuesto' => 'ARS 280.000-400.000', 'zona_interes' => 'Güemes', 'estado' => 'Activo', 'agente_id' => 9],
    ['id' => 43, 'nombre' => 'Matías Céspedes', 'tipo' => 'Comprador', 'telefono' => '383-155442233', 'email' => 'matias.c@gmail.com', 'preferencia' => 'Casa con pileta', 'presupuesto' => 'USD 100.000-160.000', 'zona_interes' => 'Catamarca', 'estado' => 'Potencial', 'agente_id' => 1],
    ['id' => 44, 'nombre' => 'Eugenia Colombo', 'tipo' => 'Comprador', 'telefono' => '11-155443344', 'email' => 'euge.colombo@outlook.com', 'preferencia' => 'Depto 3 amb. terraza', 'presupuesto' => 'USD 100.000-160.000', 'zona_interes' => 'Palermo', 'estado' => 'Activo', 'agente_id' => 5],
    ['id' => 45, 'nombre' => 'Ramiro Valdez', 'tipo' => 'Comprador', 'telefono' => '351-155444455', 'email' => 'ramiro.v@gmail.com', 'preferencia' => 'Lote country', 'presupuesto' => 'USD 50.000-80.000', 'zona_interes' => 'Chateau Carreras', 'estado' => 'Activo', 'agente_id' => 10],
    ['id' => 46, 'nombre' => 'Lorena Figueredo', 'tipo' => 'Inquilino', 'telefono' => '383-155445566', 'email' => 'lorena.f@hotmail.com', 'preferencia' => 'Casa 3 amb.', 'presupuesto' => 'ARS 350.000-500.000', 'zona_interes' => 'Catamarca', 'estado' => 'Activo', 'agente_id' => 2],
    ['id' => 47, 'nombre' => 'Santiago Quiroga', 'tipo' => 'Comprador', 'telefono' => '11-155446677', 'email' => 'santiago.q@gmail.com', 'preferencia' => 'Depto 2 amb.', 'presupuesto' => 'USD 55.000-75.000', 'zona_interes' => 'Caballito', 'estado' => 'Potencial', 'agente_id' => 4],
    ['id' => 48, 'nombre' => 'Ailén Morales', 'tipo' => 'Inquilino', 'telefono' => '351-155447788', 'email' => 'ailen.m@gmail.com', 'preferencia' => 'Depto 1 amb.', 'presupuesto' => 'ARS 250.000-350.000', 'zona_interes' => 'Nueva Córdoba', 'estado' => 'Activo', 'agente_id' => 9],
    ['id' => 49, 'nombre' => 'Iván Contreras', 'tipo' => 'Comprador', 'telefono' => '383-155448899', 'email' => 'ivan.c@outlook.com', 'preferencia' => 'Depósito / Galpón', 'presupuesto' => 'USD 30.000-60.000', 'zona_interes' => 'Catamarca Sur', 'estado' => 'Potencial', 'agente_id' => 1],
    ['id' => 50, 'nombre' => 'Paola Escobar', 'tipo' => 'Comprador', 'telefono' => '11-155449900', 'email' => 'paola.e@gmail.com', 'preferencia' => 'Casa Belgrano', 'presupuesto' => 'USD 350.000-500.000', 'zona_interes' => 'Belgrano R', 'estado' => 'Activo', 'agente_id' => 6],
    ['id' => 51, 'nombre' => 'Alejandro Vidal', 'tipo' => 'Inversor', 'telefono' => '383-155550011', 'email' => 'a.vidal@fondos.com.ar', 'preferencia' => 'Edificios en pozo', 'presupuesto' => 'USD 500.000-2.000.000', 'zona_interes' => 'Catamarca / Córdoba', 'estado' => 'Activo', 'agente_id' => 1],
    ['id' => 52, 'nombre' => 'Julieta Aráoz', 'tipo' => 'Inquilino', 'telefono' => '381-155551122', 'email' => 'juli.araoz@gmail.com', 'preferencia' => 'Depto 2 amb.', 'presupuesto' => 'ARS 200.000-280.000', 'zona_interes' => 'Tucumán Centro', 'estado' => 'Activo', 'agente_id' => 7],
];

// ============================================
// LEADS / CONSULTAS (40+)
// ============================================
$leads = [
    ['id' => 1, 'nombre' => 'Pedro González', 'telefono' => '383-155660011', 'email' => 'pedro.g@gmail.com', 'canal' => 'Portal Web', 'propiedad_id' => 1, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 80.000', 'estado' => 'Nuevo', 'agente_id' => 1, 'scoring' => 85, 'fecha' => '2025-06-10', 'ultima_interaccion' => '2025-06-10'],
    ['id' => 2, 'nombre' => 'Laura Nieto', 'telefono' => '383-155660022', 'email' => 'laura.n@hotmail.com', 'canal' => 'WhatsApp', 'propiedad_id' => 4, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 120.000', 'estado' => 'Contactado', 'agente_id' => 2, 'scoring' => 72, 'fecha' => '2025-06-09', 'ultima_interaccion' => '2025-06-10'],
    ['id' => 3, 'nombre' => 'Sergio Mendoza', 'telefono' => '11-155660033', 'email' => 'sergio.m@outlook.com', 'canal' => 'Referido', 'propiedad_id' => 10, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 350.000', 'estado' => 'Interesado', 'agente_id' => 4, 'scoring' => 90, 'fecha' => '2025-06-08', 'ultima_interaccion' => '2025-06-10'],
    ['id' => 4, 'nombre' => 'Claudia Ríos', 'telefono' => '351-155660044', 'email' => 'claudia.r@gmail.com', 'canal' => 'Portal Inmobiliario', 'propiedad_id' => 6, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 90.000', 'estado' => 'Visita Agendada', 'agente_id' => 3, 'scoring' => 78, 'fecha' => '2025-06-07', 'ultima_interaccion' => '2025-06-09'],
    ['id' => 5, 'nombre' => 'Andrés Figueroa', 'telefono' => '383-155660055', 'email' => 'andres.f@yahoo.com', 'canal' => 'Teléfono', 'propiedad_id' => 5, 'tipo_interes' => 'Alquiler', 'presupuesto' => 'ARS 200.000', 'estado' => 'En Negociación', 'agente_id' => 2, 'scoring' => 65, 'fecha' => '2025-06-06', 'ultima_interaccion' => '2025-06-09'],
    ['id' => 6, 'nombre' => 'Silvina Ortega', 'telefono' => '11-155660066', 'email' => 'silvina.o@gmail.com', 'canal' => 'Instagram', 'propiedad_id' => 27, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 300.000', 'estado' => 'Nuevo', 'agente_id' => 4, 'scoring' => 82, 'fecha' => '2025-06-10', 'ultima_interaccion' => '2025-06-10'],
    ['id' => 7, 'nombre' => 'Héctor Bravo', 'telefono' => '383-155660077', 'email' => 'hector.b@hotmail.com', 'canal' => 'Portal Web', 'propiedad_id' => 3, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 30.000', 'estado' => 'Contactado', 'agente_id' => 8, 'scoring' => 60, 'fecha' => '2025-06-05', 'ultima_interaccion' => '2025-06-08'],
    ['id' => 8, 'nombre' => 'Renata Suárez', 'telefono' => '351-155660088', 'email' => 'renata.s@gmail.com', 'canal' => 'Email', 'propiedad_id' => 7, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 180.000', 'estado' => 'Interesado', 'agente_id' => 3, 'scoring' => 88, 'fecha' => '2025-06-04', 'ultima_interaccion' => '2025-06-09'],
    ['id' => 9, 'nombre' => 'Emanuel Vargas', 'telefono' => '11-155660099', 'email' => 'ema.vargas@outlook.com', 'canal' => 'WhatsApp', 'propiedad_id' => 16, 'tipo_interes' => 'Alquiler', 'presupuesto' => 'ARS 1.500.000', 'estado' => 'Visita Agendada', 'agente_id' => 5, 'scoring' => 70, 'fecha' => '2025-06-03', 'ultima_interaccion' => '2025-06-08'],
    ['id' => 10, 'nombre' => 'Celina Paredes', 'telefono' => '383-155660110', 'email' => 'celina.p@gmail.com', 'canal' => 'Portal Web', 'propiedad_id' => 30, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 160.000', 'estado' => 'Nuevo', 'agente_id' => 2, 'scoring' => 75, 'fecha' => '2025-06-10', 'ultima_interaccion' => '2025-06-10'],
    ['id' => 11, 'nombre' => 'Oscar Giménez', 'telefono' => '351-155660121', 'email' => 'oscar.g@hotmail.com', 'canal' => 'Referido', 'propiedad_id' => 14, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 65.000', 'estado' => 'Contactado', 'agente_id' => 10, 'scoring' => 68, 'fecha' => '2025-06-09', 'ultima_interaccion' => '2025-06-10'],
    ['id' => 12, 'nombre' => 'Tamara Leiva', 'telefono' => '11-155660132', 'email' => 'tamara.l@gmail.com', 'canal' => 'Instagram', 'propiedad_id' => 35, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 1.000.000', 'estado' => 'Interesado', 'agente_id' => 4, 'scoring' => 95, 'fecha' => '2025-06-02', 'ultima_interaccion' => '2025-06-08'],
    ['id' => 13, 'nombre' => 'Raúl Espinoza', 'telefono' => '383-155660143', 'email' => 'raul.e@yahoo.com', 'canal' => 'Teléfono', 'propiedad_id' => 22, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 150.000', 'estado' => 'Cerrado', 'agente_id' => 8, 'scoring' => 92, 'fecha' => '2025-05-20', 'ultima_interaccion' => '2025-06-05'],
    ['id' => 14, 'nombre' => 'Mónica Salinas', 'telefono' => '351-155660154', 'email' => 'monica.s@outlook.com', 'canal' => 'Portal Inmobiliario', 'propiedad_id' => 33, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 110.000', 'estado' => 'Nuevo', 'agente_id' => 3, 'scoring' => 74, 'fecha' => '2025-06-10', 'ultima_interaccion' => '2025-06-10'],
    ['id' => 15, 'nombre' => 'Darío Montero', 'telefono' => '11-155660165', 'email' => 'dario.m@gmail.com', 'canal' => 'WhatsApp', 'propiedad_id' => 24, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 400.000', 'estado' => 'En Negociación', 'agente_id' => 6, 'scoring' => 88, 'fecha' => '2025-05-28', 'ultima_interaccion' => '2025-06-09'],
    ['id' => 16, 'nombre' => 'Valeria Romero', 'telefono' => '383-155660176', 'email' => 'vale.romero@gmail.com', 'canal' => 'Portal Web', 'propiedad_id' => 47, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 95.000', 'estado' => 'Nuevo', 'agente_id' => 8, 'scoring' => 70, 'fecha' => '2025-06-10', 'ultima_interaccion' => '2025-06-10'],
    ['id' => 17, 'nombre' => 'Julio Carrizo', 'telefono' => '383-155660187', 'email' => 'julio.c@hotmail.com', 'canal' => 'Teléfono', 'propiedad_id' => 17, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 35.000', 'estado' => 'Contactado', 'agente_id' => 1, 'scoring' => 55, 'fecha' => '2025-06-08', 'ultima_interaccion' => '2025-06-09'],
    ['id' => 18, 'nombre' => 'Roxana Acevedo', 'telefono' => '11-155660198', 'email' => 'roxana.a@gmail.com', 'canal' => 'Email', 'propiedad_id' => 18, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 200.000', 'estado' => 'Visita Agendada', 'agente_id' => 4, 'scoring' => 80, 'fecha' => '2025-06-06', 'ultima_interaccion' => '2025-06-10'],
    ['id' => 19, 'nombre' => 'Cristian Páez', 'telefono' => '351-155660209', 'email' => 'cristian.p@yahoo.com', 'canal' => 'Portal Inmobiliario', 'propiedad_id' => 23, 'tipo_interes' => 'Alquiler', 'presupuesto' => 'ARS 350.000', 'estado' => 'Interesado', 'agente_id' => 9, 'scoring' => 62, 'fecha' => '2025-06-05', 'ultima_interaccion' => '2025-06-08'],
    ['id' => 20, 'nombre' => 'Daniela Oviedo', 'telefono' => '383-155660220', 'email' => 'dani.oviedo@outlook.com', 'canal' => 'Referido', 'propiedad_id' => 15, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 70.000', 'estado' => 'Contactado', 'agente_id' => 2, 'scoring' => 67, 'fecha' => '2025-06-07', 'ultima_interaccion' => '2025-06-09'],
    ['id' => 21, 'nombre' => 'Fabián Luna', 'telefono' => '11-155660231', 'email' => 'fabian.l@gmail.com', 'canal' => 'Portal Web', 'propiedad_id' => 60, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 290.000', 'estado' => 'Nuevo', 'agente_id' => 6, 'scoring' => 76, 'fecha' => '2025-06-10', 'ultima_interaccion' => '2025-06-10'],
    ['id' => 22, 'nombre' => 'Gisela Torres', 'telefono' => '383-155660242', 'email' => 'gisela.t@hotmail.com', 'canal' => 'WhatsApp', 'propiedad_id' => 55, 'tipo_interes' => 'Alquiler', 'presupuesto' => 'ARS 280.000', 'estado' => 'Contactado', 'agente_id' => 1, 'scoring' => 58, 'fecha' => '2025-06-09', 'ultima_interaccion' => '2025-06-10'],
    ['id' => 23, 'nombre' => 'Néstor Villalba', 'telefono' => '351-155660253', 'email' => 'nestor.v@gmail.com', 'canal' => 'Instagram', 'propiedad_id' => 37, 'tipo_interes' => 'Alquiler', 'presupuesto' => 'ARS 500.000', 'estado' => 'Interesado', 'agente_id' => 9, 'scoring' => 64, 'fecha' => '2025-06-04', 'ultima_interaccion' => '2025-06-07'],
    ['id' => 24, 'nombre' => 'Belén Castro', 'telefono' => '11-155660264', 'email' => 'belen.c@outlook.com', 'canal' => 'Teléfono', 'propiedad_id' => 46, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 85.000', 'estado' => 'Nuevo', 'agente_id' => 4, 'scoring' => 71, 'fecha' => '2025-06-10', 'ultima_interaccion' => '2025-06-10'],
    ['id' => 25, 'nombre' => 'Maximiliano Sosa', 'telefono' => '383-155660275', 'email' => 'maxi.sosa@yahoo.com', 'canal' => 'Portal Web', 'propiedad_id' => 20, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 75.000', 'estado' => 'Visita Agendada', 'agente_id' => 2, 'scoring' => 73, 'fecha' => '2025-06-03', 'ultima_interaccion' => '2025-06-08'],
    ['id' => 26, 'nombre' => 'Ailín Peralta', 'telefono' => '11-155660286', 'email' => 'ailin.p@gmail.com', 'canal' => 'Email', 'propiedad_id' => 51, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 65.000', 'estado' => 'Nuevo', 'agente_id' => 5, 'scoring' => 66, 'fecha' => '2025-06-10', 'ultima_interaccion' => '2025-06-10'],
    ['id' => 27, 'nombre' => 'Esteban Flores', 'telefono' => '383-155660297', 'email' => 'esteban.f@hotmail.com', 'canal' => 'Referido', 'propiedad_id' => 34, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 90.000', 'estado' => 'Contactado', 'agente_id' => 2, 'scoring' => 69, 'fecha' => '2025-06-08', 'ultima_interaccion' => '2025-06-09'],
    ['id' => 28, 'nombre' => 'Romina Lucero', 'telefono' => '351-155660308', 'email' => 'romina.l@gmail.com', 'canal' => 'Portal Inmobiliario', 'propiedad_id' => 49, 'tipo_interes' => 'Alquiler', 'presupuesto' => 'ARS 400.000', 'estado' => 'Interesado', 'agente_id' => 9, 'scoring' => 63, 'fecha' => '2025-06-06', 'ultima_interaccion' => '2025-06-09'],
    ['id' => 29, 'nombre' => 'Walter Guzmán', 'telefono' => '11-155660319', 'email' => 'walter.g@outlook.com', 'canal' => 'WhatsApp', 'propiedad_id' => 38, 'tipo_interes' => 'Alquiler', 'presupuesto' => 'ARS 2.200.000', 'estado' => 'En Negociación', 'agente_id' => 6, 'scoring' => 77, 'fecha' => '2025-05-30', 'ultima_interaccion' => '2025-06-08'],
    ['id' => 30, 'nombre' => 'Lucía Heredia', 'telefono' => '383-155660330', 'email' => 'lucia.h@yahoo.com', 'canal' => 'Portal Web', 'propiedad_id' => 63, 'tipo_interes' => 'Alquiler', 'presupuesto' => 'ARS 450.000', 'estado' => 'Nuevo', 'agente_id' => 1, 'scoring' => 72, 'fecha' => '2025-06-10', 'ultima_interaccion' => '2025-06-10'],
    ['id' => 31, 'nombre' => 'Adrián Corvalán', 'telefono' => '351-155660341', 'email' => 'adrian.corv@gmail.com', 'canal' => 'Instagram', 'propiedad_id' => 41, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 70.000', 'estado' => 'Nuevo', 'agente_id' => 10, 'scoring' => 61, 'fecha' => '2025-06-10', 'ultima_interaccion' => '2025-06-10'],
    ['id' => 32, 'nombre' => 'Noelia Aranda', 'telefono' => '383-155660352', 'email' => 'noelia.a@hotmail.com', 'canal' => 'Teléfono', 'propiedad_id' => 42, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 50.000', 'estado' => 'Contactado', 'agente_id' => 2, 'scoring' => 56, 'fecha' => '2025-06-07', 'ultima_interaccion' => '2025-06-09'],
    ['id' => 33, 'nombre' => 'Pablo Galván', 'telefono' => '11-155660363', 'email' => 'pablo.g@gmail.com', 'canal' => 'Email', 'propiedad_id' => 27, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 310.000', 'estado' => 'Visita Agendada', 'agente_id' => 4, 'scoring' => 83, 'fecha' => '2025-06-02', 'ultima_interaccion' => '2025-06-08'],
    ['id' => 34, 'nombre' => 'Yanina Villafañe', 'telefono' => '383-155660374', 'email' => 'yanina.v@outlook.com', 'canal' => 'Referido', 'propiedad_id' => 44, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 45.000', 'estado' => 'Contactado', 'agente_id' => 1, 'scoring' => 54, 'fecha' => '2025-06-06', 'ultima_interaccion' => '2025-06-08'],
    ['id' => 35, 'nombre' => 'Joaquín Paz', 'telefono' => '351-155660385', 'email' => 'joaquin.p@gmail.com', 'canal' => 'Portal Web', 'propiedad_id' => 45, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 320.000', 'estado' => 'Interesado', 'agente_id' => 3, 'scoring' => 79, 'fecha' => '2025-06-01', 'ultima_interaccion' => '2025-06-07'],
    ['id' => 36, 'nombre' => 'Milagros Rivero', 'telefono' => '383-155660396', 'email' => 'mili.rivero@yahoo.com', 'canal' => 'WhatsApp', 'propiedad_id' => 36, 'tipo_interes' => 'Alquiler', 'presupuesto' => 'ARS 300.000', 'estado' => 'Nuevo', 'agente_id' => 1, 'scoring' => 59, 'fecha' => '2025-06-10', 'ultima_interaccion' => '2025-06-10'],
    ['id' => 37, 'nombre' => 'Leandro Quiroz', 'telefono' => '11-155660407', 'email' => 'leandro.q@hotmail.com', 'canal' => 'Portal Inmobiliario', 'propiedad_id' => 54, 'tipo_interes' => 'Alquiler', 'presupuesto' => 'ARS 800.000', 'estado' => 'Contactado', 'agente_id' => 6, 'scoring' => 65, 'fecha' => '2025-06-09', 'ultima_interaccion' => '2025-06-10'],
    ['id' => 38, 'nombre' => 'Agustín Robles', 'telefono' => '383-155660418', 'email' => 'agustin.r@gmail.com', 'canal' => 'Teléfono', 'propiedad_id' => 58, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 50.000', 'estado' => 'Nuevo', 'agente_id' => 2, 'scoring' => 63, 'fecha' => '2025-06-10', 'ultima_interaccion' => '2025-06-10'],
    ['id' => 39, 'nombre' => 'Marina Zárate', 'telefono' => '351-155660429', 'email' => 'marina.z@outlook.com', 'canal' => 'Email', 'propiedad_id' => 7, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 175.000', 'estado' => 'Perdido', 'agente_id' => 3, 'scoring' => 40, 'fecha' => '2025-05-15', 'ultima_interaccion' => '2025-05-25'],
    ['id' => 40, 'nombre' => 'Hugo Medina', 'telefono' => '11-155660440', 'email' => 'hugo.medina@gmail.com', 'canal' => 'Portal Web', 'propiedad_id' => 9, 'tipo_interes' => 'Alquiler', 'presupuesto' => 'ARS 1.100.000', 'estado' => 'Cerrado', 'agente_id' => 6, 'scoring' => 91, 'fecha' => '2025-05-10', 'ultima_interaccion' => '2025-06-01'],
    ['id' => 41, 'nombre' => 'Sofía Roldán', 'telefono' => '383-155660451', 'email' => 'sofia.roldan@gmail.com', 'canal' => 'Instagram', 'propiedad_id' => 1, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 82.000', 'estado' => 'Nuevo', 'agente_id' => 1, 'scoring' => 77, 'fecha' => '2025-06-10', 'ultima_interaccion' => '2025-06-10'],
    ['id' => 42, 'nombre' => 'Martín Ibarra', 'telefono' => '351-155660462', 'email' => 'martin.ibarra@hotmail.com', 'canal' => 'Referido', 'propiedad_id' => 62, 'tipo_interes' => 'Compra', 'presupuesto' => 'USD 45.000', 'estado' => 'Contactado', 'agente_id' => 9, 'scoring' => 57, 'fecha' => '2025-06-09', 'ultima_interaccion' => '2025-06-10'],
];

// ============================================
// CONTRATOS (20+)
// ============================================
$contratos = [
    ['id' => 1, 'tipo' => 'Alquiler', 'propiedad_id' => 2, 'propiedad' => 'Depto 2 amb. en centro', 'inquilino' => 'Carolina Figueroa', 'propietario' => 'Marta Bustos', 'inicio' => '2025-01-01', 'fin' => '2027-01-01', 'valor_mensual' => 280000, 'moneda' => 'ARS', 'estado' => 'Vigente', 'agente_id' => 1],
    ['id' => 2, 'tipo' => 'Alquiler', 'propiedad_id' => 8, 'propiedad' => 'Depto 2 amb. Palermo Soho', 'inquilino' => 'Sebastián Luna', 'propietario' => 'Patricia Méndez', 'inicio' => '2024-11-01', 'fin' => '2026-11-01', 'valor_mensual' => 650000, 'moneda' => 'ARS', 'estado' => 'Vigente', 'agente_id' => 4],
    ['id' => 3, 'tipo' => 'Venta', 'propiedad_id' => 12, 'propiedad' => 'Dúplex en barrio privado', 'inquilino' => 'Raúl Espinoza', 'propietario' => 'Daniel Figueroa', 'inicio' => '2025-05-15', 'fin' => null, 'valor_mensual' => null, 'moneda' => 'USD', 'estado' => 'Firmado', 'agente_id' => 8],
    ['id' => 4, 'tipo' => 'Alquiler', 'propiedad_id' => 29, 'propiedad' => 'Oficina centro Córdoba', 'inquilino' => 'Ignacio Tapia', 'propietario' => 'Fideicomiso Torres del Sol', 'inicio' => '2024-12-01', 'fin' => '2026-12-01', 'valor_mensual' => 550000, 'moneda' => 'ARS', 'estado' => 'Vigente', 'agente_id' => 10],
    ['id' => 5, 'tipo' => 'Alquiler', 'propiedad_id' => 43, 'propiedad' => 'Depto temp. Puerto Madero', 'inquilino' => 'Agustina Varela', 'propietario' => 'Grupo Inmobiliario Austral', 'inicio' => '2025-02-01', 'fin' => '2025-08-01', 'valor_mensual' => 1500000, 'moneda' => 'ARS', 'estado' => 'Vigente', 'agente_id' => 5],
    ['id' => 6, 'tipo' => 'Venta', 'propiedad_id' => 28, 'propiedad' => 'Lote en Polcos', 'inquilino' => 'Ezequiel Ponce', 'propietario' => 'Desarrollos Andinos S.A.', 'inicio' => '2025-04-20', 'fin' => null, 'valor_mensual' => null, 'moneda' => 'USD', 'estado' => 'Firmado', 'agente_id' => 1],
    ['id' => 7, 'tipo' => 'Venta', 'propiedad_id' => 40, 'propiedad' => 'Depto 2 amb. balcón Belgrano', 'inquilino' => 'Soledad Ríos', 'propietario' => 'Elena Correa', 'inicio' => '2025-03-10', 'fin' => null, 'valor_mensual' => null, 'moneda' => 'USD', 'estado' => 'Firmado', 'agente_id' => 6],
    ['id' => 8, 'tipo' => 'Alquiler', 'propiedad_id' => 53, 'propiedad' => 'Depto 2 amb. amoblado temp.', 'inquilino' => 'Ailén Morales', 'propietario' => 'Alejandro Bustos', 'inicio' => '2025-03-01', 'fin' => '2027-03-01', 'valor_mensual' => 450000, 'moneda' => 'ARS', 'estado' => 'Vigente', 'agente_id' => 10],
    ['id' => 9, 'tipo' => 'Alquiler', 'propiedad_id' => 2, 'propiedad' => 'Depto 2 amb. en centro (anterior)', 'inquilino' => 'Andrea Lescano', 'propietario' => 'Marta Bustos', 'inicio' => '2023-01-01', 'fin' => '2024-12-31', 'valor_mensual' => 180000, 'moneda' => 'ARS', 'estado' => 'Finalizado', 'agente_id' => 1],
    ['id' => 10, 'tipo' => 'Reserva', 'propiedad_id' => 4, 'propiedad' => 'Casa 4 amb. con quincho', 'inquilino' => 'Romina Castro', 'propietario' => 'Ricardo Gutiérrez', 'inicio' => '2025-06-01', 'fin' => '2025-06-30', 'valor_mensual' => null, 'moneda' => 'USD', 'estado' => 'Vigente', 'agente_id' => 2],
    ['id' => 11, 'tipo' => 'Reserva', 'propiedad_id' => 18, 'propiedad' => 'Depto 4 amb. Núñez premium', 'inquilino' => 'María Eugenia Valle', 'propietario' => 'Elena Correa', 'inicio' => '2025-06-05', 'fin' => '2025-07-05', 'valor_mensual' => null, 'moneda' => 'USD', 'estado' => 'Vigente', 'agente_id' => 4],
    ['id' => 12, 'tipo' => 'Alquiler', 'propiedad_id' => 9, 'propiedad' => 'Oficina premium Belgrano', 'inquilino' => 'Hugo Medina', 'propietario' => 'Grupo Inmobiliario Austral', 'inicio' => '2025-06-01', 'fin' => '2027-06-01', 'valor_mensual' => 1200000, 'moneda' => 'ARS', 'estado' => 'Vigente', 'agente_id' => 6],
    ['id' => 13, 'tipo' => 'Alquiler', 'propiedad_id' => 5, 'propiedad' => 'Depto 1 amb. amoblado (anterior)', 'inquilino' => 'Paula Benítez', 'propietario' => 'Hugo Villalba', 'inicio' => '2023-06-01', 'fin' => '2024-05-31', 'valor_mensual' => 120000, 'moneda' => 'ARS', 'estado' => 'Finalizado', 'agente_id' => 2],
    ['id' => 14, 'tipo' => 'Venta', 'propiedad_id' => 12, 'propiedad' => 'Dúplex (escritura)', 'inquilino' => 'Raúl Espinoza', 'propietario' => 'Daniel Figueroa', 'inicio' => '2025-06-01', 'fin' => null, 'valor_mensual' => null, 'moneda' => 'USD', 'estado' => 'En Escrituración', 'agente_id' => 8],
    ['id' => 15, 'tipo' => 'Alquiler', 'propiedad_id' => 11, 'propiedad' => 'Local comercial s/ Av. Güemes', 'inquilino' => 'Roberto Cáceres', 'propietario' => 'Inversiones NOA S.A.', 'inicio' => '2025-04-01', 'fin' => '2028-04-01', 'valor_mensual' => 450000, 'moneda' => 'ARS', 'estado' => 'Vigente', 'agente_id' => 1],
    ['id' => 16, 'tipo' => 'Alquiler', 'propiedad_id' => 23, 'propiedad' => 'Depto 2 amb. Güemes', 'inquilino' => 'Daniela Soria', 'propietario' => 'Osvaldo Ramos', 'inicio' => '2025-06-15', 'fin' => '2027-06-15', 'valor_mensual' => 380000, 'moneda' => 'ARS', 'estado' => 'Pendiente Firma', 'agente_id' => 9],
    ['id' => 17, 'tipo' => 'Venta', 'propiedad_id' => 40, 'propiedad' => 'Depto 2 amb. Belgrano (boleto)', 'inquilino' => 'Soledad Ríos', 'propietario' => 'Elena Correa', 'inicio' => '2025-02-15', 'fin' => null, 'valor_mensual' => null, 'moneda' => 'USD', 'estado' => 'En Escrituración', 'agente_id' => 6],
    ['id' => 18, 'tipo' => 'Alquiler', 'propiedad_id' => 37, 'propiedad' => 'Casa 4 amb. barrio Jardín', 'inquilino' => 'Verónica Paz', 'propietario' => 'Construcciones Sur S.R.L.', 'inicio' => '2025-05-01', 'fin' => '2027-05-01', 'valor_mensual' => 550000, 'moneda' => 'ARS', 'estado' => 'Vigente', 'agente_id' => 9],
    ['id' => 19, 'tipo' => 'Alquiler', 'propiedad_id' => 56, 'propiedad' => 'Depto 2 amb. centro Tucumán', 'inquilino' => 'Julieta Aráoz', 'propietario' => 'Silvia Acuña', 'inicio' => '2025-06-10', 'fin' => '2027-06-10', 'valor_mensual' => 250000, 'moneda' => 'ARS', 'estado' => 'Pendiente Firma', 'agente_id' => 7],
    ['id' => 20, 'tipo' => 'Venta', 'propiedad_id' => 28, 'propiedad' => 'Lote Polcos (boleto)', 'inquilino' => 'Ezequiel Ponce', 'propietario' => 'Desarrollos Andinos S.A.', 'inicio' => '2025-03-20', 'fin' => null, 'valor_mensual' => null, 'moneda' => 'USD', 'estado' => 'Escriturado', 'agente_id' => 1],
    ['id' => 21, 'tipo' => 'Alquiler', 'propiedad_id' => 31, 'propiedad' => 'Depto 1 amb. Palermo Hollywood', 'inquilino' => 'Cecilia Ramos', 'propietario' => 'Marcela Ibáñez', 'inicio' => '2025-06-01', 'fin' => '2027-06-01', 'valor_mensual' => 480000, 'moneda' => 'ARS', 'estado' => 'Pendiente Firma', 'agente_id' => 5],
];

// ============================================
// PAGOS Y COBROS (25+)
// ============================================
$pagos = [
    ['id' => 1, 'contrato_id' => 1, 'concepto' => 'Alquiler Junio 2025', 'monto' => 280000, 'moneda' => 'ARS', 'fecha_venc' => '2025-06-10', 'fecha_pago' => '2025-06-08', 'estado' => 'Pagado', 'metodo' => 'Transferencia', 'inquilino' => 'Carolina Figueroa'],
    ['id' => 2, 'contrato_id' => 1, 'concepto' => 'Alquiler Julio 2025', 'monto' => 280000, 'moneda' => 'ARS', 'fecha_venc' => '2025-07-10', 'fecha_pago' => null, 'estado' => 'Pendiente', 'metodo' => null, 'inquilino' => 'Carolina Figueroa'],
    ['id' => 3, 'contrato_id' => 2, 'concepto' => 'Alquiler Junio 2025', 'monto' => 650000, 'moneda' => 'ARS', 'fecha_venc' => '2025-06-01', 'fecha_pago' => '2025-06-01', 'estado' => 'Pagado', 'metodo' => 'Débito Automático', 'inquilino' => 'Sebastián Luna'],
    ['id' => 4, 'contrato_id' => 2, 'concepto' => 'Alquiler Julio 2025', 'monto' => 650000, 'moneda' => 'ARS', 'fecha_venc' => '2025-07-01', 'fecha_pago' => null, 'estado' => 'Pendiente', 'metodo' => null, 'inquilino' => 'Sebastián Luna'],
    ['id' => 5, 'contrato_id' => 3, 'concepto' => 'Seña Dúplex Valle Viejo', 'monto' => 14500, 'moneda' => 'USD', 'fecha_venc' => '2025-05-15', 'fecha_pago' => '2025-05-15', 'estado' => 'Pagado', 'metodo' => 'Cheque', 'inquilino' => 'Raúl Espinoza'],
    ['id' => 6, 'contrato_id' => 3, 'concepto' => 'Saldo Dúplex Valle Viejo', 'monto' => 130500, 'moneda' => 'USD', 'fecha_venc' => '2025-06-15', 'fecha_pago' => null, 'estado' => 'Pendiente', 'metodo' => null, 'inquilino' => 'Raúl Espinoza'],
    ['id' => 7, 'contrato_id' => 4, 'concepto' => 'Alquiler Junio 2025', 'monto' => 550000, 'moneda' => 'ARS', 'fecha_venc' => '2025-06-01', 'fecha_pago' => '2025-06-03', 'estado' => 'Pagado', 'metodo' => 'Transferencia', 'inquilino' => 'Ignacio Tapia'],
    ['id' => 8, 'contrato_id' => 5, 'concepto' => 'Alquiler Junio 2025', 'monto' => 1500000, 'moneda' => 'ARS', 'fecha_venc' => '2025-06-01', 'fecha_pago' => '2025-06-02', 'estado' => 'Pagado', 'metodo' => 'Transferencia', 'inquilino' => 'Agustina Varela'],
    ['id' => 9, 'contrato_id' => 5, 'concepto' => 'Alquiler Julio 2025', 'monto' => 1500000, 'moneda' => 'ARS', 'fecha_venc' => '2025-07-01', 'fecha_pago' => null, 'estado' => 'Pendiente', 'metodo' => null, 'inquilino' => 'Agustina Varela'],
    ['id' => 10, 'contrato_id' => 6, 'concepto' => 'Pago total Lote Polcos', 'monto' => 18000, 'moneda' => 'USD', 'fecha_venc' => '2025-04-20', 'fecha_pago' => '2025-04-20', 'estado' => 'Pagado', 'metodo' => 'Transferencia USD', 'inquilino' => 'Ezequiel Ponce'],
    ['id' => 11, 'contrato_id' => 7, 'concepto' => 'Seña Depto Belgrano', 'monto' => 9800, 'moneda' => 'USD', 'fecha_venc' => '2025-02-15', 'fecha_pago' => '2025-02-15', 'estado' => 'Pagado', 'metodo' => 'Cheque', 'inquilino' => 'Soledad Ríos'],
    ['id' => 12, 'contrato_id' => 7, 'concepto' => 'Cuota 1 Depto Belgrano', 'monto' => 44100, 'moneda' => 'USD', 'fecha_venc' => '2025-03-15', 'fecha_pago' => '2025-03-14', 'estado' => 'Pagado', 'metodo' => 'Transferencia USD', 'inquilino' => 'Soledad Ríos'],
    ['id' => 13, 'contrato_id' => 7, 'concepto' => 'Cuota 2 Depto Belgrano', 'monto' => 44100, 'moneda' => 'USD', 'fecha_venc' => '2025-04-15', 'fecha_pago' => '2025-04-16', 'estado' => 'Pagado', 'metodo' => 'Transferencia USD', 'inquilino' => 'Soledad Ríos'],
    ['id' => 14, 'contrato_id' => 8, 'concepto' => 'Alquiler Junio 2025', 'monto' => 450000, 'moneda' => 'ARS', 'fecha_venc' => '2025-06-01', 'fecha_pago' => null, 'estado' => 'Vencido', 'metodo' => null, 'inquilino' => 'Ailén Morales'],
    ['id' => 15, 'contrato_id' => 12, 'concepto' => 'Alquiler Junio 2025', 'monto' => 1200000, 'moneda' => 'ARS', 'fecha_venc' => '2025-06-01', 'fecha_pago' => '2025-06-01', 'estado' => 'Pagado', 'metodo' => 'Débito Automático', 'inquilino' => 'Hugo Medina'],
    ['id' => 16, 'contrato_id' => 15, 'concepto' => 'Alquiler Mayo 2025', 'monto' => 450000, 'moneda' => 'ARS', 'fecha_venc' => '2025-05-01', 'fecha_pago' => '2025-05-05', 'estado' => 'Pagado', 'metodo' => 'Efectivo', 'inquilino' => 'Roberto Cáceres'],
    ['id' => 17, 'contrato_id' => 15, 'concepto' => 'Alquiler Junio 2025', 'monto' => 450000, 'moneda' => 'ARS', 'fecha_venc' => '2025-06-01', 'fecha_pago' => '2025-06-04', 'estado' => 'Pagado', 'metodo' => 'Transferencia', 'inquilino' => 'Roberto Cáceres'],
    ['id' => 18, 'contrato_id' => 18, 'concepto' => 'Alquiler Mayo 2025', 'monto' => 550000, 'moneda' => 'ARS', 'fecha_venc' => '2025-05-01', 'fecha_pago' => '2025-05-01', 'estado' => 'Pagado', 'metodo' => 'Transferencia', 'inquilino' => 'Verónica Paz'],
    ['id' => 19, 'contrato_id' => 18, 'concepto' => 'Alquiler Junio 2025', 'monto' => 550000, 'moneda' => 'ARS', 'fecha_venc' => '2025-06-01', 'fecha_pago' => '2025-06-02', 'estado' => 'Pagado', 'metodo' => 'Transferencia', 'inquilino' => 'Verónica Paz'],
    ['id' => 20, 'contrato_id' => 10, 'concepto' => 'Seña Casa 4 amb. quincho', 'monto' => 12000, 'moneda' => 'USD', 'fecha_venc' => '2025-06-01', 'fecha_pago' => '2025-06-01', 'estado' => 'Pagado', 'metodo' => 'Cheque', 'inquilino' => 'Romina Castro'],
    ['id' => 21, 'contrato_id' => 11, 'concepto' => 'Seña Depto Núñez', 'monto' => 21000, 'moneda' => 'USD', 'fecha_venc' => '2025-06-05', 'fecha_pago' => '2025-06-05', 'estado' => 'Pagado', 'metodo' => 'Transferencia USD', 'inquilino' => 'María Eugenia Valle'],
    ['id' => 22, 'contrato_id' => 1, 'concepto' => 'Alquiler Mayo 2025', 'monto' => 280000, 'moneda' => 'ARS', 'fecha_venc' => '2025-05-10', 'fecha_pago' => '2025-05-12', 'estado' => 'Pagado', 'metodo' => 'Transferencia', 'inquilino' => 'Carolina Figueroa'],
    ['id' => 23, 'contrato_id' => 2, 'concepto' => 'Alquiler Mayo 2025', 'monto' => 650000, 'moneda' => 'ARS', 'fecha_venc' => '2025-05-01', 'fecha_pago' => '2025-05-01', 'estado' => 'Pagado', 'metodo' => 'Débito Automático', 'inquilino' => 'Sebastián Luna'],
    ['id' => 24, 'contrato_id' => 4, 'concepto' => 'Alquiler Mayo 2025', 'monto' => 550000, 'moneda' => 'ARS', 'fecha_venc' => '2025-05-01', 'fecha_pago' => '2025-05-02', 'estado' => 'Pagado', 'metodo' => 'Transferencia', 'inquilino' => 'Ignacio Tapia'],
    ['id' => 25, 'contrato_id' => 5, 'concepto' => 'Alquiler Mayo 2025', 'monto' => 1500000, 'moneda' => 'ARS', 'fecha_venc' => '2025-05-01', 'fecha_pago' => '2025-05-01', 'estado' => 'Pagado', 'metodo' => 'Transferencia', 'inquilino' => 'Agustina Varela'],
];

// ============================================
// COMISIONES (20+)
// ============================================
$comisiones = [
    ['id' => 1, 'agente' => 'Luciano Martínez', 'tipo' => 'Alquiler', 'propiedad' => 'Depto 2 amb. centro', 'porcentaje' => 5, 'importe' => 14000, 'moneda' => 'ARS', 'estado' => 'Liquidada', 'fecha' => '2025-01-15'],
    ['id' => 2, 'agente' => 'Luciano Martínez', 'tipo' => 'Alquiler', 'propiedad' => 'Local s/ Güemes', 'porcentaje' => 5, 'importe' => 22500, 'moneda' => 'ARS', 'estado' => 'Liquidada', 'fecha' => '2025-04-15'],
    ['id' => 3, 'agente' => 'Sofía Peralta', 'tipo' => 'Venta', 'propiedad' => 'Casa 4 amb. quincho (reserva)', 'porcentaje' => 3, 'importe' => 3600, 'moneda' => 'USD', 'estado' => 'Pendiente', 'fecha' => '2025-06-01'],
    ['id' => 4, 'agente' => 'Emiliano Quiroga', 'tipo' => 'Venta', 'propiedad' => 'Dúplex barrio privado', 'porcentaje' => 3, 'importe' => 4350, 'moneda' => 'USD', 'estado' => 'Liquidada', 'fecha' => '2025-05-20'],
    ['id' => 5, 'agente' => 'Camila Vega', 'tipo' => 'Alquiler', 'propiedad' => 'Depto Palermo Soho', 'porcentaje' => 5, 'importe' => 32500, 'moneda' => 'ARS', 'estado' => 'Liquidada', 'fecha' => '2024-11-15'],
    ['id' => 6, 'agente' => 'Camila Vega', 'tipo' => 'Venta', 'propiedad' => 'Depto Núñez premium (reserva)', 'porcentaje' => 3, 'importe' => 6300, 'moneda' => 'USD', 'estado' => 'Pendiente', 'fecha' => '2025-06-05'],
    ['id' => 7, 'agente' => 'Pablo Mendoza', 'tipo' => 'Venta', 'propiedad' => 'Depto Belgrano', 'porcentaje' => 3, 'importe' => 2940, 'moneda' => 'USD', 'estado' => 'Liquidada', 'fecha' => '2025-03-15'],
    ['id' => 8, 'agente' => 'Pablo Mendoza', 'tipo' => 'Alquiler', 'propiedad' => 'Oficina Belgrano', 'porcentaje' => 5, 'importe' => 60000, 'moneda' => 'ARS', 'estado' => 'Liquidada', 'fecha' => '2025-06-05'],
    ['id' => 9, 'agente' => 'Luciano Martínez', 'tipo' => 'Venta', 'propiedad' => 'Lote Polcos', 'porcentaje' => 3, 'importe' => 540, 'moneda' => 'USD', 'estado' => 'Liquidada', 'fecha' => '2025-04-25'],
    ['id' => 10, 'agente' => 'Facundo Ríos', 'tipo' => 'Alquiler', 'propiedad' => 'Depto Puerto Madero', 'porcentaje' => 5, 'importe' => 75000, 'moneda' => 'ARS', 'estado' => 'Liquidada', 'fecha' => '2025-02-10'],
    ['id' => 11, 'agente' => 'Martín Acosta', 'tipo' => 'Alquiler', 'propiedad' => 'Oficina centro Córdoba', 'porcentaje' => 5, 'importe' => 27500, 'moneda' => 'ARS', 'estado' => 'Liquidada', 'fecha' => '2024-12-15'],
    ['id' => 12, 'agente' => 'Laura Gómez', 'tipo' => 'Alquiler', 'propiedad' => 'Casa barrio Jardín', 'porcentaje' => 5, 'importe' => 27500, 'moneda' => 'ARS', 'estado' => 'Liquidada', 'fecha' => '2025-05-10'],
    ['id' => 13, 'agente' => 'Rocío Navarro', 'tipo' => 'Alquiler', 'propiedad' => 'Depto amoblado temp. Córdoba', 'porcentaje' => 5, 'importe' => 22500, 'moneda' => 'ARS', 'estado' => 'Liquidada', 'fecha' => '2025-03-10'],
    ['id' => 14, 'agente' => 'Natalia Romero', 'tipo' => 'Alquiler', 'propiedad' => 'Depto centro Tucumán', 'porcentaje' => 5, 'importe' => 12500, 'moneda' => 'ARS', 'estado' => 'Pendiente', 'fecha' => '2025-06-10'],
    ['id' => 15, 'agente' => 'Camila Vega', 'tipo' => 'Venta', 'propiedad' => 'Penthouse Recoleta (negociación)', 'porcentaje' => 3, 'importe' => 11400, 'moneda' => 'USD', 'estado' => 'Pendiente', 'fecha' => '2025-06-08'],
    ['id' => 16, 'agente' => 'Sofía Peralta', 'tipo' => 'Venta', 'propiedad' => 'Casa 5 amb. jardín', 'porcentaje' => 3, 'importe' => 4950, 'moneda' => 'USD', 'estado' => 'Pendiente', 'fecha' => '2025-06-03'],
    ['id' => 17, 'agente' => 'Facundo Ríos', 'tipo' => 'Alquiler', 'propiedad' => 'Depto Palermo Hollywood', 'porcentaje' => 5, 'importe' => 24000, 'moneda' => 'ARS', 'estado' => 'Pendiente', 'fecha' => '2025-06-08'],
    ['id' => 18, 'agente' => 'Luciano Martínez', 'tipo' => 'Alquiler', 'propiedad' => 'Depto 3 amb. cochera Catamarca', 'porcentaje' => 5, 'importe' => 15000, 'moneda' => 'ARS', 'estado' => 'Pendiente', 'fecha' => '2025-06-10'],
    ['id' => 19, 'agente' => 'Pablo Mendoza', 'tipo' => 'Venta', 'propiedad' => 'Casa Núñez jardín', 'porcentaje' => 3, 'importe' => 8850, 'moneda' => 'USD', 'estado' => 'Pendiente', 'fecha' => '2025-06-07'],
    ['id' => 20, 'agente' => 'Martín Acosta', 'tipo' => 'Venta', 'propiedad' => 'Depto 3 amb. Cerro Rosas', 'porcentaje' => 3, 'importe' => 3450, 'moneda' => 'USD', 'estado' => 'Pendiente', 'fecha' => '2025-06-06'],
    ['id' => 21, 'agente' => 'Emiliano Quiroga', 'tipo' => 'Venta', 'propiedad' => 'Casa quinta pileta', 'porcentaje' => 3, 'importe' => 4650, 'moneda' => 'USD', 'estado' => 'Pendiente', 'fecha' => '2025-06-09'],
];

// ============================================
// MANTENIMIENTOS / REPARACIONES (20+)
// ============================================
$mantenimientos = [
    ['id' => 1, 'propiedad_id' => 2, 'propiedad' => 'Depto 2 amb. centro', 'tipo' => 'Plomería', 'prioridad' => 'Alta', 'estado' => 'En Curso', 'responsable' => 'Juan Gómez (plomero)', 'fecha' => '2025-06-08', 'costo_est' => 45000, 'costo_final' => null, 'descripcion' => 'Pérdida en cañería de cocina'],
    ['id' => 2, 'propiedad_id' => 8, 'propiedad' => 'Depto Palermo Soho', 'tipo' => 'Electricidad', 'prioridad' => 'Media', 'estado' => 'Pendiente', 'responsable' => null, 'fecha' => '2025-06-09', 'costo_est' => 30000, 'costo_final' => null, 'descripcion' => 'Cortocircuito en llave térmica del baño'],
    ['id' => 3, 'propiedad_id' => 29, 'propiedad' => 'Oficina centro Córdoba', 'tipo' => 'Pintura', 'prioridad' => 'Baja', 'estado' => 'Aprobado', 'responsable' => 'Pinturas Córdoba SRL', 'fecha' => '2025-06-05', 'costo_est' => 80000, 'costo_final' => null, 'descripcion' => 'Repintar oficina completa por desgaste'],
    ['id' => 4, 'propiedad_id' => 11, 'propiedad' => 'Local s/ Güemes', 'tipo' => 'Vidriería', 'prioridad' => 'Alta', 'estado' => 'Finalizado', 'responsable' => 'Cristales del Norte', 'fecha' => '2025-05-20', 'costo_est' => 35000, 'costo_final' => 38000, 'descripcion' => 'Reemplazo de vidrio roto en vidriera'],
    ['id' => 5, 'propiedad_id' => 43, 'propiedad' => 'Depto Puerto Madero', 'tipo' => 'Aire Acondicionado', 'prioridad' => 'Media', 'estado' => 'En Revisión', 'responsable' => null, 'fecha' => '2025-06-10', 'costo_est' => 60000, 'costo_final' => null, 'descripcion' => 'Split no enfría, posible recarga de gas'],
    ['id' => 6, 'propiedad_id' => 1, 'propiedad' => 'Casa 3 amb. con pileta', 'tipo' => 'Pileta', 'prioridad' => 'Media', 'estado' => 'Pendiente', 'responsable' => null, 'fecha' => '2025-06-10', 'costo_est' => 25000, 'costo_final' => null, 'descripcion' => 'Limpieza y mantenimiento de pileta'],
    ['id' => 7, 'propiedad_id' => 37, 'propiedad' => 'Casa barrio Jardín', 'tipo' => 'Cerrajería', 'prioridad' => 'Alta', 'estado' => 'Finalizado', 'responsable' => 'Cerrajería Express CBA', 'fecha' => '2025-05-28', 'costo_est' => 15000, 'costo_final' => 15000, 'descripcion' => 'Cambio de cerradura puerta principal'],
    ['id' => 8, 'propiedad_id' => 53, 'propiedad' => 'Depto amoblado Córdoba', 'tipo' => 'Electrodomésticos', 'prioridad' => 'Baja', 'estado' => 'Aprobado', 'responsable' => 'Service Whirlpool', 'fecha' => '2025-06-07', 'costo_est' => 40000, 'costo_final' => null, 'descripcion' => 'Lavarropas no centrifuga'],
    ['id' => 9, 'propiedad_id' => 4, 'propiedad' => 'Casa 4 amb. quincho', 'tipo' => 'Techos', 'prioridad' => 'Alta', 'estado' => 'En Curso', 'responsable' => 'Techados del Valle', 'fecha' => '2025-06-03', 'costo_est' => 120000, 'costo_final' => null, 'descripcion' => 'Filtraciones en techo de quincho'],
    ['id' => 10, 'propiedad_id' => 9, 'propiedad' => 'Oficina Belgrano', 'tipo' => 'Limpieza', 'prioridad' => 'Baja', 'estado' => 'Finalizado', 'responsable' => 'Limpieza Pro BA', 'fecha' => '2025-05-30', 'costo_est' => 50000, 'costo_final' => 48000, 'descripcion' => 'Limpieza profunda pre-entrega'],
    ['id' => 11, 'propiedad_id' => 22, 'propiedad' => 'Casa quinta pileta', 'tipo' => 'Jardinería', 'prioridad' => 'Media', 'estado' => 'En Curso', 'responsable' => 'Verde Jardín', 'fecha' => '2025-06-06', 'costo_est' => 20000, 'costo_final' => null, 'descripcion' => 'Poda de árboles y limpieza de jardín'],
    ['id' => 12, 'propiedad_id' => 15, 'propiedad' => 'PH 3 amb. reciclado', 'tipo' => 'Humedad', 'prioridad' => 'Alta', 'estado' => 'Pendiente', 'responsable' => null, 'fecha' => '2025-06-10', 'costo_est' => 70000, 'costo_final' => null, 'descripcion' => 'Humedad en pared medianera'],
    ['id' => 13, 'propiedad_id' => 30, 'propiedad' => 'Casa 5 amb. jardín', 'tipo' => 'Gas', 'prioridad' => 'Alta', 'estado' => 'En Revisión', 'responsable' => null, 'fecha' => '2025-06-09', 'costo_est' => 35000, 'costo_final' => null, 'descripcion' => 'Revisión instalación de gas por vencimiento'],
    ['id' => 14, 'propiedad_id' => 56, 'propiedad' => 'Depto centro Tucumán', 'tipo' => 'Pintura', 'prioridad' => 'Baja', 'estado' => 'Aprobado', 'responsable' => 'Pinturas del Norte', 'fecha' => '2025-06-08', 'costo_est' => 45000, 'costo_final' => null, 'descripcion' => 'Repintar departamento para nuevo inquilino'],
    ['id' => 15, 'propiedad_id' => 7, 'propiedad' => 'Casa Cerro de las Rosas', 'tipo' => 'Seguridad', 'prioridad' => 'Media', 'estado' => 'Pendiente', 'responsable' => null, 'fecha' => '2025-06-10', 'costo_est' => 90000, 'costo_final' => null, 'descripcion' => 'Instalación de cámaras de seguridad'],
    ['id' => 16, 'propiedad_id' => 5, 'propiedad' => 'Depto 1 amb. amoblado', 'tipo' => 'Plomería', 'prioridad' => 'Media', 'estado' => 'Finalizado', 'responsable' => 'Juan Gómez (plomero)', 'fecha' => '2025-05-15', 'costo_est' => 20000, 'costo_final' => 18000, 'descripcion' => 'Destape de cañería de baño'],
    ['id' => 17, 'propiedad_id' => 38, 'propiedad' => 'Galpón Núñez', 'tipo' => 'Portón', 'prioridad' => 'Alta', 'estado' => 'En Curso', 'responsable' => 'Herrería Industrial BA', 'fecha' => '2025-06-04', 'costo_est' => 150000, 'costo_final' => null, 'descripcion' => 'Reparación de portón eléctrico'],
    ['id' => 18, 'propiedad_id' => 24, 'propiedad' => 'Casa Belgrano R', 'tipo' => 'Techos', 'prioridad' => 'Media', 'estado' => 'Aprobado', 'responsable' => 'Impermeabilizaciones BA', 'fecha' => '2025-06-07', 'costo_est' => 200000, 'costo_final' => null, 'descripcion' => 'Impermeabilización de terraza'],
    ['id' => 19, 'propiedad_id' => 47, 'propiedad' => 'Dúplex a estrenar', 'tipo' => 'Terminaciones', 'prioridad' => 'Baja', 'estado' => 'Finalizado', 'responsable' => 'Terminaciones Finas', 'fecha' => '2025-05-25', 'costo_est' => 30000, 'costo_final' => 32000, 'descripcion' => 'Ajustes de terminaciones en baños'],
    ['id' => 20, 'propiedad_id' => 63, 'propiedad' => 'Casa 4 amb. pileta quincho', 'tipo' => 'Pileta', 'prioridad' => 'Media', 'estado' => 'Pendiente', 'responsable' => null, 'fecha' => '2025-06-10', 'costo_est' => 30000, 'costo_final' => null, 'descripcion' => 'Reparación de bomba de pileta'],
];

// ============================================
// RESERVAS / SEÑAMIENTOS (15+)
// ============================================
$reservas = [
    ['id' => 1, 'propiedad_id' => 4, 'propiedad' => 'Casa 4 amb. quincho', 'cliente' => 'Romina Castro', 'monto' => 12000, 'moneda' => 'USD', 'fecha' => '2025-06-01', 'vencimiento' => '2025-06-30', 'estado' => 'Vigente', 'agente' => 'Sofía Peralta'],
    ['id' => 2, 'propiedad_id' => 18, 'propiedad' => 'Depto 4 amb. Núñez', 'cliente' => 'María Eugenia Valle', 'monto' => 21000, 'moneda' => 'USD', 'fecha' => '2025-06-05', 'vencimiento' => '2025-07-05', 'estado' => 'Vigente', 'agente' => 'Camila Vega'],
    ['id' => 3, 'propiedad_id' => 12, 'propiedad' => 'Dúplex barrio privado', 'cliente' => 'Raúl Espinoza', 'monto' => 14500, 'moneda' => 'USD', 'fecha' => '2025-05-01', 'vencimiento' => '2025-05-15', 'estado' => 'Convertida', 'agente' => 'Emiliano Quiroga'],
    ['id' => 4, 'propiedad_id' => 28, 'propiedad' => 'Lote en Polcos', 'cliente' => 'Ezequiel Ponce', 'monto' => 1800, 'moneda' => 'USD', 'fecha' => '2025-04-10', 'vencimiento' => '2025-04-20', 'estado' => 'Convertida', 'agente' => 'Luciano Martínez'],
    ['id' => 5, 'propiedad_id' => 40, 'propiedad' => 'Depto Belgrano', 'cliente' => 'Soledad Ríos', 'monto' => 9800, 'moneda' => 'USD', 'fecha' => '2025-02-10', 'vencimiento' => '2025-02-20', 'estado' => 'Convertida', 'agente' => 'Pablo Mendoza'],
    ['id' => 6, 'propiedad_id' => 10, 'propiedad' => 'Penthouse Recoleta', 'cliente' => 'Virginia Salas', 'monto' => 38000, 'moneda' => 'USD', 'fecha' => '2025-06-08', 'vencimiento' => '2025-07-08', 'estado' => 'Vigente', 'agente' => 'Camila Vega'],
    ['id' => 7, 'propiedad_id' => 30, 'propiedad' => 'Casa 5 amb. jardín', 'cliente' => 'Romina Castro', 'monto' => 16500, 'moneda' => 'USD', 'fecha' => '2025-06-03', 'vencimiento' => '2025-07-03', 'estado' => 'Vigente', 'agente' => 'Sofía Peralta'],
    ['id' => 8, 'propiedad_id' => 7, 'propiedad' => 'Casa Cerro Rosas', 'cliente' => 'Diego Arce', 'monto' => 18500, 'moneda' => 'USD', 'fecha' => '2025-06-09', 'vencimiento' => '2025-07-09', 'estado' => 'Vigente', 'agente' => 'Martín Acosta'],
    ['id' => 9, 'propiedad_id' => 6, 'propiedad' => 'Depto Nueva Córdoba', 'cliente' => 'Analía Cortez', 'monto' => 9500, 'moneda' => 'USD', 'fecha' => '2025-05-20', 'vencimiento' => '2025-06-05', 'estado' => 'Vencida', 'agente' => 'Martín Acosta'],
    ['id' => 10, 'propiedad_id' => 35, 'propiedad' => 'Edificio Caballito', 'cliente' => 'Ariel Domínguez', 'monto' => 120000, 'moneda' => 'USD', 'fecha' => '2025-06-02', 'vencimiento' => '2025-07-02', 'estado' => 'Vigente', 'agente' => 'Camila Vega'],
    ['id' => 11, 'propiedad_id' => 24, 'propiedad' => 'Casa Belgrano R', 'cliente' => 'Paola Escobar', 'monto' => 42000, 'moneda' => 'USD', 'fecha' => '2025-06-07', 'vencimiento' => '2025-07-07', 'estado' => 'Vigente', 'agente' => 'Pablo Mendoza'],
    ['id' => 12, 'propiedad_id' => 47, 'propiedad' => 'Dúplex a estrenar', 'cliente' => 'Natalia Bustos', 'monto' => 9800, 'moneda' => 'USD', 'fecha' => '2025-06-10', 'vencimiento' => '2025-07-10', 'estado' => 'Vigente', 'agente' => 'Emiliano Quiroga'],
    ['id' => 13, 'propiedad_id' => 60, 'propiedad' => 'Casa Núñez jardín', 'cliente' => 'Paola Escobar', 'monto' => 29500, 'moneda' => 'USD', 'fecha' => '2025-06-06', 'vencimiento' => '2025-07-06', 'estado' => 'Vigente', 'agente' => 'Pablo Mendoza'],
    ['id' => 14, 'propiedad_id' => 33, 'propiedad' => 'Depto Cerro Rosas', 'cliente' => 'Tomás Fuentes', 'monto' => 11500, 'moneda' => 'USD', 'fecha' => '2025-06-06', 'vencimiento' => '2025-07-06', 'estado' => 'Vigente', 'agente' => 'Martín Acosta'],
    ['id' => 15, 'propiedad_id' => 22, 'propiedad' => 'Casa quinta pileta', 'cliente' => 'Matías Céspedes', 'monto' => 15500, 'moneda' => 'USD', 'fecha' => '2025-06-09', 'vencimiento' => '2025-07-09', 'estado' => 'Vigente', 'agente' => 'Emiliano Quiroga'],
    ['id' => 16, 'propiedad_id' => 14, 'propiedad' => 'Lote Chateau Carreras', 'cliente' => 'Ramiro Valdez', 'monto' => 6800, 'moneda' => 'USD', 'fecha' => '2025-06-04', 'vencimiento' => '2025-07-04', 'estado' => 'Vigente', 'agente' => 'Rocío Navarro'],
];

// ============================================
// AGENDA / VISITAS
// ============================================
$visitas = [
    ['id' => 1, 'propiedad_id' => 1, 'propiedad' => 'Casa 3 amb. pileta', 'cliente' => 'Pedro González', 'agente' => 'Luciano Martínez', 'fecha' => '2025-06-10', 'hora' => '10:00', 'estado' => 'Confirmada', 'resultado' => null],
    ['id' => 2, 'propiedad_id' => 6, 'propiedad' => 'Depto 3 amb. Nueva Córdoba', 'cliente' => 'Claudia Ríos', 'agente' => 'Martín Acosta', 'fecha' => '2025-06-10', 'hora' => '11:30', 'estado' => 'Confirmada', 'resultado' => null],
    ['id' => 3, 'propiedad_id' => 10, 'propiedad' => 'Penthouse Recoleta', 'cliente' => 'Sergio Mendoza', 'agente' => 'Camila Vega', 'fecha' => '2025-06-10', 'hora' => '15:00', 'estado' => 'Confirmada', 'resultado' => null],
    ['id' => 4, 'propiedad_id' => 16, 'propiedad' => 'Local gastronómico Palermo', 'cliente' => 'Emanuel Vargas', 'agente' => 'Facundo Ríos', 'fecha' => '2025-06-10', 'hora' => '16:30', 'estado' => 'Pendiente', 'resultado' => null],
    ['id' => 5, 'propiedad_id' => 18, 'propiedad' => 'Depto 4 amb. Núñez', 'cliente' => 'Roxana Acevedo', 'agente' => 'Camila Vega', 'fecha' => '2025-06-11', 'hora' => '10:00', 'estado' => 'Confirmada', 'resultado' => null],
    ['id' => 6, 'propiedad_id' => 20, 'propiedad' => 'Depto 3 amb. vista parque', 'cliente' => 'Maximiliano Sosa', 'agente' => 'Sofía Peralta', 'fecha' => '2025-06-11', 'hora' => '11:00', 'estado' => 'Confirmada', 'resultado' => null],
    ['id' => 7, 'propiedad_id' => 27, 'propiedad' => 'Depto Puerto Madero', 'cliente' => 'Pablo Galván', 'agente' => 'Camila Vega', 'fecha' => '2025-06-11', 'hora' => '14:00', 'estado' => 'Pendiente', 'resultado' => null],
    ['id' => 8, 'propiedad_id' => 30, 'propiedad' => 'Casa 5 amb. jardín', 'cliente' => 'Celina Paredes', 'agente' => 'Sofía Peralta', 'fecha' => '2025-06-12', 'hora' => '09:30', 'estado' => 'Confirmada', 'resultado' => null],
    ['id' => 9, 'propiedad_id' => 7, 'propiedad' => 'Casa Cerro Rosas', 'cliente' => 'Renata Suárez', 'agente' => 'Martín Acosta', 'fecha' => '2025-06-12', 'hora' => '11:00', 'estado' => 'Confirmada', 'resultado' => null],
    ['id' => 10, 'propiedad_id' => 4, 'propiedad' => 'Casa 4 amb. quincho', 'cliente' => 'Laura Nieto', 'agente' => 'Sofía Peralta', 'fecha' => '2025-06-09', 'hora' => '10:30', 'estado' => 'Realizada', 'resultado' => 'Interesada, pidió segunda visita'],
    ['id' => 11, 'propiedad_id' => 3, 'propiedad' => 'Lote 600m² residencial', 'cliente' => 'Héctor Bravo', 'agente' => 'Emiliano Quiroga', 'fecha' => '2025-06-08', 'hora' => '09:00', 'estado' => 'Realizada', 'resultado' => 'Solicitó plano y condiciones de pago'],
    ['id' => 12, 'propiedad_id' => 35, 'propiedad' => 'Edificio Caballito', 'cliente' => 'Tamara Leiva', 'agente' => 'Camila Vega', 'fecha' => '2025-06-07', 'hora' => '14:00', 'estado' => 'Realizada', 'resultado' => 'Muy interesada, en negociación'],
];

// ============================================
// NOTIFICACIONES (30+)
// ============================================
$notificaciones = [
    ['id' => 1, 'tipo' => 'lead', 'titulo' => 'Nuevo lead recibido', 'descripcion' => 'Pedro González consultó por Casa 3 amb. con pileta', 'fecha' => '2025-06-10 09:15', 'leida' => false],
    ['id' => 2, 'tipo' => 'lead', 'titulo' => 'Nuevo lead recibido', 'descripcion' => 'Silvina Ortega consultó por Depto Puerto Madero', 'fecha' => '2025-06-10 09:00', 'leida' => false],
    ['id' => 3, 'tipo' => 'pago', 'titulo' => 'Pago vencido', 'descripcion' => 'Ailén Morales - Alquiler Junio 2025 sin pagar', 'fecha' => '2025-06-10 08:00', 'leida' => false],
    ['id' => 4, 'tipo' => 'contrato', 'titulo' => 'Contrato por vencer', 'descripcion' => 'Depto Puerto Madero - vence el 01/08/2025', 'fecha' => '2025-06-10 07:00', 'leida' => false],
    ['id' => 5, 'tipo' => 'visita', 'titulo' => 'Visita del día', 'descripcion' => 'Pedro González - Casa 3 amb. pileta - 10:00 hs', 'fecha' => '2025-06-10 07:00', 'leida' => true],
    ['id' => 6, 'tipo' => 'visita', 'titulo' => 'Visita del día', 'descripcion' => 'Claudia Ríos - Depto Nueva Córdoba - 11:30 hs', 'fecha' => '2025-06-10 07:00', 'leida' => true],
    ['id' => 7, 'tipo' => 'visita', 'titulo' => 'Visita del día', 'descripcion' => 'Sergio Mendoza - Penthouse Recoleta - 15:00 hs', 'fecha' => '2025-06-10 07:00', 'leida' => false],
    ['id' => 8, 'tipo' => 'mantenimiento', 'titulo' => 'Nuevo reclamo', 'descripcion' => 'Humedad en PH 3 amb. reciclado - Prioridad Alta', 'fecha' => '2025-06-10 08:30', 'leida' => false],
    ['id' => 9, 'tipo' => 'lead', 'titulo' => 'Nuevo lead recibido', 'descripcion' => 'Celina Paredes consultó por Casa 5 amb. jardín', 'fecha' => '2025-06-10 08:45', 'leida' => false],
    ['id' => 10, 'tipo' => 'reserva', 'titulo' => 'Nueva reserva', 'descripcion' => 'Natalia Bustos señó Dúplex a estrenar por USD 9.800', 'fecha' => '2025-06-10 09:30', 'leida' => false],
    ['id' => 11, 'tipo' => 'pago', 'titulo' => 'Pago recibido', 'descripcion' => 'Carolina Figueroa pagó alquiler Junio - $280.000', 'fecha' => '2025-06-08 14:20', 'leida' => true],
    ['id' => 12, 'tipo' => 'pago', 'titulo' => 'Pago recibido', 'descripcion' => 'Roberto Cáceres pagó alquiler Junio - $450.000', 'fecha' => '2025-06-04 10:15', 'leida' => true],
    ['id' => 13, 'tipo' => 'lead', 'titulo' => 'Lead de alta prioridad', 'descripcion' => 'Tamara Leiva (scoring 95) - Edificio Caballito', 'fecha' => '2025-06-02 11:00', 'leida' => true],
    ['id' => 14, 'tipo' => 'contrato', 'titulo' => 'Contrato firmado', 'descripcion' => 'Verónica Paz firmó alquiler Casa barrio Jardín', 'fecha' => '2025-05-01 16:00', 'leida' => true],
    ['id' => 15, 'tipo' => 'mantenimiento', 'titulo' => 'Reparación finalizada', 'descripcion' => 'Vidriería Local Güemes - Costo: $38.000', 'fecha' => '2025-05-25 12:00', 'leida' => true],
    ['id' => 16, 'tipo' => 'lead', 'titulo' => 'Nuevo lead Instagram', 'descripcion' => 'Sofía Roldán consultó por Casa 3 amb. pileta', 'fecha' => '2025-06-10 10:00', 'leida' => false],
    ['id' => 17, 'tipo' => 'lead', 'titulo' => 'Nuevo lead recibido', 'descripcion' => 'Valeria Romero consultó por Dúplex a estrenar', 'fecha' => '2025-06-10 10:15', 'leida' => false],
    ['id' => 18, 'tipo' => 'lead', 'titulo' => 'Nuevo lead recibido', 'descripcion' => 'Milagros Rivero consultó por Depto amoblado temporal', 'fecha' => '2025-06-10 10:20', 'leida' => false],
    ['id' => 19, 'tipo' => 'sistema', 'titulo' => 'Backup realizado', 'descripcion' => 'Backup automático completado exitosamente', 'fecha' => '2025-06-10 03:00', 'leida' => true],
    ['id' => 20, 'tipo' => 'mantenimiento', 'titulo' => 'Mantenimiento urgente', 'descripcion' => 'Bomba de pileta Casa 4 amb. Parque Adán Quiroga', 'fecha' => '2025-06-10 09:45', 'leida' => false],
    ['id' => 21, 'tipo' => 'reserva', 'titulo' => 'Reserva por vencer', 'descripcion' => 'Depto Nueva Córdoba - Analía Cortez - venció 05/06', 'fecha' => '2025-06-05 07:00', 'leida' => true],
    ['id' => 22, 'tipo' => 'pago', 'titulo' => 'Seña recibida', 'descripcion' => 'Matías Céspedes señó Casa quinta - USD 15.500', 'fecha' => '2025-06-09 15:30', 'leida' => false],
    ['id' => 23, 'tipo' => 'lead', 'titulo' => 'Nuevo lead recibido', 'descripcion' => 'Fabián Luna consultó por Casa Núñez jardín', 'fecha' => '2025-06-10 10:30', 'leida' => false],
    ['id' => 24, 'tipo' => 'lead', 'titulo' => 'Nuevo lead WhatsApp', 'descripcion' => 'Gisela Torres consultó por Depto 3 amb. cochera', 'fecha' => '2025-06-09 20:15', 'leida' => false],
    ['id' => 25, 'tipo' => 'contrato', 'titulo' => 'Contrato pendiente firma', 'descripcion' => 'Depto Güemes - Daniela Soria - Esperando firma', 'fecha' => '2025-06-10 08:15', 'leida' => false],
    ['id' => 26, 'tipo' => 'sistema', 'titulo' => 'Nuevo usuario creado', 'descripcion' => 'Se registró Emiliano Quiroga como Corredor', 'fecha' => '2025-06-01 09:00', 'leida' => true],
    ['id' => 27, 'tipo' => 'lead', 'titulo' => 'Lead convertido', 'descripcion' => 'Hugo Medina cerró alquiler Oficina Belgrano', 'fecha' => '2025-06-01 17:00', 'leida' => true],
    ['id' => 28, 'tipo' => 'mantenimiento', 'titulo' => 'Reparación finalizada', 'descripcion' => 'Cerrajería Casa barrio Jardín - Costo: $15.000', 'fecha' => '2025-05-28 16:00', 'leida' => true],
    ['id' => 29, 'tipo' => 'visita', 'titulo' => 'Visita mañana', 'descripcion' => 'Roxana Acevedo - Depto Núñez - 10:00 hs', 'fecha' => '2025-06-10 18:00', 'leida' => false],
    ['id' => 30, 'tipo' => 'lead', 'titulo' => 'Nuevo lead recibido', 'descripcion' => 'Agustín Robles consultó por Lote esquina 500m²', 'fecha' => '2025-06-10 10:45', 'leida' => false],
    ['id' => 31, 'tipo' => 'pago', 'titulo' => 'Recordatorio de pago', 'descripcion' => 'Saldo Dúplex Valle Viejo vence 15/06 - USD 130.500', 'fecha' => '2025-06-10 07:00', 'leida' => false],
    ['id' => 32, 'tipo' => 'reserva', 'titulo' => 'Nueva reserva', 'descripcion' => 'Ramiro Valdez señó Lote Chateau - USD 6.800', 'fecha' => '2025-06-04 14:00', 'leida' => true],
];

// ============================================
// AUDITORÍA
// ============================================
$auditoria = [
    ['id' => 1, 'usuario' => 'Jorge Francesia', 'accion' => 'Creó propiedad', 'modulo' => 'Propiedades', 'detalle' => 'Casa 4 amb. pileta quincho (DV-027)', 'fecha' => '2025-06-10 10:30', 'ip' => '190.17.34.56'],
    ['id' => 2, 'usuario' => 'Sofía Peralta', 'accion' => 'Registró reserva', 'modulo' => 'Reservas', 'detalle' => 'Natalia Bustos - Dúplex a estrenar', 'fecha' => '2025-06-10 09:30', 'ip' => '190.17.34.58'],
    ['id' => 3, 'usuario' => 'Luciano Martínez', 'accion' => 'Asignó lead', 'modulo' => 'Leads', 'detalle' => 'Pedro González asignado a prop. DV-001', 'fecha' => '2025-06-10 09:15', 'ip' => '190.17.34.57'],
    ['id' => 4, 'usuario' => 'María López', 'accion' => 'Editó empresa', 'modulo' => 'Empresas', 'detalle' => 'Actualizó datos de Inmobiliaria Del Valle', 'fecha' => '2025-06-10 08:45', 'ip' => '190.17.34.60'],
    ['id' => 5, 'usuario' => 'Camila Vega', 'accion' => 'Generó contrato', 'modulo' => 'Contratos', 'detalle' => 'Alquiler Oficina Belgrano - Hugo Medina', 'fecha' => '2025-06-01 17:00', 'ip' => '181.44.12.33'],
    ['id' => 6, 'usuario' => 'Pablo Mendoza', 'accion' => 'Registró pago', 'modulo' => 'Pagos', 'detalle' => 'Seña Depto Belgrano - Soledad Ríos USD 9.800', 'fecha' => '2025-02-15 11:30', 'ip' => '181.44.12.35'],
    ['id' => 7, 'usuario' => 'Gabriela Sánchez', 'accion' => 'Registró pago', 'modulo' => 'Pagos', 'detalle' => 'Alquiler Junio - Carolina Figueroa $280.000', 'fecha' => '2025-06-08 14:20', 'ip' => '190.17.34.62'],
    ['id' => 8, 'usuario' => 'Emiliano Quiroga', 'accion' => 'Creó visita', 'modulo' => 'Agenda', 'detalle' => 'Héctor Bravo - Lote 600m² - 08/06 09:00', 'fecha' => '2025-06-07 16:00', 'ip' => '190.17.34.63'],
    ['id' => 9, 'usuario' => 'Jorge Francesia', 'accion' => 'Creó usuario', 'modulo' => 'Usuarios', 'detalle' => 'Emiliano Quiroga - Corredor - Valle Viejo', 'fecha' => '2025-06-01 09:00', 'ip' => '190.17.34.56'],
    ['id' => 10, 'usuario' => 'Martín Acosta', 'accion' => 'Cambió estado lead', 'modulo' => 'Leads', 'detalle' => 'Marina Zárate pasó a Perdido', 'fecha' => '2025-05-25 14:00', 'ip' => '200.69.88.12'],
    ['id' => 11, 'usuario' => 'Facundo Ríos', 'accion' => 'Publicó aviso', 'modulo' => 'Publicaciones', 'detalle' => 'Depto 1 amb. Palermo Hollywood en ZonaProp', 'fecha' => '2025-05-28 10:00', 'ip' => '181.44.12.40'],
    ['id' => 12, 'usuario' => 'Tomás Aguirre', 'accion' => 'Resolvió ticket', 'modulo' => 'Soporte', 'detalle' => 'Ticket #45 - Error en exportación de reportes', 'fecha' => '2025-06-09 16:00', 'ip' => '190.17.34.65'],
    ['id' => 13, 'usuario' => 'Laura Gómez', 'accion' => 'Registró mantenimiento', 'modulo' => 'Mantenimiento', 'detalle' => 'Casa barrio Jardín - Cerrajería', 'fecha' => '2025-05-27 09:00', 'ip' => '200.69.88.15'],
    ['id' => 14, 'usuario' => 'Jorge Francesia', 'accion' => 'Actualizó configuración', 'modulo' => 'Configuración', 'detalle' => 'Cambió moneda por defecto a ARS', 'fecha' => '2025-06-01 08:00', 'ip' => '190.17.34.56'],
    ['id' => 15, 'usuario' => 'Natalia Romero', 'accion' => 'Creó propiedad', 'modulo' => 'Propiedades', 'detalle' => 'Depto 2 amb. centro Tucumán (NP-002)', 'fecha' => '2025-06-08 11:00', 'ip' => '190.55.22.10'],
];

// ============================================
// PUBLICACIONES / AVISOS (20+)
// ============================================
$publicaciones = [
    ['id' => 1, 'propiedad_id' => 1, 'propiedad' => 'Casa 3 amb. con pileta', 'portal' => 'ZonaProp', 'estado' => 'Activa', 'fecha' => '2025-01-20', 'vistas' => 1250, 'consultas' => 18, 'leads' => 5],
    ['id' => 2, 'propiedad_id' => 1, 'propiedad' => 'Casa 3 amb. con pileta', 'portal' => 'Argenprop', 'estado' => 'Activa', 'fecha' => '2025-01-22', 'vistas' => 890, 'consultas' => 12, 'leads' => 3],
    ['id' => 3, 'propiedad_id' => 4, 'propiedad' => 'Casa 4 amb. quincho', 'portal' => 'ZonaProp', 'estado' => 'Pausada', 'fecha' => '2025-02-15', 'vistas' => 980, 'consultas' => 15, 'leads' => 4],
    ['id' => 4, 'propiedad_id' => 6, 'propiedad' => 'Depto 3 amb. Nueva Córdoba', 'portal' => 'ZonaProp', 'estado' => 'Activa', 'fecha' => '2025-01-25', 'vistas' => 1560, 'consultas' => 22, 'leads' => 6],
    ['id' => 5, 'propiedad_id' => 7, 'propiedad' => 'Casa Cerro de las Rosas', 'portal' => 'Argenprop', 'estado' => 'Activa', 'fecha' => '2024-12-20', 'vistas' => 2100, 'consultas' => 28, 'leads' => 8],
    ['id' => 6, 'propiedad_id' => 10, 'propiedad' => 'Penthouse Recoleta', 'portal' => 'ZonaProp', 'estado' => 'Activa', 'fecha' => '2025-03-20', 'vistas' => 3200, 'consultas' => 45, 'leads' => 12],
    ['id' => 7, 'propiedad_id' => 10, 'propiedad' => 'Penthouse Recoleta', 'portal' => 'Mercado Libre', 'estado' => 'Activa', 'fecha' => '2025-03-22', 'vistas' => 4500, 'consultas' => 35, 'leads' => 8],
    ['id' => 8, 'propiedad_id' => 16, 'propiedad' => 'Local gastronómico Palermo', 'portal' => 'ZonaProp', 'estado' => 'Activa', 'fecha' => '2025-03-28', 'vistas' => 1800, 'consultas' => 20, 'leads' => 5],
    ['id' => 9, 'propiedad_id' => 24, 'propiedad' => 'Casa Belgrano R', 'portal' => 'Argenprop', 'estado' => 'Activa', 'fecha' => '2025-01-15', 'vistas' => 2800, 'consultas' => 32, 'leads' => 9],
    ['id' => 10, 'propiedad_id' => 27, 'propiedad' => 'Depto Puerto Madero', 'portal' => 'ZonaProp', 'estado' => 'Activa', 'fecha' => '2025-04-18', 'vistas' => 2500, 'consultas' => 30, 'leads' => 7],
    ['id' => 11, 'propiedad_id' => 30, 'propiedad' => 'Casa 5 amb. jardín', 'portal' => 'ZonaProp', 'estado' => 'Activa', 'fecha' => '2025-06-02', 'vistas' => 450, 'consultas' => 8, 'leads' => 3],
    ['id' => 12, 'propiedad_id' => 35, 'propiedad' => 'Edificio Caballito', 'portal' => 'Portal propio', 'estado' => 'Activa', 'fecha' => '2025-02-25', 'vistas' => 1200, 'consultas' => 15, 'leads' => 4],
    ['id' => 13, 'propiedad_id' => 3, 'propiedad' => 'Lote 600m² residencial', 'portal' => 'ZonaProp', 'estado' => 'Activa', 'fecha' => '2025-03-05', 'vistas' => 680, 'consultas' => 10, 'leads' => 3],
    ['id' => 14, 'propiedad_id' => 47, 'propiedad' => 'Dúplex a estrenar', 'portal' => 'Argenprop', 'estado' => 'Activa', 'fecha' => '2025-06-08', 'vistas' => 180, 'consultas' => 5, 'leads' => 2],
    ['id' => 15, 'propiedad_id' => 22, 'propiedad' => 'Casa quinta pileta', 'portal' => 'ZonaProp', 'estado' => 'Activa', 'fecha' => '2025-03-12', 'vistas' => 1400, 'consultas' => 18, 'leads' => 5],
    ['id' => 16, 'propiedad_id' => 14, 'propiedad' => 'Lote Chateau Carreras', 'portal' => 'ZonaProp', 'estado' => 'Activa', 'fecha' => '2025-04-20', 'vistas' => 920, 'consultas' => 14, 'leads' => 4],
    ['id' => 17, 'propiedad_id' => 31, 'propiedad' => 'Depto Palermo Hollywood', 'portal' => 'ZonaProp', 'estado' => 'Activa', 'fecha' => '2025-05-30', 'vistas' => 320, 'consultas' => 6, 'leads' => 2],
    ['id' => 18, 'propiedad_id' => 60, 'propiedad' => 'Casa Núñez jardín', 'portal' => 'ZonaProp', 'estado' => 'Activa', 'fecha' => '2025-05-12', 'vistas' => 1100, 'consultas' => 16, 'leads' => 5],
    ['id' => 19, 'propiedad_id' => 60, 'propiedad' => 'Casa Núñez jardín', 'portal' => 'Argenprop', 'estado' => 'Activa', 'fecha' => '2025-05-14', 'vistas' => 780, 'consultas' => 10, 'leads' => 3],
    ['id' => 20, 'propiedad_id' => 63, 'propiedad' => 'Casa 4 amb. pileta quincho', 'portal' => 'ZonaProp', 'estado' => 'Activa', 'fecha' => '2025-06-10', 'vistas' => 45, 'consultas' => 2, 'leads' => 1],
];

// ============================================
// GASTOS DE PROPIEDAD
// ============================================
$gastos = [
    ['id' => 1, 'propiedad_id' => 2, 'propiedad' => 'Depto 2 amb. centro', 'tipo' => 'Expensas', 'monto' => 35000, 'moneda' => 'ARS', 'fecha' => '2025-06-01', 'estado' => 'Pagado', 'responsable' => 'Propietario'],
    ['id' => 2, 'propiedad_id' => 8, 'propiedad' => 'Depto Palermo Soho', 'tipo' => 'Expensas', 'monto' => 85000, 'moneda' => 'ARS', 'fecha' => '2025-06-01', 'estado' => 'Pagado', 'responsable' => 'Propietario'],
    ['id' => 3, 'propiedad_id' => 1, 'propiedad' => 'Casa 3 amb. pileta', 'tipo' => 'Impuesto Inmobiliario', 'monto' => 12000, 'moneda' => 'ARS', 'fecha' => '2025-06-15', 'estado' => 'Pendiente', 'responsable' => 'Propietario'],
    ['id' => 4, 'propiedad_id' => 29, 'propiedad' => 'Oficina centro Córdoba', 'tipo' => 'Expensas', 'monto' => 45000, 'moneda' => 'ARS', 'fecha' => '2025-06-01', 'estado' => 'Pagado', 'responsable' => 'Inquilino'],
    ['id' => 5, 'propiedad_id' => 43, 'propiedad' => 'Depto Puerto Madero', 'tipo' => 'Expensas', 'monto' => 180000, 'moneda' => 'ARS', 'fecha' => '2025-06-01', 'estado' => 'Pagado', 'responsable' => 'Propietario'],
    ['id' => 6, 'propiedad_id' => 11, 'propiedad' => 'Local s/ Güemes', 'tipo' => 'Servicios', 'monto' => 25000, 'moneda' => 'ARS', 'fecha' => '2025-06-10', 'estado' => 'Pendiente', 'responsable' => 'Inquilino'],
    ['id' => 7, 'propiedad_id' => 4, 'propiedad' => 'Casa 4 amb. quincho', 'tipo' => 'Mantenimiento', 'monto' => 120000, 'moneda' => 'ARS', 'fecha' => '2025-06-03', 'estado' => 'En proceso', 'responsable' => 'Propietario'],
    ['id' => 8, 'propiedad_id' => 9, 'propiedad' => 'Oficina Belgrano', 'tipo' => 'Expensas', 'monto' => 120000, 'moneda' => 'ARS', 'fecha' => '2025-06-01', 'estado' => 'Pagado', 'responsable' => 'Inquilino'],
    ['id' => 9, 'propiedad_id' => 37, 'propiedad' => 'Casa barrio Jardín', 'tipo' => 'Impuesto Inmobiliario', 'monto' => 18000, 'moneda' => 'ARS', 'fecha' => '2025-06-15', 'estado' => 'Pendiente', 'responsable' => 'Propietario'],
    ['id' => 10, 'propiedad_id' => 53, 'propiedad' => 'Depto amoblado Córdoba', 'tipo' => 'Expensas', 'monto' => 40000, 'moneda' => 'ARS', 'fecha' => '2025-06-01', 'estado' => 'Pagado', 'responsable' => 'Propietario'],
];

// ============================================
// MENSAJERÍA INTERNA
// ============================================
$mensajes = [
    ['id' => 1, 'de' => 'María López', 'para' => 'Luciano Martínez', 'asunto' => 'Lead urgente Casa pileta', 'mensaje' => 'Luciano, llegó un lead de alta prioridad para la casa con pileta. Por favor contactar hoy.', 'fecha' => '2025-06-10 09:20', 'leido' => false],
    ['id' => 2, 'de' => 'Camila Vega', 'para' => 'Fernando Díaz', 'asunto' => 'Negociación Penthouse Recoleta', 'mensaje' => 'Fernando, la oferta del Penthouse está en USD 360.000. El propietario pide 380.000. Necesito tu aprobación para contraofertar.', 'fecha' => '2025-06-10 08:50', 'leido' => true],
    ['id' => 3, 'de' => 'Jorge Francesia', 'para' => 'Todos', 'asunto' => 'Actualización del sistema', 'mensaje' => 'Se realizará una actualización del sistema el próximo domingo. El sistema estará offline de 02:00 a 06:00.', 'fecha' => '2025-06-09 18:00', 'leido' => true],
    ['id' => 4, 'de' => 'Gabriela Sánchez', 'para' => 'Sofía Peralta', 'asunto' => 'Documentación reserva', 'mensaje' => 'Sofía, necesito que envíes la documentación de la reserva de Romina Castro para Casa 4 amb. quincho.', 'fecha' => '2025-06-09 14:30', 'leido' => true],
    ['id' => 5, 'de' => 'Emiliano Quiroga', 'para' => 'Carlos Ruiz', 'asunto' => 'Resultado visita lote', 'mensaje' => 'Carlos, la visita al lote de 600m² fue positiva. El cliente solicitó plano y condiciones de pago financiado.', 'fecha' => '2025-06-08 17:00', 'leido' => true],
    ['id' => 6, 'de' => 'Tomás Aguirre', 'para' => 'Jorge Francesia', 'asunto' => 'Ticket soporte resuelto', 'mensaje' => 'Jorge, resolví el ticket #45 sobre el error de exportación de reportes. Era un tema de formato de fechas.', 'fecha' => '2025-06-09 16:15', 'leido' => false],
    ['id' => 7, 'de' => 'Pablo Mendoza', 'para' => 'Diego Morales', 'asunto' => 'Negociación Casa Belgrano R', 'mensaje' => 'Diego, Paola Escobar confirmó la seña de USD 42.000 para la casa en Belgrano R. Coordinar escrituración.', 'fecha' => '2025-06-07 16:30', 'leido' => true],
    ['id' => 8, 'de' => 'Laura Gómez', 'para' => 'Roberto Paz', 'asunto' => 'Mantenimiento Casa Jardín', 'mensaje' => 'Roberto, se completó el cambio de cerradura. El inquilino ya tiene las llaves nuevas. Costo: $15.000.', 'fecha' => '2025-05-28 17:00', 'leido' => true],
];

// ============================================
// INTEGRACIONES
// ============================================
$integraciones = [
    ['id' => 1, 'nombre' => 'ZonaProp', 'tipo' => 'Portal Inmobiliario', 'estado' => 'Conectado', 'ultima_sync' => '2025-06-10 06:00', 'propiedades_sync' => 35],
    ['id' => 2, 'nombre' => 'Argenprop', 'tipo' => 'Portal Inmobiliario', 'estado' => 'Conectado', 'ultima_sync' => '2025-06-10 06:00', 'propiedades_sync' => 28],
    ['id' => 3, 'nombre' => 'Mercado Libre', 'tipo' => 'Portal Inmobiliario', 'estado' => 'Conectado', 'ultima_sync' => '2025-06-10 06:30', 'propiedades_sync' => 15],
    ['id' => 4, 'nombre' => 'WhatsApp Business', 'tipo' => 'Comunicación', 'estado' => 'Conectado', 'ultima_sync' => '2025-06-10 09:00', 'propiedades_sync' => null],
    ['id' => 5, 'nombre' => 'Gmail', 'tipo' => 'Email', 'estado' => 'Conectado', 'ultima_sync' => '2025-06-10 10:00', 'propiedades_sync' => null],
    ['id' => 6, 'nombre' => 'Google Calendar', 'tipo' => 'Agenda', 'estado' => 'Conectado', 'ultima_sync' => '2025-06-10 07:00', 'propiedades_sync' => null],
    ['id' => 7, 'nombre' => 'Google Maps', 'tipo' => 'Geolocalización', 'estado' => 'Conectado', 'ultima_sync' => null, 'propiedades_sync' => null],
    ['id' => 8, 'nombre' => 'Firma Digital (Docusign)', 'tipo' => 'Firmas', 'estado' => 'Desconectado', 'ultima_sync' => null, 'propiedades_sync' => null],
    ['id' => 9, 'nombre' => 'Mercado Pago', 'tipo' => 'Pagos', 'estado' => 'Conectado', 'ultima_sync' => '2025-06-10 08:00', 'propiedades_sync' => null],
    ['id' => 10, 'nombre' => 'Properati', 'tipo' => 'Portal Inmobiliario', 'estado' => 'Desconectado', 'ultima_sync' => null, 'propiedades_sync' => null],
];

// ============================================
// PLANTILLAS
// ============================================
$plantillas = [
    ['id' => 1, 'nombre' => 'Contrato de Alquiler Estándar', 'tipo' => 'Contrato', 'estado' => 'Activa', 'ultima_mod' => '2025-05-01'],
    ['id' => 2, 'nombre' => 'Contrato de Venta', 'tipo' => 'Contrato', 'estado' => 'Activa', 'ultima_mod' => '2025-04-15'],
    ['id' => 3, 'nombre' => 'Boleto de Reserva', 'tipo' => 'Contrato', 'estado' => 'Activa', 'ultima_mod' => '2025-03-20'],
    ['id' => 4, 'nombre' => 'Recibo de Alquiler', 'tipo' => 'Recibo', 'estado' => 'Activa', 'ultima_mod' => '2025-05-10'],
    ['id' => 5, 'nombre' => 'Email Bienvenida Inquilino', 'tipo' => 'Email', 'estado' => 'Activa', 'ultima_mod' => '2025-04-01'],
    ['id' => 6, 'nombre' => 'Email Recordatorio de Pago', 'tipo' => 'Email', 'estado' => 'Activa', 'ultima_mod' => '2025-05-15'],
    ['id' => 7, 'nombre' => 'Aviso Inmobiliario Estándar', 'tipo' => 'Publicación', 'estado' => 'Activa', 'ultima_mod' => '2025-03-01'],
    ['id' => 8, 'nombre' => 'Mensaje Automático WhatsApp', 'tipo' => 'Mensaje', 'estado' => 'Activa', 'ultima_mod' => '2025-05-20'],
    ['id' => 9, 'nombre' => 'Contrato Alquiler Temporario', 'tipo' => 'Contrato', 'estado' => 'Borrador', 'ultima_mod' => '2025-06-05'],
    ['id' => 10, 'nombre' => 'Email Seguimiento Post-Visita', 'tipo' => 'Email', 'estado' => 'Activa', 'ultima_mod' => '2025-04-20'],
];

// ============================================
// MÉTRICAS DASHBOARD
// ============================================
$metricas = [
    'propiedades_activas' => 47,
    'propiedades_vendidas' => 4,
    'propiedades_alquiladas' => 6,
    'contratos_vigentes' => 10,
    'leads_mes' => 42,
    'visitas_agendadas' => 8,
    'ingresos_mes_ars' => 5810000,
    'ingresos_mes_usd' => 75900,
    'comisiones_mes' => 1250000,
    'mantenimientos_pendientes' => 7,
    'reservas_activas' => 11,
    'pagos_pendientes' => 6,
    'pagos_vencidos' => 1,
    'usuarios_activos' => 20,
    'ocupacion' => 78,
];

// ============================================
// DATOS GRÁFICOS
// ============================================
$grafico_ventas = [
    ['mes' => 'Ene', 'cantidad' => 2, 'monto' => 180000],
    ['mes' => 'Feb', 'cantidad' => 1, 'monto' => 98000],
    ['mes' => 'Mar', 'cantidad' => 2, 'monto' => 163000],
    ['mes' => 'Abr', 'cantidad' => 1, 'monto' => 18000],
    ['mes' => 'May', 'cantidad' => 3, 'monto' => 290000],
    ['mes' => 'Jun', 'cantidad' => 2, 'monto' => 240000],
];

$grafico_alquileres = [
    ['mes' => 'Ene', 'cantidad' => 3, 'monto' => 1480000],
    ['mes' => 'Feb', 'cantidad' => 2, 'monto' => 2150000],
    ['mes' => 'Mar', 'cantidad' => 4, 'monto' => 2800000],
    ['mes' => 'Abr', 'cantidad' => 2, 'monto' => 900000],
    ['mes' => 'May', 'cantidad' => 3, 'monto' => 1280000],
    ['mes' => 'Jun', 'cantidad' => 5, 'monto' => 3430000],
];

$grafico_leads = [
    ['mes' => 'Ene', 'cantidad' => 25],
    ['mes' => 'Feb', 'cantidad' => 32],
    ['mes' => 'Mar', 'cantidad' => 28],
    ['mes' => 'Abr', 'cantidad' => 35],
    ['mes' => 'May', 'cantidad' => 38],
    ['mes' => 'Jun', 'cantidad' => 42],
];

// ============================================
// SOPORTE / FAQ
// ============================================
$faq = [
    ['id' => 1, 'pregunta' => '¿Cómo cargo una nueva propiedad?', 'respuesta' => 'Ingresá a Propiedades > Nueva Propiedad y completá el formulario con todos los datos requeridos.'],
    ['id' => 2, 'pregunta' => '¿Cómo genero un contrato?', 'respuesta' => 'Desde Contratos > Nuevo Contrato, seleccioná la propiedad, inquilino y plantilla deseada.'],
    ['id' => 3, 'pregunta' => '¿Cómo exporto reportes?', 'respuesta' => 'En la sección Reportes, seleccioná el tipo de reporte y hacé clic en Exportar PDF o Excel.'],
    ['id' => 4, 'pregunta' => '¿Cómo gestiono los permisos de usuario?', 'respuesta' => 'Desde Usuarios > Editar Usuario podés asignar roles y permisos específicos.'],
    ['id' => 5, 'pregunta' => '¿Cómo publico en portales inmobiliarios?', 'respuesta' => 'Configurá la integración en Integraciones, luego desde la ficha de la propiedad podés publicar directamente.'],
];

$tickets_soporte = [
    ['id' => 1, 'titulo' => 'Error al exportar reporte PDF', 'usuario' => 'Laura Gómez', 'estado' => 'Resuelto', 'prioridad' => 'Media', 'fecha' => '2025-06-09'],
    ['id' => 2, 'titulo' => 'No puedo ver las fotos de propiedades', 'usuario' => 'Natalia Romero', 'estado' => 'En Proceso', 'prioridad' => 'Alta', 'fecha' => '2025-06-10'],
    ['id' => 3, 'titulo' => 'Solicitud de nuevo campo en ficha', 'usuario' => 'Roberto Paz', 'estado' => 'Pendiente', 'prioridad' => 'Baja', 'fecha' => '2025-06-10'],
    ['id' => 4, 'titulo' => 'Error de sincronización ZonaProp', 'usuario' => 'Facundo Ríos', 'estado' => 'En Proceso', 'prioridad' => 'Alta', 'fecha' => '2025-06-10'],
    ['id' => 5, 'titulo' => 'Consulta sobre comisiones', 'usuario' => 'Emiliano Quiroga', 'estado' => 'Pendiente', 'prioridad' => 'Media', 'fecha' => '2025-06-10'],
];

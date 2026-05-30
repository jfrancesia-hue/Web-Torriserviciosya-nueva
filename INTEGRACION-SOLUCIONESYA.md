# Integracion TooriServiciosYa -> SolucionesYa

Este repo ya puede enviar sus prestadores de Supabase a SolucionesYa.

## Fuente de datos

Toori usa la tabla:

```text
sy_perfiles
```

con:

```text
rol = prestador
```

Campos usados:

- `id` -> `marketplaceId`
- `nombre`
- `telefono`
- `email`
- `oficios` -> `rubros`
- `responsable_pago` -> `responsablePago` en tickets de SolucionesYa

## Endpoints de sincronizacion

Archivos:

```text
api/sync-solucionesya-prestadores.php
api/sync-solucionesya-pedidos.php
api/sync-solucionesya-todo.php
```

Variables necesarias en `webhook/.env`:

```text
SOLUCIONESYA_SYNC_BASE_URL=https://tu-solucionesya.com
SOLUCIONESYA_SYNC_TOKEN=el-mismo-token-configurado-en-solucionesya
SOLUCIONESYA_CRON_TOKEN=token-para-ejecutar-sync-todo
SOLUCIONESYA_TENANT_ID=uuid-del-tenant-inmobiliaria-en-solucionesya
```

En desarrollo local:

```text
SOLUCIONESYA_SYNC_BASE_URL=http://localhost:3000
```

Tambien se pueden configurar URLs separadas si hace falta:

```text
SOLUCIONESYA_PRESTADORES_SYNC_URL=https://tu-solucionesya.com/api/marketplace/proveedores
SOLUCIONESYA_PEDIDOS_SYNC_URL=https://tu-solucionesya.com/api/marketplace/solicitudes
```

## Resultado

Cuando se ejecuta `api/sync-solucionesya-prestadores.php`:

1. Lee prestadores de `sy_perfiles`.
2. Los transforma al formato de SolucionesYa.
3. Los envia a `/api/marketplace/proveedores`.
4. SolucionesYa los crea o actualiza como `Contacto` con `tipo = PROVEEDOR`.
5. El campo `marketplaceId` queda como vinculo estable con Toori.

Cuando se ejecuta `api/sync-solucionesya-pedidos.php`:

1. Lee pedidos de `sy_pedidos` y ofertas conversacionales de `nuevaOferta`.
2. Los transforma al formato de SolucionesYa.
3. Los envia a `/api/marketplace/solicitudes`.
4. SolucionesYa los crea o actualiza como `Ticket`.
5. El campo `whatsappMessageId` guarda la clave externa `toori-pedido:{id}` para evitar duplicados.
6. El campo `responsable_pago` viaja como `responsablePago`.

## Campo Quien paga

Migracion SQL para Toori:

```text
webhook/migracion_responsable_pago.sql
```

Opciones:

- `INQUILINO`
- `PROPIETARIO`
- `INMOBILIARIA`
- `A_DEFINIR`
- `COMPARTIDO`

## Automatizacion recomendada

Configurar un cron cada 5 minutos contra:

```text
https://tooriserviciosya.com/api/sync-solucionesya-todo.php
```

Si `SOLUCIONESYA_CRON_TOKEN` esta configurado, llamarlo asi:

```text
https://tooriserviciosya.com/api/sync-solucionesya-todo.php?token=token-para-ejecutar-sync-todo
```

Ese endpoint ejecuta ambas sincronizaciones: prestadores y pedidos.

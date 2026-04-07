-- =============================================
-- MIGRACIÓN: Nuevos campos para IA Conversacional
-- Ejecutar en Supabase SQL Editor
-- =============================================

-- 1. Agregar campo para nombre del cliente
ALTER TABLE "nuevaOferta" 
ADD COLUMN IF NOT EXISTS nombre_cliente TEXT;

-- 2. Agregar campo para disponibilidad horaria del cliente
ALTER TABLE "nuevaOferta" 
ADD COLUMN IF NOT EXISTS disponibilidad TEXT;

-- 2. Agregar campo para URL de foto/video
ALTER TABLE "nuevaOferta" 
ADD COLUMN IF NOT EXISTS media_url TEXT;

-- 3. Agregar campo para URLs de videos (separado de fotos)
ALTER TABLE "nuevaOferta" 
ADD COLUMN IF NOT EXISTS video_urls TEXT;

-- 4. Agregar campo para descripción de la imagen (lo que vio la IA)
ALTER TABLE "nuevaOferta" 
ADD COLUMN IF NOT EXISTS media_descripcion TEXT;

-- 5. Agregar historial de conversación (JSON)
ALTER TABLE "nuevaOferta" 
ADD COLUMN IF NOT EXISTS historial_conversacion TEXT DEFAULT '[]';

-- 6. Agregar modo_agente para panel de control
ALTER TABLE "nuevaOferta" 
ADD COLUMN IF NOT EXISTS modo_agente BOOLEAN DEFAULT false;

-- 7. Agregar nuevo estado "recolectando"
-- (No necesita migración, solo asegurarse de usarlo)

-- 7. Comentarios para documentar
COMMENT ON COLUMN "nuevaOferta".disponibilidad IS 'Disponibilidad horaria del cliente para recibir al profesional';
COMMENT ON COLUMN "nuevaOferta".media_url IS 'URLs de fotos enviadas por el cliente (separados por coma)';
COMMENT ON COLUMN "nuevaOferta".video_urls IS 'URLs de videos enviados por el cliente (separados por coma)';
COMMENT ON COLUMN "nuevaOferta".media_descripcion IS 'Descripción generada por IA de las imágenes/videos';
COMMENT ON COLUMN "nuevaOferta".historial_conversacion IS 'JSON con historial de mensajes para contexto de IA';

-- =============================================
-- VERIFICAR CAMPOS EXISTENTES
-- =============================================

-- Verificar que estos campos ya existen (del sistema anterior):
-- - cliente_telefono
-- - descripcion
-- - categoria
-- - zona
-- - paso
-- - estado
-- - domicilio
-- - fecha_hora_acordada
-- - presupuesto_seleccionado_id
-- - monto_final
-- - comision

-- Si alguno no existe, agregar:
ALTER TABLE "nuevaOferta" 
ADD COLUMN IF NOT EXISTS domicilio TEXT;

ALTER TABLE "nuevaOferta" 
ADD COLUMN IF NOT EXISTS fecha_hora_acordada TEXT;

ALTER TABLE "nuevaOferta" 
ADD COLUMN IF NOT EXISTS presupuesto_seleccionado_id INTEGER;

ALTER TABLE "nuevaOferta" 
ADD COLUMN IF NOT EXISTS monto_final DECIMAL(10,2);

ALTER TABLE "nuevaOferta" 
ADD COLUMN IF NOT EXISTS comision DECIMAL(10,2);

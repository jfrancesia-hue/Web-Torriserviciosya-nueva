-- Responsable de pago para solicitudes/ordenes de Toori.
-- Ejecutar en Supabase antes de guardar el campo desde la web.

DO $$
BEGIN
  IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'responsable_pago') THEN
    CREATE TYPE responsable_pago AS ENUM ('INQUILINO', 'PROPIETARIO', 'INMOBILIARIA', 'A_DEFINIR', 'COMPARTIDO');
  END IF;
END $$;

ALTER TABLE IF EXISTS sy_pedidos
  ADD COLUMN IF NOT EXISTS responsable_pago responsable_pago NOT NULL DEFAULT 'A_DEFINIR';

ALTER TABLE IF EXISTS "nuevaOferta"
  ADD COLUMN IF NOT EXISTS responsable_pago responsable_pago NOT NULL DEFAULT 'A_DEFINIR';

CREATE INDEX IF NOT EXISTS sy_pedidos_responsable_pago_idx ON sy_pedidos(responsable_pago);
CREATE INDEX IF NOT EXISTS nuevaoferta_responsable_pago_idx ON "nuevaOferta"(responsable_pago);

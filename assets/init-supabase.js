// Inicialización simple y global de Supabase
// Reemplaza estos valores por los de tu proyecto
const supabaseUrl = 'https://dhhhftzdfpqthzvkrqoz.supabase.co';
const supabaseKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImRoaGhmdHpkZnBxdGh6dmtycW96Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NDQ2OTQyODUsImV4cCI6MjA2MDI3MDI4NX0.-atBYl9Uica9quKZQzqmgWQ8wNd1PFB4ivLrSNv89OQ';

// Asegúrate de que createClient esté disponible globalmente
// Si usas un bundle, esto debe estar después de cargar el bundle de supabase-js
window.supabase = window.supabase || createClient(supabaseUrl, supabaseKey);


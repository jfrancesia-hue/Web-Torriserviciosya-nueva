<script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>

<script>
if (!window.supabaseClient) {

    const supabaseUrl = "https://dhhhftzdfpqthzvkrqoz.supabase.co";
    const supabaseKey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImRoaGhmdHpkZnBxdGh6dmtycW96Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NDQ2OTQyODUsImV4cCI6MjA2MDI3MDI4NX0.-atBYl9Uica9quKZQzqmgWQ8wNd1PFB4ivLrSNv89OQ"

    window.supabaseClient = window.supabase.createClient(
        supabaseUrl,
        supabaseKey
    );

}
</script>
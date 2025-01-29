<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ config('index', 'Laravel') }}</title>
</head>
<body>
    <div class="d-flex justify-content-center mt-5 pt-5">
        <div class="mt-5 spinner-border text-info fs-5" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>

      <script>
        setTimeout(function() {
            window.location.href = "{{ route('grafico') }}";
        }, 2000);
    </script>
</body>
</html>
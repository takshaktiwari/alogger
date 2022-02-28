<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aloggers</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container-fluid py-3">
        <h3 class="mb-4">Alogger Entries</h3>
        <x-alogger-loggers />
    </div>

    <script>
        var showModal = new bootstrap.Modal(document.getElementById('logger-show'), {});
        showModal.show();
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en" data-theme="dracula">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="../../assets/images/file-lock.png">
    <title>LockBox</title>
</head>

<body>
    <main class="mx-auto flex-col lg:flex-row">
        <?php if (alertMsg('msg', 'success')): ?>
            <div class="hero mt-10">
                <?= alertMsg('msg', 'success') ?>
            </div>
        <?php endif ?>
        <?php require "../views/{$view}.view.php" ?>
    </main>
</body>

</html>
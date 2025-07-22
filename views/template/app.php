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
    <main class="mx-auto flex-col lg:flex-row  h-screen">
        <?php require "../views/{$view}.view.php" ?>
    </main>
    <script>
        const myDiv = document.getElementById('msg');

        setTimeout(() => {
            myDiv.classList.remove('opacity-100');
            myDiv.classList.add('opacity-0');
        }, 500);
        setTimeout(() => {

            myDiv.classList.add('hidden');
        }, 2000);
    </script>
</body>

</html>
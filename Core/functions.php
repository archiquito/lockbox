<?php

use Core\Flash;

function base_path($path)
{
    return __DIR__ . '/../' . $path;
}

function view($view, $data = [])
{
    foreach ($data as $key => $value) {
        $$key = $value;
    }

    require base_path('views/template/app.php');
};

function dd(...$data)
{
    dump($data);
    die();
};

function dump(...$data)
{
    echo "<pre>";
    var_dump($data);
    "</pre>";
};

function abort($status)
{
    http_response_code($status);
    view($status);
    die();
};

function cleanSpecialCharacters($string)
{
    return preg_replace("/[^A-Za-z0-9\-\']/", '', $string);
}

function flash()
{
    return new Flash();
}

function config($key = null)
{
    $config = require base_path('config/config.php');

    if (strlen($key) > 0) {
        return $config[$key];
    }
    return $config;
}

function createStars($fullStars, $halfStars, $emptyStars)
{
    for ($i = 0; $i < $fullStars; $i++) {
        echo '&#9733;';
    }

    // Exibe a meia estrela, se houver
    if ($halfStars) {
        echo '&#x2bea;';
    }

    // Loop para exibir as estrelas vazias
    for ($i = 0; $i < $emptyStars; $i++) {
        echo '&#9734;';
    }
}

function getPost($field)
{
    $post = $_POST;

    if (isset($post[$field])) {
        return $post[$field];
    }

    return '';
}

function errorValidations($nameSession)
{
    $validations = flash()->get($nameSession);
    if (empty($validations)) {
        return '';
    }
    $html = '<div role="alert" class="alert alert-error"><ul>';
    foreach ($validations as $item) {
        $html .= '<li class="flex space-x-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                     </svg> <span class="leading-none">' . $item . '</span></li>';
    }
    $html .= '</ul></div>';
    return $html;
}

function alertMsg($nameSession, $type)
{
    $msg = flash()->get($nameSession);

    if (empty($msg)) {
        return '';
    }
    $html = '<div role="alert" class="alert w-full alert-' . $type . '">';
    if (is_array($msg)) {
        $html .= '<ul>';

        foreach ($msg as $item) {
            $html .= '<li class="flex space-x-1"><img src="./assets/images/' . $type . '.svg" class="h-4 w-4" /> <span class="leading-none">' . $item . '</span></li>';
        }
        $html .= '</ul>';
    } else {
        $html .= '<img src="./assets/images/' . $type . '.svg" class="h-4 w-4" /> ' . $msg;
    }
    $html .= '</div>';
    return $html;
}

function redirect($url)
{
    return header('Location: ' . $url);
}

function auth()
{
    if (isset($_SESSION['auth']) && !empty($_SESSION['auth'])) {
        return flash()->getSession('auth');
    }
    return false;
}

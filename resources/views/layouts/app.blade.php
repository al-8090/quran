<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Nurul Quran')</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            background: #fbf7ee;
            color: #222;
        }

        nav {
            background: #14513f;
            padding: 14px 24px;
        }

        nav a {
            color: #f3e3b0;
            margin-right: 18px;
            text-decoration: none;
            font-weight: bold;
        }

        main {
            max-width: 900px;
            margin: 24px auto;
            padding: 0 16px;
        }

        .card {
            background: #fff;
            border: 1px solid #e3d9bd;
            border-radius: 10px;
            padding: 14px;
            margin-bottom: 12px;
        }

        .arab {
            font-family: 'Amiri', serif;
            font-size: 2rem;
            line-height: 2.2;
        }

        .alert {
            background: #fde8e8;
            border: 1px solid #e59;
            padding: 12px;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <nav>
        <a href="/">Beranda</a>
        <a href="/surat">Al-Qur'an</a>
        <a href="/doa">Doa Harian</a>
    </nav>
    <main>@yield('content')</main>
</body>

</html>
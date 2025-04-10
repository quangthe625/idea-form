<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: linear-gradient(135deg, rgb(111, 0, 255) 0%, rgb(255, 143, 160) 100%);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .brand-text {
            color: #0a192f;
            font-size: 28px;
            font-weight: bold;
            line-height: 1;
        }

        h1 {
            color: #0a192f;
            font-size: 36px;
            margin-bottom: 30px;
            align-self: flex-start;
            margin-left: calc(50% - 175px);
            font-weight: normal;
        }

        .form-container {
            width: 100%;
            max-width: 500px;
            padding: 50px;
            border-radius: 30px;
        }

        .form-field {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <div class="form-container bg-white">
        {{ $slot }}
    </div>
</body>

</html>
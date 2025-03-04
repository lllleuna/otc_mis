<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Transaction Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .popover {
            position: relative;
            display: inline-block;
        }

        .popover-content {
            display: none;
            visibility: hidden;
            position: absolute;
            z-index: 10;
            width: auto;
            right: 0;
            top: 100%;
            margin-top: 8px;
            background-color: white;
            border-radius: 6px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            border: 1px solid rgb(229, 231, 235);
        }

        .popover:hover .popover-content {
            visibility: visible;
            display: block;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-7 max-w-full w-full">
        @yield('content')
    </div>
</body>
</html>

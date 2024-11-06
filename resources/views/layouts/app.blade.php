<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <script src="https://unpkg.com/@phosphor-icons/web"></script>

<!-- 
    <style>
        /* Alterando a cor do cabeçalho da tabela */
        table.dataTable thead {
            background-color: #000;
            /* Cor de fundo da tabela */
            color: #1a202c;
            /* Cor do texto */
        }

        /* Alterando a cor das linhas da tabela */
        table.dataTable tbody tr {
            background-color: #000;
            /* Cor de fundo das linhas */
        }

        table.dataTable tbody tr:hover {
            background-color: #f7fafc;
            /* Cor de fundo ao passar o mouse */
        }

        /* Cor do texto das linhas */
        table.dataTable tbody tr td {
            color: #000;
            /* Cor do texto */
        }

        /* Alterando a cor do botão de paginação */
        .dataTables_paginate .paginate_button {
            background: #4299e1;
            /* Cor de fundo */
            color: #fff;
            /* Cor do texto */
            border: none;
            /* Remover bordas */
        }

        .dataTables_paginate .paginate_button:hover {
            background: #3182ce;
            /* Cor de fundo ao passar o mouse */
        }

        /* Alterando a cor do input de pesquisa */
        .dataTables_filter input {
            border: 1px solid #ccc;
            /* Borda do input */
            padding: 5px;
            /* Espaçamento interno */
            border-radius: 5px;
            /* Cantos arredondados */
        }

        .dataTables_filter label {
            color: #4a5568;
            /* Cor do texto */
        }

        /* Alterando a cor do select para definir o número de registros por página */
        .dataTables_length select {
            border: 1px solid #ccc;
            /* Borda do select */
            padding: 5px;
            /* Espaçamento interno */
            border-radius: 5px;
            /* Cantos arredondados */
        }
    </style>
 -->

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
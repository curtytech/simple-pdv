<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="py-12">
                    <div class="gap-5 grid grid-cols-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Maiores vendas</h3>
                            <div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500"></div>
                                        <p class="text-sm font-semibold text-gray-800 dark:text-gray-200 pr-2">R$: 400,00</p>
                                    </div>
                                    <p class="ml-2 text-sm text-gray-600 dark:text-gray-400"> 12/11/24</p>
                                </div>
                                <div class="flex items-center justify-between">

                                    <div class="flex items-center gap-2">
                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500"></div>
                                        <p class="text-sm font-semibold text-gray-800 dark:text-gray-200 pr-2">R$: 300,00</p>
                                    </div>
                                    <p class="ml-2 text-sm text-gray-600 dark:text-gray-400"> 01/11/24</p>
                                </div>
                                <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500"></div>
                                        <p class="text-sm font-semibold text-gray-800 dark:text-gray-200 pr-2">R$: 150,00</p>
                                    </div>
                                    <p class="ml-2 text-sm text-gray-600 dark:text-gray-400"> 15/12/24</p>
                                </div>
                            </div>

                        </div>

                        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total vendido no mês</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">R$ 5.000,00</p>
                        </div>
                        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total Investido</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">R$ 5.000,00</p>
                        </div>
                        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total Investido no mês</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">R$ 5.000,00</p>
                        </div>
                    </div>

                    <div class="py-12 flex mx-6">
                        <div class="w-1/2">
                            <canvas id="salesChart" class="w-full h-64"></canvas>
                        </div>
                        <div class="w-1/2">
                            <canvas id="buysChart" class="w-full h-64"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const ctx = document.getElementById('salesChart').getContext('2d');

            const salesData = {
                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                datasets: [{
                    label: 'Vendas nos últimos 12 meses',
                    data: [5000, 7000, 8000, 6000, 9000, 11000, 13000, 10000, 12000, 15000, 17000, 16000],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    tension: 0.3, // Suaviza a curva
                }, ],
            };

            new Chart(ctx, {
                type: 'line',
                data: salesData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                        },
                        tooltip: {
                            enabled: true,
                        },
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: (value) => `R$ ${value.toLocaleString()}`,
                            },
                        },
                    },
                },
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const ctx = document.getElementById('buysChart').getContext('2d');

            const salesData = {
                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                datasets: [{
                    label: 'Investimentos nos últimos 12 meses',
                    data: [5000, 1000, 8000, 1000, 800, 11000, 2000, 10000, 12000, 7000, 17000, 1000],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    tension: 0.3, // Suaviza a curva
                }, ],
            };

            new Chart(ctx, {
                type: 'line',
                data: salesData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                        },
                        tooltip: {
                            enabled: true,
                        },
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: (value) => `R$ ${value.toLocaleString()}`,
                            },
                        },
                    },
                },
            });
        });
    </script>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
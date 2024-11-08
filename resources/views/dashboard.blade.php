<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Caixa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="py-12">
                    <div
                        class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex items-center">
                            <div class="flex-1 text-lg font-semibold text-gray-800 dark:text-gray-200">
                                {{ __('Saldo') }}</div>
                                </div>
                            <div class="text-lg font-semibold text-green-600 dark:text-green-400">R$ 1.500,00</div>
                            <div class="flex-1 text-lg font-semibold text-gray-800 dark:text-gray-200">
                                {{ __('Total Investido') }}</div>
                            <div class="text-lg font-semibold text-green-600 dark:text-green-400">R$ 1.500,00</div>
                            <div class="flex-1 text-lg font-semibold text-gray-800 dark:text-gray-200">
                                {{ __('Vendas do Mes') }}</div>
                            <div class="text-lg font-semibold text-green-600 dark:text-green-400">R$ 1.500,00</div>
                            <div class="flex-1 text-lg font-semibold text-gray-800 dark:text-gray-200">
                                {{ __('Vendas do Mes Anterior') }}</div>
                            <div class="text-lg font-semibold text-green-600 dark:text-green-400">R$ 1.500,00</div>
                        </div>
                    </div>
                </div>
            </div>
</x-app-layout>

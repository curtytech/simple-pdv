<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Caixa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="py-12">
                <div class="p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="flex-1 text-lg font-semibold text-gray-800 dark:text-gray-200">{{ __('Saldo') }}</div>
                        <div class="text-lg font-semibold text-green-600 dark:text-green-400">R$ 1.500,00</div>
                    </div>

                </div>
            </div>
        </div>
</x-app-layout>
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
                    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 w-full flex gap-6 mb-6">
                        <div class="flex flex-col w-3/4">
                            <div class="h-32 px-6 w-full flex flex-row items-center justify-between bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                                <select name="product_id" class="w-full py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-gray-200">
                                    <option value="">Selecione um Produto</option>
                                </select>
                                <p class="p-6 text-white dark:text-gray-100">
                                    <input type="number" class='rounded bg-gray-600 text-white' />
                                </p>
                                <button class="w-1/4 mx-auto justify-center p-2 bg-gray-600 rounded-lg dark:text-gray-100">
                                    <i class="ph ph-plus"></i>
                                </button>
                            </div>
                            <div class="h-32 px-6 w-3/4 flex flex-row items-center justify-between bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                                <img src="https://picsum.photos/200/300" class='w-32 h-32 p-4 rounded-full' alt="" />
                                <p class="p-6 text-gray-900 dark:text-gray-100">
                                    Name
                                </p>
                                <p class="p-6 text-gray-900  dark:text-gray-100">
                                    <input type="number" class='rounded bg-gray-600 text-black' />
                                </p>
                                <p class="p-6 text-gray-900 dark:text-gray-100">
                                    R$ 7.88
                                </p>
                                <Trash size={32} class='text-gray-900 dark:text-gray-100 cursor-pointer' />
                            </div>
                        </div>
                        <div class='w-1/4 flex flex-row items-center justify-between bg-white shadow-sm sm:rounded-lg dark:bg-gray-800'>
                            <div class='w-full flex flex-col justify-center items-center p-6'>
                                <p class="p-6 text-gray-900 dark:text-gray-100">
                                    Detalhes da compra
                                </p>

                                <div class='flex flex-col justify-start w-full mb-6'>
                                    <div class='w-full flex justify-between'>
                                        <p class='text-gray-900 dark:text-gray-100 text-sm justify-start'>SubTotal:</p>
                                        <p class='text-gray-900 dark:text-gray-100 text-sm justify-start'>80.99</p>
                                    </div>
                                    <div class='w-full flex justify-between'>
                                        <p class='text-gray-900 dark:text-gray-100 text-sm justify-start'>Desconto:</p>
                                        <p class='text-gray-900 dark:text-gray-100 text-sm justify-start'>2.99</p>
                                    </div>
                                    <div class='w-full flex justify-between'>
                                        <p class='text-gray-900 dark:text-gray-100 text-sm justify-start'>Total:</p>
                                        <p class='text-gray-900 dark:text-gray-100 text-sm justify-start'>78.00</p>
                                    </div>
                                </div>

                                <button class='mx-auto w-full justify-center p-2 bg-gray-600 rounded-lg dark:text-gray-100'>
                                    Enviar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
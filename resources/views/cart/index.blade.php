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
                    <div class="flex w-full gap-6 mx-auto mb-6 max-w-7xl sm:px-6 lg:px-8">
                        <div class="flex flex-col w-3/4">
                            <div
                                class="flex flex-row items-center justify-between w-full h-32 px-6 bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                                <select name="product_id"
                                    class="w-full py-2 border border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                                    <option value="">Selecione um Produto</option>
                                </select>
                                <p class="p-6 text-white dark:text-gray-100">
                                    <input type="number" class='text-white bg-gray-600 rounded' />
                                </p>
                                <button
                                    class="justify-center w-1/4 p-2 mx-auto bg-gray-600 rounded-lg dark:text-gray-100">
                                    <i class="ph ph-plus"></i>
                                </button>
                            </div>
                            <div
                                class="flex flex-row items-center justify-between w-3/4 h-32 px-6 bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                                <img src="https://picsum.photos/200/300" class='w-32 h-32 p-4 rounded-full'
                                    alt="" />
                                <p class="p-6 text-gray-900 dark:text-gray-100">
                                    Name
                                </p>
                                <p class="p-6 text-gray-900 dark:text-gray-100">
                                    <input type="number" class='text-black bg-gray-600 rounded' />
                                </p>
                                <p class="p-6 text-gray-900 dark:text-gray-100">
                                    R$ 7.88
                                </p>
                                <Trash size={32} class='text-gray-900 cursor-pointer dark:text-gray-100' />
                            </div>
                        </div>
                        <div
                            class='flex flex-row items-center justify-between w-1/4 bg-white shadow-sm sm:rounded-lg dark:bg-gray-800'>
                            <div class='flex flex-col items-center justify-center w-full p-6'>
                                <p class="p-6 text-gray-900 dark:text-gray-100">
                                    Detalhes da compra
                                </p>

                                <div class='flex flex-col justify-start w-full mb-6'>
                                    <div class='flex justify-between w-full'>
                                        <p class='justify-start text-sm text-gray-900 dark:text-gray-100'>SubTotal:</p>
                                        <p class='justify-start text-sm text-gray-900 dark:text-gray-100'>80.99</p>
                                    </div>
                                    <div class='flex justify-between w-full'>
                                        <p class='justify-start text-sm text-gray-900 dark:text-gray-100'>Desconto:</p>
                                        <p class='justify-start text-sm text-gray-900 dark:text-gray-100'>2.99</p>
                                    </div>
                                    <div class='flex justify-between w-full'>
                                        <p class='justify-start text-sm text-gray-900 dark:text-gray-100'>Total:</p>
                                        <p class='justify-start text-sm text-gray-900 dark:text-gray-100'>78.00</p>
                                    </div>
                                </div>

                                <button
                                    class='justify-center w-full p-2 mx-auto bg-gray-600 rounded-lg dark:text-gray-100'>
                                    Enviar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>

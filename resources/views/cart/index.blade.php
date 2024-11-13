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
                            <div class="flex flex-row items-center justify-between w-full h-32 px-6 bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                                <select name="product_id"
                                    id="productSelect"
                                    class="w-full py-2 border border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                                    <option selected disabled value="">Selecione um Produto</option>
                                    @foreach ($data as $row)
                                    <option class="text-white bg-gray-600" value="{{ $row->id }}" data-price="{{ $row->sell_price }}">
                                        {{ $row->name }}
                                        R$ {{ $row->sell_price }}
                                    </option>
                                    @endforeach
                                </select>
                                <p class="p-6 text-white dark:text-gray-100">
                                    <input id="quantityInput" type="number" class='text-white bg-gray-600 rounded' />
                                </p>
                                <button id="addProductButton"
                                    class="justify-center w-1/4 p-2 mx-auto bg-gray-600 rounded-lg dark:text-gray-100">
                                    <i class="ph ph-plus"></i>
                                </button>
                            </div>
                            <div id="productList" class="flex flex-col items-center justify-center w-full p-6 border border-gray-300 dark:border-gray-600">
                                <!-- Produtos adicionados serão exibidos aqui -->
                            </div>
                        </div>
                        <div class='flex flex-row items-center justify-between w-1/4 bg-white shadow-sm sm:rounded-lg dark:bg-gray-800'>
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

<script>
    document.getElementById('addProductButton').addEventListener('click', function(event) {
        event.preventDefault();

        const productSelect = document.getElementById('productSelect');
        const quantityInput = document.getElementById('quantityInput');
        const productList = document.getElementById('productList');

        // Obtenha o produto selecionado e a quantidade
        const selectedOption = productSelect.options[productSelect.selectedIndex];
        const productName = selectedOption.textContent.split('-')[0].trim();
        const productPrice = parseFloat(selectedOption.getAttribute('data-price'));
        const quantity = parseInt(quantityInput.value) || 1;
        const totalPrice = (productPrice * quantity).toFixed(2);

        // Cria o novo item de produto com o layout desejado
        const productItem = document.createElement('div');
        productItem.classList.add('flex', 'flex-row', 'items-center', 'justify-between', 'w-3/4', 'h-32', 'px-6', 'bg-white', 'shadow-sm', 'sm:rounded-lg', 'dark:bg-gray-800', 'mt-4');
        productItem.innerHTML = `
            <img src="https://picsum.photos/200/300" class="w-32 h-32 p-4 rounded-full" alt="" />
            <p class="p-6 text-gray-900 dark:text-gray-100">${productName}</p>
            <p class="p-6 text-gray-900 dark:text-gray-100">
                <input type="number" value="${quantity}" class="text-white bg-gray-600 rounded w-16" />
            </p>
            <p class="p-6 text-gray-900 dark:text-gray-100">R$ ${totalPrice}</p>
            <button class="text-gray-900 dark:text-gray-100 cursor-pointer" onclick="this.parentElement.remove()">
                        <i class="ph ph-trash text-gray-900 dark:text-gray-100 cursor-pointer"></i>
            </button>
        `;

        // Adiciona o item à lista de produtos
        productList.appendChild(productItem);

        // Limpa os campos
        productSelect.selectedIndex = 0;
        quantityInput.value = '';
    });
</script>
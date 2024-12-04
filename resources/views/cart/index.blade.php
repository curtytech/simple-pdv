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
                            <div class="flex flex-row items-center justify-between w-full h-32  bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                                <!-- <img
                                class="w-12 h-12 object-cover rounded-full mr-4"
                                src="{{ Storage::url('products/2FLad9Bmp8jBdnwucko6V2KK8w3CLYCSZzhNv3lt.jpg') }}" alt=""> -->
                                <select
                                    name="product_id"
                                    id="productSelect"
                                    class="w-full py-2 border border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                                    <option selected disabled value="">Selecione um Produto</option>
                                    @foreach ($data as $row)
                                    <option class="text-white bg-gray-600" value="{{ $row->id }}" data-price="{{ $row->sell_price }}" data-image="{{ Storage::url($row->image) }}">
                                        {{ $row->name }}
                                        R$ {{ $row->sell_price }}
                                    </option>
                                    @endforeach
                                </select>
                                <p class="p-6 text-white dark:text-gray-100">
                                    <input id="quantityInput" type="number" value="1" min="1" class='text-white bg-gray-700 rounded' />
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
                                        <p id="subtotal" class='justify-start text-sm text-gray-900 dark:text-gray-100'>0.0</p>
                                    </div>
                                    <div class='flex justify-between w-full'>
                                        <p class='justify-start text-sm text-gray-900 dark:text-gray-100'>Desconto:</p>
                                        <p id="discount" class='justify-start text-sm text-gray-900 dark:text-gray-100'>0.0</p>
                                    </div>
                                    <div class='flex justify-between w-full'>
                                        <p class='justify-start text-sm text-gray-900 dark:text-gray-100'>Total:</p>
                                        <p id="total" class='justify-start text-sm text-gray-900 dark:text-gray-100'></p>
                                    </div>
                                </div>

                                <button id="saveSaleButton" class='justify-center w-full p-2 mx-auto bg-gray-600 rounded-lg dark:text-gray-100'>
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
    $('#productSelect').change(function() {
        var selectedValue = $(this).val(); // Obtém o valor do item selecionado
        console.log("Produto selecionado: " + selectedValue);
    });
</script>
<script>
    document.getElementById('addProductButton').addEventListener('click', function(event) {
        event.preventDefault();

        const productSelect = document.getElementById('productSelect');
        const quantityInput = document.getElementById('quantityInput');
        const productList = document.getElementById('productList');
        const SubTotalElement = document.getElementById('subtotal');

        if (productSelect.value === '') {
            Toastify({
                text: "Selecione um produto.",
                className: "warning",
                style: {
                    background: "#c2410c",
                    color: "#fff",
                    padding: "10px",
                    borderRadius: "5px",
                    fontWeight: "bold",
                }
            }).showToast();
            return;
        }

        // Obtenha o produto selecionado e a quantidade
        const selectedOption = productSelect.options[productSelect.selectedIndex];
        const productId = productSelect.value; // ID do produto
        const productName = selectedOption.textContent.split('-')[0].trim();
        const productPrice = parseFloat(selectedOption.getAttribute('data-price'));
        const productImage = selectedOption.getAttribute('data-image');

        const quantity = parseInt(quantityInput.value) || 1;
        const totalPrice = (productPrice * quantity).toFixed(2);

        // Cria o novo item de produto com o layout desejado
        const productItem = document.createElement('div');
        productItem.classList.add('flex', 'flex-row', 'items-center', 'justify-between', 'w-full', 'bg-white', 'shadow-sm', 'sm:rounded-lg', 'dark:bg-gray-800', 'mt-4');
        productItem.setAttribute('data-id', productId); // Armazena o ID do produto no atributo
        productItem.innerHTML = `
            <img src="{{ Storage::url($row->image) }}" class="w-12 h-12 object-cover rounded-full" alt="" />
            <p class="flex-1 p-6 text-gray-900 dark:text-gray-100 text-ellipsis overflow-hidden whitespace-nowrap">${productName}</p>
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

        // Atualiza o total acumulado
        updateTotal();

        function updateTotal() {
            let total = 0;
            const productItems = productList.querySelectorAll('div'); // Seleciona todos os produtos na lista
            productItems.forEach(item => {
                const priceText = item.querySelector('p:nth-child(4)').innerHTML; // Obtém o valor do total de cada item
                const price = parseFloat(priceText.replace('R$ ', '').replace(',', '.'));
                total += price;
            });

            // Atualiza o valor total na interface
            SubTotalElement.textContent = `R$ ${total.toFixed(2)}`;
        }
    });

    // Salvar a venda
    document.getElementById('saveSaleButton').addEventListener('click', function() {
        const productList = document.getElementById('productList');
        const saleData = [];

        // Itera pelos itens na lista de produtos
        const productItems = productList.querySelectorAll('div');
        productItems.forEach(item => {
            const productId = item.getAttribute('data-id'); // Obtém o ID do produto
            const quantity = item.querySelector('input[type="number"]').value; // Obtém a quantidade

            saleData.push({
                id: productId,
                quantity: parseInt(quantity)
            });
        });

        console.log('Dados da venda:', saleData);

        $.ajax({
            url: '/sendcart',
            type: 'POST', 
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: JSON.stringify({
                products: saleData
            }), 
            contentType: 'application/json', 
            success: function(response) {
                console.log('Venda salva com sucesso!', response);
            },
            error: function(xhr, status, error) {
                console.error('Erro ao salvar a venda:', error);
            }
        });
    });
</script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Compras') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ open: false, openEdit: false, currentProduct: {} }">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="flex justify-end p-4">
                    <button @click="open = true"
                        class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                        Criar Registro de Compra
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-gray-800">
                        <thead>
                            <tr class="text-gray-800 bg-gray-200 dark:bg-gray-700 dark:text-gray-200">
                                <th class="px-4 py-2 text-left">Produto</th>
                                <th class="px-4 py-2 text-left">Comprador</th>
                                <th class="px-4 py-2 text-left">Preço</th>
                                <th class="px-4 py-2 text-left">Quantidade</th>
                                <th class="px-4 py-2 text-left text-center">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 dark:text-gray-300">
                            @foreach ($data as $row)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <td class="px-4 py-2 border-b border-gray-300">{{ $row->product->name }}</td>
                                    <td class="px-4 py-2 border-b border-gray-300"> {{ $row->user->name }}</td>
                                    <td class="px-4 py-2 border-b border-gray-300">R$:
                                        {{ number_format($row->buy_price, 2, ',', '.') }}</td>
                                    <td class="px-4 py-2 border-b border-gray-300">{{ $row->quantity }}</td>
                                    <td class="flex gap-3 border-b border-gray-300">
                                        <a @click="currentProduct = {{ json_encode($row) }}; openEdit = true"
                                            class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                            <i class="ph ph-pencil"></i> Editar
                                        </a>
                                        <button type="button"
                                            class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">
                                            <i class="ph ph-trash"></i> Excluir
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal de Criação -->
        <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-600 bg-opacity-50"
            style="display: none;">
            <div class="w-full max-w-lg p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
                <h2 class="mb-4 text-xl font-semibold text-gray-800 dark:text-gray-200"> Nova Registro de Compra</h2>
                <form action="{{ route('buys.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-gray-300">Usuário</label>
                        <select name="user_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                            <option value="">Selecione um Usuário</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-gray-300">Produto</label>
                        <select name="product_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                            <option value="">Selecione um Produto</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-gray-300">Quantidade</label>
                        <input type="number" name="quantity"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"
                            placeholder="Digite a quantidade">
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-gray-300">Preço de
                            Compra</label>
                        <input type="text" name="buy_price"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"
                            placeholder="Digite o preço de compra">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" @click="open = false"
                            class="px-4 py-2 mr-2 font-bold text-white bg-gray-500 rounded hover:bg-gray-700">Cancelar</button>
                        <button type="submit"
                            class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Salvar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal de Edição -->
        <div x-show="openEdit" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-600 bg-opacity-50"
            style="display: none;">
            <div class="w-full max-w-lg p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
                <h2 class="mb-4 text-xl font-semibold text-gray-800 dark:text-gray-200">Editar Produto</h2>
                <form method="POST" :action="`{{ url('buys') }}/${currentProduct.id}`"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-gray-300">Usuário</label>
                        <select name="user_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                            <option value="">Selecione um Usuário</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-gray-300">Produto</label>
                        <select name="product_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200">
                            <option value="">Selecione um Produto</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-gray-300">Quantidade</label>
                        <input type="number" name="quantity"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"
                            placeholder="Digite a quantidade">
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-gray-300">Preço de
                            Compra</label>
                        <input type="text" name="buy_price"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"
                            placeholder="Digite o preço de compra">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" @click="openEdit = false"
                            class="px-4 py-2 mr-2 font-bold text-white bg-gray-500 rounded hover:bg-gray-700">Cancelar</button>
                        <button type="submit"
                            class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('.min-w-full').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "Nenhum registro encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtrado de _MAX_ registros no total)",
                "search": "Pesquisar:",
                "paginate": {
                    "next": "Próximo",
                    "previous": "Anterior"
                }
            }
        });
    });
</script> -->

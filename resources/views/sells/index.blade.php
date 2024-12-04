<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Vendas') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ open: false, openEdit: false, currentProduct: {} }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-end p-4">
                
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-gray-800">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                                <th class="py-2 px-4 text-center">Vendido por</th>
                                <th class="py-2 px-4 text-center">Produto</th>
                                <th class="py-2 px-4 text-center">Preço</th>
                                <th class="py-2 px-4 text-center">Quantidade</th>
                                <th class="py-2 px-4 text-center">Data</th>
                                <th class="py-2 px-4 text-center">Total</th>
                                <!-- <th class="py-2 px-4 text-center">Ação</th> -->
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 dark:text-gray-300">
                            @foreach ($data as $row)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                <td class="py-2 px-4 text-center border-b border-gray-300">{{ $row->user->name }}</td>
                                <td class="py-2 px-4 text-center border-b border-gray-300">{{ $row->product->name }}</td>
                                <td class="py-2 px-4 text-center border-b border-gray-300">R$: {{ number_format($row->sell_price, 2, ',', '.') }}</td>
                                <td class="py-2 px-4 text-center border-b border-gray-300">{{ $row->quantity }}</td>
                                <td class="py-2 px-4 text-center border-b border-gray-300">{{ $row->created_at->format('d/m/Y') }}</td>
                                <td class="py-2 px-4 text-center border-b border-gray-300">R$: {{ number_format($row->quantity * $row->sell_price, 2, ',', '.') }}</td>
                                <!-- <td class="flex gap-3 border-b border-gray-300 justify-center">
                                    <a @click="currentProduct = {{ json_encode($row) }}; openEdit = true" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        <i class="ph ph-pencil"></i> Editar
                                    </a>                                   
                                </td> -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
     
    </div>
</x-app-layout>

<script src="//unpkg.com/alpinejs" defer></script>
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
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Produtos') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ open: false, openEdit: false, currentProduct: {} }">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="flex justify-end p-4">
                    <button @click="open = true"
                        class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                        Criar Produto
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-gray-800">
                        <thead>
                            <tr class="text-gray-800 bg-gray-200 dark:bg-gray-700 dark:text-gray-200">
                                <th class="px-4 py-2 text-center">Nome</th>
                                <th class="px-4 py-2 text-center">Preço</th>
                                <th class="px-4 py-2 text-center">Descrição</th>
                                <th class="px-4 py-2 text-center">Código de Barras</th>
                                <th class="px-4 py-2 text-center">Ação</th>
                            </tr>
                        </thead>

                        <tbody class="text-gray-600 dark:text-gray-300">
                            @foreach ($data as $row)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                <td class="px-4 text-center py-2 border-b border-gray-300">
                                    {{ $row->name }}
                                </td>

                                <td class="px-4 text-center py-2 border-b border-gray-300">
                                    R$ {{ number_format($row->sell_price, 2, ',', '.') }}
                                </td>

                                <td class="px-4 text-center py-2 border-b border-gray-300">
                                    {{ $row->description }}
                                </td>

                                <td class="px-4 text-center py-2 border-b border-gray-300">
                                    {{ $row->barcode }}
                                </td>
                                <td class="flex gap-3 text-center border-b border-gray-300 justify-center">
                                    <a @click="currentProduct = {{ json_encode($row) }}; openEdit = true"
                                        class="my-2 px-4 py-1 cursor-pointer font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                                        <i class="ph ph-pencil"></i>
                                        Editar
                                    </a>
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
                <h2 class="mb-4 text-xl font-semibold text-gray-800 dark:text-gray-200">Novo Produto</h2>
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4 flex">
                        <div class="flex flex-row flex-grow  mr-4 w-1/4 ">
                            <div x-data="{ files: null }" id="FileUpload"
                                class="block w-full py-2 px-3 relative bg-gray-700 appearance-none border-2 border-gray-300 border-solid rounded-md hover:shadow-outline-gray">
                                <input type="file" multiple name="image"
                                    class="absolute inset-0 z-50 m-0 p-0 w-full h-full outline-none opacity-0"
                                    x-on:change="files = $event.target.files; console.log($event.target.files);"
                                    x-on:dragover="$el.classList.add('active')" x-on:dragleave="$el.classList.remove('active')" x-on:drop="$el.classList.remove('active')">
                                <template x-if="files !== null">
                                    <div class="flex flex-col space-y-1">
                                        <template x-for="(_,index) in Array.from({ length: files.length })">
                                            <div class="flex flex-row items-center space-x-2">
                                                <template
                                                    x-if="files[index].type.includes('audio/')"><i class="far fa-file-audio fa-fw"></i></template>
                                                <template
                                                    x-if="files[index].type.includes('application/')"><i class="far fa-file-alt fa-fw"></i></template>
                                                <template
                                                    x-if="files[index].type.includes('image/')"><i class="far fa-file-image fa-fw"></i></template>
                                                <template
                                                    x-if="files[index].type.includes('video/')"><i class="far fa-file-video fa-fw"></i></template>
                                                <span class="font-medium text-gray-900" x-text="files[index].name">Uploading</span>
                                                <span class="text-xs self-end text-gray-500" x-text="filesize(files[index].size)">...</span>
                                            </div>
                                        </template>
                                    </div>
                                </template>
                                <template x-if="files === null">
                                    <div class="flex flex-col space-y-1 items-center justify-center" title="Arraste ou selecione uma imagem.">
                                        <i class="ph ph-cloud-arrow-up text-5xl text-white"></i>
                                        <!-- <p class="text-base text-white">Arraste ou selecione uma imagem.</p> -->
                                        <!-- <a href="javascript:void(0)"
                                                class="flex items-center mx-auto py-2 px-4 text-white text-center font-medium border border-transparent rounded-md outline-none bg-red-700">Select
                                                a file</a> -->
                                    </div>
                                </template>
                            </div>
                        </div>
                        <div class="w-3/4">
                            <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-gray-300">Nome do
                                Produto</label>
                            <input type="text" name="name"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"
                                placeholder="Digite o nome do produto">
                        </div>
                    </div>


                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-gray-300">Código de
                            Barras</label>
                        <input type="number" name="barcode"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"
                            placeholder="Digite o código de barra">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-gray-300">Preço de
                            Venda</label>
                        <input type="text" name="sell_price"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"
                            placeholder="Digite o preço de Venda">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-gray-300">Descrição</label>
                        <textarea name="description" placeholder="Digite a descrição"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"></textarea>
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

                <form method="POST" :action="`{{ url('products') }}/${currentProduct.id}`"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                
                    <div class="mb-4 flex">
                        <div class="flex flex-row flex-grow  mr-4 w-1/4 ">
                            <div x-data="{ files: null }" id="FileUpload"
                                class="block w-full py-2 px-3 relative bg-gray-700 appearance-none border-2 border-gray-300 border-solid rounded-md hover:shadow-outline-gray">
                                <input type="file" multiple
                                    class="absolute inset-0 z-50 m-0 p-0 w-full h-full outline-none opacity-0"
                                    x-on:change="files = $event.target.files; console.log($event.target.files);"
                                    x-on:dragover="$el.classList.add('active')" x-on:dragleave="$el.classList.remove('active')" x-on:drop="$el.classList.remove('active')">
                                <template x-if="files !== null">
                                    <div class="flex flex-col space-y-1">
                                        <template x-for="(_,index) in Array.from({ length: files.length })">
                                            <div class="flex flex-row items-center space-x-2">
                                                <template
                                                    x-if="files[index].type.includes('audio/')"><i class="far fa-file-audio fa-fw"></i></template>
                                                <template
                                                    x-if="files[index].type.includes('application/')"><i class="far fa-file-alt fa-fw"></i></template>
                                                <template
                                                    x-if="files[index].type.includes('image/')"><i class="far fa-file-image fa-fw"></i></template>
                                                <template
                                                    x-if="files[index].type.includes('video/')"><i class="far fa-file-video fa-fw"></i></template>
                                                <span class="font-medium text-gray-900" x-text="files[index].name">Uploading</span>
                                                <span class="text-xs self-end text-gray-500" x-text="filesize(files[index].size)">...</span>
                                            </div>
                                        </template>
                                    </div>
                                </template>
                                <template x-if="files === null">
                                    <div class="flex flex-col space-y-1 items-center justify-center" title="Arraste ou selecione uma imagem.">
                                        <i class="ph ph-cloud-arrow-up text-5xl text-white"></i>
                                        <!-- <p class="text-base text-white">Arraste ou selecione uma imagem.</p> -->
                                        <!-- <a href="javascript:void(0)"
                                                class="flex items-center mx-auto py-2 px-4 text-white text-center font-medium border border-transparent rounded-md outline-none bg-red-700">Select
                                                a file</a> -->
                                    </div>
                                </template>
                            </div>
                        </div>
                        <div class="w-3/4">
                            <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-gray-300">Nome do
                                Produto</label>
                                <input type="text" name="name" x-model="currentProduct.name"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"
                                placeholder="Digite o nome do produto">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-gray-300">Código de
                            Barras</label>
                        <input type="number" name="barcode" x-model="currentProduct.barcode"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"
                            placeholder="Digite o código de barra">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-gray-300">Preço de
                            Venda</label>
                        <input type="text" name="sell_price" x-model="currentProduct.sell_price"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"
                            placeholder="Digite o preço de Venda">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-gray-300">Descrição</label>
                        <textarea name="description" x-model="currentProduct.description"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200"
                            placeholder="Digite a descrição"></textarea>
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
<div>
    <?php include base_path('components/header.php'); ?>
</div>
<div class="flex space-x-4 w-full justify-center px-5 z-0">
    <input type="text" class="input input-bordered w-full " placeholder="Pesquisar...">
    <button class="btn btn-neutral">Buscar</button>
</div>
<div class="flex space-x-4 w-full px-5 z-0 mt-6">
    <ul class="menu bg-white w-56 [&_li>*]:rounded-none p-0 me-auto">
        <li class="bg-gray-300 text-base-200 border-b border-gray-300"><a>Item 1</a></li>
        <li class="border-b border-gray-300 text-base-200"><a>Item 2</a></li>
        <li class="border-b border-gray-300 text-base-200"><a>Item 3</a></li>
        <li class="border-b border-gray-300 text-base-200"><a>Item 2</a></li>
        <li class="border-b border-gray-300 text-base-200"><a>Item 3</a></li>
        <li class="border-b border-gray-300 text-base-200"><a>Item 2</a></li>
        <li class="border-b border-gray-300 text-base-200"><a>Item 3</a></li>
        <li class="border-b border-gray-300 text-base-200"><a>Item 2</a></li>
        <li class="border-b border-gray-300 text-base-200"><a>Item 3</a></li>
    </ul>
    <div class="bg-gray-300 p-4 w-full text-base-300">
        <form>
            <div>
                <label class="label text-base-200 font-bold">Título:</label>
                <input name="title" type="text" class="input w-full bg-white border-base-100" value="Título do Item" />
            </div>
            <div class="mt-6">
                <label class="label text-base-200 font-bold">Nota:</label>
                <textarea name="note" class="textarea w-full bg-white border-base-100" placeholder="Escreva sua nota aqui...">Esta é uma nota de exemplo.</textarea>
            </div>
            <div class="mt-6 flex justify-between">

                <button type="button" class="btn btn-error">Deletar</button>
                <button type="submit" class="btn btn-neutral">Atualizar</button>
            </div>
        </form>
    </div>
</div>
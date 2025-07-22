<h1 class="text-2xl font-bold mt-6">Meus Livros</h1>
<section class="space-4 grid grid-cols-4 gap-4 lg:grid-cols-3 md:grid-cols-2">
     <div class="col-span-2 space-y-4">
    <?php if (count($books) > 0) { ?>
        <?php foreach ($books as $book) { ?>
            <?php include 'components/card-book.php'; ?>
        <?php } ?>
    <?php } else { ?>
        <p>Nenhum dado encontrado!</p>
    <?php } ?>
     </div>
    <div class="col-span-1">

        <h3 class="mb-2 font-bold">Cadastre seu livro:</h3>
                <hr class="mb-2" />
        <form action="/book-make" method="POST">
            <?php
            if ($registerOk = flash()->get('registerOk')) { ?>
                <div class="bg-emerald-500 text-emerald-800 p-2 rounded font-bold">
                    <?= $registerOk ?>
                </div>
            <?php } ?>
            <?php
            if ($validations = flash()->get('registerValidation')) { ?>

                <div class="bg-red-500 text-red-800 p-2 rounded font-bold">
                    <ul>
                        <?php foreach ($validations as $item) { ?>
                            <li>• <?= $item ?></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
            <label class="text-stone-400 mb-3">Título do livro:</label>
            <input type="text" name="title" require placeholder="título" class="w-full border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-2 py-1 mb-3" />
            <label class="text-stone-400 mb-3">Autor do livro:</label>
            <input type="text" name="author" require placeholder="autor" class="w-full border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-2 py-1 mb-3" />
            <label class="text-stone-400 mb-3">Descrição do livro:</label>
            <textarea name="description" require placeholder="descrição" class="w-full border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-2 py-1 mb-3"></textarea>
            <label class="text-stone-400 mb-3">Foto do Livro:</label>
            <input type="text" name="img_url" require placeholder="https://www.url da imagem..." class="w-full border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-2 py-1 mb-3" />
            <button type="submit" class="border-stone-800  border-2 rounded-md bg-stone-700 px-2 py-1 cursor-pointer flex items-center justify-center
                ">Enviar</button>
        </form>
    </div>
    
</section>
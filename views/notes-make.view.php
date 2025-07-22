<div class="flex flex-col w-full h-screen pb-4">
    <?php include base_path('partials/header.php'); ?>

    <div class="flex space-x-4 w-full justify-center px-5 z-0">
        <?php include base_path('partials/search.php'); ?>
    </div>
    <div class="flex flex-grow space-x-4 w-full px-5 z-0 mt-6">
        <ul class="menu bg-white w-56 [&_li>*]:rounded-none p-0 me-auto">
            <li class="bg-gray-300 text-base-200 border-b border-gray-300 font-bold"><a>+ Nova nota</a></li>
            <?php foreach ($notes as $note): ?>
                <li class="border-b border-gray-300 text-base-200"><a><?= $note->title ?></a></li>
            <?php endforeach; ?>
        </ul>
        <div class="bg-gray-300 p-4 w-full text-base-300">
            <form action="/notes" method="POST">
                <?= alertMsg('noteValidation', 'error') ?>
                <div>
                    <label class="label text-base-200 font-bold">Título:</label>
                    <input name="title" type="text" class="input w-full bg-white border-base-100" placeholder="Título do Item" />
                </div>
                <div class="mt-6">
                    <label class="label text-base-200 font-bold">Nota:</label>
                    <textarea name="note" class="textarea w-full bg-white border-base-100" placeholder="Escreva sua nota aqui..."></textarea>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="btn btn-neutral">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
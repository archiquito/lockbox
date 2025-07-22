<div class="flex flex-col w-full h-screen pb-4">
    <?php include base_path('partials/header.php'); ?>
    <?php include base_path('partials/search.php'); ?>

    <?php if (empty($notes)) { ?>
        <div role="alert" class="alert alert-warning z-0 mt-6 mx-6 flex items-center justify-center font-bold">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <span>Nenhum dado encontrado!</span>
        </div>
    <?php } else { ?>
        <div class="flex flex-grow space-x-4 w-full px-5 z-0 mt-6">
            <?php include base_path('partials/menu-notes.php'); ?>
            <div class="bg-gray-300 p-4 w-full text-base-300">
                <form action="/notes/update" method="POST">
                    <input type="hidden" name="id" value="<?= $selectedNote->id ?? '' ?>">
                    <div>
                        <label class="label text-base-200 font-bold">Título:</label>
                        <input
                            name="title"
                            type="text"
                            class="input w-full bg-white border-base-100"
                            value="<?= $selectedNote->title ?? '' ?>"
                            <?php (! session()->get('uncrypt')) && print 'disabled' ?> />
                    </div>
                    <div class="mt-6">
                        <label class="label text-base-200 font-bold">Nota:</label>
                        <textarea
                            name="note"
                            class="textarea w-full bg-white border-base-100"
                            placeholder="Escreva sua nota aqui..."
                            <?php (! session()->get('uncrypt')) && print 'disabled' ?>><?= $selectedNote->note() ?? '' ?></textarea>
                    </div>
                    <div class="mt-6 flex justify-between">

                        <a href="/notes/delete?id=<?= $selectedNote->id ?? '' ?>" class="btn btn-error">Deletar</a>
                        <button type="submit" class="btn btn-neutral disabled:text-gray-400 border-gray-400" <?php (! session()->get('uncrypt')) ? print ('disabled="disabled"') : print '' ?>>Atualizar</button>
                    </div>
                </form>
            </div>
        <?php } ?>
        </div>
</div>
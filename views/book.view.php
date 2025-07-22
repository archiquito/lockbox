<div class="mt-10">
    <?php include 'components/card-book.php'; ?>
</div>

<h2 class="font-bold text-medium">Avaliações</h2>
<hr />
<div class="grid grid-cols-4 gap-4">
    <?php if (count($reviews)) { ?>
        <?php foreach ($reviews as $item) { ?>
            <div class="col-span-3 mr-16">
                <p> <?= $item->review ?> <?= str_repeat('&#9733;', $item->rating) ?></p>
            </div>
        <?php } ?>
    <?php } else { ?>
        <div class="col-span-3">
            <p>Nenhuma avaliação para esse livro</p>
        </div>
    <?php } ?>
    <div>
        <h3 class="font-bold"> Avalie o livro</h3>
        <?php if (flash()->getSession('auth')) { ?>
            <?php
            if ($validations = flash()->get('reviewValidation')) { ?>

                <div class="bg-red-500 text-red-800 p-2 rounded font-bold">
                    <ul>
                        <?php foreach ($validations as $item) { ?>
                            <li>• <?= $item ?></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
            <form action="/review-make" method="POST" class="space-y-4">
                <input type="hidden" name="book_id" value="<?= $book->id ?>" />
                <label class="text-stone-400 mb-3">Avalição:</label>
                <textarea
                    name="review"
                    placeholder="conte o que achou do livro..."
                    class="w-full border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-2 py-1 mb-3"></textarea>
                <label class="text-stone-400 mb-3">Nota:</label>
                <select require name="rating" class="w-full border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-2 py-1 mb-3">
                    <option value="">selecione</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <button
                    type="submit"
                    class="border-stone-800  border-2 rounded-md bg-stone-700 px-2 py-1 cursor-pointer flex items-center justify-center">
                    Enviar
                </button>
            </form>
        <?php } else { ?>
            <p>Faça o login</p>
        <?php } ?>
    </div>

</div>
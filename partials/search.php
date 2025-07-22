<div class="flex space-x-4 w-full justify-center px-5 z-0">
    <form action="/notes" method="GET" class="flex space-x-2 w-full">
        <input name="search" type="text" class="input input-bordered w-full " placeholder="Pesquisar notas..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
    </form>
    <a href="/notes-make" class="btn btn-primary">+ Item</a>
</div>
<?php
$alertMessage = alertMsg('msg', 'success');
if (!empty($alertMessage)): ?>
    <div id="msg" class="flex w-full justify-center px-5 z-0 mt-6 opacity-100 transition-opacity duration-2000 ease-in-out">
        <?= $alertMessage ?>
    </div>
<?php endif ?>
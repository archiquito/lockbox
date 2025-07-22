<ul class="menu bg-white w-56 [&_li>*]:rounded-none p-0 me-auto">
    <?php foreach ($notes as $note): ?>
        <li class="<?php if ($selectedNote && $selectedNote->id == $note->id) echo 'bg-gray-300'; ?> border-b border-gray-300 text-base-200"><a href="/notes?id=<?= $note->id ?>"><?= $note->title ?></a></li>
    <?php endforeach; ?>
</ul>
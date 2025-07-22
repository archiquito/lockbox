<div class="navbar bg-base-100 shadow-sm z-10">
    <div class="flex-1">
        <a href="/notes" class="btn btn-ghost text-xl">LockBox</a>
    </div>
    <div class="flex-none z-10">
        <ul class="menu menu-horizontal px-1">
            <li>
                    <?php
                    if (session()->get('uncrypt')): ?>
                       <a href="/notes/hidden"> <img src="../../assets/images/eye.svg" alt="Eye Icon" class="fill-white" /></a>
                    <?php else: ?>
                        <a href="/notes/show"> <img src="../../assets/images/eye-off.svg" alt="Eye Icon" class="fill-white" /></a>
                    <?php endif; ?>
                </a></li>
            <li>
                <details>
                    <summary><?= $user ?></summary>
                    <ul class="bg-base-100 rounded-t-none p-2">
                        <li><a href="/notes">Notas</a></li>
                        <li><a href="/logout">logout</a></li>
                    </ul>
                </details>
            </li>
        </ul>
    </div>
</div>
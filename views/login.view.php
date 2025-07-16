<div class="hero min-h-screen">
    <div class="hero-content flex-col lg:flex-row">
        <div class="text-center lg:text-left w-full  ">
            <h2>Bem Vindo ao</h2>
            <h1 class="text-5xl font-bold">LockBox!</h1>
        </div>
        <div class="card w-full max-w-sm shrink-0 shadow-2xl bg-white">
            <div class="card-body">
                <p class="font-bold text-black text-xl">Faça seu login:</p>
                <fieldset class="fieldset">
                    <form action="/login" method="POST">
                        <?php
                        if ($validations = flash()->get('loginValidation')): ?>
                            <div role="alert" class="alert alert-error">
                                <ul>
                                    <?php foreach ($validations as $item): ?>
                                        <li class="flex space-x-1"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg> <span class="leading-none"><?= $item ?></span></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        <?php endif ?>
                        <label class="label text-base-200">Seu e-mail:</label>
                        <input name="email" type="email" class="input w-full" placeholder="Email" value="<?=getPost('email')?>" />
                        <label class="label text-base-200 mt-2">Sua senha:</label>
                        <input name="password" type="password" class="input w-full" placeholder="Password" value="<?=getPost('password')?>"/>
                        <div><a class="link link-hover  text-base-200">Forgot password?</a></div>
                        <button type="submit" class="btn btn-neutral mt-4 w-full">Logar</button>
                    </form>
                    <p class="mt-4"><a href="/register" class="link link-primary">Quero me registrar</a></p>
                </fieldset>
            </div>
        </div>
    </div>
</div>
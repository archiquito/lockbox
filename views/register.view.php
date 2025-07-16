<div class="hero min-h-screen">
    <div class="hero-content flex-col lg:flex-row">
        <div class="text-center lg:text-left w-full  ">
            <h2>Bem Vindo ao</h2>
            <h1 class="text-5xl font-bold">LockBox!</h1>
        </div>
        <div class="card w-full max-w-sm shrink-0 shadow-2xl bg-white">
            <div class="card-body">
                <p class="font-bold text-black text-xl">Registrar:</p>
                <fieldset class="fieldset">
                    <form action="/register" method="POST">
                        <?=alertMsg('registerValidation', 'error')?>
                        <label class="label text-base-200">Seu nome:</label>
                        <input name="name" type="text" class="input w-full" placeholder="nome" value="<?=getPost('name')?>" />
                        <label class="label text-base-200">Seu e-mail:</label>
                        <input name="email" type="email" class="input w-full" placeholder="Email" value="<?=getPost('email')?>" />
                        <label class="label text-base-200">Confirme seu e-mail:</label>
                        <input name="confirm_email" type="email" class="input w-full" placeholder="confirme email" />
                        <label class="label text-base-200 mt-2">Sua senha:</label>
                        <input name="password" type="password" class="input w-full" placeholder="Password" />
                        <div><a class="link link-hover  text-base-200">Forgot password?</a></div>
                        <button type="submit" class="btn btn-neutral mt-4 w-full">Registrar</button>
                    </form>
                    <p class="mt-4"><a href="/login" class="link link-primary">Já tenho uma conta</a></p>
                </fieldset>
            </div>
        </div>
    </div>
</div>
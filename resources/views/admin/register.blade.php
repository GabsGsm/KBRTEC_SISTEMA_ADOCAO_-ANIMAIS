<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KBRTEC ADMIN</title>

    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
</head>
<body class="bg-dark">
    <main class="py-5" style="min-height: calc(100vh - 72px);">
        <div class="container">
            <div class="bg-custom mx-auto row col-8 rounded shadow-sm overflow-hidden">
                <div class="col-6 bg-white p-5 d-flex align-items-center justify-content-center">
                    <img src="img/kbrtec.webp" alt="KBRTEC" height="200" width="200" class="object-fit-contain">
                </div>
    
                <div class="col-6 d-flex align-items-center p-5">
                    <form method="POST" action="{{ route('register') }}" class="form w-100">
                         @csrf
                    
                        <h2 class="h4 text-light mb-4">Cadastro de Usuario</h2>
    
                        <div class="row row-gap-3">
                            <div class="col-12 form-group text-light">
                                <label for="name">Nome:</label>
                                <input name="name" :value="old('name')" required autofocus autocomplete="name" type="text" class="form-control bg-dark border-dark text-light" id="name" >
                                <!-- <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">Erro</small> -->
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div class="col-12 form-group text-light">
                                <label for="email">E-mail:</label>
                                <input name="email" :value="old('email')" required autocomplete="username" type="email" class="form-control bg-dark border-dark text-light" id="email" placeholder="example@kbrtec.com.br">
                                <!-- <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">Erro</small> -->
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
    
                            <div class="col-12 form-group text-light">
                                <label for="password">Senha:</label>
                                <input type="password" class="form-control bg-dark border-dark text-light" id="password" name="password" required autocomplete="new-password">
                                <!-- <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">Erro</small> -->
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div class="col-12 form-group text-light">
                                <label for="password_confirmation">Confirme a senha:</label>
                                <input type="password" class="form-control bg-dark border-dark text-light" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                                <!-- <small class="bg-danger rounded py-1 px-2 mt-1 d-block text-light">Erro</small> -->
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
    
                            @if (Route::has('password.request'))
                                    <a href="{{ route('login') }}" class="link-light"><small>Já possui cadastro?</small></a>
                            @endif

                            <div class="col-auto me-3" style="">
                                <button type="submit" class="btn btn-light mt-3">Cadastrar</button>
                            </div>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-custom text-light text-center py-4">
        <small>© Copyright 2023 - KBR TEC - Todos os Direitos Reservados</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
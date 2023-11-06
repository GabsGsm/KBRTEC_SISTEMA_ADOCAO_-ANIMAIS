<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KBRTEC PETS</title>

    <link rel="icon" type="image/x-icon" href="{{asset('img/favicon.ico')}}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bowlby+One&family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <header class="border-bottom-1 shadow py-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-4">
                    <a href="/" title="KBR TEC" class="d-inline-block">
                        <h1>
                            <img src="{{asset('img/logo.webp')}}" alt="KBR TEC" width="150">
                        </h1>
                    </a>
                </div>

                <div class="col-8">
                    <nav class="d-flex gap-4 align-items-center justify-content-end">
                        <a href="/">Home</a>
                        <a href="/quero-adotar">Quero Adotar</a>
                        <a href="/login" class="btn btn-custom">Admin</a>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <section class="position-relative">
        <img src="{{asset('img/banner.webp')}}" alt="Banner Principal" class="w-100">

        <div class="position-absolute top-0 left-0 h-100 w-100">
            <div class="container h-100">
                <div class="d-flex flex-column align-items-start justify-content-center h-100 pb-4">
                    <h2 class="text-uppercase fw-bold bowlby-one">
                        Você pode se <br>
                        <span class="destaque">apaixonar</span> agora <br>
                        por um pet
                    </h2>
    
                    <a href="/quero-adotar" class="btn btn-custom d-flex align-items-center gap-3 mt-4 px-4 text">
                        Buscar um PET

                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="20" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-light py-5">
        <div class="container mb-4 d-flex flex-column align-items-center">
            <h3 class="h5 text-center text-uppercase mb-5 bowlby-one">
                Por que adotar?
            </h3>

            <div class="row">
                <div class="col-4">
                    <div class="d-flex align-items-center h-100 rounded overflow-hidden" style="background-color: #FFE8BA;">
                        <img src="{{asset('img/cartoon-dog.webp')}}" alt="Cachorro em desenho animado" width="130">
                        <p class="m-0 p-3 h-100 d-flex align-items-center bg-white">
                            Nesse exato momento, existem milhares de doguinhos e gatinhos esperando um humano para chamar de seu.
                        </p>
                    </div>
                </div>
                
                <div class="col-4">
                    <div class="d-flex align-items-center h-100 rounded overflow-hidden" style="background-color: #DC9AFE;">
                        <img src="{{asset('img/cartoon-cat.webp')}}" alt="Gato em desenho animado" width="130">
                        <p class="m-0 p-3 h-100 d-flex align-items-center bg-white">
                            E não há recompensa maior do que vê-los se tornando aquela coisinha alegre e saudável depois de uma boa dose de cuidado e carinho.
                        </p>
                    </div>
                </div>

                <div class="col-4">
                    <div class="d-flex align-items-center h-100 rounded overflow-hidden" style="background-color: #84FBFF;">
                        <img src="{{asset('img/cartoon-cat-2.webp')}}" alt="Gato em desenho animado" width="130">
                        <p class="m-0 p-3 h-100 d-flex align-items-center bg-white">
                            Pensando bem, a pergunta é outra: se você pode mudar o destino de um animal de rua, por que não faria isso?
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <p class="m-0">
                    Copyright © 2023. Todos os direitos reservados
                </p>

                <a href="https://www.kbrtec.com.br/" target="_blank" title="Acesse o site da KBR TEC">
                    <img src="{{asset('img/kbrtec.webp')}}" alt="KBRTEC" width="100">
                </a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
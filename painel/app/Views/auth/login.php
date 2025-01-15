<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= csrf_hash() ?>">
    <title>Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center min-vh-100 align-items-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4">Login</h2>
                        <form id="loginForm" novalidate>
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="email" required>
                                <div class="invalid-feedback">
                                    Por favor, insira um e-mail válido.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="password" minlength="8" required>
                                <div class="invalid-feedback">
                                    A senha deve ter no mínimo 8 caracteres.
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-3">Entrar</button>
                            <!--
                            <div class="text-center">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#recoveryModal">
                                    Esqueci minha senha
                                </a>
                            </div>
                            -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Recuperação de Senha -->
    <!--
    <div class="modal fade" id="recoveryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Recuperação de Senha</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="recoveryForm" novalidate>
                        <div class="mb-3">
                            <label for="recoveryEmail" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="recoveryEmail" required>
                            <div class="invalid-feedback">
                                Por favor, insira um e-mail válido.
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/js/login.js') ?>"></script>
</body>
</html>
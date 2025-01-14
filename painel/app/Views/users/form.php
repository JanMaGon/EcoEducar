<div class="col py-3">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><?= isset($painel_user) ? 'Editar Usuário' : 'Novo Usuário' ?></h2>
        </div>
        
        <?php if(session()->has('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <?php if(session()->has('message')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session('message') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form id="userForm" action="<?= isset($painel_user) ? base_url('users/update/'.$painel_user['id']) : base_url('users/create-user') ?>" method="POST" class="needs-validation" novalidate>
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= isset($painel_user) ? $painel_user['name'] : old('name') ?>" required minlength="3" maxlength="100">
                                <div class="invalid-feedback">
                                    O Nome é obrigatório e deve ter entre 3 e 255 caracteres.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= isset($painel_user) ? $painel_user['email'] : old('email') ?>" required>
                                <div class="invalid-feedback">
                                    O e-mail é obrigatório e deve ter entre 3 e 100 caracteres.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="password" name="password" value="<?= isset($painel_user) ? $painel_user['password'] : old('password') ?>" required minlength="8">
                                <div class="invalid-feedback">
                                    A senha deve ter no mínimo 8 caracteres.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Tipo de usuário</label>                                
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="user" value="user" <?= (isset($painel_user) && $painel_user['role'] == 'user') ? 'checked' : 'checked' ?>>
                                    <label class="form-check-label" for="user">
                                        User (gerencia seu perfil e seus posts criados)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" id="admin" value="admin" <?= (isset($painel_user) && $painel_user['role'] == 'admin') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="admin">
                                        Admin (permissão total)
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <?= isset($painel_user) ? 'Atualizar' : 'Criar' ?> Usuário
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
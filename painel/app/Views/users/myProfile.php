<div class="col py-3">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Meu Perfil</h2>
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

        <form id="userForm" action="<?= base_url('users/update/'.$painel_user['id']) ?>" method="POST" class="needs-validation" novalidate>
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
                                <?php if (isset($painel_user)):?>
                                    <div class="d-grid">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#alteraSenhaModal<?= $painel_user['id'] ?>" class="btn btn-success">Alterar senha</a>
                                    </div>
                                <?php else :?>
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="password" name="password" value="" required minlength="8">
                                <div class="invalid-feedback">
                                    A senha deve ter no mínimo 8 caracteres.
                                </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="d-grid">
                        <input type="hidden" name="return" value="myp">
                        <button type="submit" class="btn btn-primary">
                            Atualizar informações do meu perfil
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <?php if (isset($painel_user)):?>
        <div class="modal fade" id="alteraSenhaModal<?= $painel_user['id'] ?>" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Alterar Senha</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form id="userFormPassword" action="<?= base_url('users/update-password/'.$painel_user['id'])?>" method="post" class="needs-validation" novalidate>
                        <div class="modal-body">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Nova Senha</label>
                                        <input type="password" class="form-control" id="password" name="password" value="" required minlength="8">
                                        <div class="invalid-feedback">
                                            A senha deve ter no mínimo 8 caracteres.
                                        </div>
                                    </div>
                                </div>
                            </div>                                                        
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="return_pass" value="myp">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Alterar senha</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endif;?>
    </div>
</div>
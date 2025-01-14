<div class="col py-3">
    <button class="btn btn-dark d-md-none mb-3" id="sidebarToggle">
        <i class="bi bi-list"></i>
    </button>
   
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><?= $title ?? 'Usuários' ?></h2>
            <div>
                <?php if (!$isTrash): ?>
                    <a href="<?= base_url('users/trash') ?>" class="btn btn-warning me-2">
                        <i class="bi bi-trash me-2"></i>Lixeira
                    </a>
                    <a href="<?= base_url('users/create') ?>" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Criar Usuário
                    </a>
                <?php else: ?>
                    <a href="<?= base_url('users') ?>" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Voltar aos Usuários
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('message') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (empty($users)): ?>
            <div class="alert alert-info text-center" role="alert">
                <?php if ($isTrash): ?>
                    <p class="mb-3">A lixeira está vazia.</p>
                <?php else: ?>
                    <p class="mb-3">Nenhum usuário foi criado ainda.</p>
                    <a href="<?= base_url('users/create') ?>" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Criar Primeiro Usuário
                    </a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <?= $isTrash ? 'Usuários na Lixeira' : 'Lista de Usuários' ?>
                    </h5>
                </div>
                <div class="list-group list-group-flush">
                    <?php foreach ($users as $itemuser): ?>
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0"><?= esc($itemuser['name']) ?> | <?= $itemuser['email']?> (<small><b><?= $itemuser['role']?></b></small>)</h6>
                                <div>
                                    <small class="text-muted me-3">
                                        <?php echo '<i>Criado em </i>' . date('d/m/Y', strtotime($itemuser['created_at'])) ?>
                                    </small>
                                    <?php if ($user['role'] === 'admin' || $itemuser['user_id'] === $user['id']): ?>
                                        <?php if ($isTrash): ?>
                                            <a href="<?= base_url('users/restore/' . $itemuser['id']) ?>" 
                                               class="btn btn-sm btn-success me-1">
                                                <i class="bi bi-arrow-counterclockwise"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal<?= $itemuser['id'] ?>">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        <?php else: ?>
                                            <a href="<?= base_url('users/edit/' . $itemuser['id']) ?>" 
                                               class="btn btn-sm btn-primary me-1">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal<?= $itemuser['id'] ?>">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Modal de Confirmação -->
                        <div class="modal fade" id="deleteModal<?= $itemuser['id'] ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Confirmar Exclusão</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php if ($isTrash): ?>
                                            <p>Tem certeza que deseja excluir permanentemente este usuário?</p>
                                            <small class="text-danger">Esta ação não poderá ser desfeita!</small>
                                        <?php else: ?>
                                            <p>Tem certeza que deseja mover este usuário para a lixeira?</p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <?php if ($isTrash): ?>
                                            <a href="<?= base_url('users/forceDelete/' . $itemuser['id']) ?>" 
                                               class="btn btn-danger">Excluir Permanentemente</a>
                                        <?php else: ?>
                                            <a href="<?= base_url('users/delete/' . $itemuser['id']) ?>" 
                                               class="btn btn-danger">Mover para Lixeira</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Paginação -->
            <div class="mt-4">
                <?= $pager->links() ?>
            </div>
        <?php endif; ?>
    </div>
</div>
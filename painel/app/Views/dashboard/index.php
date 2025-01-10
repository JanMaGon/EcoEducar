<!-- Conteúdo principal -->
<div class="col py-3">
    <!-- Toggle Button -->
    <button class="btn btn-dark d-md-none mb-3" id="sidebarToggle">
        <i class="bi bi-list"></i>
    </button>
   
    <!-- Page Content -->
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><?= $title ?? 'Dashboard' ?></h2>
            <a href="<?= base_url('posts/create') ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Criar Post
            </a>
        </div>

        <?php if (empty($posts)): ?>
            <div class="alert alert-info text-center" role="alert">
                <p class="mb-3">Nenhum post foi criado ainda.</p>
                <a href="<?= base_url('posts/create') ?>" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Criar Primeiro Post
                </a>
            </div>
        <?php else: ?>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Últimos Posts</h5>
                </div>
                <div class="list-group list-group-flush">
                    <?php foreach ($posts as $post): ?>
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0"><?= esc($post['title']) ?></h6>
                                <small class="text-muted">
                                    <?= date('d/m/Y', strtotime($post['created_at'])) ?>
                                </small>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
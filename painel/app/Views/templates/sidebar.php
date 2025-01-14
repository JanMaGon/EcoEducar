        <!-- Sidebar -->
        <div class="sidebar col-auto px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="<?= base_url()?>" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Painel Ecoeducar</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="<?= base_url()?>" class="nav-link active">
                                <i class="bi bi-house"></i>
                                <span class="ms-1 d-none d-sm-inline">Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('posts')?>" class="nav-link">
                                <i class="bi bi-file-post"></i>
                                <span class="ms-1 d-none d-sm-inline">Posts</span>
                            </a>
                        </li>
                        <?php if ($user['role'] === 'admin'): ?>
                        <li>
                            <a href="<?= base_url('users')?>" class="nav-link">
                                <i class="bi bi-people"></i>
                                <span class="ms-1 d-none d-sm-inline">Usuários</span>
                            </a>
                        </li>
                        <?php elseif ($user['role'] === 'user'):?>
                        <li>
                            <a href="<?= base_url('my-profile')?>" class="nav-link">
                                <i class="bi bi-people"></i>
                                <span class="ms-1 d-none d-sm-inline">Meu Perfil</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <li>
                            <a href="<?= base_url('logout') ?>" class="nav-link">
                                <i class="bi bi-box-arrow-right"></i>
                                <span class="ms-1 d-none d-sm-inline">Sair</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

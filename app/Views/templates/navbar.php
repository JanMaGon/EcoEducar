    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>"><img src="<?= base_url('assets/image/logo-x1.png') ?>" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item fw-semibold">
                        <a class="nav-link <?= (uri_string() == '' || uri_string() == '/') ? 'active' : '' ?>" href="<?= base_url() ?>">Página Inicial</a>
                    </li>
                    <li class="nav-item fw-semibold">
                        <a class="nav-link <?= (uri_string() == 'sobre-o-projeto') ? 'active' : '' ?>" href="<?= base_url('sobre-o-projeto') ?>">Sobre o Projeto</a>
                    </li>
                    <li class="nav-item fw-semibold">
                        <a class="nav-link <?= (uri_string() == 'blog') ? 'active' : '' ?>" href="<?= base_url('blog') ?>">Blog</a>
                    </li>
                    <li class="nav-item fw-semibold">
                        <a class="nav-link <?= (uri_string() == 'locais-de-descarte') ? 'active' : '' ?>" href="<?= base_url('locais-de-descarte') ?>">Locais de Descarte</a>
                    </li>
                    <li class="nav-item fw-semibold">
                        <a class="nav-link <?= (uri_string() == 'participe') ? 'active' : '' ?>" href="<?= base_url('participe') ?>">Participe</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
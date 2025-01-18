    <!-- Hero Section -->
    <section class="banner text-center">
        <picture>
            <!-- Imagem para telas maiores que 576px -->
            <source srcset="<?= base_url('assets/image/banners/banner_2543px.png')?>" media="(min-width: 577px)">
            <!-- Imagem para telas menores ou iguais a 576px -->
            <source srcset="<?= base_url('assets/image/banners/banner_576px.png')?>" media="(max-width: 576px)">
            <!-- Imagem padrão (fallback) -->
            <img src="<?= base_url('assets/image/banners/banner_2543px.png')?>" alt="">
        </picture>      
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    &nbsp;
                </div>
                <div class="col-md-6 about-section-text">
                    <h2>Descarte responsável</h2>
                    <h4 class="pt-4">Gestão adequada dos resíduos</h4>
                    <p>Locais de descarte de resíduos desempenham um papel crucial nesse processo, sendo espaços destinados à coleta, tratamento e disposição final dos materiais descartados pela sociedade.</p>
                    <div class="d-flex justify-content-end mt-3">
                        <a href="<?= base_url('locais-de-descarte') ?>" class="btn btn-custom">Veja os locais de descarte</a>
                    </div>
                </div>
            </div>            
        </div>
    </section>

    <!-- Blog Section -->
    <section class="blog-section py-5">
        <div class="container">
            <h2 class="text-center mb-4">Blog</h2>
            <h1 class="text-center mb-5 fw-bold">Nossas atividades recentes</h1>
            <div class="row py-5">
                <?php foreach ($posts as $post):?>
                <div class="col-sm-12 col-xl-4 mb-5">
                    <div class="card blog-card">
                        <?php 
                            if (empty($post['cover_type'])) {
                                echo '<img src="'.base_url('assets/image/post-sem-capa.jpg').'" class="card-img-top" alt="Sem Imagem de capa">';
                            } elseif ($post['cover_type'] === 'image') {
                                echo '<img src="'.base_url('assets/image/posts/covers/'.$post['cover_content']).'" class="card-img-top" alt="Sem Imagem de capa">';
                            } else {
                                $embedCode = generateVideoEmbedCode($post['cover_content'], '215');
                                if ($embedCode) {
                                    echo $embedCode;
                                } else {
                                    echo '<img src="'.base_url('assets/image/post-sem-capa.jpg').'" class="card-img-top" alt="Sem Imagem de capa">';
                                }
                            }
                        ?>                        
                        <div class="card-body">
                            <h5 class="card-title"><?= $post['title']?></h5>
                            <p class="card-text"><?= truncateText($post['content']) ?></p>
                            <div class="d-flex justify-content-end mt-3">
                                <a href="<?= base_url('blog/post/' . $post['id'] . '/' . generateSlug($post['title'])) ?>" class="btn btn-custom">Continuar lendo</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>                
            </div>
        </div>
    </section>

    <!-- Education Section -->
    <section class="education-section my-5 py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7 col-sm-12">
                    <h1 class="fw-bold">Programas educativos</h1>
                    <p>
                        A educação ambiental desempenha um papel crucial na construção de uma 
                        sociedade sustentável e consciente do impacto humano no meio ambiente. Trata-se de um 
                        processo contínuo que visa sensibilizar, informar e envolver indivíduos em práticas que promovam a 
                        preservação dos recursos naturais, a biodiversidade e a qualidade de vida das gerações presentes e futuras.
                    </p>
                </div>
                <div class="col-md-5 col-sm-12 d-flex justify-content-center">
                    <img src="<?= base_url('assets/image/educacao-ambiental.png')?>" alt="">
                </div>
            </div>
        </div>
    </section>


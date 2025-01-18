    <section class="title-section">
        <h1 class="fw-bold text-center py-5">Blog</h1>
    </section>

    <!-- Blog Section -->
    <section class="blog-section blog-page py-5">
        <div class="container">
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
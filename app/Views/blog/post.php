    <section class="title-section">
        <h1 class="fw-bold text-center py-5">Blog / <small>Post</small></h1>
    </section>
    <section class="post-page py-5">
        <div class="container">
            <h1 class="fw-bold"><?= $post['title']?></h1>
            <p class="author-post">Criado por: <span class="fw-semibold"><?= $post['author_name']?></span></p>
            <p class="data-post">Publicado em: <i><?php echo date('d/m/Y', strtotime($post['created_at']));?></i></p>
            <div class="row mt-5">
                <div class="col-md-12">
                    <?php 
                        if ($post['cover_type'] === 'image') {
                            echo '<img src="'.base_url('assets/image/posts/covers/'.$post['cover_content']).'" class="card-img-top" alt="Sem Imagem de capa">';
                        } elseif ($post['cover_type'] === 'video') {
                            $embedCode = generateVideoEmbedCode($post['cover_content'], '450');
                            if ($embedCode) {
                                echo $embedCode;
                            }
                        }
                    ?>
                </div>
                <?php if (!empty($gallery)): ?>
                    <div class="col-md-12 mt-5">
                        <div class="row">
                            <?php foreach ($gallery as $image): ?>
                                <div class="col-md-2 mb-4">
                                    <a href="<?= base_url('assets/image/posts/gallery/' . $image['image_name']) ?>" data-lightbox="gallery" data-title="Imagem do post">
                                        <img src="<?= base_url('assets/image/posts/gallery/' . $image['image_name']) ?>" alt="Thumbnail" class="img-fluid img-thumbnail">
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-md-12 mt-5">
                    <?= $post['content']?>
                </div>
            </div>
        </div>
    </section>
<!-- app/Views/posts/form.php -->
<div class="col py-3">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><?= isset($post) ? 'Editar Post' : 'Novo Post' ?></h2>
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

        <form id="postForm" action="<?= isset($post) ? base_url('posts/update/'.$post['id']) : base_url('posts/create-post') ?>" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="title" class="form-label">Título</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?= isset($post) ? $post['title'] : old('title') ?>" required minlength="3" maxlength="255">
                                <div class="invalid-feedback">
                                    O título é obrigatório e deve ter entre 3 e 255 caracteres.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label">Conteúdo</label>
                                <textarea id="content" name="content" required><?= isset($post) ? $post['content'] : old('content') ?></textarea>
                                <div class="invalid-feedback">
                                    O conteúdo é obrigatório.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="author_name" class="form-label">Nome do Autor</label>
                                <input type="text" class="form-control" id="author_name" name="author_name" value="<?= isset($post) ? $post['author_name'] : old('author_name') ?>" required minlength="3" maxlength="100">
                                <div class="invalid-feedback">
                                    O nome do autor é obrigatório e deve ter entre 3 e 100 caracteres.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Capa</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cover_type" id="noCover" value="" <?= (!isset($post) || !$post['cover_type']) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="noCover">
                                        Sem capa
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cover_type" id="coverImage" value="image" <?= (isset($post) && $post['cover_type'] == 'image') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="coverImage">
                                        Imagem
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cover_type" id="coverVideo" value="video" <?= (isset($post) && $post['cover_type'] == 'video') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="coverVideo">
                                        Vídeo
                                    </label>
                                </div>

                                <div id="coverImageInput" class="mt-3 <?= (isset($post) && $post['cover_type'] == 'image') ? '' : 'd-none' ?>">
                                    <input type="file" class="form-control" name="cover_image" accept=".jpg, .png, .gif" data-max-size="2145728">
                                    <div class="invalid-feedback"></div>
                                    <?php if(isset($post) && $post['cover_type'] == 'image'): ?>
                                        <div class="mt-2">
                                            <?php 
                                                $url_img = 'http://localhost/ecoeducar/assets/image/posts/covers/';
                                                //$url_img  = 'https://ecoeducar.app.br/assets/image/posts/covers/';
                                            ?>
                                            <img src="<?php echo $url_img . $post['cover_content']; ?>" class="img-thumbnail" style="max-width: 200px">
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div id="coverVideoInput" class="mt-3 <?= (isset($post) && $post['cover_type'] == 'video') ? '' : 'd-none' ?>">
                                    <input type="text" class="form-control" name="cover_video" placeholder="URL do vídeo (YouTube/Vimeo)" value="<?= (isset($post) && $post['cover_type'] == 'video') ? $post['cover_content'] : '' ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Galeria de Imagens</h5>
                            <div class="mb-3">
                                <input id="gallery-upload" type="file" name="gallery[]" multiple class="file-loading" accept="image/*">                                
                            </div>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <?= isset($post) ? 'Atualizar' : 'Publicar' ?> Post
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
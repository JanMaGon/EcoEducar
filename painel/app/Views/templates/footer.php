        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Sidebar Toggle Script -->
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
        });
    </script>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-fileinput/js/fileinput.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize CKEditor
            ClassicEditor
                .create(document.querySelector('#content'))
                .catch(error => {
                    console.error(error);
                });           
            // Handle cover type selection
            $('input[name="cover_type"]').on('change', function() {
                $('#coverImageInput').addClass('d-none');
                $('#coverVideoInput').addClass('d-none');
                
                if (this.value === 'image') {
                    $('#coverImageInput').removeClass('d-none');
                } else if (this.value === 'video') {
                    $('#coverVideoInput').removeClass('d-none');
                }
            });
            <?php 
                if (isset($post['id'])){ $post_id = $post['id']; } else { $post_id = 0;}
                
                $url_img = 'http://localhost/ecoeducar/assets/image/posts/gallery/';
                //$url_img  = 'https://ecoeducar.app.br/assets/image/posts/gallery/';
                $doc_root = 'C:/wamp64/www/ecoeducar/public/assets/image/posts/gallery/'; 
                //$doc_root = '/home/storage/6/27/1d/ecoeducar1/public_html/public/assets/image/posts/gallery/'; 
            ?>
            // Inicializar o fileinput
            $("#gallery-upload").fileinput({
                uploadUrl: '<?= base_url('posts/upload-gallery/'.$post_id) ?>', // URL para upload
                uploadAsync: true,
                maxFileCount: 5, // Número máximo de arquivos
                allowedFileTypes: ['image'], // Tipos de arquivos permitidos
                maxFileSize: 5000, // Tamanho máximo do arquivo em KB
                showUpload: true,
                showRemove: true,
                showPreview: true,
                overwriteInitial: false,
                initialPreviewAsData: true,
                initialPreview: [
                    <?php if(isset($gallery) && !empty($gallery)): ?>
                        <?php foreach($gallery as $image): ?>
                            "<?php echo $url_img . $image['image_name']; ?>",
                        <?php endforeach; ?>
                    <?php endif; ?>
                ],
                initialPreviewConfig: [
                    <?php if(isset($gallery) && !empty($gallery)): ?>
                        <?php foreach($gallery as $image): ?>
                            {caption: "<?= $image['image_name'] ?>", 
                                size: <?= filesize($doc_root . $image['image_name']) ?>, 
                                key: <?= $image['id'] ?>,
                                url: "<?= base_url('posts/remove-gallery-image/'.$image['id']) ?>", // URL para exclusão
                            },
                        <?php endforeach; ?>
                    <?php endif; ?>
                ],
                // Adicione outras opções conforme necessário
            });

            // Form validation - post
            $('#postForm').on('submit', function(event) {
                console.log('Formulário enviado');
                if (!this.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                $(this).addClass('was-validated');

                // Validação adicional do CKEditor
                const content = $('#content').val();
                if (!content || content.trim() === '') {
                    event.preventDefault();
                    //alert('O conteúdo do post é obrigatório');
                    return false;
                }

                // Validação do arquivo de imagem
                const fileInput = $('input[name="cover_image"]')[0];
                const invalidFeedback = $(fileInput).siblings('.invalid-feedback'); // Seleciona a div de feedback

                if (fileInput && fileInput.files.length > 0) {
                    const file = fileInput.files[0];
                    const maxSize = fileInput.getAttribute('data-max-size');
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

                    // Verifica o tipo do arquivo
                    if (!allowedTypes.includes(file.type)) {
                        invalidFeedback.text('Por favor, selecione uma imagem válida (JPG, PNG, GIF).');
                        $(fileInput).addClass('is-invalid'); // Adiciona a classe 'is-invalid' para destacar o campo
                        event.preventDefault();
                        return false;
                    }

                    // Verifica o tamanho do arquivo
                    if (file.size > maxSize) {
                        invalidFeedback.text('O arquivo não pode exceder 2MB.');
                        $(fileInput).addClass('is-invalid'); // Adiciona a classe 'is-invalid' para destacar o campo
                        event.preventDefault();
                        return false;
                    }

                    // Se o arquivo for válido, remove a classe 'is-invalid' e limpa a mensagem de erro
                    $(fileInput).removeClass('is-invalid');
                    invalidFeedback.text('');
                } else {
                    // Se nenhum arquivo for selecionado, remove a classe 'is-invalid' e limpa a mensagem de erro
                    $(fileInput).removeClass('is-invalid');
                    invalidFeedback.text('');
                }
            });

            // Form validation - user and password
            $('#userForm, #userFormPassword').on('submit', function(event) {
                console.log('Formulário enviado');
                if (!this.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                $(this).addClass('was-validated');
            });
        });
    </script>
</body>
</html>

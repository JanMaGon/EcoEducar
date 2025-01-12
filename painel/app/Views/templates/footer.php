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

            // Inicializar o fileinput
            $("#gallery-upload").fileinput({
                uploadUrl: '<?= base_url('posts/upload-gallery') ?>', // URL para upload
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
                            "<?= base_url('assets/image/posts/gallery/' . $image['image_name']) ?>",
                        <?php endforeach; ?>
                    <?php endif; ?>
                ],
                initialPreviewConfig: [
                    <?php if(isset($gallery) && !empty($gallery)): ?>
                        <?php foreach($gallery as $image): ?>
                            {caption: "<?= $image['image_name'] ?>", size: <?= filesize('assets/image/posts/gallery/' . $image['image_name']) ?>, key: <?= $image['id'] ?>},
                        <?php endforeach; ?>
                    <?php endif; ?>
                ],
                // Adicione outras opções conforme necessário
            }).on('fileuploaded', function(event, data, previewId, index) {
                if (data.response.success) {
                    const file = data.response.file; // Supondo que o servidor retorne o arquivo
                    const html = `
                        <div class="col-6 gallery-item" data-id="${file.id}">
                            <div class="position-relative">
                                <img src="${file.url}" class="img-thumbnail">
                                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 remove-gallery-image">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                        </div>
                    `;
                    $('#gallery-preview').append(html);
                } else {
                    alert('Erro ao fazer upload: ' + data.response.message);
                }
            });

            // Handle gallery image removal
            $(document).on('click', '.remove-gallery-image', function() {
                const item = $(this).closest('.gallery-item');
                const imageId = item.data('id');
                
                if (confirm('Deseja realmente remover esta imagem?')) {
                    $.post('<?= base_url('posts/remove-gallery-image') ?>/' + imageId, function(response) {
                        if (response.success) {
                            item.remove();
                        } else {
                            alert('Erro ao remover imagem: ' + response.message);
                        }
                    });
                }
            });

            // Form validation
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
            });
        });
    </script>
</body>
</html>

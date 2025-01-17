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
                        <a href="#" class="btn btn-custom">Veja os locais de descarte</a>
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
                <div class="col-sm-12 col-xl-4 mb-5">
                    <div class="card blog-card">
                        <img src="<?= base_url('assets/image/blog1.jpg')?>" class="card-img-top" alt="Imagem do Blog">
                        <div class="card-body">
                            <h5 class="card-title">Processo de reciclagem</h5>
                            <p class="card-text">O processo de reciclagem é uma série de espaços que transforma resíduos descartados em outras produções, reduzindo a demanda por recursos naturais e fortalecendo os lucros sociais.</p>
                            <div class="d-flex justify-content-end mt-3">
                                <a href="#" class="btn btn-custom">Continuar lendo</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-4 mb-5">
                    <div class="card blog-card">
                        <img src="<?= base_url('assets/image/blog2.jpg')?>" class="card-img-top" alt="Imagem do Blog">
                        <div class="card-body">
                            <h5 class="card-title">Parcerias com escolas e comunidades</h5>
                            <p class="card-text">Estabelecer aspectos para receitar e comunicá-los e uns O objetivo: adaptação de resíduos em casa foi fundamento.</p>
                            <div class="d-flex justify-content-end mt-3">
                                <a href="#" class="btn btn-custom">Continuar lendo</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-4 mb-5">
                    <div class="card blog-card">
                        <img src="<?= base_url('assets/image/blog3.jpg')?>" class="card-img-top" alt="Imagem do Blog">
                        <div class="card-body">
                            <h5 class="card-title">Parcerias com escolas e comunidades</h5>
                            <p class="card-text">Estabelecer aspectos para receitar e comunicá-los e uns O objetivo: adaptação de resíduos em casa foi fundamento.</p>
                            <div class="d-flex justify-content-end mt-3">
                                <a href="#" class="btn btn-custom">Continuar lendo</a>
                            </div>
                        </div>
                    </div>
                </div>
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


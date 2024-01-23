<nav class="navbar navbar-expand-lg p-0 light back-blue navV px-1" id="navV">
    <div class="container-fluid p-2" style="margin-top: -500px !important;">

        <!-- <a class="navbar-brand fw-bold lh-1 mt-2 titleVMunicipalidad" style="display: none;">Municipalidad Digital</a>
        <span class="navbar-brand fs-6 lh-sm titleVGestion" style="display: none;">Gestion Ambiental</span> -->

        <button class="navbar-toggler btnResponsive" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <!-- <span class="navbar-toggler-icon"></span> -->
            <img src="../Librerias/Img/digital.png" alt="Ícono de menú">
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <div class="accordion accordion-flush w-100" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <a class="accordion-button collapsed btn-nav" href="descargasListado"><i class="fas fa-home p-1 fs-5 mr-2"></i> Pagina Principal </a>
                        </h2>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                <i class="fas fa-truck p-1 fs-5 mr-2"></i> Gestionar Camiones
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body p-0">
                                <a class="nav-link fs-6 nav-link-agregar" href="camionesListado"><i class="fas fa-list bg-light p-1 rounded t-color-blue"></i> Listado de Camiones </a>
                                <!-- <a class="nav-link fs-6 nav-link-agregar" role="button" id="#a_camion" onclick="" data-bs-toggle="modal" data-bs-target="#nuevo_camion"><i class="fas fa-plus p-1 rounded t-color-blue bg-light"></i> Ingresar Camion </a> -->
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                <i class="fas fa-users p-1 fs-5 mr-2"></i> Gestionar Cooperativas
                            </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body p-0">
                                <a class="nav-link fs-6 nav-link-agregar" role="button" id="#a_cooperativa" href="cooperativaListado"><i class="fa-solid fa-list"></i> Listado Cooperativa</a>
                                <a class="nav-link fs-6 nav-link-formar" role="button" id="#a_grupos" onclick=""><i class="fas fa-users"></i> Grupos </a>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                <i class="fas fa-map-marked-alt p-1 fs-5 mr-2"></i> Gestionar Zonas
                            </button>
                        </h2>
                        <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body p-0">
                                <a class="nav-link fs-6 nav-link-agregar" role="button" id="#a_zona" href="zonasListado"><i class="fa-solid fa-list"></i> Listado Zonas</a>
                                <a class="nav-link fs-6 nav-link-agregar" role="button" id="#a_zona" onclick="" data-bs-toggle="modal" data-bs-target="#nueva_zona">Ingresar Zona <i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <a class="CloseSess accordion-button custom-button-class" href="cerrarSesion.php"><i class="fas fa-power-off p-1 fs-5 mr-2"></i> Cerrar Sesión </i></a>
                    </div>
                </div>
        </div>
    </div>
</nav>
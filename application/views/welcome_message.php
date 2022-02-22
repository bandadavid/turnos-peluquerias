<script type="text/javascript">
    $("#menu_inicio").addClass("active");
</script>

<!-- Carousel Start -->
<div id="carousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carousel" data-slide-to="0" class="active"></li>
        <li data-target="#carousel" data-slide-to="1"></li>
        <li data-target="#carousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?php echo base_url(); ?>/assets/imagenes/f2.jpg" alt="Carousel Image">
        </div>

        <div class="carousel-item">
            <img src="<?php echo base_url(); ?>/assets/imagenes/f3.jpg" alt="Carousel Image">
        </div>

        <div class="carousel-item">
            <img src="<?php echo base_url(); ?>/assets/imagenes/f4.jpg" alt="Carousel Image">
        </div>
    </div>

    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
    </a>
    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Siguiente</span>
    </a>
</div>
<!-- Carousel End -->



<!-- About Start -->
<div class="about wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 col-md-6">
                <div class="about-img">
                    <img src="<?php echo base_url(); ?>/assets/imagenes/f1.jpeg" alt="Image">
                </div>
            </div>
            <div class="col-lg-7 col-md-6">
                <div class="section-header text-left">
                    <p>Bienvenidos a Stylo's Peluquería</p>
                    <h2>10 Años de Experiencia</h2>
                </div>
                <div class="about-text">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi.
                        Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor, auctor id gravida condimentum, viverra quis sem.
                    </p>
                    <a class="btn" href="">Agendar Cita</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->
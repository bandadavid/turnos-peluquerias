<br>

<!-- Footer Start -->
<div class="footer" style="padding-top:0px;">
  <div class="container copyright">
    <div class="row">
      <div class="col-md-12 text-center">
        <p>&copy;
          <a href="#" target="_blank">STYLO'S PELUQUERIA
            <br>
            2022
          </a>
        </p>
      </div>
    </div>
  </div>
</div>
<!-- Footer End -->

<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
</div>

<!-- JavaScript Libraries -->

<style>
  .fc-content {
    cursor: pointer !important;
  }

  .fc-title,
  .fc-time {
    color: white !important;
  }

  .fc-more {
    color: white !important;
    background-color: #1D1A49;
    padding-left: 5px;
    padding-right: 5px;
    border-radius: 5px;
    font-size: 12px !important;
  }

  .fc-more-cell {
    text-align: center;
  }
</style>

<script src="<?php echo base_url(); ?>/assets/template/lib/easing/easing.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/template/lib/wow/wow.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/template/lib/owlcarousel/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/template/lib/isotope/isotope.pkgd.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/template/lib/lightbox/js/lightbox.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/template/lib/waypoints/waypoints.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/template/lib/counterup/counterup.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/template/lib/slick/slick.min.js"></script>

<!-- Template Javascript -->
<script src="<?php echo base_url(); ?>/assets/template/js/main.js"></script>

<script type="text/javascript">
  <?php if ($this->session->flashdata("bienvenida")) : ?>
    toastr.success("<?php echo $this->session->flashdata("bienvenida"); ?>");
  <?php endif; ?>
</script>
<script type="text/javascript">
  <?php if ($this->session->flashdata("confirmacion")) : ?>
    toastr.success("<?php echo $this->session->flashdata("confirmacion"); ?>");
  <?php endif; ?>
</script>
<script type="text/javascript">
  <?php if ($this->session->flashdata("error")) : ?>
    toastr.error("<?php echo $this->session->flashdata("error"); ?>");
  <?php endif; ?>
</script>
</body>

</html>
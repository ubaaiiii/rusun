<!-- Isinya -->
</div>
</div>
</div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modalSmall">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="judulModal"></h5>
        <button id="modal-close" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="load-modal-here">
        .....
      </div>
    </div>
  </div>
</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalLarge">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulModal-large"></h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body" id="load-modal-large">
                .....
            </div>
        </div>
    </div>
</div>
<!-- main content area end -->
<!-- footer area start-->
<footer>
    <div class="footer-area">
        <p>Copyright ©<?=date('Y');?> All rights reserved | This template is made with <i class="fa fa-heart"></i> by <a href="<?= base_url() ?>" target="_blank"><?= $setting['nama'] ?></a></p>
    </div>
</footer>
</div>
<!-- page container area end -->
<!-- bootstrap 4 js -->
<script src="<?=base_url();?>assets/js/popper.min.js"></script>
<script src="<?=base_url();?>assets/js/autoNumeric.min.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/js/dropzone.min.js"></script>
<script src="<?=base_url();?>assets/js/ekko-lightbox.min.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap-toggle.min.js"></script>
<script src="<?=base_url();?>assets/js/owl.carousel.min.js"></script>
<script src="<?=base_url();?>assets/js/metisMenu.min.js"></script>
<script src="<?=base_url();?>assets/js/jquery.slimscroll.min.js"></script>
<script src="<?=base_url();?>assets/js/jquery.slicknav.min.js"></script>

<!-- others plugins -->
<script src="<?=base_url();?>assets/js/plugins.js"></script>
<script src="<?=base_url();?>assets/js/moment.min.js"></script>
<script src="<?=base_url();?>assets/js/daterangepicker/daterangepicker.min.js"></script>
<script src="<?=base_url();?>assets/js/scripts.js"></script>
<script>
$(document).ready(function(){
  $(document).on('click', '[data-toggle="lightbox"]', function (event) {
    event.preventDefault();
    $(this).ekkoLightbox();
  });
  $('[data-toggle=tooltip]').tooltip();

  $('li:contains("<?=$lokasi;?>")').closest("li").addClass('active');
  $('li.active').closest('ul').addClass('in');
  // console.log("<?=$lokasi;?>");
});
</script>
</body>

</html>

<footer >

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6">
                <!-- <div class="follow-link">
                    <a class="text-light" href=""><img class="pay" src="<?php echo base_url()?>images/apple-pay(1).png" alt=""></a>
                    <a class="text-light" href=""><img class="apple-pay" src="<?php echo base_url()?>images/maestro.png" alt=""></a>
                    <a class="text-light" href=""><img class="paypal" src="<?php echo base_url()?>images/paypal.png" alt=""></a>
                    <a class="text-light" href=""><img class="visa" src="<?php echo base_url()?>images/visa.png" alt=""></i></a>
                    <a class="text-light" href=""><img class="master-card" src="<?php echo base_url()?>images/master-card(1).png" alt=""></a>
                    <a class="text-light" href=""><img class="mada" src="<?php echo base_url()?>images/mada.png" alt=""></i></a>
                </div> -->
            </div>
            <div class="col-md-6">
                <p class="footer-text"><?php echo $this->lang->line('all_rights_reserved'); ?> © 2022 Khadim Hazir </p>
            </div>
        </div>

    </div>

</footer>

    </div>

    </div>

</body>


<script async defer src="<?=base_url()?>assets/js/bootstrap.bundle.min.js"></script>

<script async defer src="<?php echo base_url() . 'assets/toastr/toastr.min.js'; ?>"></script>



 <!-- SHOW TOASTR NOTIFIVATION -->

<?php if ($this->session->flashdata('flash_message') != "") : ?>

    <script type="text/javascript">

        toastr.success('<?php echo $this->session->flashdata("flash_message"); ?>');

    </script>

<?php unset($_SESSION['flash_message']); endif; ?>

<?php if ($this->session->flashdata('error_message') != "") : ?>

    <script type="text/javascript">

        toastr.error('<?php echo $this->session->flashdata("error_message"); ?>');

    </script>

<?php unset($_SESSION['error_message']); endif; ?>

<?php if ($this->session->flashdata('info_message') != "") : ?>

    <script type="text/javascript">

       //toastr.info('<?php echo $this->session->flashdata("info_message"); ?>');

    </script>

<?php unset($_SESSION['info_message']); endif; ?>

</html>
   <style>
.footer-heading {
    color: white;
}

.footer-a {
    color: white;
}

.footer-para {
    color: white;
}

.footer-li {
    color: floralwhite;
}

a.icons {
    color: white;
}
   </style>

   <footer class="site-footer footer-dark bg-dark shadow-sm">
       <div class="container">
           <div class="row">
               <div class="col-md-4 col-sm-6 footer-widget">
                   <h3 class="footer-heading">Quick Links</h3>
                   <ul>
                       <li><a class="footer-a" href="#">Home</a></li>
                       <li><a class="footer-a" href="#">About Us</a></li>
                       <li><a class="footer-a" href="#">Services</a></li>
                       <li><a class="footer-a" href="#">Contact Us</a></li>
                   </ul>
               </div>
               <div class="col-md-4 col-sm-6 footer-widget">
                   <h3 class="footer-heading">Contact Us</h3>
                   <ul class="address">
                       <li class="footer-li"><i class="fa fa-map-marker"></i> 123 Main Street<br> Anytown, USA 12345
                       </li>
                       <li class="footer-li"><i class="fa fa-phone"></i> (555) 555-5555</li>
                       <li class="footer-li"><i class="fa fa-envelope"></i> info@example.com</li>
                   </ul>
               </div>
               <div class="col-md-4 col-sm-6 footer-widget">
                   <h3 class="footer-heading">Follow Us</h3>
                   <ul class="social">
                       <li><a class="icons" href="#"><i class="bi bi-facebook"></i>Facebook</a></li>
                       <li><a class="icons" href="#"><i class="bi bi-twitter"></i>Twitter</a></li>
                       <li><a class="icons" href="#"><i class="bi bi-instagram"></i>Instagram</a></li>
                       <li><a class="icons" href="#"><i class="bi bi-linkedin"></i>Linkedin</a></li>
                   </ul>
               </div>
           </div>
       </div>
       <div class="bottom-bar">
           <div class="container">
               <div class="row">
                   <div class="col-md-12">
                       <p class="footer-para text-right">&copy; 2023 <a href="<?php echo base_url() ?>">Khadim Hazir</a>. All rights reserved.</p>
                   </div>
               </div>
           </div>
       </div>
   </footer>


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
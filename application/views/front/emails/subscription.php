<div class="container">
     <!-- alert massage start -->
     <?php if ($this->session->flashdata('msg')) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('msg'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php } ?>
        <!-- alert massage end -->

        <h1>HI Testing Khadim Hazir</h1>
</div>
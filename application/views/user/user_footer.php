</div><!-- /#right-panel -->

<script src="<?=base_url();?>vendors/jquery/dist/jquery.min.js"></script>
<script src="<?=base_url();?>vendors/popper.js/dist/umd/popper.min.js"></script>
<script src="<?=base_url();?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>js/main.js"></script>
<script src="<?=base_url();?>vendors/chosen/chosen.jquery.min.js"></script>

<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.js"></script> -->
<script src="<?=base_url();?>vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url();?>vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url();?>vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?=base_url();?>js/init-scripts/data-table/datatables-init.js"></script>

<script>
    jQuery(document).ready(function() {
        jQuery(".standardSelect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });
    });
</script>

</body>
<footer class="main-footer">
    <strong>Copyright &copy; <?= date('Y') ?></strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.0
    </div>
</footer>
</div>
<!-- ./wrapper -->
<!-- form Wizard -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="admin/dist/js/adminlte.js"></script>



<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="admin/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="admin/plugins/raphael/raphael.min.js"></script>
<script src="admin/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="admin/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- SummerNote -->
<script src="admin/plugins/summernote/summernote-bs4.min.js"></script>
<!-- ChartJS -->
<script src="admin/plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="admin/dist/js/pages/dashboard2.js"></script>
<!-- Data Tables -->



<!-- Select2 -->
<script src="admin/plugins/select2/js/select2.full.min.js"></script>

<!-- ================Data Table Buttons -->
<!-- <script src="admin/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="admin/plugins/datatables/buttons.flash.min.js"></script>
<script src="admin/plugins/datatables/jszip.min"></script>
<script src="admin/plugins/datatables/pdfmake.min"></script>
<script src="admin/plugins/datatables/vfs_fonts"></script>
<script src="admin/plugins/datatables/buttons.html5.min"></script>
<script src="admin/plugins/datatables/buttons.print.min"></script> -->







<!-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> -->
<script src="admin/plugins/datatables/jquery.dataTables.min.js"></script>

<script src="admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>



<!-- <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script> -->


<!-- ADDITIONAL SCRIPTS -->

<script src="admin/dist/js/demo.js"></script>
<script src="admin/dist/js/app.js"></script>

<script src="admin/dist/js/switch.js"></script>
<script src="admin/dist/js/scales.js"></script>
<script src="admin/dist/js/scaleCalculations.js"></script>
<script src="admin/dist/js/personalDetails.js"></script>
<script src="admin/dist/js/registerScale.js"></script>
<script src="admin/dist/js/searchCustomer.js"></script>





<script>
$(document).ready(function() {


    let tableHeader = $('.head');

    let columnArray = [];
    for (let i = 0; i < tableHeader.length - 1; i++) {

        columnArray.push(i)
    }
    $("#example1").DataTable({

        "footerCallback": function(row, data, start, end, display) {
            var api = this.api(),
                data;


            // ================Create a dynamic index to target the column==============
            const target = document.querySelector("#amount");
            const columnIndex = Array.from(document.querySelectorAll(".head")).indexOf(target);

            function formatCurrency(amount) {
                return new Intl.NumberFormat().format(amount)
            }


            // Remove the formatting to get integer data for summation
            var intVal = function(i) {
                return typeof i === 'string' ?
                    i.replace(/[\Tsh,]/g, '') * 1 :
                    typeof i === 'number' ?
                    i : 0;
            };

            // Total over all pages
            total = api
                .column(columnIndex)
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Total over this page
            pageTotal = api
                .column(columnIndex, {
                    page: 'current'
                })
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(columnIndex).footer()).html(
                'Tsh ' + formatCurrency(pageTotal) + ' Total'
            );

            $('.total').html('Tsh ' + formatCurrency(pageTotal));
        },
        dom: 'Bfrtip',
        buttons: [

            {
                extend: 'print',
                // autoPrint: true,
                orientation: 'landscape',
                exportOptions: {
                    columns: columnArray
                }
            },

            {
                extend: 'copyHtml5',
                footer: true,
                exportOptions: {
                    columns: [0, ':visible'],
                    columns: columnArray
                }
            },
            {
                extend: 'excelHtml5',
                footer: true,
                exportOptions: {
                    columns: ':visible',
                    columns: columnArray
                }
            },
            {
                extend: 'pdfHtml5',
                footer: true,
                orientation: 'landscape',
                pageSize: 'LEGAL',

                exportOptions: {
                    columns: columnArray
                }
            },

            'csv',
            // 'colvis'
        ],

        "responsive": true,
        "autoWidth": false,
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        // "autoWidth": true, // Adds A tiny Blue btn
        "responsive": true,

    });

});


setInterval(function() {
    $('#message').fadeOut(7000)
});

//Initialize Select2 Elements
$('.select2').select2()

//Initialize Select2 Elements
$('.select2bs4').select2({
    theme: 'bootstrap4'
});

$(function() {
    // Summernote
    $('.textarea').summernote()
})
</script>
<script src="admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
</body>



</html>
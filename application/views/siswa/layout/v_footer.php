<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="<?=base_url('siswa') ?>">Bimbingan Konseling</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

  <aside class="control-sidebar control-sidebar-dark">

  </aside>

</div>

<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<script src="<?=base_url() ?>assets/backend/plugins/jquery/jquery.min.js"></script>
<script src="<?=base_url() ?>assets/backend/plugins/jquery-ui/jquery-ui.min.js"></script>

<script src="<?=base_url() ?>assets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url() ?>assets/backend/plugins/chart.js/Chart.min.js"></script>
<script src="<?=base_url() ?>assets/backend/plugins/sparklines/sparkline.js"></script>
<script src="<?=base_url() ?>assets/backend/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?=base_url() ?>assets/backend/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="<?=base_url() ?>assets/backend/plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="<?=base_url() ?>assets/backend/plugins/moment/moment.min.js"></script>
<script src="<?=base_url() ?>assets/backend/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?=base_url() ?>assets/backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="<?=base_url() ?>assets/backend/plugins/select2/js/select2.full.min.js"></script>
<script src="<?=base_url() ?>assets/backend/plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?=base_url() ?>assets/backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?=base_url() ?>assets/backend/dist/js/adminlte.js"></script>
<script src="<?=base_url() ?>assets/backend/dist/js/demo.js"></script>
<script src="<?=base_url() ?>assets/backend/dist/js/pages/dashboard.js"></script>
<script src="<?=base_url() ?>assets/backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url() ?>assets/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url() ?>assets/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url() ?>assets/backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?=base_url() ?>assets/backend/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url() ?>assets/backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?=base_url() ?>assets/backend/plugins/jszip/jszip.min.js"></script>
<script src="<?=base_url() ?>assets/backend/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?=base_url() ?>assets/backend/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?=base_url() ?>assets/backend/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?=base_url() ?>assets/backend/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?=base_url() ?>assets/backend/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="<?=base_url() ?>assets/backend/plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?=base_url() ?>assets/backend/plugins/moment/moment.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

  <script>
    document.getElementById('logout-link').addEventListener('click', function (e) {
      e.preventDefault(); // mencegah langsung logout

      Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda akan keluar dari sistem.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Logout!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "<?= base_url('dashboard/logout') ?>";
        }
      });
    });
  </script>

  <script>
      // Cek jika ada flashdata untuk success
      <?php if ($this->session->flashdata('success')): ?>
          Swal.fire({
              icon: 'success',
              title: 'Berhasil!',
              text: '<?php echo $this->session->flashdata('success'); ?>',
              confirmButtonText: 'Ok',
              confirmButtonColor: '#3085d6',
          });
      <?php endif; ?>

      // Cek jika ada flashdata untuk error
      <?php if ($this->session->flashdata('error')): ?>
          Swal.fire({
              icon: 'error',
              title: 'Gagal!',
              text: '<?php echo $this->session->flashdata('error'); ?>',
              confirmButtonText: 'Ok',
              confirmButtonColor: '#d33',
          });
      <?php endif; ?>
  </script>

  <script>
      function confirmDelete(url) {
          Swal.fire({
              title: 'Apakah Anda yakin?',
              text: "Data yang dihapus tidak dapat dikembalikan!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#3085d6',
              confirmButtonText: 'Ya, hapus!',
              cancelButtonText: 'Batal'
          }).then((result) => {
              if (result.isConfirmed) {
                  window.location.href = url; // Redirect ke URL hapus
              }
          });
      }
  </script>

  <script>
      function confirmSelesai(url) {
          Swal.fire({
              title: 'Apakah Anda yakin?',
              text: "Data yang selesai tidak bisa di edit lagi!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#3085d6',
              confirmButtonText: 'Ya, Selesai!',
              cancelButtonText: 'Batal'
          }).then((result) => {
              if (result.isConfirmed) {
                  window.location.href = url; // Redirect ke URL hapus
              }
          });
      }
  </script>

  <script>
      function confirmBatal(url) {
          Swal.fire({
              title: 'Apakah Anda yakin?',
              text: "Data yang batal tidak bisa di edit lagi!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#3085d6',
              confirmButtonText: 'Ya, Batalkan!',
              cancelButtonText: 'Batal'
          }).then((result) => {
              if (result.isConfirmed) {
                  window.location.href = url; // Redirect ke URL hapus
              }
          });
      }
  </script>

  <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
      
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    })
  </script>

  <script>
    $(function () {
      // Inisialisasi semua Summernote
      $('#summernote, #summernote1, #summernote2').summernote({
        height: 100 // kamu bisa sesuaikan tinggi
      });

      // Inisialisasi CodeMirror satu kali (jika hanya satu editor)
      CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
        mode: "htmlmixed",
        theme: "monokai"
      });
    });
  </script>

</body>
</html>
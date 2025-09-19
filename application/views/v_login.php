
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | Bimbingan Konseling</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/dist/css/adminlte.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
  body.login-page {
    background: url('<?= base_url("assets/image/back1.jpg") ?>') no-repeat center center fixed;
    background-size: cover;
  }
</style>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?= base_url('auth') ?>"><b>Login</b> BK</a>
  </div>
  
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Masukan username dan password</p>

      <?php echo form_open('auth/do_login') ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="uname" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="pass" id="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
          <div class="col-12">
                <div class="form-group">
                    <input type="checkbox" id="showPassword" onclick="togglePassword()"> <label for="showPassword">Show Password</label>
                </div>
          </div>
            
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
        <?php echo form_close() ?>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <p>Jika lupa password silahkan hubungi admin </p>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url() ?>assets/backend/plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/backend/dist/js/adminlte.min.js"></script>
  <script>
    function togglePassword() {
      var passwordInput = document.getElementById("password");
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
      } else {
        passwordInput.type = "password";
      }
    }
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
</body>
</html>

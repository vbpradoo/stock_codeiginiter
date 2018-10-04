

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Control
            <small>Usuarios</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Principal</a></li>
            <li class="active">Usuarios</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">
          
          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('success'); ?>
            </div>
          <?php elseif($this->session->flashdata('error')): ?>
            <div class="alert alert-error alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('error'); ?>
            </div>
          <?php endif; ?>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Añadir Usuario</h3>
            </div>
            <form role="form" action="<?php base_url('users/create') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="groups">Grupos</label>
                  <select class="form-control" id="groups" name="groups">
                    <option value="">Seleccione Grupos</option>
                    <?php foreach ($group_data as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['group_name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="username">Nombre de usuario</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de usuario" autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="password">Contraseña</label>
                  <input type="text" class="form-control" id="password" name="password" placeholder="Contraseña" autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="cpassword">Confirmar contraseña</label>
                  <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirmar contraseña" autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="fname">Nombre</label>
                  <input type="text" class="form-control" id="fname" name="fname" placeholder="Nombre" autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="lname">Apellidos</label>
                  <input type="text" class="form-control" id="lname" name="lname" placeholder="Apellidos" autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="phone">Teléfono</label>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Teléfono" autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="gender">Género</label>
                  <div class="radio">
                    <label>
                      <input type="radio" name="gender" id="male" value="1">
                      Hombre
                    </label>
                    <label>
                      <input type="radio" name="gender" id="female" value="2">
                      Mujer
                    </label>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                <a href="<?php echo base_url('users/') ?>" class="btn btn-warning">Volver</a>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script type="text/javascript">
  $(document).ready(function() {
    $("#groups").select2();

    $("#mainUserNav").addClass('active');
    $("#createUserNav").addClass('active');
  
  });
</script>

<!-- Reutilizacion de HTML usando php -->
<?php require './business/ctrl_countries.php'; ?>
<?php require './partials/header.php'; ?>
<div class="container pt-4 p-3">

  <!-- Add a new country form -->
  <div class="card">
    <div class="col-md-12">
      <?php if ($error): ?>
        <p class="text-danger"><?= $error ?></p>
      <?php endif; ?>
      
      <div class="card-header">Add a new country</div>
      <div class="card-body">
        <form method="post" action="add_country.php" id="country-form">
          <input type="hidden" id="country-id" name="id">
          <div class="mb-3 row">
            <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
            <div class="col-md-6">
              <input id="name" type="text" class="form-control" id='input_country' name="name" autocomplete="name" autofocus>
            </div>
          </div>
          <div class="mb-3 row">
            <div class="col-md-6 offset-md-4">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Separacion de 1 cm entre los elementos -->
  <div style="margin-top: 1cm;"></div>
  <!-- Countries table -->
  <div class="row">
    
    <div class="col-md-12">
      <h1 class="text-center">Countries</h1>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
    
  </div>
</div>
<script src= "./static/js/ajax_countries.js"></script>

<?php require './partials/footer.php'; ?>
  



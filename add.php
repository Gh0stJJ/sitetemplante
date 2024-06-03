<?php require './business/ctrl_add.php'; ?>
<?php require './partials/header.php'; ?>
<div class="container pt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Add New Contact</div>
        <div class="card-body">
          <?php if ($error): ?>
            <p class="text-danger"><?= $error ?></p>
              
          <?php endif; ?>

          <form method="post" action="./business/ctrl_add.php">
            <div class="mb-3 row">
              <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

              <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" autocomplete="name" autofocus>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="phone_number" class="col-md-4 col-form-label text-md-end">Phone Number</label>

              <div class="col-md-6">
                <input id="phone_number" type="tel" class="form-control" name="phone_number" autocomplete="phone_number" autofocus>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="country" class="col-md-4 col-form-label text-md-end">Country</label>

              <div class="col-md-6">
                <select id="country" class="form-select" name="country" autofocus>
                  <option value="0">Select a country</option>
                  <?php foreach ($countries as $country): ?>
                    <option value="<?= $country['id'] ?>"><?= $country['name'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="cities" class="col-md-4 col-form-label text-md-end">City</label>

              <div class="col-md-6">
                <select id = "cities" class="form-select" name="cities" disabled autofocus>
                </select>
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
  </div>
</div>
<script src="./static/js/add.js"></script>

<?php require './partials/footer.php'; ?>

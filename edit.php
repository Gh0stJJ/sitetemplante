<?php require_once './business/ctrl_edit.php'; ?>
<?php require './partials/header.php'; ?>
<div class="container pt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Edit Contact</div>
        <div class="card-body">
          <?php if ($error): ?>
            <p class="text-danger">
              <?= $error ?>
            </p>
          <?php endif ?>
          <form method="POST" action="./business/ctrl_edit.php?id=<?= $contact['id'] ?>">
            <div class="mb-3 row">
              <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

              <div class="col-md-6">
                <input value="<?= $contact['name'] ?>" id="name" type="text" class="form-control" name="name" autocomplete="name" autofocus>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="phone_number" class="col-md-4 col-form-label text-md-end">Phone Number</label>

              <div class="col-md-6">
                <input value="<?= $contact['phone_number'] ?>" id="phone_number" type="tel" class="form-control" name="phone_number" autocomplete="phone_number" autofocus>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="country_id" class="col-md-4 col-form-label text-md-end">Country</label>

              <div class="col-md-6">
                <select id="country_id" class="form-select" name="country_id">
                  <option value="">Select a country</option>
                  <?php foreach ($countries as $country): ?>
                    <option value="<?= $country['id'] ?>" <?=$contact['country_id'] == $country['id'] ? 'selected' : ''?>>
                      <?= $country['name'] ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="city" class="col-md-4 col-form-label text-md-end">City</label>

              <div class="col-md-6">
                <input value="<?= $contact['city'] ?>" id="city" type="text" class="form-control" name="city" autocomplete="city" autofocus>
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

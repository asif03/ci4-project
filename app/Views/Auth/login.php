<?php $this->extend(config('Auth')->views['layout'])?>

<?php $this->section('title')?>BCPS :: <?=lang('Auth.login')?><?php $this->endSection()?>

<?php $this->section('main')?>

<div
  class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
  <div class="d-flex align-items-center justify-content-center w-100">
    <div class="row justify-content-center w-100">
      <div class="col-md-8 col-lg-6 col-xxl-3">
        <div class="card mb-0">
          <div class="card-body">
            <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100 text-decoration-none d-flex
            align-items-center justify-content-center gap-1">
              <img src="<?php echo base_url(); ?>public/logo.png" width="40" height="40" alt="BCPS Logo"><span
                class="fs-3 fw-bold">BCPS</span>
            </a>
            <h5 class="text-center mb-4"><?=lang('Auth.login')?></h5>

            <?php if (session('error') !== null): ?>
            <div class="alert alert-danger" role="alert"><?=session('error')?></div>
            <?php elseif (session('errors') !== null): ?>
            <div class="alert alert-danger" role="alert">
              <?php if (is_array(session('errors'))): ?>
<?php foreach (session('errors') as $error): ?>
              <?=$error?>
              <br>
              <?php endforeach?>
<?php else: ?>
              <?=session('errors')?>
<?php endif?>
            </div>
            <?php endif?>

            <?php if (session('message') !== null): ?>
            <div class="alert alert-success" role="alert"><?=session('message')?></div>
            <?php endif?>

            <form action="<?=url_to('login')?>" method="post">
              <?=csrf_field()?>
              <!-- Email -->
              <div class="mb-3">
                <label for="floatingEmailInput" class="form-label"><?=lang('Auth.email')?></label>
                <input type="email" class="form-control" id="floatingEmailInput" name="email" inputmode="email"
                  autocomplete="email" placeholder="<?=lang('Auth.email')?>" value="<?=old('email')?>" required>
              </div>
              <!-- Password -->
              <div class="mb-4">
                <label for="floatingPasswordInput" class="form-label"><?=lang('Auth.password')?></label>
                <input type="password" class="form-control" id="floatingPasswordInput" name="password" inputmode="text"
                  autocomplete="current-password" placeholder="<?=lang('Auth.password')?>" required>
              </div>
              <div class="d-flex align-items-center justify-content-between mb-4">
                <!-- Remember me -->
                <?php if (setting('Auth.sessionConfig')['allowRemembering']): ?>
                <div class="form-check">
                  <input class="form-check-input primary" type="checkbox" name="remember" id="flexCheckChecked"
                    <?php if (old('remember')): ?> checked<?php endif?>>
                  <label class="form-check-label text-dark" for="flexCheckChecked">
                    <?=lang('Auth.rememberMe')?>
                  </label>
                </div>
                <?php endif; ?>

                <?php if (setting('Auth.allowMagicLinkLogins')): ?>
                <a class="text-primary fw-bold" href="<?=url_to('magic-link')?>"><?=lang('Auth.forgotPassword')?></a>
                <?php endif?>
              </div>
              <button type="submit"
                class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2 text-white fw-bold fs-6"><?=lang('Auth.login')?></button>

              <div class="d-flex align-items-center justify-content-center">


                <?php if (setting('Auth.allowRegistration')): ?>
                <p class="fs-sm mb-0 fw-bold"><?=lang('Auth.needAccount')?> <a class="text-primary ms-1"
                    href="<?=url_to('register')?>"><?=lang('Auth.register')?></a></p>
                <?php endif?>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->endSection()?>
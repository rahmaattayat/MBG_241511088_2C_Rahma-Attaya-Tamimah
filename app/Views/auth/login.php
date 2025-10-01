<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title><?= esc($title ?? 'Login') ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    html, body { font-family: Arial, sans-serif; margin:0; padding:0; }
    .wrap { padding: 24px; max-width: 360px; }
    h1 { margin: 0 0 16px 0; font-size: 22px; }
    .field { margin-bottom: 12px; }
    label { display:block; margin-bottom:6px; font-weight:600; }
    input[type="text"], input[type="password"] {
      width: 100%; padding: 8px 10px; border: 1px solid #aaa; border-radius: 4px;
    }
    .btn {
      display:inline-block; padding:8px 16px; border:1px solid #000; background:#000; color:#fff; border-radius:4px; cursor:pointer;
    }
    .error { margin-top:10px; color:#b00020; }
  </style>
</head>
<body>
  <div class="wrap">
    <h1>Login</h1>

    <?php if (!empty($error)): ?>
      <div class="error"><?= esc($error) ?></div>
    <?php endif; ?>

    <form action="<?= base_url('login') ?>" method="post">
      <?= csrf_field() ?>
      <div class="field">
        <label for="username">Username</label>
        <input id="username" name="username" type="text" value="<?= old('username') ?>" autofocus>
      </div>
      <div class="field">
        <label for="password">Password</label>
        <input id="password" name="password" type="password">
      </div>
      <button class="btn" type="submit">Masuk</button>
    </form>
  </div>
</body>
</html>

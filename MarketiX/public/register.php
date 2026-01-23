<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';

/* لو المستخدم مسجّل دخول */
if (isset($_SESSION['user_id'])) {
  header("Location: " . BASE_URL . "/public/index.php");
  exit;
}

$errors = [];
$old    = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // تنظيف المدخلات
  $name     = trim($_POST['name'] ?? '');
  $email    = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';

  $old['name']  = htmlspecialchars($name);
  $old['email'] = htmlspecialchars($email);

  /* ===============================
     Full Name Validation
  ================================ */
  if ($name === '') {
    $errors[] = 'Full name is required.';
  } elseif (str_word_count($name) < 2) {
    $errors[] = 'Please enter your full name (first & last name).';
  } elseif (strlen($name) < 6) {
    $errors[] = 'Full name must be at least 6 characters.';
  }

  /* ===============================
     Email Validation
  ================================ */
  if ($email === '') {
    $errors[] = 'Email address is required.';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Please enter a valid email address.';
  } else {
    $stmt = $pdo->prepare("SELECT user_id FROM users WHERE user_email = ? LIMIT 1");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
      $errors[] = 'This email is already registered.';
    }
  }

  /* ===============================
     Password Validation
  ================================ */
  if ($password === '') {
    $errors[] = 'Password is required.';
  } elseif (strlen($password) < 8) {
    $errors[] = 'Password must be at least 8 characters.';
  } elseif (!preg_match('/[A-Z]/', $password)) {
    $errors[] = 'Password must contain at least one uppercase letter.';
  } elseif (!preg_match('/[a-z]/', $password)) {
    $errors[] = 'Password must contain at least one lowercase letter.';
  } elseif (!preg_match('/[0-9]/', $password)) {
    $errors[] = 'Password must contain at least one number.';
  }

  /* ===============================
     CREATE USER
  ================================ */
  if (empty($errors)) {

    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("
      INSERT INTO users (
        user_name,
        user_email,
        user_password,
        user_role,
        user_status
      ) VALUES (?, ?, ?, 'user', 'active')
    ");

    $stmt->execute([
      $name,
      $email,
      $hashed
    ]);

    $_SESSION['flash'] = [
      'type'    => 'success',
      'message' => 'Account created successfully. Please login.'
    ];

    header("Location: " . BASE_URL . "/public/login.php");
    exit;
  }
}

include __DIR__ . '/../views/layouts/header.php';
?>


<style>
:root {
  --mx-green:#22c55e;
  --mx-blue:#3b82f6;
  --mx-dark:#0f172a;
  --mx-border:#e5e7eb;
}

.register-wrapper{
  min-height:75vh;
  display:flex;
  align-items:center;
  justify-content:center;
  background:linear-gradient(135deg,#f8fafc,#ecfdf5);
}

.register-card{
  max-width:460px;
  width:100%;
  border-radius:22px;
  padding:34px;
  background:#fff;
  border:1px solid var(--mx-border);
}

.register-title{
  font-weight:900;
}

.form-control{
  border-radius:12px;
  padding:10px 14px;
}

.form-control:focus{
  border-color:var(--mx-blue);
  box-shadow:0 0 0 .15rem rgba(59,130,246,.15);
}

.register-btn{
  font-weight:800;
  background:linear-gradient(135deg,var(--mx-blue),var(--mx-green));
  border:none;
}

.register-footer{
  font-size:14px;
}
</style>

<div class="register-wrapper">
  <div class="register-card shadow-sm">

    <h3 class="register-title text-center mb-2">
      Create Your <span class="text-success">Marketi</span><span class="text-primary">X</span> Account
    </h3>

    <p class="text-muted text-center mb-4">
      Join Market and start shopping today
    </p>

    <?php if (!empty($errors)): ?>
      <div class="alert alert-danger rounded-4">
        <ul class="mb-0">
          <?php foreach ($errors as $err): ?>
            <li><?= htmlspecialchars($err) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form method="POST">

      <div class="mb-3">
        <label class="form-label fw-semibold">Full Name</label>
        <input name="name"
               class="form-control"
               value="<?= $old['name'] ?? '' ?>"
               placeholder="Your full name"
               required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Email Address</label>
        <input name="email"
               type="email"
               class="form-control"
               value="<?= $old['email'] ?? '' ?>"
               placeholder="example@email.com"
               required>
      </div>

      <div class="mb-4">
        <label class="form-label fw-semibold">Password</label>
        <input name="password"
               type="password"
               class="form-control"
               placeholder="Create a strong password"
               required>
      </div>

      <button class="btn btn-success w-100 register-btn">
        Create Account
      </button>

      <p class="register-footer text-center mt-4 mb-0">
        Already have an account?
        <a href="<?= BASE_URL ?>/public/login.php" class="fw-semibold">
          Login
        </a>
      </p>

    </form>

  </div>
</div>

<?php include __DIR__ . '/../views/layouts/footer.php'; ?>

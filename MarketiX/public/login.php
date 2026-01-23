<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';

/* لو المستخدم مسجّل دخول مسبقًا */
if (isset($_SESSION['user_id'])) {
    header("Location: " . BASE_URL . "/public/index.php");
    exit;
}

$auth  = new AuthController($pdo);
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $result = $auth->login(
        $_POST['email'] ?? '',
        $_POST['password'] ?? ''
    );

    if ($result['success']) {

        /* ===============================
           Remember Me - Cookies
        ================================ */
        if (!empty($_POST['remember_me'])) {

            $token = hash(
                'sha256',
                $_SESSION['user_id'] . ($_SERVER['HTTP_USER_AGENT'] ?? '')
            );

            setcookie(
                'remember_user',
                (string) $_SESSION['user_id'],
                time() + (60 * 60 * 24 * 30),
                '/',
                '',
                false,
                true
            );

            setcookie(
                'remember_token',
                $token,
                time() + (60 * 60 * 24 * 30),
                '/',
                '',
                false,
                true
            );
        }

        /* ===============================
           Redirect حسب الدور
        ================================ */
        switch ($_SESSION['user_role']) {

            case 'admin':
                header("Location: " . BASE_URL . "/views/admin/dashboard.php");
                break;

            case 'seller':
                header("Location: " . BASE_URL . "/views/seller/dashboard.php");
                break;

            default:
                header("Location: " . BASE_URL . "/public/index.php");
        }
        exit;

    } else {
        $error = $result['message'];
    }
}


include __DIR__ . '/../views/layouts/header.php';
?>

<style>
/* ===============================
   LOGIN UI – MarketiX Identity
================================ */

:root {
  --mx-green: #22c55e;
  --mx-blue:  #3b82f6;
  --mx-dark:  #0f172a;
  --mx-bg:    #f8fafc;
  --mx-border:#e5e7eb;
}

.login-wrapper {
  min-height: 75vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #f8fafc, #ecfdf5);
}

.login-card {
  width: 100%;
  max-width: 420px;
  border-radius: 22px;
  padding: 34px;
  background: #fff;
  border: 1px solid var(--mx-border);
}

.login-title {
  font-weight: 900;
  color: var(--mx-dark);
}

.form-control {
  border-radius: 12px;
  padding: 10px 14px;
}

.form-control:focus {
  border-color: var(--mx-blue);
  box-shadow: 0 0 0 .15rem rgba(59,130,246,.15);
}

.login-btn {
  font-weight: 800;
  font-size: 16px;
  background: linear-gradient(135deg, var(--mx-blue), var(--mx-green));
  border: none;
}

.login-btn:hover {
  opacity: .95;
}

.login-footer {
  font-size: 14px;
}
</style>

<div class="login-wrapper">

  <div class="login-card shadow-sm">

    <h3 class="login-title text-center mb-2">
      Login to <span class="text-success">Marketi</span><span class="text-primary">X</span>
    </h3>

    <p class="text-muted text-center mb-4">
      Welcome back! Please sign in
    </p>

    <?php if ($error): ?>
      <div class="alert alert-danger rounded-4 text-center">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['flash'])): ?>
      <div class="alert alert-<?= $_SESSION['flash']['type'] ?> rounded-4 text-center">
        <?= htmlspecialchars($_SESSION['flash']['message']) ?>
      </div>
      <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <form method="POST">

      <div class="mb-3">
        <label class="form-label fw-semibold">Email Address</label>
        <input name="email"
               type="email"
               class="form-control"
               placeholder="example@email.com"
               required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Password</label>
        <input name="password"
               type="password"
               class="form-control"
               placeholder="••••••••"
               required>
      </div>

      <div class="form-check mb-3">
        <input class="form-check-input"
               type="checkbox"
               name="remember_me"
               id="rememberMe">
        <label class="form-check-label" for="rememberMe">
          Remember me
        </label>
      </div>

      <button type="submit" class="btn btn-success w-100 login-btn">
        Login
      </button>

      <p class="login-footer text-center mt-4 mb-0">
        Don’t have an account?
        <a href="<?= BASE_URL ?>/public/register.php" class="fw-semibold">
          Create one
        </a>
      </p>

    </form>

  </div>

</div>

<?php include __DIR__ . '/../views/layouts/footer.php'; ?>

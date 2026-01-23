<?php
/**
 * User Profile – Single Page
 * View + Edit + Change Password (Required)
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';
require_once ROOT_PATH . '/app/middleware/auth.php';

requireAuth($pdo);

$userId = $_SESSION['user_id'];
$error  = null;
$success = null;

/* ===============================
   FETCH USER
================================ */
$stmt = $pdo->prepare("
  SELECT user_name, user_email, user_password
  FROM users
  WHERE user_id = ?
  LIMIT 1
");
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
  die('User not found');
}

/* ===============================
   HANDLE UPDATE
================================ */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $name        = trim($_POST['name'] ?? '');
  $email       = trim($_POST['email'] ?? '');
  $currentPass = $_POST['current_password'] ?? '';
  $newPass     = $_POST['new_password'] ?? '';

  /* ===== Validation ===== */

  if (strlen($name) < 3) {
    $error = 'Full name must be at least 3 characters.';
  }
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = 'Invalid email address.';
  }
  else {
    // تحقق من تكرار الإيميل
    $check = $pdo->prepare("
      SELECT user_id FROM users
      WHERE user_email = ? AND user_id != ?
    ");
    $check->execute([$email, $userId]);

    if ($check->fetch()) {
      $error = 'Email already in use.';
    }
  }

  // كلمة المرور الحالية (إجباري)
  if (!$error) {
    if (empty($currentPass)) {
      $error = 'Current password is required.';
    }
    elseif (!password_verify($currentPass, $user['user_password'])) {
      $error = 'Current password is incorrect.';
    }
  }

  // كلمة المرور الجديدة (إجباري)
  if (!$error) {
    if (strlen($newPass) < 8 ||
        !preg_match('/[A-Z]/', $newPass) ||
        !preg_match('/[a-z]/', $newPass) ||
        !preg_match('/[0-9]/', $newPass)) {

      $error = 'New password must be at least 8 characters and contain uppercase, lowercase and number.';
    }
  }

  /* ===== Update ===== */
  if (!$error) {

    $hashed = password_hash($newPass, PASSWORD_DEFAULT);

    $update = $pdo->prepare("
      UPDATE users SET
        user_name = ?,
        user_email = ?,
        user_password = ?
      WHERE user_id = ?
    ");
    $update->execute([
      $name,
      $email,
      $hashed,
      $userId
    ]);

    $success = 'Profile updated successfully.';
    
    // تحديث البيانات المعروضة
    $user['user_name']  = $name;
    $user['user_email'] = $email;
  }
}
?>

<?php include ROOT_PATH . '/views/layouts/header.php'; ?>

<style>
.profile-wrapper{
  max-width:520px;
  margin:auto;
}
.profile-card{
  background:#fff;
  border:1px solid #e5e7eb;
  border-radius:22px;
  padding:28px;
}
.profile-title{
  font-weight:900;
}
.form-control{
  border-radius:12px;
}
.save-btn{
  border-radius:999px;
  font-weight:800;
}
</style>

<div class="container py-5">

  <div class="profile-wrapper">

    <div class="profile-card shadow-sm">

      <h3 class="profile-title mb-3 text-center">
        👤 My Profile
      </h3>

      <?php if ($error): ?>
        <div class="alert alert-danger rounded-4 text-center">
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <?php if ($success): ?>
        <div class="alert alert-success rounded-4 text-center">
          <?= htmlspecialchars($success) ?>
        </div>
      <?php endif; ?>

      <form method="POST">

        <div class="mb-3">
          <label class="form-label fw-semibold">Full Name</label>
          <input name="name"
                 class="form-control"
                 value="<?= htmlspecialchars($user['user_name']) ?>"
                 required>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold">Email</label>
          <input name="email"
                 type="email"
                 class="form-control"
                 value="<?= htmlspecialchars($user['user_email']) ?>"
                 required>
        </div>

        <hr>

        <div class="mb-3">
          <label class="form-label fw-semibold">
            Current Password <span class="text-danger">*</span>
          </label>
          <input name="current_password"
                 type="password"
                 class="form-control"
                 required>
        </div>

        <div class="mb-4">
          <label class="form-label fw-semibold">
            New Password <span class="text-danger">*</span>
          </label>
          <input name="new_password"
                 type="password"
                 class="form-control"
                 placeholder="Min 8 chars, A-z, 0-9"
                 required>
        </div>

        <button class="btn btn-success w-100 save-btn">
          Save Changes
        </button>

      </form>

    </div>

  </div>

</div>

<?php include ROOT_PATH . '/views/layouts/footer.php'; ?>

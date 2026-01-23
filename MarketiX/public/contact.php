<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MarketiX/app/bootstrap.php';

$errors = [];
$success = false;

$userId   = $_SESSION['user_id']   ?? null;
$userName = $_SESSION['user_name'] ?? '';
$userEmail = '';

if ($userId) {
    $stmt = $pdo->prepare("SELECT user_email FROM users WHERE user_id = ?");
    $stmt->execute([$userId]);
    $userEmail = $stmt->fetchColumn();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '')     $errors[] = 'Name is required.';
    if ($email === '')    $errors[] = 'Email is required.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                          $errors[] = 'Invalid email address.';
    if ($subject === '')  $errors[] = 'Subject is required.';
    if ($message === '')  $errors[] = 'Message is required.';

    if (empty($errors)) {

        $stmt = $pdo->prepare("
            INSERT INTO contact_requests
            (user_id, user_name, user_email, subject, message)
            VALUES (?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $userId,
            $name,
            $email,
            $subject,
            $message
        ]);

        $success = true;
    }
}
?>
<?php include ROOT_PATH . '/views/layouts/header.php'; ?>

<style>
.contact-wrapper{
  min-height:75vh;
  display:flex;
  align-items:center;
  justify-content:center;
  background:#f8fafc;
}
.contact-card{
  max-width:520px;
  width:100%;
  padding:34px;
  border-radius:20px;
  background:#fff;
  border:1px solid #e5e7eb;
}
.form-control{
  border-radius:12px;
  padding:10px 14px;
}
</style>

<div class="contact-wrapper">
  <div class="contact-card shadow-sm">

    <h3 class="fw-bold text-center mb-2">📩 Contact Administration</h3>
    <p class="text-muted text-center mb-4">
      Send us your request and we’ll get back to you.
    </p>

    <?php if ($success): ?>
      <div class="alert alert-success rounded-4 text-center">
        ✅ Your request has been sent successfully.
      </div>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
      <div class="alert alert-danger rounded-4">
        <ul class="mb-0">
          <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form method="POST">

      <div class="mb-3">
        <label class="form-label">Name</label>
        <input name="name"
               class="form-control"
               value="<?= htmlspecialchars($userName) ?>"
               required>
      </div>

      <div class="mb-3">
        <label class="form-label">Email</label>
        <input name="email"
               type="email"
               class="form-control"
               value="<?= htmlspecialchars($userEmail) ?>"
               required>
      </div>

      <div class="mb-3">
        <label class="form-label">Subject</label>
        <input name="subject"
               class="form-control"
               placeholder="Account / Store Issue"
               required>
      </div>

      <div class="mb-4">
        <label class="form-label">Message</label>
        <textarea name="message"
                  rows="4"
                  class="form-control"
                  placeholder="Explain your issue..."
                  required></textarea>
      </div>

      <button class="btn btn-primary w-100 fw-bold">
        Send Message
      </button>

    </form>

  </div>
</div>

<?php include ROOT_PATH . '/views/layouts/footer.php'; ?>

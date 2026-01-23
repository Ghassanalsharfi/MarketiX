<?php
class CheckoutController
{
    private PDO $pdo;
    private int $minAddressLength = 5;
    private int $maxNotesLength   = 500;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getUser(int $userId): array
    {
        $stmt = $this->pdo->prepare("
            SELECT user_name, user_email
            FROM users
            WHERE user_id = ?
            LIMIT 1
        ");
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            die('User not found');
        }

        return $user;
    }

    public function calculateTotal(array $cart): float
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['product_price'] * $item['quantity'];
        }
        return $total;
    }

    public function placeOrder(
        int $userId,
        array $user,
        array $cart,
        array $data
    ): array {

        /* ===============================
           Validation (Server-side)
        ================================ */
        $fullName = trim($data['full_name'] ?? '');
        $email    = trim($data['email'] ?? '');
        $address  = trim($data['address'] ?? '');
        $phone    = trim($data['phone'] ?? '');
        $notes    = trim($data['order_notes'] ?? '');

        if ($fullName === '' || mb_strlen($fullName) < 3) {
            return ['error' => '❌ Please enter a valid full name.'];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['error' => '❌ Invalid email address.'];
        }

        if ($fullName !== $user['user_name'] || $email !== $user['user_email']) {
            return ['error' => '❌ Name or email does not match your account.'];
        }

        if (mb_strlen($address) < $this->minAddressLength) {
            return ['error' => '❌ Delivery address is too short.'];
        }

    // Remove spaces
$phone = trim($data['phone'] ?? '');

// Phone must start with specific prefixes
if (!preg_match('/^(77|78|73|71)[0-9]{7}$/', $phone)) {
    return [
        'error' =>
        '❌ Phone number must start with 77, 78, 73, or 71 and be 9 digits.'
    ];
}


        if ($notes !== '' && mb_strlen($notes) > $this->maxNotesLength) {
            return ['error' => '❌ Order notes are too long.'];
        }

        /* ===============================
           Business Logic (unchanged)
        ================================ */
        try {
            $this->pdo->beginTransaction();

            $checkStock = $this->pdo->prepare("
                SELECT product_quantity, product_reserved
                FROM products
                WHERE product_id = ?
                FOR UPDATE
            ");

            $reserveStock = $this->pdo->prepare("
                UPDATE products
                SET product_reserved = product_reserved + ?
                WHERE product_id = ?
            ");

            foreach ($cart as $item) {
                $checkStock->execute([$item['product_id']]);
                $product = $checkStock->fetch(PDO::FETCH_ASSOC);

                if (!$product) {
                    throw new Exception("Product not found");
                }

                $available =
                    (int)$product['product_quantity']
                  - (int)$product['product_reserved'];

                if ($item['quantity'] > $available) {
                    throw new Exception(
                        "Not enough stock for {$item['product_name']}"
                    );
                }

                $reserveStock->execute([
                    $item['quantity'],
                    $item['product_id']
                ]);
            }

            $total = $this->calculateTotal($cart);

            $stmt = $this->pdo->prepare("
                INSERT INTO orders (
                    user_id, order_total, order_status,
                    order_name, order_email,
                    order_address, order_phone, order_notes
                )
                VALUES (?, ?, 'pending', ?, ?, ?, ?, ?)
            ");

            $stmt->execute([
                $userId,
                $total,
                $fullName,
                $email,
                $address,
                $phone,
                $notes
            ]);

            $orderId = $this->pdo->lastInsertId();

            $itemStmt = $this->pdo->prepare("
                INSERT INTO order_items
                (order_id, product_id, quantity, product_price)
                VALUES (?, ?, ?, ?)
            ");

            foreach ($cart as $item) {
                $itemStmt->execute([
                    $orderId,
                    $item['product_id'],
                    $item['quantity'],
                    $item['product_price']
                ]);
            }

            $this->pdo->commit();
            unset($_SESSION['cart']);

            return ['success' => true];

        } catch (Exception $e) {
            $this->pdo->rollBack();
            return ['error' => $e->getMessage()];
        }
    }
}

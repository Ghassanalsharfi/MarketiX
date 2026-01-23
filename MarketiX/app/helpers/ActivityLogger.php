<?php
/**
 * ActivityLogger
 *
 * Helper class responsible for logging system activities
 * into the activity_logs table.
 *
 * @author MarketiX
 * @version 1.0
 */

class ActivityLogger
{
    /**
     * Log a system activity
     *
     * @param PDO        $pdo
     * @param int|null   $userId
     * @param string     $type
     * @param string     $description
     *
     * @return void
     */
    public static function log(PDO $pdo, ?int $userId, string $type, string $description): void
    {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO activity_logs 
                    (user_id, activity_type, activity_description)
                VALUES 
                    (:user_id, :activity_type, :activity_description)
            ");

            $stmt->execute([
                ':user_id'             => $userId,
                ':activity_type'       => $type,
                ':activity_description'=> $description
            ]);
        } catch (PDOException $e) {
            /**
             * IMPORTANT:
             * Do NOT throw exception to avoid breaking the system.
             * Activity logging must be silent.
             */
        }
    }
}

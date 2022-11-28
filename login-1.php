<?php
    $is_invalid = false;
    if ($_SERVER["REQUEST_METHOD"] === "POST"){

        $mysqli = require __DIR__ . "/database.php";

        $sql = sprintf("SELECT * FROM user WHERE email = '%s'",
        $mysqli->real_escape_string($_POST["email"]));

        $result = $mysqli->query($sql);

        $user = $result->fetch_assoc();

        if ($user){
            if (password_verify($_POST["password"], $user["password_hash"])){
                die("login successful");
            }
        }

        $is_invalid = true;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Signup</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    </head>

    <body>
            <h1>Login</h1>

            <?php if ($is_invalid): ?>
                <em>Invalid login</em>
            <?php endif; ?>

            
            <form method="post">
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email"
                        value="<?= htmlspecialchars($_POST["email"] ?? "") ?>"> <!-- remember email when password is inavlid -->
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                </div>
              
                <button>Login</button>
            </form>
    </body>
</html>
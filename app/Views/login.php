<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h2 class="text-center">Login</h2>

            <?php if(!empty($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']) ?></div>
                <?php endif; ?>

            <form action="/login" method="POST">
                <div class="mb-3">
                    <label for="">Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="">Password:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>

    </div>
   </div>
</body>
</html>
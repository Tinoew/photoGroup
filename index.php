<!DOCTYPE html>
<html
    lang="en">

    <?php include 'includes/head.php' ?>

    <body>
        <?php include 'includes/nav1.php'; ?>
        <main class="main-log-in">

            <div class="primary-bg">
                <div class="girl-reading-wrapper">
                    <img class="girl-reading-img" src="images/girl-enjoying-reading.png" alt="Girl enjoying-reading">
                </div>
                <p class="action">Log in</p>
                <p class="what-you-have-to-do">log in je account</p>
                <form method="post" class="input-fields">
                    <input type="text" name="username" placeholder="username" required><br>
                    <input type="password" name="password" placeholder="password" required><br>
                    <button type="submit" name="submit">log in</button>
                </form>
                <a href="sign_up.php">maak een account</a>
            </div>
        </main>
        <?php include 'includes/footer.php' ?>
    </body>

</html>
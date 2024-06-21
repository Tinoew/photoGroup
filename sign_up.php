<body>
<?php include 'includes/nav.php'; ?>
    <main class="main-log-in">
        <div class="primary-bg">
            </div>
            <p class="action">Account aanmaken</p>
            <p class="what-you-have-to-do">maak je account aan</p>
            <form method="post" class="input-fields">

                <input type="text" name="username" placeholder="username"><br>

                <input type="password" name="password" placeholder="password"><br>
                
                <button type="submit" name= "submit" >account creëren</button>
                
            </form>
            <a href="login.php">log in</a>
        </div>
    </main>
    <?php include 'includes/footer.php' ?>
</body>

</html>
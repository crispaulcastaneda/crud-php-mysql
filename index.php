<!DOCTYPE html>
<html lang='EN-US'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD PHP</title>

    <link rel="icon" type="image/x-icon" href="https://www.flaticon.com/svg/vstatic/svg/762/762620.svg?token=exp=1613657745~hmac=3af04c64f082660948a0f00bb101ba42">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>
<body>

<?php require_once 'php-pages/process.php'; ?>

<?php if (isset($_SESSION['message'])): ?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">

        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>

    </div> <!-- End of div alert -->
    <?php endif; ?>


    <div class="container">
        <?php
            // Connect mySQL DB
            $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
            // pre_r($result);
        ?>

        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
        <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id']; ?>"
                            class="btn btn-info">Edit</a>
                        <a href="php-pages/process.php?delete=<?php echo $row['id']; ?>"
                            class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </table>
        </div>

        <?php
            function pre_r($array) {
                echo '<pre>';
                print_r($array);
                echo '</pre>';
            }
        ?>

        <div class="row justify-content-center">
            <form action="php-pages/process.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control"
                        value="<?php echo $name; ?>"  placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" class="form-control"
                        value="<?php echo $location; ?>" placeholder="Enter your location">
                </div>
                <div class="form-group">
                <?php if ($update == true): ?>
                    <button type="submit" class="btn btn-info" name="update">Update</button>
                <?php else:?>
                    <button type="submit" class="btn btn-primary" name="save">Save</button>
                <?php endif;?>
                </div>
            </form>
        </div> <!-- Justify Content -->
    </div> <!-- Design for Container -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/app.js" defer></script>

</body>
</html>
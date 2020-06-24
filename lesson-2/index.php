<?php
session_start();
include_once __DIR__ . '/db/sql_injection.php';

?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link crossorigin="anonymous" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
              integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" rel="stylesheet">
        <title>PHP CRUD</title>
    </head>
    <body>
    <div class="container">
        <!-- INSERT USER -->
        <div class="insert-form">
            <?php if (isset($_SESSION['db_errors'])): ?>
            <div class="alert alert-danger" role="alert">
                <p><?= $_SESSION['db_errors']['message'] ?></p>
            </div>
            <?php endif ?>
            <div class="row">
                <div class="mx-auto my-5">
                    <h1 class="text-center mb-5">Insert User</h1>
                    <?php if (isset($_SESSION['success']['insert_message'])): ?>
                        <div class="alert alert-success" role="alert">
                            <p><?= $_SESSION['success']['insert_message'] ?></p>
                        </div>
                    <?php elseif (isset($_SESSION['errors']['insert_message'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <p><?= $_SESSION['errors']['insert_message'] ?></p>
                        </div>
                    <?php endif ?>
                    <form action="db/insert.php" method="post" class="justify-content-center">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputLogin">Login</label>
                                <input type="text" class="form-control" id="inputLogin" name="login">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword">Password</label>
                                <input type="password" class="form-control" id="inputPassword" name="password">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail">Email</label>
                                <input type="email" class="form-control" id="inputEmail" name="email"
                                       placeholder="example@email.com">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPhone">Phone</label>
                                <input type="tel" class="form-control" id="inputPhone" name="phone"
                                       placeholder="380501234567">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputFirstName">First Name</label>
                            <input type="text" class="form-control" name="first_name" id="inputFirstName">
                        </div>
                        <div class="form-group">
                            <label for="inputLastName">Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="inputLastName">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputBirthDay">Birthday</label>
                                <input type="date" class="form-control" name="birthday" id="inputBirthDay">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Add User</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- UPDATE USER -->
        <div class="update-form">
            <div class="row">
                <div class="mx-auto my-5">
                    <h1 class="text-center mb-5">Update User</h1>
                    <?php if (isset($_SESSION['success']['update_message'])): ?>
                        <div class="alert alert-success" role="alert">
                            <p><?= $_SESSION['success']['update_message'] ?></p>
                        </div>
                    <?php elseif (isset($_SESSION['errors']['update_message'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <p><?= $_SESSION['errors']['update_message'] ?></p>
                        </div>
                    <?php endif ?>
                    <form action="db/update.php" method="post" class="justify-content-center">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputId">User Id</label>
                                <input type="number" class="form-control" id="inputId" name="user_id">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputNewName">New Name</label>
                                <input type="text" class="form-control" id="inputNewName" name="new_name">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">Update User</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- DELETE USER -->
        <div class="delete-form">
            <div class="row">
                <div class="mx-auto my-5">
                    <h1 class="text-center mb-5">Delete User</h1>
                    <?php if (isset($_SESSION['success']['delete_message'])): ?>
                        <div class="alert alert-success" role="alert">
                            <p><?= $_SESSION['success']['delete_message'] ?></p>
                        </div>
                    <?php elseif (isset($_SESSION['errors']['delete_message'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <p><?= $_SESSION['errors']['delete_message'] ?></p>
                        </div>
                    <?php endif ?>
                    <form action="db/delete.php" method="post" class="justify-content-center">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="inputId">User Id</label>
                                <input type="number" class="form-control" id="inputId" name="user_id">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Delete User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    </body>
    </html>
<?php unset($_SESSION['db_errors'], $_SESSION['errors'], $_SESSION['success']) ?>
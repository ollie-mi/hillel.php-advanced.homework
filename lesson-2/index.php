<?php session_start() ?>
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
            <div class="row">
                <div class="mx-auto my-5">
                    <h1 class="text-center mb-5">Insert User</h1>
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success" role="alert">
                            <p><?= $_SESSION['success']['message'] ?></p>
                        </div>
                    <?php elseif (isset($_SESSION['errors'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <p><?= $_SESSION['errors']['message'] ?></p>
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
                    <?php if (isset($_SESSION['update_success'])): ?>
                        <div class="alert alert-success" role="alert">
                            <p><?= $_SESSION['update_success']['message'] ?></p>
                        </div>
                    <?php elseif (isset($_SESSION['update_errors'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <p><?= $_SESSION['update_errors']['message'] ?></p>
                        </div>
                    <?php endif ?>
                    <form action="db/update.php" method="post" class="justify-content-center">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputId">User Id</label>
                                <input type="text" class="form-control" id="inputId" name="user_id">
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
    </div>

    <!--    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"-->
    <!--            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"-->
    <!--            crossorigin="anonymous"></script>-->
    <!--    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"-->
    <!--            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"-->
    <!--            crossorigin="anonymous"></script>-->
    <!--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"-->
    <!--            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"-->
    <!--            crossorigin="anonymous"></script>-->
    </body>
    </html>
<?php unset($_SESSION['errors'], $_SESSION['success'], $_SESSION['update_success'], $_SESSION['update_errors']) ?>
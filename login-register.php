<?php

$first_name = (isset($_POST['submit'])) ? trim($_POST['first-name']) : "";
$last_name = (isset($_POST['submit'])) ? trim($_POST['last-name']) : "";
$email = (isset($_POST['submit'])) ? trim($_POST['email']) : "";
$password = (isset($_POST['submit'])) ? trim($_POST['password']) : "";
$confirm_password = (isset($_POST['submit'])) ? trim($_POST['confirm-password']) : "";
$phone = (isset($_POST['submit'])) ? trim($_POST['phone']) : "";

//Encryption of password 
$password_hash = password_hash($password,PASSWORD_DEFAULT);

// Message Variables
$message_first_name = "";
$message_last_name = "";
$message_email = "";
$message_phone = "";
$message_password = "";
$message_confirm_password = "";
$message_pass = "";

// Initialisation for our boolean (when the user has not touched the submit button yet!)
$form_good = null;

if (isset($_POST['submit'])) {
    // This boolean will keep track of whether or not we've passed validation.
    $form_good = TRUE;

    // First Name Validation
    if ($first_name == "") {
        $message_first_name = "<p>Please enter your first name.</p>";
        $form_good = FALSE;
    }
    // If the input is NOT null (the user typed something), we'll sanitise it.
    else {
        $first_name = filter_var($first_name, FILTER_SANITIZE_STRING);
    }
    if ($first_name == FALSE) {
        $message_first_name = "<p>Please enter a valid first name.</p>";
        $form_good = FALSE;
    }
    // Last Name Validation
    if ($last_name == "") {
        $message_last_name = "<p>Please enter your last name.</p>";
        $form_good = FALSE;
    }
    // If the input is NOT null (the user typed something), we'll sanitise it.
    else {
        $last_name = filter_var($last_name, FILTER_SANITIZE_STRING);
    }
    if ($last_name == FALSE) {
        $message_last_name = "<p>Please enter a valid last name.</p>";
        $form_good = FALSE;
    }

    // EMAIL VALIDATION
    if ($email == "") {
        $message_email = "<p>Please enter your email address.</p>";
        $form_good = FALSE;
    } else {
        // If there's something there, we'll sanitise the value.
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    }
    if ($email == FALSE) {
        $message_email = "<p>Please enter a valid email address.</p>";
        $form_good = FALSE;
    }
    // If they pass sanitisation, let's do validation.
    else {
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    if ($email == FALSE) {
        $message_email = "<p>Please enter a valid email address, including an @ and a top-level domain.</p>";
        $form_good = FALSE;
    } else {
        // One last check! Let's compare our email to a regular expression (RegEx).
        $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";

        if (preg_match($pattern, $email) == false) {
            $message_email = "<p>Please enter a valid email address, including an @ and a top-level domain.</p>";
            $form_good = FALSE;
        }

    }
    //Password Validation 
    if(strlen($password)<8){
        $message_password = "<p>Your password cannot be less than 8 characters long </p>";
        $form_good = FALSE;
    }
    if($password !== $confirm_password){
        $message_confirm_password = "<p>Your passwords do not match </p>";
        $form_good = FALSE; 
    }


    //  PHONE NUMBER
    if ($phone == "") {
        $message_phone = "<p>Please enter your phone number.</p>";
        $form_good = FALSE;
    } else {
        $phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
    }
    if ($phone == FALSE) {
        $message_phone = "<p>Please enter your phone number without letters or special characters.</p>";
        $form_good = FALSE;
    } else {
        // Let's strip out any potential extra characters the users punched in.
        $phone = str_replace('-', '', $phone);
        $phone = str_replace('+', '', $phone);
        $phone = str_replace('.', '', $phone);
        $phone = str_replace('(', '', $phone);
        $phone = str_replace(')', '', $phone);
    }
    // Let's check to see if, after we've stripped all of the special characters away, whether or not we have a number left.
    if (!is_numeric($phone)) {
        $message_phone = "<p>Please enter your phone number without letters or special characters.</p>";
        $form_good = FALSE;
    } else {
        // Let's test the length of the number. Let's assume we want a Canadian number. That means we want 10 digits. (ex. 780 123 4567)
        if (strlen($phone) != 10) {
            $message_phone = "<p>Please enter a ten-digit Canadian phone number without the country code.</p>";
            $form_good = FALSE;
        }
    }
}



if ($form_good == TRUE) {
    $message_pass = "<p>Congratulations you have sucessfully registered!</p>";
}


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP Form Validation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body class="bg-secondary-subtle">
    <main class="d-flex justify-content-center align-items-center min-vh-100 p-3">
        <section class="row">
            <div class="col bg-white rounded p-5 border border-secondary-subtle">
                <h1 class="fw-light">Register</h1>
                <p class="text-muted">Please fill out all of the fields below to register.</p>

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="my-3" method="POST">
                    <!-- First & Last Name -->
                    <div class="mb-3">
                        <label for="first-name" class="form-label">First Name</label>
                        <input id="first-name" type="text" name="first-name" aria-describedby="first-name-help"
                            class="form-control" value="<?php echo $first_name; ?>">
                        <div id="first-name-help" class="form-text">
                            <?php echo $message_first_name; ?>
                        </div>
                    </div>
                    <!-- Last Name  -->
                    <div class="mb-3">
                        <label for="last-name" class="form-label">Last Name</label>
                        <input id="last-name" type="text" name="last-name" aria-describedby="last-name-help"
                            class="form-control" value="<?php echo $last_name; ?>">
                        <div id="last-name-help" class="form-text">
                            <?php echo $message_last_name; ?>
                        </div>
                    </div>
                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input id="email" name="email" type="text" class="form-control" aria-describedby="email-help"
                            value="<?php echo $email; ?>">
                        <div class="form-text" id="email-help">
                            <?php echo $message_email; ?>
                        </div>
                    </div>
                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" name="password" type="password" class="form-control"
                            aria-describedby="password-help">
                        <div class="form-text" id="password-help">
                            <?php echo $message_password; ?>
                        </div>
                    </div>
                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="confirm-password" class="form-label">Confirm Password</label>
                        <input id="confirm-password" name="confirm-password" type="password" class="form-control"
                            aria-describedby="confirm-password-help">
                        <div class="form-text" id="confirm-password-help">
                            <?php echo $message_confirm_password; ?>
                        </div>
                    </div>
                    <!-- Phone Number -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input id="phone" name="phone" type="tel" class="form-control" aria-describedby="phone-help"
                            value="<?php echo $phone; ?>">
                        <div class="form-text" id="phone-help">
                            <?php echo $message_phone; ?>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="d-flex justify-content-center">
                        <input type="submit" name="submit" class="btn btn-primary" value="Send Message">
                    </div>
                </form>

                <!-- This area will echo out a success message if the data is valid and passes our gauntlet. -->
                <?php if ($form_good == true): ?>
                    <div class="alert alert-primary my-4" role="alert">
                        <?php echo $message_pass; ?>
                    </div>
                <?php endif ?>
            </div>
        </section>
    </main>
    <h1>Output Values</h1>
    <p>First Name:
        <?php echo $first_name; ?>
    </p>
    <p>Last Name:
        <?php echo $last_name; ?>
    </p>
    <p>Email:
        <?php echo $email; ?>
    </p>
    <p>Password:
        <?php echo $password; ?>
    </p>
    <p>Confirm Password:
        <?php echo $confirm_password; ?>
    </p>
    <p>Phone:
        <?php echo $phone; ?>
    </p>
</body>

</html>
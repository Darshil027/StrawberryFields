<?php
    // Initialising Variables
    // $var_name = (Condition) ? (Then) : (Else/Default);

$name = (isset($_GET['submit'])) ? trim($_GET['name']) : "";
$email = (isset($_GET['submit'])) ? trim($_GET['email']) : "";
$phone = (isset($_GET['submit'])) ? trim($_GET['phone']) : "";
$comments = (isset($_GET['submit'])) ? trim($_GET['comments']) : "";

// Message Variables
$message_name = "";
$message_email = "";
$message_phone = "";
$message_comments = "";
$message_pass = "";

// Initialisation for our boolean (when the user has not touched the submit button yet!)
$form_good = null;

if(isset($_GET['submit'])) {
    // This boolean will keep track of whether or not we've passed validation.
    $form_good = TRUE;

    // NAME VALIDATION
    if ($name == "") {
        $message_name = "<p>Please enter your name.</p>";
        $form_good = FALSE;
    }
    // If the input is NOT null (the user typed something), we'll sanitise it.
    else {    
        $name = filter_var($name, FILTER_SANITIZE_STRING);
    }
    if ($name == FALSE) {
        $message_name = "<p>Please enter a valid name.</p>";
        $form_good = FALSE;
    }
    // Let's check to see if there is a space! We want a full (first and last) name.
    if (strpos($name, " ") == false) {
        $message_name = "<p>Please enter your full (first and last) name.</p>";
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
                // http://data.iana.org/TLD/tlds-alpha-by-domain.txt
            }
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
            $message_phone = "<p>Please enter a ten-digit Canadian phone number.</p>";
            $form_good = FALSE;
        }
    }

    // COMMENTS / MESSAGE
    if ($comments == "") {
        $message_comments = "<p>Please enter your message above.</p>";
        $form_good = FALSE;
    } else {
        // This will strip out any ASCII characters with a value below 32.
        // https://www.rapidtables.com/code/text/ascii-table.html
        $comments = filter_var($comments, FILTER_SANITIZE_SPECIAL_CHARS);
    }
    if ($comments == false) {
        $message_comments = "<p>Please enter a valid message.</p>";
        $form_good = FALSE;
    } else {
        $comments = filter_var($comments, FILTER_SANITIZE_STRING);
    }
    if ($comments == false) {
        $message_comments = "<p>Please enter a valid message.</p>";
        $form_good = FALSE;
    }

    // If the user passes our gauntlet of validation tests, we'll echo out a celebratory message.
    if ($form_good == TRUE) {
        $message_pass = "<p>All fields have passed validation. Congratulations!</p>";
    }


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP Form Validation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body class="bg-secondary-subtle">
    <main class="d-flex justify-content-center align-items-center min-vh-100 p-3">
        <section class="row">
            <div class="col bg-white rounded p-5 border border-secondary-subtle">
                <h1 class="fw-light">Contact Us</h1>
                <p class="text-muted">We'd love to hear from you! Please fill out all of the fields below.</p>

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="my-3">
                <!-- First & Last Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input id="name" type="text" name="name" aria-describedby="name-help" class="form-control" value="<?php echo $name; ?>">
                        <div id="name-help" class="form-text">
                            <?php echo $message_name; ?>
                        </div>
                    </div>
                <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input id="email" name="email" type="text" class="form-control" aria-describedby="email-help" value="<?php echo $email; ?>">
                        <div class="form-text" id="email-help">
                            <?php echo $message_email; ?>
                        </div>
                    </div>
                <!-- Phone Number -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input id="phone" name="phone" type="tel" class="form-control" aria-describedby="phone-help" value="<?php echo $phone; ?>">
                        <div class="form-text" id="phone-help">
                            <?php echo $message_phone; ?>
                        </div>
                    </div>
                <!-- Message / Comments -->
                    <div class="mb-3">
                        <label for="comments" class="form-label">Your Message</label>
                        <textarea id="comments" name="comments" type="text" class="form-control" aria-describedby="comments-help"><?php echo $comments; ?></textarea>
                        <div class="form-text" id="comments-help">
                            <?php echo $message_comments; ?>
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
  </body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/admin/css/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/admin/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/admin/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/admin/css/style.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom right, #70c1ff, #498ffc);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .card {
            width: 350px;
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 15px;
            padding: 40px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #fff;
            text-align: center;
            margin-bottom: 20px;
            font-size: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            color: #fff;
            margin-bottom: 5px;
        }

        input {
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.8);
        }

        button {
            padding: 10px;
            background-color: #fff;
            color: #498ffc;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #70c1ff;
        }

        @media (max-width: 480px) {
            .card {
                width: 100%;
                max-width: 350px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Registration Form</h2>
            <form id="register" method="post">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Enter your name">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" placeholder="Enter your email">
                <label for="email">Phon Number</label>
                <input type="text" name="phone" id="phone" placeholder="Enter your phone no.">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password">
                <label for="password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Enter your Confirm Password">
                <button value="submit" name="submit" class="btn searchbtn butn">Submit<span
                        class="wpcf7-spinner"><br></span></button>
                        <div class="alert-message"></div>
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                    value="<?php echo $this->security->get_csrf_hash(); ?>"></p>
            </form>
        </div>
    </div>
</body>


<script> var base_url = '<?php echo base_url(); ?>';</script>
<script src="<?php echo base_url()?>assets/admin/js/jquery-min.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/jquery-ui.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/form_val.js"></script>

</html>
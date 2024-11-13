<?php
include './header/header.php';
?>
 <style>
        /* Importing fonts from Google */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

        /* Reseting */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }


        .wrapper {
            max-width: 350px;
            min-height: 500px;
            margin: 80px auto;
            padding: 40px 30px 30px 30px;
            background-color: #ecf0f3;
            border-radius: 15px;
            box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff;
        }

        .logo {
            width: 205px;
            /* margin: 80px auto; */
        }

        .logo img {
            width: 140%;
            height: 210px;
            border-radius: 10%;
            box-shadow: 0px 0px 3px #5f5f5f,
                0px 0px 0px 5px #ecf0f3,
                8px 8px 15px #a7aaa7,
                -8px -8px 15px #fff;
        }

        .wrapper .name {
            font-weight: 600;
            font-size: 1.4rem;
            letter-spacing: 1.3px;
            padding-left: 10px;
            color: #555;
        }

        .wrapper .form-field input {
            width: 100%;
            display: block;
            border: none;
            outline: none;
            background: none;
            font-size: 1.2rem;
            color: #666;
            padding: 10px 15px 10px 10px;
            /* border: 1px solid red; */
        }

        .wrapper .form-field {
            padding-left: 10px;
            margin-bottom: 20px;
            border-radius: 20px;
            box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff;
        }

        .wrapper .form-field .fas {
            color: #555;
        }

        .wrapper .btn {
            box-shadow: none;
            width: 100%;
            height: 40px;
            background-image: linear-gradient(#2000ff, #181813);
            color: #fff;
            border-radius: 25px;
            box-shadow: 3px 3px 3px #b1b1b1,
                -3px -3px 3px #fff;
            letter-spacing: 1.3px;
        }

        .wrapper .btn:hover {
            /* background-color: #039BE5; */
            background-image: linear-gradient(#2000ff, #181813);

        }

        .wrapper a {
            text-decoration: none;
            font-size: 0.8rem;
            color: #03A9F4;
        }

        .wrapper a:hover {
            color: #039BE5;
        }

        @media(max-width: 380px) {
            .wrapper {
                margin: 30px 20px;
                padding: 40px 15px 15px 15px;
            }
        }
    </style>
    <?php

    $data = [
        "nama_users" => "",
        "password" => "",
        "err_uname" => "",
        "err_upass" => "",
        "err_msg" => "",
    ];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $data["nama_users"] = $_POST["nama_users"];
        $data["password"] = $_POST["password"];


        #Database Connection
        include_once('./config/koneksi.php');


        $nama_users = mysqli_real_escape_string($koneksi, $_POST["nama_users"]);
        $password = mysqli_real_escape_string($koneksi, $_POST["password"]);

        $sql = "SELECT * FROM users WHERE nama_users='{$nama_users}'";
        $res = $koneksi->query($sql);

        if ($res->num_rows > 0) {

            $row = $res->fetch_assoc();
            if ($row["password"] === $password) {

                $_SESSION["login_details"] = $row;
                header("location:./v_dashboard");
            } else {
                #Set error message for Invalid Password 
                $data["err_upass"] = "Invalid Password";
            }
        } else {
            #Set error message for Invalid User Name 
            $data["err_uname"] = "Invalid User Name";
        }
    }
    ?>

    <div class="wrapper">
    <div class="text-center mt-6 name">
             <img src="./logo.png" class="form-control" height="180">
            </div>
    
        <!-- <div class="text-center mt-6 name">
              Silahkan Login
            </div> -->
        <br />
        <form method='post' action='<?php echo $_SERVER["REQUEST_URI"]; ?>' class="p-3 mt-3" autocomplete='off'>
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type='text' name='nama_users' required placeholder='Username' value='<?php echo $data["nama_users"]; ?>'>
                <p style='color:red;'><?php echo $data["err_uname"]; ?></p>
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type='Password' name='password' required placeholder='password' value='<?php echo $data["password"]; ?>' id="myInput">

                <p style='color:red;'><?php echo $data["err_upass"]; ?></p>
            </div>
            &nbsp;<input type="checkbox" onclick="myFunction()">&nbsp;Show Password &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <br />

            <br />
            <button class="btn mt-3" type='submit' name='submit'>Login</button>
        </form>
    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
<?php
include './footer/footer.php';
?>
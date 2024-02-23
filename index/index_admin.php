<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: index_login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <style>
        .timeline-section {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            justify-content: center;
            align-items: center;
            padding-top: 2rem;
            margin-bottom: 2rem;
        }

        .timeline-section h2{
            font-size: 20px;
            color: #719692;
        }

        .form-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 500px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: border-color 0.3s ease;
            font-size: 16px;
        }

        .form-group input[type="file"] {
            cursor: pointer;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="file"]:focus {
            border-color: #007bff;
            outline: none;
        }

        .form-group input[type="submit"] {
            background-color: #396460;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            width: 100%;
            display: block;
        }

        .form-group input[type="submit"]:hover {
            background-color: #719692;
        }

        .form-group textarea {
            width: 420px;
            height: 220px;
            border: 1px solid black;
            padding-left: 10px;
            padding-top: 6px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">

            <li class="active">
                <a href="#">
                    <i class='bx bxs-dashboard'></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="#about">
                    <i class='bx bxs-info-circle'></i>
                    <span>About</span>
                </a>
            </li>

            <li>
                <a href="#timeline">
                    <i class='bx bxs-graduation'></i>
                    <span>Timeline</span>
                </a>
            </li>

            <li>
                <a href="#experience">
                    <i class='bx bx-library'></i>
                    <span>Experience</span>
                </a>
            </li>

            <li>
                <a href="#project">
                    <i class='bx bxs-briefcase'></i>
                    <span>Projects</span>
                </a>
            </li>

            <li>
                <a href="#photography">
                    <i class='bx bxs-camera'></i>
                    <span>Photography</span>
                </a>
            </li>

            <li>
                <a href="#message">
                    <i class='bx bxs-message-dots'></i>
                    <span>Message</span>
                </a>
            </li>

            <li>
                <a href="./index.php">
                    <i class='bx bxs-home'></i>
                    <span>Homepage</span>

                </a>
            </li>

            <li class="logout">
                <a href="./logout.php">
                    <i class='bx bx-log-out'></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>


    <div class="main--content">
        <div class="header--wraper">
            <div class="head-title">
                <span>Primary</span>
                <h2>Dashboard</h2>
            </div>
            <div class="user--info">
                <div class="search--box">
                    <i class='bx bx-search'></i>
                    <input type="text" placeholder="Search">
                </div>
                <img src="../asset/profile-user.png" alt="">
            </div>
        </div>

        <section id="about">
            <div class="main--title--div">
                <h3 class="main--title">About</h3>
            </div>
            <div class="timeline-section">
                <h2>Upload Section</h2>
                <div class="form-container">
                    <form action="../include/about.inc.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <!-- <tex type="text" name="bio" required placeholder="Enter Bio"> -->
                            <textarea name="bio" placeholder="Enter Bio" rows="5" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="picture">Upload Picture:</label>
                            <input type="file" id="picture" name="picture" accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Upload">
                        </div>
                    </form>
                </div>
            </div>

            <div class="timeline-section">
                <h2>Display Section</h2>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Bio</th>
                                <th>Picture</th>
                                <th>Time</th>
                                <th>Operation</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php

                            include './dbconnect.inc.php';

                            $sql = "SELECT * FROM `about`";
                            $result = mysqli_query($conn, $sql);

                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row['sn'];
                                    $bio = $row['bio'];
                                    $picture = $row['picture'];
                                    $time = $row['time'];

                                    echo '<tr>
                <th scope="row">' . $id . '</th>
                <td>' . $bio . '</td>
                <td>' . $picture . '</td>
                <td>' . $time . '</td>
                <td>                                   
                <button><a href="../crud/delete_about.php ? deleteid=' . $id . '">Delete</a> </button>
                <button><a href="../crud/update_about.php ? updateid=' . $id . '">Update</a> </button>
                </td>           
                </tr>';
                                }
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </section>

        <section id="timeline">
            <div class="main--title--div">
                <h3 class="main--title">Timeline</h3>
            </div>
            <div class="timeline-section">
                <div class="form-container">
                    <form action="../include/timeline.inc.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <!-- <label for="name">University Name:</label> -->
                            <input type="text" name="name" required placeholder="University Name">
                        </div>
                        <div class="form-group">
                            <!-- <label for="email">Degree:</label> -->
                            <input type="text" name="degree" required placeholder="Degree">
                        </div>
                        <div class="form-group">
                            <!-- <label for="subject">Year:</label > -->
                            <input type="text" name="year" required required placeholder="Year">
                        </div>
                        <div class="form-group">
                            <!-- <label for="message">Description:</label> -->
                            <textarea name="description" placeholder="Description" rows="5" required></textarea>
                            <!-- <input type="text" name="description" required required placeholder="Description"> -->
                        </div>
                        <div class="form-group">
                            <label for="picture">Upload University Logo:</label>
                            <input type="file" id="picture" name="picture" accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Upload">
                        </div>
                    </form>
                </div>
            </div>

        </section>

        <section id="experience">
            <div class="main--title--div">
                <h3 class="main--title">Experience</h3>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>Query</td>
                            <td>Hello, I have a question...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section id="project">
            <div class="main--title--div">
                <h3 class="main--title">Projects</h3>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>Query</td>
                            <td>Hello, I have a question...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section id="photography">
            <div class="main--title--div">
                <h3 class="main--title">Photography</h3>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>Query</td>
                            <td>Hello, I have a question...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <section id="message">
            <div class="main--title--div">
                <h3 class="main--title">Message</h3>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Time</th>
                            <th>Operation</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php

                        include './dbconnect.inc.php';

                        $sql = "SELECT * FROM `message`";
                        $result = mysqli_query($conn, $sql);

                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $email = $row['email'];
                                $subject = $row['subject'];
                                $message = $row['message'];
                                $time = $row['time'];
                                echo '<tr>
                <th scope="row">' . $id . '</th>
                <td>' . $name . '</td>
                <td>' . $email . '</td>
                <td>' . $subject . '</td>
                <td>' . $message . '</td>
                <td>' . $time . '</td>
                <td>  
                                                      
                <button><a href="../crud/delete_message.php ? deleteid=' . $id . '">Delete</a> </button>
                </td>           
                </tr>';
                            }
                        }
                        ?>
                    </tbody>

                </table>
            </div>
        </section>



    </div>

</body>

</html>
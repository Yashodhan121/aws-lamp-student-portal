<?php

require_once "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $course = trim($_POST["course"] ?? "");

    if ($name === "" || $email === "" || $course === "") {
        $message = "Please fill in all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address.";
    } else {

        $stmt = $conn->prepare(
            "INSERT INTO students (name, email, phone, course)
             VALUES (?, ?, ?, ?)"
        );

        $stmt->bind_param("ssss", $name, $email, $phone, $course);

        if ($stmt->execute()) {
            $message = "Student added successfully!";
        } else {
            $message = "Error adding student: " . $stmt->error;
        }

        $stmt->close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Student - AWS Student Portal</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f7fb;
        }

        .header {
            background: #232f3e;
            color: white;
            padding: 25px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        button {
            width: 100%;
            margin-top: 25px;
            padding: 13px;
            background: #ff9900;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #e68900;
        }

        .message {
            padding: 12px;
            margin-bottom: 15px;
            background: #e8f5e9;
            color: #2e7d32;
            border-radius: 6px;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #1976d2;
        }
    </style>
</head>

<body>

<div class="header">
    <h1>🎓 AWS Student Portal</h1>
    <p>Add Student</p>
</div>

<div class="container">

    <h2>👨‍🎓 Student Registration</h2>

    <?php if ($message !== ""): ?>
        <div class="message">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">

        <label for="name">Student Name *</label>
        <input
            type="text"
            id="name"
            name="name"
            placeholder="Enter student name"
            required
        >

        <label for="email">Email *</label>
        <input
            type="email"
            id="email"
            name="email"
            placeholder="Enter email address"
            required
        >

        <label for="phone">Phone</label>
        <input
            type="text"
            id="phone"
            name="phone"
            placeholder="Enter phone number"
        >

        <label for="course">Course *</label>
        <input
            type="text"
            id="course"
            name="course"
            placeholder="Enter course"
            required
        >

        <button type="submit">
            ➕ Add Student
        </button>

    </form>

    <a class="back" href="index.php">
        ← Back to Student Portal
    </a>

</div>

</body>
</html>

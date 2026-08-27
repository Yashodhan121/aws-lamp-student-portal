<?php
require_once "db.php";

$sql = "SELECT id, name, email, phone, course, created_at 
        FROM students 
        ORDER BY id DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>AWS Student Portal</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #222;
        }

        header {
            background: #232f3e;
            color: white;
            padding: 25px;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        header p {
            margin: 8px 0 0;
            color: #ddd;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: 35px auto;
        }

        .top-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 15px;
        }

        .top-section h2 {
            margin: 0;
        }

        .btn {
            display: inline-block;
            background: #ff9900;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 6px;
            font-weight: bold;
        }

        .btn:hover {
            background: #e68a00;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            padding: 13px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #232f3e;
            color: white;
        }

        tr:hover {
            background: #f5f5f5;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #777;
        }

        footer {
            text-align: center;
            margin-top: 40px;
            padding: 20px;
            color: #666;
        }

        @media (max-width: 700px) {
            .top-section {
                flex-direction: column;
                align-items: flex-start;
            }

            table {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

<header>
    <h1>🎓 AWS Student Portal</h1>
    <p>LAMP Application hosted on AWS</p>
</header>

<div class="container">

    <div class="top-section">
        <h2>Student Records</h2>

        <a href="add_student.php" class="btn">
            ➕ Add Student
        </a>
    </div>

    <div class="card">

        <?php if ($result && $result->num_rows > 0): ?>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Course</th>
                        <th>Created At</th>
                    </tr>
                </thead>

                <tbody>

                <?php while ($student = $result->fetch_assoc()): ?>

                    <tr>
                        <td>
                            <?php echo htmlspecialchars($student['id']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($student['name']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($student['email']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($student['phone']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($student['course']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($student['created_at']); ?>
                        </td>
                    </tr>

                <?php endwhile; ?>

                </tbody>
            </table>

        <?php else: ?>

            <div class="empty">
                <h3>No students found</h3>
                <p>Add your first student using the button above.</p>
            </div>

        <?php endif; ?>

    </div>

</div>

<footer>
    <p>☁️ AWS LAMP Student Portal</p>
    <p>PHP + Apache + Amazon RDS MySQL</p>
</footer>

</body>
</html>

<?php
$conn->close();
?>

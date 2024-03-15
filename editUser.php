<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      
        body {
            background: linear-gradient(to right, #7bdcb5, #00d084);
            color: #333;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn {
            margin-right: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    require 'connection.php';


    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
        $id = $_GET['id'];
        $connection = new Connection();
        $stmt = $connection->getConnection()->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);

       
        if ($user) {
            ?>
            <h2>Editar Usuário</h2>
            <form action="sendEdit.php" method="post">
                <input type="hidden" name="id" value="<?php echo $user->id; ?>">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" id="nome" name="nome" value="<?php echo $user->name; ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $user->email; ?>" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            </form>
            <?php
        } else {
            echo "<div class='alert alert-danger' role='alert'>Usuário não encontrado.</div>";
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>ID do usuário não fornecido.</div>";
    }
    ?>
</div>

</body>
</html>

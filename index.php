<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos personalizados */
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
    $connection = new Connection();

    $dbh = $connection->getConnection();
    if ($dbh) {
        echo "<h2 class='mb-4'>Lista de Usuários</h2>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Erro ao estabelecer conexão com o banco de dados.</div>";
    }

    $users = $connection->query("SELECT * FROM users");

    if ($users->rowCount() > 0) {
        echo "<table class='table table-striped'>
                <thead>
                    <tr>
                        <th>ID</th>    
                        <th>Nome</th>    
                        <th>Email</th>
                        <th>Ações</th>    
                    </tr>
                </thead>
                <tbody>";

        foreach ($users as $user) {
            echo "<tr>
                    <td>{$user->id}</td>
                    <td>{$user->name}</td>
                    <td>{$user->email}</td>
                    <td>
                        <a href='editUser.php?id={$user->id}' class='btn btn-primary'>Editar</a>
                        <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#confirmDeleteModal' data-user-id='{$user->id}'>Excluir</button>
                    </td>
                  </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "<div class='alert alert-info' role='alert'>Não há usuários cadastrados.</div>";
    }

    ?>

    <form action="adduser.php" method="post">
        <h2 class="mt-4">Adicionar Usuário</h2>
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <button type="submit" class="btn btn-success">Adicionar Usuário</button>
    </form>
</div>

<!-- Modal de confirmação de exclusão -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmação de Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Tem certeza de que deseja excluir este usuário?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="#" id="confirmDeleteButton" class="btn btn-danger">Excluir</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script>
    // Atualizar o link de exclusão com o ID do usuário quando o modal de exclusão é mostrado
    var confirmDeleteModal = document.getElementById('confirmDeleteModal');
    confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var userId = button.getAttribute('data-user-id');
        var confirmDeleteButton = confirmDeleteModal.querySelector('#confirmDeleteButton');
        confirmDeleteButton.setAttribute('href', 'deleteUser.php?id=' + userId);
    });
</script>

</body>
</html>

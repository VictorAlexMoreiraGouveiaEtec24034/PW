<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="container mt-5">
                <h2>Cadastro de Notícia</h2>
                <form id="formCadastro" method="POST">

                    <div class="mb-3">
                        <label for="id_autor" class="form-label">Autor</label>
                        <select class="form-control" id="id_autor" name="id_autor" required>
                            <!-- Aqui você precisará listar os autores existentes -->
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="resumo" class="form-label">Resumo</label>
                        <input type="text" class="form-control" id="resumo" name="resumo" required>
                    </div>
                    <div class="mb-3">
                        <label for="texto" class="form-label">Texto</label>
                        <textarea class="form-control" id="texto" name="texto" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                    <a href="" class="btn btn-primary">Voltar</a>
                </form>
            </div>
        </div>
        <div id="alert-container"></div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
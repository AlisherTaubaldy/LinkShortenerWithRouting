<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Short Link</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/zGJyexI1oVI9f2rw8sYNNjYzdOnLS1h0m8k6/aaI4495smCfY1HHnRsvf" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-3">
        <h1>Форма укорочения ссылки</h1>
        <form action="/form" method="post">
            <div class="mb-3">
                <label for="exampleInput" class="form-label">Введите ссылку которую хотите укоротить:</label>
                <input type="text" class="form-control" id="exampleInput" name="link" aria-describedby="textHelp">
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
</body>
</html>

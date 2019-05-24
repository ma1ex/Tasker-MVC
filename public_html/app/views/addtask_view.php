<h1>Добавление новой задачи</h1>
<p></p>
<form action="" method="post">
    <?php if($data['saved']) { ?>
    <div class="alert alert-success" role="alert">
        <strong>Сохранено!</strong>
        Задача успешно сохранена!
    </div>
    <?php } ?>

    <div class="form-group">
        <label for="author_name">Имя автора:</label>
        <input type="text" class="form-control" id="author_name" name="author_name" placeholder="Имя" required>
    </div>

    <label for="email">Email:</label>
    <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
            <div class="input-group-text">@</div>
        </div>
        <input class="form-control" id="email" name="email" placeholder="Электронная почта" type="text" required>
    </div>

    <div class="form-group">
        <label for="task_text">Текст задачи</label>
        <input type="text" class="form-control" id="task_text" name="task_text" placeholder="Текст задачи" required>
    </div>

    <button type="submit" class="btn btn-primary mb-2">Сохранить</button>
</form>

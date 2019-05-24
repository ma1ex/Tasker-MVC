<h1>Панель администрирования</h1>
<p>
    Админка...
    <!--
    Пока что, отобразим здесь простой текст.
    Далее можно добавить в админку некоторый функционал.
    Например, WYSIWYG-редактор для изменения страниц сайта (видов).
    Тогда, этот вид будет содержать выпадающий список для выбора страницы, поле редактора, а также кнопку
    для сохранения изменений. А некоторое действие контроллера администрирования будет описывать логику редактирования страниц.
    -->
</p>

<h3>Список текущих задач:</h3>

<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Автор</th>
        <th>Электронная почта</th>
        <th>Описание задачи</th>
        <th>Отметка о выполнении</th>
        <th>В архиве</th>
        <th>Управление</th>
    </tr>
    </thead>
    <tbody>
    <?php

    foreach($data as $task) {
        $marked = ($task['mark']) ? 'checked="checked"' : '';
        $archived = ($task['archive']) ? 'checked="checked"' : '';
        echo '<form action="/admin/edit/" method="post" name="form_task_edit">
              <tr><td>'.$task['id'].'</td>
                  <td><input type="text" name="user_name" value="'.$task['user_name'].'"></td>
                  <td><input type="text" name="email" value="'.$task['email'].'"></td>
                  <td><input type="text" name="task" value="'.$task['task'].'"></td>
                  <td><input class="form-check-input" type="checkbox" name="mark" id="mark" '. $marked .'</td>
                  <td><input class="form-check-input" type="checkbox" name="archive" id="archive" '. $archived .'</td>
                  <input type="hidden" name="id" value="'.$task['id'].'">
                  <td><input type="submit" class="btn btn-primary" value="Сохранить"></td>
              </tr></form>';
    }

    ?>

    </tbody>
</table>

<a href="/admin/logout" class="btn btn-primary" data-toggle="tooltip"
   data-placement="top" title="" data-original-title="Выйти">Выйти</a>
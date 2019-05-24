<h1>Панель администрирования</h1>
<p>Админка...</p>

<h3>Задача обновлена:</h3>

<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Автор</th>
        <th>Электронная почта</th>
        <th>Описание задачи</th>
        <th>Отметка о выполнении</th>
        <th>В архиве</th>
    </tr>
    </thead>
    <tbody>
    <?php
        $marked = ($data['mark']) ? 'checked="checked"' : '';
        $archived = ($data['archive']) ? 'checked="checked"' : '';
        echo '<tr><td>'.$data['id'].'</td>
                  <td>'.$data['user_name'].'</td>
                  <td>'.$data['email'].'</td>
                  <td>'.$data['task'].'</td>
                  <td><input class="form-check-input" type="checkbox" name="mark" id="mark" '. $marked .'</td>
                  <td><input class="form-check-input" type="checkbox" name="archive" id="archive" '. $archived .'</td>
              </tr>';
    ?>
    </tbody>
</table>

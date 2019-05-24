        <div class="card">
            <img src="app/assets/images/img_header.jpg" alt="" class="card-img-top">
            <div class="card-body"></div>
        </div>

        <h3>Список всех задач:</h3>
        <table class="table" id="task_table">
            <thead>
            <tr>
                <th>Автор</th>
                <th>Электронная почта</th>
                <th>Описание задачи</th>
            </tr>
            </thead>
            <tbody>
            <?php

            foreach($data as $task) {
                $marked = ($task['mark']) ? 'style="background:lightgreen;"' : '';
                echo '<tr '. $marked .'><td>'.$task['user_name'].'</td><td>'.$task['email'].'</td><td>'.$task['task'].'</td></tr>';
            }

            ?>
            </tbody>
        </table>
        <a href="task/add" class="btn btn-primary" data-toggle="tooltip"
           data-placement="top" title="" data-original-title="Новая задача">Создать задачу</a>
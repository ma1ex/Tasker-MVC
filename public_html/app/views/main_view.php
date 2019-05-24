<div class="card">
    <img src="app/assets/images/img_header.jpg" alt="" class="card-img-top">
    <div class="card-body">
        <h4 class="card-title">Самое интересное начинается здесь!</h4>
        <h5 class="card-title">Наша задача - Ваши успех и удача!</h5>
        <p class="card-text">
            Здесь публично размещаются корпоративные задачи в виде
            "<strong>Автор -> Электронная почта -> Описание задачи</strong>".
            Выполненные задачи помечены <span style="background:lightgreen;">зеленым маркером</span>. Чтобы добавить новую
            задачу, нажмите на кнопку "Создать задачу".
        </p>
        <a href="task/add" class="btn btn-primary" data-toggle="tooltip"
           data-placement="top" title="" data-original-title="Новая задача">Создать задачу</a>
    </div>
</div>

<div id="container">
    <div id="row">
        <h5>Найди свою задачу:</h5>

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

            foreach($data['data'] as $task => $item) {
                $marked = ($item['mark']) ? 'style="background:lightgreen;"' : '';
                echo '<tr '. $marked .'><td>'.$item['user_name'].'</td><td>'.$item['email'].'</td><td>'.$item['task'].'</td></tr>';
            }

            ?>
            </tbody>
        </table>

        <?php echo $params; ?>

    </div>
</div>



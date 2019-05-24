<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">

    <!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Tasker MVC for BeeJee</title>

    <meta name="description" content="">
    <meta name="keywords" content="">

    <base href="">

    <!--[if lt IE 9]>
    <script src="/app/assets/js/html5shiv_v3-7-3.min.js"></script>
    <script src="/app/assets/js/respond.min.js"></script>
    <![endif]-->

    <!-- Bootstrap 4.3.1 -->
    <link rel="stylesheet" href="/app/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/app/assets/css/font-glyphicons.css">

    <!--  DataTables -->
    <link rel="stylesheet" href="/app/assets/css/jquery.dataTables.min.css">

    <!-- User Style -->
    <link rel="stylesheet" href="/app/assets/css/style.css">

    <!-- Inline styles -->
    <style type="text/css" media="screen">
        /**/
    </style>

</head>

<body>

<div class="container-fluid">
    <div class="row" style="height: 10px; background: #93298E;"></div>
</div>

<div class="container">
    <div class="row">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Главная <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/task">Все задачи</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Управление задачами</a>
                    </li>
                    <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] == '123') { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin">Панель управления</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
    </div>

    <?php include 'app/views/'. $content_view; ?>

</div>



<!-- END -->
<script src="/app/assets/js/jquery-3.3.1.min.js"></script>

<!-- Bootstrap 4.3.1 + Popper.js -->
<script src="/app/assets/js/bootstrap.bundle.min.js"></script>

<!-- dataTables -->
<script src="/app/assets/js/jquery.dataTables.min.js"></script>

<!-- User JavaScript -->
<!-- <script src="/app/assets/js/common.js"></script> -->

<!-- Inline JavaScript -->
<script type="text/javascript">
    $(function () {

        // Note: A custom script is used to activate tooltips
        $('[data-toggle="tooltip"]').tooltip();

        $('#task_table').DataTable( {
            //"lengthMenu": [[ 3 ], [ 3 ]],
            "paging": false,
            //"info": false,
            "searching": false,
            "language": {
                "processing": "Подождите...",
                "search": "Поиск:",
                "lengthMenu": "Показать _MENU_ записей",
                "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
                "infoEmpty": "Записи с 0 до 0 из 0 записей",
                "infoFiltered": "(отфильтровано из _MAX_ записей)",
                "infoPostFix": "",
                "loadingRecords": "Загрузка записей...",
                "zeroRecords": "Записи отсутствуют.",
                "emptyTable": "В таблице отсутствуют данные",
                "paginate": {
                    "first": "Первая",
                    "previous": "Предыдущая",
                    "next": "Следующая",
                    "last": "Последняя"
                },
                "aria": {
                    "sortAscending": ": активировать для сортировки столбца по возрастанию",
                    "sortDescending": ": активировать для сортировки столбца по убыванию"
                }
            }
        } );

    });


</script>

</body>
</html>
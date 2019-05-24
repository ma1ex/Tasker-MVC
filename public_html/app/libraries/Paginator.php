<?php

/**
 * Project: Tasker MVC;
 * File: Paginator.php;
 * Comment:
 */

class Paginator {

    protected $id;
    protected $startChar;
    protected $prevChar;
    protected $nextChar;
    protected $endChar;

    /**
     * Конструктор
     * @param string $id        - атрибут ID элемента <UL> - постраничной навигации
     * @param string $startChar - текст ссылки "В начало"
     * @param string $prevChar  - текст ссылки "Назад"
     * @param string $nextChar  - текст ссылки "Вперед"
     * @param string $endChar   - текст ссылки "В конец"
     */
    public function __construct( /*string*/ $id     = 'pagination',
        /*string*/ $startChar = '&laquo;',
        /*string*/ $prevChar  = '&lsaquo;',
        /*string*/ $nextChar  = '&rsaquo;',
        /*string*/ $endChar   = '&raquo;'
    ) {
        $this->id = $id;
        $this->startChar = $startChar;
        $this->prevChar  = $prevChar;
        $this->nextChar  = $nextChar;
        $this->endChar   = $endChar;
    }

    /**
     * Получить HTML - код постраничной навигации
     * @param int $all        - Полное кол-во элементов (Материалов в категории)
     * @param int $limit      - Кол-во элементов на странице
     * @param int $start      - Текущее смещение элементов
     * @param int $linkLimit  - Количество ссылок в состоянии
     * @param string $varName - Имя GET - переменной которая будет использоваться в постр. навигации.
     * @return string
     */
    public function getLinks( /*int*/ $all, /*int*/ $limit, /*int*/ $start, $linkLimit = 10, $varName = 'start' )
    {
        // Ничего не делаем, если лимит больше или равен кол-ву всех элементов вообще,
        // И если лимит = 0. 0 - будет означать "не разбивать на страницы".
        if ($limit >= $all || $limit == 0) {
            return null;
        }

        $pages     = 0;       // кол-во страниц в пагинации
        $needChunk = 0;       // индекс нужного в данный момент чанка
        $queryVars = [];      // ассоц. массив полученный из строки запроса
        $pagesArr  = [];      // пременная для промежуточного хранения массива навигации
        $htmlOut   = '';      // HTML - код постраничной навигации
        $link      = null;    // формируемая ссылка

        // В этом блоке мы просто строим ссылку - такую же, как та, по которой
        // пришли на данную страницу, но извлекаем из неё нашу GET-переменную:
        parse_str($_SERVER['QUERY_STRING'], $queryVars); //   &$queryVars

        // Убиваем нашу GET-переменную
        if(isset($queryVars[$varName])) {
            unset($queryVars[$varName]);
        }

        // Формируем такую же ссылку, ведущую на эту же страницу:
        $link = $_SERVER['PHP_SELF']. '?' .http_build_query($queryVars);

        $pages = ceil($all / $limit); // кол-во страниц

        // Заполняем массив: ключ - это номер страницы, значение - это смещение для БД.
        // Нумерация здесь нужна с единицы. А смещение с шагом = кол-ву материалов на странице.
        for($i = 0; $i < $pages; $i++) {
            $pagesArr[$i + 1] = $i * $limit;
        }

        // Теперь чтобы на странице отображать нужное кол-во ссылок
        // дробим массив со значениями [№ страницы] => "смещение" на
        // Части (чанки)
        $allPages = array_chunk($pagesArr, $linkLimit, true);

        // Получаем индекс чанка в котором находится нужное смещение.
        // И далее только из него сформируем список ссылок:
        $needChunk = $this->searchPage($allPages, $start);

        // Формируем ссылки "В начало", "передыдущая" --------------------------

        if ($start > 1) {
            $htmlOut .= '<li class="page-item"><a class="page-link" href="'.$link.'&'.$varName.'=0">'.$this->startChar.'</a></li>'.
                '<li class="page-item"><a class="page-link" href="'.$link.'&'.$varName.'='.($start - $limit).'">'.$this->prevChar.'</a></li>';
        } else {
            $htmlOut .= '<li class="page-item disabled"><a class="page-link" href="#!">'.$this->startChar.'</a></li>'.
                '<li class="page-item disabled"><a class="page-link" href="#!">'.$this->prevChar.'</a></li>';
        }
        // Выводим ссылки из нужного чанка
        foreach($allPages[$needChunk] as $pageNum => $offset) {
            // Делаем текущую страницу не активной:
            if($offset == $start) {
                $htmlOut .= '<li class="page-item active"><a class="page-link" href="#!">'. $pageNum .'</a></li>';
                continue;
            }
            $htmlOut .= '<li class="page-item"><a class="page-link" href="'.$link.'&'.$varName.'='. $offset .'">'. $pageNum . '</a></li>';
        }

        // Формируем ссылки "следующая", "в конец" -----------------------------
        $allPages = array_pop($allPages);
        $allPages = array_pop($allPages);

        if (($all - $limit) > $start) {

            $htmlOut .= '<li class="page-item"><a class="page-link" href="' . $link . '&' . $varName . '=' . ($start + $limit) . '">' . $this->nextChar . '</a></li>'.
                '<li class="page-item"><a class="page-link" href="' . $link . '&' . $varName . '=' . $allPages . '">' . $this->endChar . '</a></li>';
        } else {
            $htmlOut .= '<li class="page-item disabled"><a class="page-link" href="#!">' . $this->nextChar . '</a></li>'.
                '<li class="page-item disabled"><a class="page-link" href="#!">' . $this->endChar . '</a></li>';
        }

        return '<nav aria-label="Page navigation"><ul id="'.$this->id.'" class="pagination">' . $htmlOut . '</ul></nav>';
    }

    /**
     * Ищет в каком чанке находится сраница со смещением $needPage
     * @param array $pagesList массив чанков (массивов страниц разбитый по лимиту ссылок на странице)
     * @param int $needPage - смещение
     * @return number Ключ чанка в котором есть нужная страница
     */
    protected function searchPage(array $pagesList, /*int*/$needPage)
    {
        foreach($pagesList as $chunk => $pages) {
            if(in_array($needPage, $pages)) {
                return $chunk;
            }
        }
        return 0;
    }
}
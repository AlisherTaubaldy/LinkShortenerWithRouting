<?php
namespace app\Controller;
class PageController
{
    public function execute($page): void
    {
        include __DIR__ . "/../Views/nav.php";
        include __DIR__ . "/../Views/" . $page;
        include __DIR__ . "/../Views/footer.php";
    }
}
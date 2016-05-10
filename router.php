<?php
include('controller.php');

$currentPage   = (!empty($_GET['page'])) ? $_GET['page'] : '';
$currentAction = (!empty($_GET['action'])) ? $_GET['action'] : '';

if(!file_exists('views/'.$currentPage.'.php'))
{
    $currentPage = 'index';
}elseif ($currentPage == 'image')
{
    $encoded = true;
}


$templateContent = renderView($DBH, $currentPage, $currentAction);
function render($DBH, $templateContent, $currentPage)
{
    include('views/header.php');

    include($templateContent);

    include('views/footer.php');
}
function renderEncoded($DBH,$templateContent)
{
    include($templateContent);
}

?>
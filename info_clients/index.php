<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Информация о клиентах");
?>

<?
    $APPLICATION->IncludeComponent("dev:table.list_info_client", "", array());
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
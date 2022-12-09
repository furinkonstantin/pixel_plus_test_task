<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

    use Bitrix\Main\Localization\Loc as Loc,
        Bitrix\Main\Page\Asset;

    Loc::loadMessages(__FILE__);
    $this->setFrameMode(true);
    
?>
<? if ($arResult['INFO_CLIENT']):?>
    <table>
        <tr>
            <th>ID клиента</th>
            <th>Название клиента</th>
            <th>Сумма по задачам в статусе "Выполнено"</th>
            <th>Сумма по задачам в статусе "В процессе"</th>
            <th>Общее количество задач клиента</th>
        </tr>
        <? foreach($arResult['INFO_CLIENT'] as $arInfoClient):?>
            <tr>
                <td><?=$arInfoClient['clientID']?></td>
                <td><?=$arInfoClient['clientName']?></td>
                <td><?=$arInfoClient['totalPriceF']?></td>
                <td><?=$arInfoClient['totalPriceP']?></td>
                <td><?=$arInfoClient['totalCountTasks']?></td>
            </tr>
        <? endforeach;?>
    </table>
<? endif;?>
<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

/** @var array $arCurrentValues */

use Bitrix\Main,
    Bitrix\Main\Localization\Loc as Loc;

Loc::loadMessages(__FILE__);

try
{
    $arComponentParameters = array(
        'GROUPS' => array(
        ),
        'PARAMETERS' => array(
            'CACHE_TIME'  =>  array('DEFAULT'=>36000000)
        )
    );
}
catch (Main\LoaderException $e)
{
	ShowError($e->getMessage());
}
?>
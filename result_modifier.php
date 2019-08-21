<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?

if ($arParams["ID_FOR_CANONICAL"] !== "")
{
	$arFilter = array(
		'IBLOCK_ID' => $arParams["ID_FOR_CANONICAL"],
		'ACTIVE' => 'Y',
	);

	$blockElements = CIBlockElement::GetList(array(), $arFilter);

	$isLinked = isLinked($blockElements, $arParams);
	if ($isLinked[0])
	{
		echo $isLinked[1];
		$arResult["CANONICAL_URL"] = $isLinked[1];
		$this->getComponent()->SetResultCacheKeys(array('CANONICAL_URL'));
	}
}

function isLinked($blockElement, $arParams)
{
	while ($element = $blockElement->GetNextElement()) {
		$linkedNews = $element->GetProperty("NEWS_PROP");

		if ($arParams["ELEMENT_ID"] == $linkedNews["VALUE"])
		{	
			$isLinked[0] = true;
			$isLinked[1] = $element->GetFields()["NAME"];
			return $isLinked;
		}
	}
	return $isLinked[0] = false;
}

?>


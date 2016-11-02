<?php

class BreadcrumbsModel
{

	// метод выборки данных
	public function breadcrumbs($array, $page, $settings)
	{
		$array['settings'] = $settings;
		return $array;
	}
}
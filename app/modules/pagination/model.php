<?php

class PaginationModel
{

	// метод выборки данных
	public function pagination($array, $page, $settings)
	{
		$array['settings'] = $settings;
		return $array;
	}
}
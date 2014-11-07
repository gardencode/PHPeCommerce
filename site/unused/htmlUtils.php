<?php


Class HtmlUtils {
	private $recordset;
	
	public function __construct($recordset) {
		$this->recordset=$recordset;
	}

	public function markup ($header, $template, $footer){
		if (count(this->$recordset)==0) {
			return '';
		}
		$html=$header;
		foreach ($this->recordset as $row) {
		    $temp=$template;
			foreach ($row as $field=>value) {
				$temp=str_replace('@@'.$field.'@@',$value,$temp);
			}
			$html.=$temp;
		}
		$header.=$footer;
		return $html;
	}
	
	public function dropdownList($formName,$keyField,$valueField) {
		return $this->markup($recordset,
			'<select name="@@'.$formName.'@@">',
			'<option value="@@'.$field.'@@">@@'.$valueField.'@@</option>',
			'</select>');
	}
	
	public function menuBar ($map, $selected) {
		$html='<ul>';
		foreach ($map as $key=>$value) {
		
		}
		$html.='</ul>';
		return $html;
	}
}
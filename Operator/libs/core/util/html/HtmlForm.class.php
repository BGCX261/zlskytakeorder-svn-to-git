<?php
loadCore('html/Html');
/**
 * 表单解释类
 * @author php-朱磊
 *
 */
class HtmlForm extends Html {
	
	/**
	 * 生成checkbox
	 * @param $array name:chekcbox名称.options:选项.selected:选中数组.gule:间隔,默认&nbsp;
	 * @param $params
	 */
	public function checkbox($array,$params=null){
		$name=$array['name'];
		$chkecboxArr=$array['options'];
		$selected=(array)$array['selected'];
		$gule=$array['gule']?$array['gule']:'&nbsp;';
		$checkboxs=array();
		if (!is_null($params)){//附加属性
			$appendParams='';
			foreach ($params as $key=>$val){
				$appendParams.=" {$key}='{$val}' ";
			}
		}
		foreach ($chkecboxArr as $key=>$val){
			$isSelected=in_array($key,$selected)?"checked='checked'":'';
			$checkboxs[]="<label><input type='checkbox' name='{$name}[]' value='{$key}' {$isSelected} {$appendParams} />{$val}</label>";
		}
		return implode($gule,$checkboxs);
	}
	
	/**
	 * 生成checkbox
	 * @param $array name:chekcbox名称.options:选项,多维数组.selected:选中数组.gule:间隔,默认&nbsp;
	 * @param $params
	 */
	public function checkboxTwo($array,$params=null){
		$name=$array['name'];
		$chkecboxArr=$array['options'];
		$selected=(array)$array['selected'];
		$checkboxKey=$array['key'];
		$checkboxValue=$array['value'];
		$gule=$array['gule']?$array['gule']:'&nbsp;';
		$checkboxs=array();
		if (!is_null($params)){//附加属性
			$appendParams='';
			foreach ($params as $key=>$val){
				$appendParams.=" {$key}='{$val}' ";
			}
		}
		foreach ($chkecboxArr as $val){
			$isSelected=in_array($val[$checkboxKey],$selected)?"checked='checked'":'';
			$checkboxs[]="<label><input type='checkbox' name='{$name}[]' value='{$val[$checkboxKey]}' {$isSelected} {$appendParams} />{$val[$checkboxValue]}</label>";
		}
		return implode($gule,$checkboxs);
	}
	
	/**
	 * 生成radio
	 * @param $array name:radio名称.options:选项.selected:选中数组.gule:间隔,默认&nbsp;
	 * @param $params
	 */
	public function radio($array,$params=null){
		$name=$array['name'];
		$chkecboxArr=$array['options'];
		$selected=$array['selected'];
		$gule=$array['gule']?$array['gule']:'&nbsp;';
		$checkboxs=array();
		if (!is_null($params)){//附加属性
			$appendParams='';
			foreach ($params as $key=>$val){
				$appendParams.=" {$key}='{$val}' ";
			}
		}
		foreach ($chkecboxArr as $key=>$val){
			$isSelected=($key==$selected)?"checked='checked'":'';
			$checkboxs[]="<label><input type='radio' name='{$name}' value='{$key}' {$isSelected} {$appendParams} />{$val}</label>";
		}
		return implode($gule,$checkboxs);
	}
	
	/**
	 * 生成radio
	 * @param $array name:chekcbox名称.options:选项,多维数组.selected:选中数组.gule:间隔,默认&nbsp;.key:value值.value:选项名称
	 * @param $params
	 */
	public function radioTwo($array,$params=null){
		$name=$array['name'];
		$chkecboxArr=$array['options'];
		$selected=$array['selected'];
		$checkboxKey=$array['key'];
		$checkboxValue=$array['value'];
		$gule=$array['gule']?$array['gule']:'&nbsp;';
		$checkboxs=array();
		if (!is_null($params)){//附加属性
			$appendParams='';
			foreach ($params as $key=>$val){
				$appendParams.=" {$key}='{$val}' ";
			}
		}
		foreach ($chkecboxArr as $val){
			$isSelected=($val[$checkboxKey]==$selected)?'checked':'';
			$checkboxs[]="<label><input type='radio' name='{$name}' value='{$val[$checkboxKey]}' {$isSelected} {$appendParams} />{$val[$checkboxValue]}</label>";
		}
		return implode($gule,$checkboxs);
	}
	
	/**
	 * 生成option
	 * @param $array
	 * @param $params
	 */
	public function options($array){
		$selected=$array['selected'];
		$options=array();
		foreach ($array['options'] as $key=>$val){
			$isSelected=($key==$selected)?"selected='selected'":'';
			$options[]="<option {$isSelected} label='{$val}' value='{$key}'>{$val}</option>";
		}
		return implode("\r\n",$options);
	}
	
	
	/**
	 * 生成options
	 * @param $array options:选项,多维数组.key:value值.value:选项名称
	 * @param $params
	 */
	public function optionsTwo($array){
		$selected=$array['selected'];
		$optionKey=$array['key'];
		$optionValue=$array['value'];
		$options=array();
		foreach ($array['options'] as $key=>$val){
			$isSelected=($val[$optionKey]==$selected)?"selected='selected'":'';
			$options[]="<option {$isSelected} label='{$val[$optionValue]}' value='{$val[$optionKey]}'>{$val[$optionValue]}</option>";
		}
		return implode("\r\n",$options);
	}
	
}
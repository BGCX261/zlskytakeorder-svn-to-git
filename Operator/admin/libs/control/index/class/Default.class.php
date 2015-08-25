<?php
class ControlDefault extends Index {
	
	/**
	 * 文件上传
	 */
	public function cUpload() {
		switch ($_GET ['type']) { //跟据类型选择上传文件夹,默认玩家Faq
			default :
				{
					$uploadDir = config ( 'UPLOAD_PATH' ) . '/news/' . date ( 'Ymd' );
					$saveUrl = config ( 'ABSOLUTE_PATH' ) . '/upload/news/' . date ( 'Ymd' );
					break;
				}
		}
		if (! file_exists ( $uploadDir ))
			mkdir ( $uploadDir, 0777, true );
		$extArr = array ('gif', 'jpg', 'jpeg', 'png', 'bmp' );
		$maxSize = 1024 * 1024 * 2;
		if (empty ( $_FILES ) === false) {
			$fileName = $_FILES ['imgFile'] ['name'];
			$tmpName = $_FILES ['imgFile'] ['tmp_name'];
			$fileSize = $_FILES ['imgFile'] ['size'];
			if (! $fileName)
				$this->_imgAlert ( '请选择文件.' );
			if (is_writable ( $uploadDir ) === false)
				$this->_imgAlert ( '上传目录没有写权限' );
			if (is_uploaded_file ( $tmpName ) === false)
				$this->_imgAlert ( '临时文件可能不是上传文件' );
			if ($fileSize > $maxSize)
				$this->_imgAlert ( '上传文件超出大小限制' );
			$tempArr = explode ( '.', $fileName );
			$fileExt = array_pop ( $tempArr );
			$fileExt = strtolower ( trim ( $fileExt ) );
			if (in_array ( $fileExt, $extArr ) === false)
				$this->_imgAlert ( '上传的文件扩展名是不允许的' );
			$newFileName = date ( 'His' ) . '_' . rand ( 10000, 99999 ) . ".{$fileExt}";
			$filePath = $uploadDir . "/{$newFileName}";
			if (move_uploaded_file ( $tmpName, $filePath ) === false)
				$this->_imgAlert ( '上传图片失败' );
			$fileUrl = $saveUrl . "/{$newFileName}";
			exit ( json_encode ( array ('error' => 0, 'url' => $fileUrl ) ) );
		}
	}
	
	private function _imgAlert($msg, $error = 1) {
		exit ( json_encode ( array ('error' => $error, 'message' => $msg ) ) );
	}
	
	/**
	 * 验证码
	 */
	public function cVerifyCode() {
	
	}

}
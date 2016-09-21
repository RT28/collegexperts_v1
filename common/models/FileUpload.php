<?php

namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

class FileUpload extends Model 
{
	public $imageFile;
	public $logoFile;

	public function rules()
	{
		return [
			[['imageFile', 'logoFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
		];
	}

	public function upload($university) {		
		$result = is_dir("./../uploads/$university->id/cover_photo");		
		if (!$result) {			
			$result = FileHelper::createDirectory("./../web/uploads/$university->id/cover_photo");			
		}		
		if ($this->validate() && $this->imageFile) {
			$this->imageFile->saveAs("./../web/uploads/$university->id/cover_photo/cover" . '.' . $this->imageFile->extension);
			return true;
		}
		return false;
	}

	public function uploadLogo($university) {		
		$result = is_dir("./../uploads/$university->id/logo");		
		if (!$result) {			
			$result = FileHelper::createDirectory("./../web/uploads/$university->id/logo");			
		}		
		if ($this->validate() && $this->logoFile) {
			$this->logoFile->saveAs("./../web/uploads/$university->id/logo/logo" . '.' . $this->logoFile->extension);
			return true;
		}
		return false;
	}
}
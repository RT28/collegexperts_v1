<?php

namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

class FileUpload extends Model 
{
	public $imageFile;

	public function rules()
	{
		return [
			[['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
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
}
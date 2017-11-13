<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            if (isset($this->imageFile)) {
                $this->imageFile->saveAs('public/img/news/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
                return true;
            }
        } else {
            return false;
        }
    }
}
/**
 * Created by PhpStorm.
 * User: vanny
 * Date: 12.11.2017
 * Time: 16:28
 */
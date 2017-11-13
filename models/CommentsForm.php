<?php
namespace app\models;

use app\models\comments\Comments;
use Yii;
use yii\base\Model;

/**
 * CommentsForm is the model behind the comments form.
 */
class CommentsForm extends Model
{
    public $news_id;
    public $user_id;
    public $user_name;
    public $comm_text;
    public $category_id;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['comm_text',], 'required'],
            [['comm_text'], 'string', 'max' => 255],
        ];
    }



    /**
     * Appends post to DB
     * @return boolean whether the post is appended successfully
     */
    public function post()
    {
        $comment = new Comments();
        $comment->news_id = htmlspecialchars($this->news_id);
        $comment->user_id = htmlspecialchars($this->user_id);
        $comment->user_name = htmlspecialchars($this->user_name);
        $comment->comm_text = htmlspecialchars($this->comm_text);
        $comment->category_id = htmlspecialchars($this->category_id);

        $comment->save();
        //$db->createCommand('INSERT INTO tbl_comments (`nick`, `email`, `body`)' .
        //   ' VALUES (\'' . $nickSafe . '\', \'' . $emailSafe . '\', REPLACE("' . $bodySafe . '", "\n", "<br />"));')->execute();

        //return true;
    }
}
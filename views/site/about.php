<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\db\Query;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <table width="100%" border="2" bgcolor="blue">
        <tbody>
        <tr><td class="pcatHead"><span class="pgenmed substr"><b>Навигация</b></span></td></tr>
        <tr><td>
    <p>
        <?=
        //$query = new Query();
        //$sql = 'SELECT * FROM user WHERE username=:username';
        //print_r($customer = \app\customs\models\User::findOne(1));
        $idClient = Yii::$app->user->identity->id;
        $user = \app\customs\models\User::find()->where(['id' => $idClient])->one();
        $username = $user->username;


        echo '<br/>' . '<br/>';

        $articles = \app\models\Articles::find()->where(['User_id' => $idClient])->one();
        $text = $articles->text;
        $title = $articles->title;
        $categorie_id = $articles->categorie_id;


        $categorie = \app\models\ArticlesCategories::find()->where(['id' => $categorie_id])->one();
        $categorietitle = $categorie->title;

        $comments = \app\customs\models\FormAddComments::find()->where(['articles_id' => $articles->id])->one();
        $comment = $comments->text;

/*
        print_r($username);
        echo '   ';
        print_r($categorietitle);
        echo '<br/>' . '<br/>';
        print_r($title);
        echo '<br/>' . '<br/>';
        print_r($text);
        echo '<br/>' . '<br/>';
        print_r($comment);*/

        /* $id = $customer->id;
         $name=$customer->username;
         print_r($name);
         print_r($id);*/
        ?>
        <!--<br><br><br>-->
    <h3 class="substr">
        <?=print_r($username);
        echo '   '  ;
        print_r($categorietitle);
        echo '<br/>' ;

        ?>  </h3>

    <h2 class="substr">
       <?= print_r($title); ?>
    </h2>

        <h3 class="substr">
           <?= print_r($text); ?>
        </h3>
                <h3 class="substr">
                    <?=print_r($comment);
                   ?>
                </h3>





    This is the About page. You may modify the following file to customize its content:
    </p>

            </td></tr>
        </tbody>
    </table>
    <code><?= __FILE__ ?></code>
</div>

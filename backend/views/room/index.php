<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
use common\models\PropertyUnit;

$this->title = '用户';
$this->params['breadcrumbs'][] = ['label' => '用户'];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>
<?php Pjax::begin();?>

<?php Pjax::end();?>

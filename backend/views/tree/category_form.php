<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="tree-category-form">

    <?php $form = ActiveForm::begin(); ?>
   	<?php if (get_class($model) == 'common\models\TreeCategory'): ?>
   		<?= $form->field($model, 'category')->dropDownList(['常绿'=>'常绿','落叶'=>'落叶'])?>
   	<?php endif ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

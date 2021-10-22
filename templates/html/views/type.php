<?php

use yii\apidoc\helpers\ApiMarkdown;
use yii\apidoc\models\ClassDoc;
use yii\apidoc\models\InterfaceDoc;
use yii\apidoc\models\TraitDoc;

/* @var $type ClassDoc|InterfaceDoc|TraitDoc */
/* @var $this yii\web\View */
/* @var $renderer \yii\apidoc\templates\html\ApiRenderer */

$renderer = $this->context;
?>

<div class="class-description">
    <p><strong><?= ApiMarkdown::process($type->shortDescription, $type, true) ?></strong></p>
    <?= ApiMarkdown::process($type->description, $type) ?>

    <?= $this->render('seeAlso', ['object' => $type]) ?>
</div>

<a id="methods"></a>
<?= $this->render('@yii/apidoc/templates/html/views/methodSummary', ['type' => $type, 'protected' => false]) ?>

<?= $this->render('@yii/apidoc/templates/html/views/methodDetails', ['type' => $type]) ?>
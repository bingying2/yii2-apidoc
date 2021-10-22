<?php

use yii\apidoc\helpers\ApiMarkdown;
use yii\apidoc\models\ClassDoc;
use yii\apidoc\models\InterfaceDoc;
use yii\apidoc\models\TraitDoc;
use yii\helpers\ArrayHelper;

/* @var $type ClassDoc|InterfaceDoc|TraitDoc */
/* @var $protected bool */
/* @var $this yii\web\View */
/* @var $renderer \yii\apidoc\templates\html\ApiRenderer */

$renderer = $this->context;

if ($protected && count($type->getProtectedMethods()) == 0 || !$protected && count($type->getPublicMethods()) == 0) {
    return;
} ?>

<div class="summary doc-method">
<h2><?= $protected ? 'Protected Methods' : '方法列表' ?></h2>

<table class="summary-table table table-striped table-bordered table-hover">
<colgroup>
    <col class="col-method" />
    <col class="col-description" />
</colgroup>
<tr>
  <th>方法</th><th>说明</th>
</tr>
<?php

if(!function_exists('toUnderScore')){
    function toUnderScore($str){
        $dstr = preg_replace_callback('/([A-Z]+)/', function($matchs) {
            return '-' . strtolower($matchs[0]);
        }, $str);
        return trim(preg_replace('/-{2,}/', '-', $dstr), '-');
    }
}

$methods = $type->methods;
ArrayHelper::multisort($methods, 'name');
foreach ($methods as $method): ?>
    <?php if ($protected && $method->visibility == 'protected' || !$protected && $method->visibility != 'protected'): ?>
    <?php if($method->definedBy != $type->name || !$method->shortDescription) continue; ?>
    <?php $method->name = str_replace('action', '', $method->name); ?>
    <?php $method->name = toUnderScore($method->name); ?>
    <tr<?= $method->definedBy != $type->name ? ' class="inherited"' : '' ?> id="<?= $method->name ?>()">
        <td><?= $renderer->createSubjectLink($method, $method->name.'()') ?></td>
        <td><?= ApiMarkdown::process($method->shortDescription, $method->definedBy, true) ?></td>
    </tr>
    <?php endif; ?>
<?php endforeach; ?>
</table>
</div>

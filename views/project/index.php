<?php
/**
 * @var $this yii\web\View
 */
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = \Yii::t('app', 'Projects') . ' - ' . $this->params['appSettings']['app_name'];

$this->registerJsFile('/js/controllers/vProjectApp.js');
?>
<div id="project-app">
    <div class="row">
        <div class="col-sm-9">
            <h1><?= \Yii::t('app', 'Projects'); ?></h1>
        </div>
        <div class="col-sm-3 text-right">
            <?php
            if (!Yii::$app->user->isGuest) {
                echo Html::a('<i class="fa fa-plus"></i> '.\Yii::t('app', 'New Project'), ['/project/create'], ['class' => 'btn btn-primary btn-sm']);
            }
            ?>
        </div>
    </div>

    <?php if (!Yii::$app->user->isGuest): ?>
        <div class="btn-group pull-right m-b-10" role="group">
            <a href="<?= Url::toRoute(['index']); ?>" class="btn btn-default btn-sm" v-bind:class="getActiveButton('all')" v-on:click="setActiveButton('all')" onclick="return false">
                <?= \Yii::t('app', 'All'); ?>
            </a>
            <a href="<?= Url::toRoute(['index', 'status' => 'public']); ?>" class="btn btn-default btn-sm" v-bind:class="getActiveButton('public')" v-on:click="setActiveButton('public')" onclick="return false">
                <?= \Yii::t('app', 'Public'); ?>
            </a>
            <a href="<?= Url::toRoute(['index', 'status' => 'private']); ?>" class="btn btn-default btn-sm" v-bind:class="getActiveButton('private')" v-on:click="setActiveButton('private')" onclick="return false">
                <?= \Yii::t('app', 'Private'); ?>
            </a>
        </div>
        <div class="clearfix"></div>
    <?php endif; ?>

    <div id="project-list">
        <div class="row" v-for="project in filteredProjects">
            <div class="col-sm-9">
                {{ project.title }} <br/>
                {{ project.description }}
            </div>
            <div class="col-sm-3 text-right">
                <span v-bind:class="labelClass(project)" class="label">{{ labelText(project) }}</span><br/>
                <p><?= \Yii::t('app', 'Start Date') . ': '; ?>{{ project.created_date }}</p>
            </div>
            <hr/>
        </div>
    </div>
</div>
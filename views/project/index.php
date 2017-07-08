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
            <h1><?= \Yii::t('app', 'Projects'); ?> / {{totalItemsCount}}</h1>
        </div>
        <div class="col-sm-3 text-right">
            <?php
            if (!Yii::$app->user->isGuest) {
                echo Html::a('<i class="fa fa-plus"></i> '.\Yii::t('app', 'New Project'), ['/project/create'], ['class' => 'btn btn-primary btn-sm', 'data-toggle' => 'modal', 'data-target' => '#create-project-modal', 'onclick' => 'return false;']);
            }
            ?>
        </div>
    </div>

    <?php if (!Yii::$app->user->isGuest): ?>
        <div class="row">
            <div class="col-sm-9">
                <input type="text" class="form-control input-sm" placeholder="<?= Yii::t('app', 'Start typing project name...'); ?>" v-model="searchBy" />
            </div>
            <div class="col-sm-3">
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
            </div>
        </div>
        <div class="clearfix"></div>
    <?php endif; ?>

    <div id="project-list">
        <div class="row" v-for="project in filteredProjects">
            <div class="col-sm-9">
                {{ project.title }} <br/>
                <div v-html="project.description" class="text-muted"></div>
            </div>
            <div class="col-sm-3 text-right">
                <span v-bind:class="labelClass(project)" class="label">{{ labelText(project) }}</span><br/>
                <p><?= \Yii::t('app', 'Start Date') . ': '; ?>{{ project.created_date | formatDate }}</p>
            </div>
            <div class="clearfix"></div>
            <hr/>
        </div>
        <div class="row text-center" v-if="pagination.pageCount > 1">
            <ul class="pagination">
                <li v-for="page in pagination.pageCount" v-bind:class="{active: pagination.page == page}"><a href="#" :data-page="page" v-on:click="loadPage" onclick="return false">{{page}}</a></li>
            </ul>
        </div>
    </div>

    <div class="modal fade" id="create-project-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">
                    <p>One fine body&hellip;</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
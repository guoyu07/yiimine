<?php
$this->menu = array(
    array('label' => $project->title, 'itemOptions' => array('class' => 'nav-header')),
    array('label' => 'Обзор', 'url' => $this->createUrl('/project/view', array('url' => $project->identifier))),
    array('label' => 'Задачи', 'url' => $this->createUrl('/issue')),
    array('label' => 'Wiki', 'url' => $this->createUrl('/wiki')),
    array('label' => 'Файлы', 'url' => $this->createUrl('/file')),
    '---',
    array('label' => 'Создать задачу', 'url' => $this->createUrl('create')),
);

$this->pageTitle = 'Редактирование задачи #'.$model->id;

$this->renderPartial('_form', array('model' => $model));
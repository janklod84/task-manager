<div class="main-container container">
<p>
    <a class="btn btn-md btn-primary" href="<?= url("task/add"); ?>">Новая задача</a>
</p>
<div class="bs-example">
<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th><a href="sort_by=name"> Имя</a></th>
        <th>E-майл</th>
        <th>Текст</th>
        <th><a href="sort_by=user-status">Статус</a></th>
        <?php if(Auth::isLogged()): ?>
          <th>Действия</th>
        <?php endif; ?>
    </tr>
    </thead>
    <tbody>
        <?php if(!empty($tasks)): $i = 1; ?> 
        <?php foreach($tasks as $task): ?>
        <tr>
              <td><?= $i++; ?></td>
              <td><?= $task->username ?></td>
              <td><?= $task->email ?></td>
              <td><?= crop($task->text, 50) ?></td>
              <td>
                 <?php if($task->status == 1): ?>
                   <span class="label label-success">Выполнена</span>
                 <?php else: ?>
                   <span class="label label-default">В работе</span>
                 <?php endif; ?>
              </td>
              <?php if(Auth::isLogged()): ?>
              <td>
                  <a href="<?= url("task.show", ['id' => $task->id]) ?>">
                      <span class="glyphicon glyphicon-pencil btn-sm btn-primary"></span>
                  </a>
                  <a href="<?= url("task.remove", ['id' => $task->id]) ?>" onclick="return confirm('Вы действительно хотите удалить?');">
                      <span class="glyphicon glyphicon-trash btn-sm btn-danger"></span>
                  </a>
                </td>
              <?php endif; ?>
           </tr>
          <?php endforeach; ?>
        <?php endif; ?>
     </tbody>
</table>
<div class="text-center">
    <p>Задачи: <?= count($tasks);?> из <?= $total;?></p>
    <?php if($pagination->getCountPages() > 1): ?>
        <?= $pagination; ?>
    <?php endif; ?>
</div>
<?php view_path(__FILE__); ?>
</div>
</div>


<div class="d-flex justify-content-center">
	<div class="col-md-4 col-md-offset-4">
		<h1><?= HTML::title() ?></h1>
		 <?= $form->showErrors($errors); ?>
		 <?= $form->open(['action' => '/dashboard/login']) ?>
		  <div class="form-group">
		     <?= $form->text([
		     	'placeholder' => "Введите ваш логин",
		     	'id' => 'username',
		     	'name' => 'username',
		     	'value' => escape($form->value('username')) ?? ''
		     ], 'Логин');?>
		  </div>
		  <div class="form-group">
		    <?= 
		     $form->input([
		     	 'placeholder' => "Введите ваш пароль",
		     	 'id' => 'password',
		     	 'name' => 'password',
		     	 'class' => 'form-control',
		     	 'value' => escape($form->value('password')) ?? ''
		     	 ], 'password', 'Пароль'); 
		     ?>
		  </div>
		  <!-- csrf Token -->
		  <?= $form->hidden(['name' => '_csrf', 'value' => csrfToken()]) ?>
		  
		  <!-- input button -->
		  <?= $form->button(['class' => 'btn btn-primary'], 'Отправить', 'submit'); ?>
          <?= $form->close();  view_path(__FILE__); ?>
          <a href="/">На главную</a>
	</div>
</div>
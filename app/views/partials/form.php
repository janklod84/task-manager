<div class="row">
	 <?= $form->open(['action' => Url::to($url), 'enctype' => 'multipart/form-data']) ?>
	 <div class="col-md-8 col-md-offset-2">
	  <?= $form->showErrors($errors); ?>
	  <h3 style="margin: 0 0 15px 5px;"><?= HTML::title() ?></h3>
	  <div class="col-md-6">
		   <div class="form-group">
		     <?= $form->text([
		     	'placeholder' => "Имя пользователя",
		     	'id' => 'username',
		     	'name' => 'username',
		     	'value' => $task->username ?? escape($form->value('username')), 
		     ], 'Имя пользователя');?>
		  </div>
	  </div>
	  <div class="col-md-6">
	     <div class="form-group">
		    <?= 
		     $form->input([
		     	 'placeholder' => "E-mail",
		     	 'id' => 'password',
		     	 'name' => 'email',
		     	 'value' => $task->email ?? escape($form->value('email')),
		     	 ], 'email', 'Е-майл'); 
		     ?>
	     </div>
	  </div>
	  <div class="col-md-12">
		  <div class="form-group">
		    <?= 
		     $form->textarea([
		     	 'placeholder' => "Введите ваш текст",
		     	 'id' => 'text',
		     	 'name' => 'text',
		     	 'rows' => 10
		     	 ], 'Текст', $task->text ?? escape($form->value('text'))); 
		     ?>
		  </div>
		  <?php if(Auth::isLogged()): ?>
			  <div class="form-group">
			  	 <?= 
			     $form->checkbox([
			     	 'id' => 'status',
			     	 'name' => 'status',
			     	 'value' => 1
			     	 ], false, $status); 
			     ?>
	     	  	<label for="status" style="cursor:pointer;">Статус</label>
			  </div>
		 <?php endif; ?>
		  <!-- csrf Token -->
	      <?= $form->hidden(['name' => '_csrf', 'value' => csrfToken()]) ?>

	      <!-- input button -->
	      <?= $form->button(['class' => 'btn btn-primary'], 'Сохранить', 'submit'); ?>
	  </div>
   </div><!-- col-md-8 -->
   <div class="col-md-8 col-md-offset-2">
   	  <?php view_path(__FILE__, 'margin: 15px 0 0 15px;'); ?>
   </div>
    <?= $form->close() ?>
</div>
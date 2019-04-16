$('#send').click(function () {
     
      // recueillir 
      $.ajax({
         url: '/',
         type: 'POST',
         data: {'id': 2},
         success: function (res) {
         	console.log(res);
         },
         error: function () {
         	// alert('Error');
            console.log('Error server');
         }
      });
});
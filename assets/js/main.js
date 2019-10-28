$(document).ready(function () {

	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
			BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
			iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
			Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
			Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
			any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};


	var mobileMenuOutsideClick = function () {
		$(document).click(function (e) {
	    var container = $("#gtco-offcanvas, .js-gtco-nav-toggle");
	    if (!container.is(e.target) && container.has(e.target).length === 0) {
	    	if ( $('body').hasClass('offcanvas') ) {
    			$('body').removeClass('offcanvas');
    			$('.js-gtco-nav-toggle').removeClass('active');
	    	}
	    }
		});

	};


	var scrollNavBar = function () {
		if ( $(window).scrollTop() > 50)  {
			$('body').addClass('scrolled');
			$('.js-gtco-nav-toggle').removeClass('gtco-nav-white');
		} else {
			$('body').removeClass('scrolled');
			$('.js-gtco-nav-toggle').addClass('gtco-nav-white');
		}

		$(window).scroll(function () {
			if ( $(window).scrollTop() > 50)  {
				$('body').addClass('scrolled');
				$('.js-gtco-nav-toggle').removeClass('gtco-nav-white');
			} else {
				$('body').removeClass('scrolled');
				$('.js-gtco-nav-toggle').addClass('gtco-nav-white');
			}
		});
	};

	var offcanvasMenu = function() {

		$('#page').prepend('<div id="gtco-offcanvas" />');
		$('#page').prepend('<a href="#" class="js-gtco-nav-toggle gtco-nav-toggle gtco-nav-white"><i></i></a>');
		var clone1 = $('.menu-1 > ul').clone();
		$('#gtco-offcanvas').append(clone1);
		var clone2 = $('.menu-2 > ul').clone();
		$('#gtco-offcanvas').append(clone2);

		$('#gtco-offcanvas .has-dropdown').addClass('offcanvas-has-dropdown');
		$('#gtco-offcanvas').find('li').removeClass('has-dropdown');

		// Hover dropdown menu on mobile
		$('.offcanvas-has-dropdown').mouseenter(function () {
			var $this = $(this);
			$this
				.addClass('active')
				.find('ul')
				.slideDown(500, 'easeOutExpo');				
		}).mouseleave(function(){

			var $this = $(this);
			$this
				.removeClass('active')
				.find('ul')
				.slideUp(500, 'easeOutExpo');				
		});


		$(window).resize(function(){

			if ( $('body').hasClass('offcanvas') ) {

    			$('body').removeClass('offcanvas');
    			$('.js-gtco-nav-toggle').removeClass('active');
				
	    	}
		});
	};


	var burgerMenu = function() {

		$('body').on('click', '.js-gtco-nav-toggle', function(event){
			var $this = $(this);


			if ( $('body').hasClass('overflow offcanvas') ) {
				$('body').removeClass('overflow offcanvas');
			} else {
				$('body').addClass('overflow offcanvas');
			}
			$this.toggleClass('active');
			event.preventDefault();

		});
	};



	var contentWayPoint = function() {
		var i = 0;
		$('.animate-box').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('animated-fast') ) {
				
				i++;

				$(this.element).addClass('item-animate');
				setTimeout(function(){

					$('body .animate-box.item-animate').each(function(k){
						var el = $(this);
						setTimeout( function () {
							var effect = el.data('animate-effect');
							if ( effect === 'fadeIn') {
								el.addClass('fadeIn animated-fast');
							} else if ( effect === 'fadeInLeft') {
								el.addClass('fadeInLeft animated-fast');
							} else if ( effect === 'fadeInRight') {
								el.addClass('fadeInRight animated-fast');
							} else {
								el.addClass('fadeInUp animated-fast');
							}

							el.removeClass('item-animate');
						},  k * 50, 'easeInOutExpo' );
					});
					
				}, 100);
				
			}

		} , { offset: '85%' } );
	};


	var dropdown = function() {

		$('.has-dropdown').mouseenter(function(){

			var $this = $(this);
			$this
				.find('.dropdown')
				.css('display', 'block')
				.addClass('animated-fast fadeInUpMenu');

		}).mouseleave(function(){
			var $this = $(this);

			$this
				.find('.dropdown')
				.css('display', 'none')
				.removeClass('animated-fast fadeInUpMenu');
		});

	};


	var goToTop = function() {

		$('.js-gotop').on('click', function(event){
			
			event.preventDefault();

			$('html, body').animate({
				scrollTop: $('html').offset().top
			}, 500, 'easeInOutExpo');
			
			return false;
		});

		$(window).scroll(function(){

			var $win = $(window);
			if ($win.scrollTop() > 200) {
				$('.js-top').addClass('active');
			} else {
				$('.js-top').removeClass('active');
			}

		});
	};


var loaderPage = function() {
	$(".gtco-loader").fadeOut("slow");
};

var counter = function() {
	$('.js-counter').countTo({
		 formatter: function (value, options) {
      return value.toFixed(options.decimals);
    },
	});
};

var counterWayPoint = function() {
	if ($('#gtco-counter').length > 0 ) {
		$('#gtco-counter').waypoint( function( direction ) {
									
			if( direction === 'down' && !$(this.element).hasClass('animated') ) {
				setTimeout( counter , 400);					
				$(this.element).addClass('animated');
			}
		} , { offset: '90%' } );
	}
};

var parallax = function() {
	if ( !isMobile.any()) {
		$(window).stellar();
	}
};

$('.signIn').click(function (e) {
  e.stopPropagation();
  if($(this).hasClass('active')) {
    $('.signIn-dialog').fadeOut(200);
    $(this).removeClass('active');
  } else {
    $('.signIn-dialog').delay(300).fadeIn(200);
    $(this).addClass('active');
  }
  $('.dropdown-menu').dropdown('toggle');
});


$('.signIn-form').submit(function (event) {
	event.preventDefault();
	let username = $(this).find('.username').val(), password = $(this).find('.userpassword').val(), csrf = $('input[name="security_token"]').val();;
	$('.signin-errors').html('');
  $.post('../index.php/user/signIn', {'username': username, 'password': password}, function (response) {
		if(!response.length) {
    	window.location = '/news';
    } else {
      $('.signin-errors').html(response);
    }
  });
});

var 
  input = document.getElementById('news-image'),
  img = document.getElementById('image-uploaded'),
  removeImage = document.getElementById('remove-image'),
  imgName = '',
  editedNews = 0;

input.onchange = function (e) {
  loadFileFromInput(e.target, 'dataurl');
}

input.addEventListener('fileLoaded', fileHandler);

function loadFileFromInput (input, typeData) {
  var reader, fileLoadedEvent, files = input.files;

  if(files && files[0]) {
    reader = new FileReader();

    reader.onload = function (e) {
      fileLoadedEvent = new CustomEvent('fileLoaded', {
        detail: {
          data: reader.result,
          file: files[0]  
        },
        bubbles: true,
        cancelable: true
      });
      input.dispatchEvent(fileLoadedEvent);
    }
    switch(typeData) {
      case 'arraybuffer':
        reader.readAsArrayBuffer(files[0]);
      break;
      case 'dataurl':
        reader.readAsDataURL(files[0]);
      break;
      case 'binarystring':
        reader.readAsBinaryString(files[0]);
      break;
      case 'text':
        reader.readAsText(files[0]);
      break;
    }
  }
}

function fileHandler (e) {
  var data = e.detail.data, fileInfo = e.detail.file;
  var imgLoaded = document.createElement('img');
	imgLoaded.src = data;
  img.appendChild(imgLoaded);
  removeImage.style.display = '';
}

removeImage.onclick = function (e) {
	if(imgName.length) {
		$.post('../index.php/upload/removeImage', {'imgName': imgName}, function (response) {
			let data = JSON.parse(response);
			if(data.status == 'success') {
				img.innerHTML = '';
				removeImage.style.display = 'none';
				$('#news-image').css('display', '');
				imgName = '';
				$('#news-image').val('');
			}
		});
	}
};

$('.logout').click(function (event) {
	event.preventDefault();
	$.post('user/logout', {}, function (data) {
		document.location.reload(true);
	});
});


$('#news-image').change(function () {
	var file_data = $('#news-image').prop('files')[0];
	let Data = new FormData();
	Data.append('news-image', file_data);
	$.ajax({
     url:'../index.php/upload/do_upload',
     type: 'post',
     data: Data,
     processData: false,
     contentType: false,
     cache: false,
     async: false
  }).done(function (response) {
  	let data = JSON.parse(response);
  	if(data.status == 'success') {
  		$('#news-image').css('display', 'none');
  		imgName = data.imageUrl;
  	} else {
  		$('#news-image').removeProp('files');
			$('.image-uploaded').html('<p class="error">' + data.msg + '</p>');
  	}
  });
});


$('form.createNews-form').on('submit', function (event) {
	event.preventDefault();
	$('.form__errors').html();
	var form_data = new FormData($('form.createNews-form')[0]);
	form_data.append('author', 'Admin');
	form_data.append('id', editedNews);
	form_data.append('image', imgName);
	
	$.ajax({
     url:'../index.php/news/createNews',
     type: 'post',
     data: form_data,
     processData: false,
     contentType: false,
     cache: false,
     async: false
  }).done(function (response) {
  	let data = JSON.parse(response);
  	if(data.status == 'success') {
  		if(editedNews > 0) {
  			newsTable.ajax.reload();
  		}
  		$("form.createNews-form")[0].reset();
  		if(imgName.length) {
	  		img.innerHTML = '';
				removeImage.style.display = 'none';
				$('#news-image').css('display', '');
				imgName = '';
			}
  		$('form.createNews-form').find('.btn').removeClass('btn-default').addClass('btn-success').prop('disabled', true).val('Created');
  		setTimeout(function () {
  			$('form.createNews-form').find('.btn').removeClass('btn-success').addClass('btn-default').prop('disabled', false).val('Create');
  		}, 1500);
  	} else {
  		$('.form__errors').html(data.msg);
  	}
  });
});

var newsTable = jQuery('#news-table').DataTable({
  'pageLength' : 15,
  'ajax': {
    'url': '../index.php/news/newsList',
    'type' : 'GET',
    'dataType': 'json',
    'dataSrc': 'data',
  },
  columns: [
    { 'data': 'id' },
    { 'data': 'title' },
    { 'data': 'text' },
    { 'data': 'author' },
    { 'data': 'image' },
    { 'data': '' }
  ],
  "columnDefs": [
    {
      className: "dt-body-center",
      targets: -1,
      defaultContent: ["<span  class='glyphicon glyphicon-edit' aria-hidden='true'></span>&nbsp;&nbsp;&nbsp;<span  class='glyphicon glyphicon-trash' aria-hidden='true'></span>"] 
    }
  ]
});

$('body').on('click', '#news-table tbody tr .glyphicon-edit', function () {
  var rowData = newsTable.row($(this).parents('tr')).data();
  if(rowData.id) {
  	$('#modalCreateNewsForm').modal();
  	$('input[name="title"]').val(rowData.title);
  	$('textarea[name="text"]').val(rowData.text);
  	if(rowData.image) {
  		$('#news-image').css('display', 'none');
  		imgName = rowData.image;
  		removeImage.style.display = '';
  		editedNews = rowData.id;
  		$('#image-uploaded').html('<img src="http://localhost:8888/assets/uploads/' + imgName + '" />');
  	}
  }
});

$('body').on('click', '#news-table tbody tr .glyphicon-trash', function () {
  var rowData = newsTable.row($(this).parents('tr')).data();
  if(rowData.id) {
  	$.post('../index.php/news/removeNews', {'newsId': rowData.id}, function (response) {
  		let data = JSON.parse(response);
	  	if(data.status == 'success') {
	  		newsTable.ajax.reload();
	  	} else {
	  		alert(data.msg);
	  	}
  	});
  }
});

mobileMenuOutsideClick();
scrollNavBar();
offcanvasMenu();
burgerMenu();
contentWayPoint();
dropdown();
goToTop();
loaderPage();
counterWayPoint();
parallax();
});
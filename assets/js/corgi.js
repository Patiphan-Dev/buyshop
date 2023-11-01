function success(title, desc, reload) { 
	if(reload == "true") {
		Swal.fire({
			title: '<span style="color:black">'+title+'</span>',
			// type: 'success',
			// icon: 'success',
			imageUrl: 'https://media.tenor.com/AFLSNpQpHVcAAAAi/my-melody.gif',
			imageWidth: 200,
			imageHeight: 200,
			imageAlt: 'Custom image',
			html: '<span style="color:gray">'+desc+'</span>',
			showConfirmButton: true,
		}).then(function(isConfirm) {
			var url = "";   
			 if (isConfirm === true) {
			//    $(location).attr('href',url);
				window.location.reload();
			 }else {
			//    $(location).attr('href',url);
				window.location.reload();
			 }
		})
	}else {
		Swal.fire({
		title: '<span style="color:black">'+title+'</span>',
		type: 'success',
		icon: 'success',
		html: '<span style="color:gray">'+desc+'</span>',
		showConfirmButton: true,
		})
	}
}
function isuccess(title, desc, reload, url) { 
	if(reload == "true") {
		Swal.fire({
		title: '<span style="color:black">'+title+'</span>',
		type: 'success',
		icon: 'success',
		html: '<span style="color:gray">'+desc+'</span>',
		showConfirmButton: true,
		}).then(function(isConfirm) {
		  if (isConfirm === true) {
			$(location).attr('href',url);
		  }else {
			$(location).attr('href',url);
		  }
		})
	}else {
		Swal.fire({
		title: '<span style="color:black">'+title+'</span>',
		type: 'success',
		icon: 'success',
		html: '<span style="color:gray">'+desc+'</span>',
		showConfirmButton: true,
		})
	}
}

function error(title, desc, reload) {
	if(reload == "true") {
		Swal.fire({
		title: '<span style="color:black">'+title+'</span>',
		// type: 'error',
		// icon: 'error',
		imageUrl: 'https://media.tenor.com/BB3sZELhyQgAAAAi/ermm-hmmm.gif',
		imageWidth: 200,
		imageHeight: 200,
		imageAlt: 'Custom image',
		html: '<span style="color:gray">'+desc+'</span>',
		confirmButtonText: '<span style="color:black;"><i class="fa fa-times"></i> ปิด</span>',
		confirmButtonColor: '#3085d6',
		}).then(function(isConfirm) {
		 var url = "";   
		 	if (isConfirm === true) {
		//    $(location).attr('href',url);
			window.location.reload();
			}else {
		//    $(location).attr('href',url);
			window.location.reload();
			}
		})
	}else {
		Swal.fire({
			title: '<span style="color:black">'+title+'</span>',
			// type: 'error',
			// icon: 'error',
			imageUrl: 'https://media.tenor.com/BB3sZELhyQgAAAAi/ermm-hmmm.gif',
			imageWidth: 200,
			imageHeight: 200,
			imageAlt: 'Custom image',
			html: '<span style="color:#gray">'+desc+'</span>',
			confirmButtonText: '<span style="color:#fff;"><i class="fa fa-times"></i> ปิด</span>',
			confirmButtonColor: '#2a9fd6',
		})
	}
}
function ierror(title, desc, reload, url) {
	if(reload == "true") {
		Swal.fire({
		title: '<span style="color:black">'+title+'</span>',
		type: 'error',
		icon: 'error',
		html: '<span style="color:gray">'+desc+'</span>',
		confirmButtonText: '<span style="color:black;"><i class="fa fa-times"></i> ปิด</span>',
		confirmButtonColor: '#3085d6',
		}).then(function(isConfirm) {
		  if (isConfirm === true) {
			$(location).attr('href',url);
		  }else {
			$(location).attr('href',url);
		  }
		})
	}else {
		Swal.fire({
		title: '<span style="color:black">'+title+'</span>',
		type: 'error',
		icon: 'error',
		html: '<span style="color:gray">'+desc+'</span>',
		confirmButtonText: '<span style="color:black;"><i class="fa fa-times"></i> ปิด</span>',
		confirmButtonColor: '#e54d40',
		})
	}
}

function warning(title, desc) {
	Swal.fire({
	title: '<span style="color:black">'+title+'</span>',
	type: 'warning',
	icon: 'warning',
	html: '<span style="color:gray">'+desc+'</span>',
	showConfirmButton: false,
    showCancelButton: false,
    showConfirmButton: false,
    allowOutsideClick: false,
    allowEscapeKey: false,
   })
}

function info(title, desc) {
	Swal.fire({
	title: '<span style="color:black">'+title+'</span>',
	type: 'info',
	icon: 'info',
	html: '<span style="color:gray">'+desc+'</span>',
	confirmButtonText: '<span style="color:black;"><i class="fa fa-times"></i> ปิด</span>',
	confirmButtonColor: '#e54d40',
   })
}

function my_info(title, desc, reload, url) {
	if(reload == "true") {
		Swal.fire({
		title: '<span style="color:black">'+title+'</span>',
		type: 'info',
		html: '<span style="color:gray">'+desc+'</span>',
		confirmButtonText: '<span style="color:black;"><i class="fa fa-times"></i> ปิด</span>',
		confirmButtonColor: '#e54d40',
		}).then(function(isConfirm) {
		  if (isConfirm === true) {
			$(location).attr('href',url);
		  }else {
			$(location).attr('href',url);
		  }
		})
	}else {
		Swal.fire({
		title: '<span style="color:black">'+title+'</span>',
		type: 'info',
		html: '<span style="color:gray">'+desc+'</span>',
		confirmButtonText: '<span style="color:black;"><i class="fa fa-times"></i> ปิด</span>',
		confirmButtonColor: '#e54d40',
		})
	}
}

function login() {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.post( "idpass.php?login",{
		email: $('#email').val(),
		password: $('#password').val(),
		recaptcha: grecaptcha.getResponse()
	},  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}



function logout() {
	Swal.fire({
		title: 'Are you sure?',
		text: "คุณการออกจากระบบใช่หรือไม่?",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, Logout it!'
	  }).then((result) => {
		if (result.isConfirmed) {
			$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
			$.get( "idpass.php?logout",  function( data ) {
				$("#btn").prop("disabled", true);
				$( "#return" ).html( data );
				$("#btn").prop("disabled", false); 
			}
			);
		}
	  })
	
}


function buyshopadd(id) {
	Swal.fire({
		title: 'Confirm Buy ShopID',
		text: "แน่ใจนะว่าจะซื้อไอดีนี้?",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Buy Now!'
	  }).then((result) => {
		if (result.isConfirmed) {
			buyidnow(id)
		}
	});
}

function buyidnow(id) {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.get( "idpass.php?buyshopid&id="+id,  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}

function buyaccount(id) {
	Swal.fire({
		title: 'Confirm Buy Account',
		text: "แน่ใจนะว่าจะซื้อบัญชีนี้?",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Buy Now!'
	  }).then((result) => {
		if (result.isConfirmed) {
			// buyidnow(id)buyshopaccount
			buyaccountnow(id)
		}
	});
}

function buypremium(id) {
	Swal.fire({
		title: 'Confirm Buy',
		text: "แน่ใจนะว่าจะซื้อสินค้านี้?",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Buy Now!'
	  }).then((result) => {
		if (result.isConfirmed) {
			$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
				$.get( "idpass.php?buy_pshop&id="+id,  function( data ) {
				$("#btn").prop("disabled", true);
				$( "#return" ).html( data );
				$("#btn").prop("disabled", false); 
			}
			);
		
		}
	});
}


function buyaccountnow(id) {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.get( "idpass.php?buyshopaccount&id="+id,  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}

function register() {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.post( "idpass.php?register",{
		username: $('#username').val(),
		password: $('#password').val(),
		repassword: $('#repassword').val(),
		email: $('#email').val(),
		recaptcha: grecaptcha.getResponse(),
		},  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}


function addshop() {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.post( "MainControllers.php?addshop",{
		name_shop: $('#name_shop').val(),
		platform_shop: $('#platform_shop').val(),
		url_shop: $('#url_shop').val(),
		point_shop: $('#point_shop').val(),
		status_shop: $('#status_shop').val(),
		download_shop: $('#download_shop').val(),
		editor: $('#summernote').summernote('code'),
		// editor: $('#editor').val(),
		// recaptcha: grecaptcha.getResponse(),
		},  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}

function editshopss() {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.post( "MainControllers.php?editshopss" ,{
		id_shop: $('#id_shop').val(),
		name_shop: $('#name_shop').val(),
		platform_shop: $('#platform_shop').val(),
		url_shop: $('#url_shop').val(),
		point_shop: $('#point_shop').val(),
		status_shop: $('#status_shop').val(),
		download_shop: $('#download_shop').val(),
		count_shop: $('#count_shop').val(),
		editor: $('#summernote').summernote('code'),
		},  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}

function updatewebinfo() {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.post( "MainControllers.php?updatewebinfo",{
		nameweb: $('#name_web').val(),
		versionweb: $('#version_web').val(),
		logoweb: $('#logo_web').val(),
		walletweb: $('#wallet_web').val(),
		facebookweb: $('#facebook_web').val(),
		discordweb: $('#discord_web').val(),
		// editor: $('#editor').val(),
		// recaptcha: grecaptcha.getResponse(),
		},  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}

function deleteitem(id) {
	Swal.fire({
		title: 'Confirm Detele Shop',
		text: "ยืนยันการลบสินค้า",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Delete Now!'
	  }).then((result) => {
		if (result.isConfirmed) {
			deleteshop(id)
		}
	});
}

function deleteshop(id) {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.get( "MainControllers.php?deleteshop&id="+id,  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}

function delete_rewarde_slot(id) {
	Swal.fire({
		title: 'Confirm Rewarde Slot',
		text: "ยืนยันการลบรางวัล",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Delete Now!'
	  }).then((result) => {
		if (result.isConfirmed) {
			del_rewarde_slot(id)
		}
	});
}

function del_rewarde_slot(id) {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.get( "MainControllers.php?deleteRewardesSlot&id="+id,  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}

function delete_rewarde_spin(id) {
	Swal.fire({
		title: 'Confirm Rewarde Slot',
		text: "ยืนยันการลบรางวัล",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Delete Now!'
	  }).then((result) => {
		if (result.isConfirmed) {
			del_rewarde_spin(id)
		}
	});
}

function del_rewarde_spin(id) {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.get( "MainControllers.php?deleteRewardesSpin&id="+id,  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}




function deletekeysallitem(id) {
	Swal.fire({
		title: 'Confirm Detele All Key',
		text: "ยืนยันการลบ key ทั้งหมด",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Delete All!'
	  }).then((result) => {
		if (result.isConfirmed) {
			deletekeysall(id)
		}
	});
}


function topups() {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.post( "idpass.php?topupwallet",{
		link_topup: $('#link_topup').val(),
		recaptcha: grecaptcha.getResponse(),
		},  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}


function shopbuyitem(id) {
	Swal.fire({
		title: 'Confirm purchase',
		text: "ยืนยันการซื้อไอเทม",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Buy Now!'
	  }).then((result) => {
		if (result.isConfirmed) {
			buyshop(id)
		}
	});
}

function buyshop(id) {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.get( "MainControllers.php?buyshop&id="+id,  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}


function repassword() {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.post( "idpass.php?repassword",{
		password_old: $('#password_old').val(),
		password_new: $('#password_new').val(),
		repassword_new: $('#repassword_new').val(),
		captcha: $('#captcha').val(),
		},  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}

function reprofile() {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.post( "idpass.php?reprofile",{
		urlimg: $('#urlimg').val(),
		// password_new: $('#password_new').val(),
		// repassword_new: $('#repassword_new').val(),
		// captcha: $('#captcha').val(),
		},  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}

function UpdateStock(){
	$.get( "idpass.php?UpdateStock",  function( data ) {
		$("#btn").prop("disabled", true);
		$( "#return" ).html( data );
		$("#btn").prop("disabled", false); 
	}
	)
}

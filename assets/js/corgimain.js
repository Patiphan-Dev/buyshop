function topups() {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.post( "manage.php?add_category",{
		link_topup: $('#link_topup').val(),
		link_topup: $('#link_topup').val(),
		link_topup: $('#link_topup').val(),
		},  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}


function delete_category(id) {
	Swal.fire({
		title: 'Confirm Delete Category',
		text: "ยืนยันการลบ category",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Delete Now!'
	  }).then((result) => {
		if (result.isConfirmed) {
			del_category(id)
		}
	});
}

function del_category(id) {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.get( "manage.php?delete_category&id="+id,  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}

function updateusers() {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.post( "manage.php?updateusers",{
		img: $('#img').val(),
		id: $('#id').val(),
		email: $('#email').val(),
		point: $('#point').val(),
		ip: $('#ip').val(),
		status: $('#status').val(),
	},  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}

function updateweb() {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.post( "manage.php?updateweb",{
		img: $('#img').val(),
		name: $('#name').val(),
		version: $('#version').val(),
		wallet: $('#wallet').val(),
		fb: $('#fb').val(),
		dc: $('#dc').val(),
		yt: $('#yt').val(),
		point_spin: $('#point_spin').val(),
		point_roller: $('#point_roller').val(),
		point_slot: $('#point_slot').val(),
		colorweb: $('#colorweb').val(),
		colormenu: $('#colormenu').val(),
		web_title: $('#web_title').val(),
	},  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}
function add_gifcode() {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.post( "manage.php?add_gifcode",{
		iditem: $('#iditem').val(),
		gifcode: $('#gifcode').val(),
	},  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}


function delete_rewards(id) {
	Swal.fire({
		title: 'Confirm Delete Rewards',
		text: "ยืนยันการลบรางวัลนี้",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Delete Now!'
	  }).then((result) => {
		if (result.isConfirmed) {
			del_rewards(id)
		}
	});
}

function del_rewards(id) {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.get( "manage.php?delete_rewards&id="+id,  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}

function delete_gifcode(id) {
	Swal.fire({
		title: 'Confirm Delete Rewards',
		text: "ยืนยันการลบ Gif code",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Delete Now!'
	  }).then((result) => {
		if (result.isConfirmed) {
			$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
				$.get( "manage.php?delete_gifcode&id="+id,  function( data ) {
				$("#btn").prop("disabled", true);
				$( "#return" ).html( data );
				$("#btn").prop("disabled", false); 
			}
			);
		}
	});
}

function delete_shop_id(id) {
	Swal.fire({
		title: 'Confirm Delete Rewards',
		text: "ยืนยันการลบสินค้านี้",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Delete Now!'
	  }).then((result) => {
		if (result.isConfirmed) {
			$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
				$.get( "manage.php?delete_shop_id&id="+id,  function( data ) {
				$("#btn").prop("disabled", true);
				$( "#return" ).html( data );
				$("#btn").prop("disabled", false); 
			}
			);
		}
	});
}

function delete_gifcode_all(id) {
	Swal.fire({
		title: 'Confirm Delete Rewards',
		text: "ยืนยันการลบ Gif code ทั้งหมด",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Delete Now!'
	  }).then((result) => {
		if (result.isConfirmed) {
			$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
				$.get( "manage.php?delete_gifcode_all&id="+id,  function( data ) {
				$("#btn").prop("disabled", true);
				$( "#return" ).html( data );
				$("#btn").prop("disabled", false); 
			}
			);
		}
	});
}

function add_account_stock() {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.post( "manage.php?add_account_stock",{
		shopid: $('#shopid').val(),
		account: $('#account').val(),
	},  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}

function delete_account_stock(id) {
	Swal.fire({
		title: 'Confirm Delete account',
		text: "ยืนยันการลบ Gif code",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Delete Now!'
	  }).then((result) => {
		if (result.isConfirmed) {
			$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
				$.get( "manage.php?delete_account_stock&id="+id,  function( data ) {
				$("#btn").prop("disabled", true);
				$( "#return" ).html( data );
				$("#btn").prop("disabled", false); 
			}
			);
		}
	});
}

function delete_account_stock_all(id) {
	Swal.fire({
		title: 'Confirm Delete account all',
		text: "ยืนยันการลบ Gif code",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Delete Now!'
	  }).then((result) => {
		if (result.isConfirmed) {
			$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
				$.get( "manage.php?delete_account_stock_all&id="+id,  function( data ) {
				$("#btn").prop("disabled", true);
				$( "#return" ).html( data );
				$("#btn").prop("disabled", false); 
			}
			);
		}
	});
}


function on_top(id) {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.get( "manage.php?shop_on_top&id="+id,  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}

function on_show(id) {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.get( "manage.php?shop_on_show&id="+id,  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}


function editshoppre(id) {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.post( "manage.php?editshoppre",{
		item_id: $('#item_id3'+id).val(),
		price: $('#price'+id).val(),
	},  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}

function on_showpremium(id) {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.get( "manage.php?shop_premium&id="+id,  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}


function delete_slide(id) {
	Swal.fire({
		title: 'Confirm Delete Slide',
		text: "ยืนยันการลบ slide",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Delete Now!'
	  }).then((result) => {
		if (result.isConfirmed) {
			del_slide(id)
		}
	});
}

function del_slide(id) {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.get( "manage.php?delete_slide&id="+id,  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}


function on_showslide(id) {
	$("#return").html("<script>warning('<i class=\"fa fa-spinner fa-spin fa-fw\"></i>\', 'กรุณารอสักครู่...');</script>");
	$.get( "manage.php?shop_slide&id="+id,  function( data ) {
	$("#btn").prop("disabled", true);
	$( "#return" ).html( data );
	$("#btn").prop("disabled", false); 
  }
 );
}



$(document).ready(function(){
	$("#btnSignIn").on("click", function(){
		var inId = $("#inId").val();
		var inPassword = $("#inPassword").val();

		if (inId.length == 0){
			Swal.fire({
				type: 'warning',
				icon: 'error',
				text: 'Empty ID Field !'
			});
		} 
		else if(inPassword.length == 0){
			Swal.fire({
				type: 'warning',
				icon: 'error',
				text: 'Empty Password Field !'
			});
		}
		else {
			$.ajax({
				url: base_url+"login/C_login/checkLogin",
				type: "POST",
				data : { 
							"inId" : inId,
							"inPassword" : inPassword
						},
				cache: false,
				success: function(data) {
					if (data == "success") {
						Swal.fire({
							type: 'success',
							title: 'Login Success !',
							text: 'You will be redirected in a few seconds',
							timer: 1000,
							showCancelButton: false,
							showConfirmButton: false
						})
						.then (function() {
						  	window.location.href = base_url+"dashboard/C_dashboard";
						});
					} 
					else {
						Swal.fire({
							type: 'error',
							title: 'Login Failed!',
							text: 'Please Try Again !'
						});
					}

					console.log(data);
				},
				error:function(data){
					Swal.fire({
						type: 'error',
						title: 'Opps!',
						text: 'server error!'
					});
  
					console.log(data);
				}
			})
		}
	})

	$("#btnRegister").on("click", function(){
		var inId = $("#inId").val();
		var inName = $("#inName").val();
		var inEmail = $("#inEmail").val();
		var inPassword = $("#inPassword").val();
		var inReTypePassword = $("#inReTypePassword").val();

		if (inId.length == 0){
			Swal.fire({
				type: 'warning',
				icon: 'error',
				text: 'Empty ID Field !'
			});
		}
		else if (inName.length == 0){
			Swal.fire({
				type: 'warning',
				icon: 'error',
				text: 'Empty Name Field !'
			});
		}
		else if (inEmail.length == 0){
			Swal.fire({
				type: 'warning',
				icon: 'error',
				text: 'Empty Email Field !'
			});
		} 
		else if(inPassword.length == 0){
			Swal.fire({
				type: 'warning',
				icon: 'error',
				text: 'Empty Password Field !'
			});
		}
		else if(inReTypePassword.length == 0){
			Swal.fire({
				type: 'warning',
				icon: 'error',
				text: 'Empty Retype Password Field !'
			});
		}
		else if(inPassword != inReTypePassword){
			Swal.fire({
				type: 'warning',
				icon: 'error',
				text: 'Password Field Does Not Match !'
			});
		}
		else {
			$.ajax({
				url: base_url+"login/C_login/saveRegister",
				type: "POST",
				data : { 
							"inId" : inId,
							"inName" : inName,
							"inEmail" : inEmail,
							"inPassword" : inPassword
						},
				cache: false,
				success: function(data) {
					if (data == "success") {
						Swal.fire({
							type: 'success',
							title: 'Register Success !',
							timer: 1000,
							showCancelButton: false,
							showConfirmButton: false
						})
						.then (function() {
						  	window.location.href = base_url+"login/C_login";
						});
					} 
					else {
						Swal.fire({
							type: 'error',
							title: 'Register Failed!',
							text: 'Please Try Again !'
						});
					}

					console.log(data);
				},
				error:function(data){
					Swal.fire({
						type: 'error',
						title: 'Opps!',
						text: 'server error!'
					});
  
					console.log(data);
				}
			})
		}
	})
});
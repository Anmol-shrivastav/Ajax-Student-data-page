<html>
	<head>
		<title>This is Second Page.</title>
		<link rel="stylesheet" href="style.css"/>
	</head>
	<body>
		<div class="container">	
			<div class="container-fluid">
			
				<div class="header-box">
					<div class="header-title-box">
						<p>Add Records With PHP & Ajax.</p>
					</div>
					
					<div class="header-search-box">
						<input type="text" id="search-input" placeholder="Search Here.."/>
					</div>
				</div>
				
				<div class="form-box">
					<div class="firstInputField">
						<p>First Name:</p>
						<input type="text" id="fname" placeholder="Name" name="NAME"/>
					</div>
					
					<div class="secondInputField">
						<p>Last Name:</p>
						<input type="text" id="lname" placeholder="Last Name" name="LASTNAME"/>
					</div>
					
					<div class="btn-box">
						<button id="submit-btn">Submit</button>
					</div>
				</div>
				
				
				<div align="center" class="table-box">
				<br>
					<!-- <table>
						<thead>
							<tr>
								<th>ID</th>
								<th>FIRST NAME</th>
								<th>LAST NAME</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>Anmol</td>
								<td>Kumar</td>
							</tr>
						</tbody>
					</table> -->
				</div>
				
				<div id="error-message"></div>
				<div id="success-message"></div>
				
				<div id="modal">
					<div id="modal-form">
						<p id="edit-title" style="margin: 0;">Edit Form</p>
						<hr>
						
						<input type="text" style="display: none;" id="student_Id"/>
						
						<div class="edit-fname">
							<p>FIRST NAME:</p>
							<input type="text" placeholder="First Name" id="edit-fname-input" style="margin-left: 15px;"/>
						</div>
						
						<div class="edit-lname">
							<p>LAST NAME:</p>
							<input type="text" placeholder="Last Name" id="edit-lname-input" style="margin-left: 1px;"/>
						</div>
						
						<button id="saveChange" align="center">UPDATE</button>
						<button id="close">X</button>
					</div>
				</div>
				
			</div>
		</div>
	
	
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				function loadData(){
					$.ajax({
						url: "loadData.php",
						type: "POST",
						success: function(data){
							$(".table-box").html(data);
						}
					});
				}
				loadData();
				
				let submit = $("#submit-btn");
				submit.on("click", function(e){
					let fnameInput = $("#fname");
					let lnameInput = $("#lname");
					
					let fname = fnameInput.val();
					let lname = lnameInput.val();
					
					if(fname == "" || lname == ""){
						$("#error-message").html("All Fields are Required").slideDown();
						$("#success-message").slideUp();
					}else{
						$.ajax({
							url: "insertData.php",
							type: "POST",
							data: {first_name: fname, last_name: lname},
							success: function(data){
								if(data == 1){
									loadData();
									fnameInput.val('');
									lnameInput.val('');
									$("#success-message").html("Data Uploaded Successfully.").slideDown();
									$("#error-message").slideUp();
								}else{
									$("#error-message").html("Can't Save Record in Database.").slideDown();
									$("#success-message").slideUp();
								}
							}
						});
					}
					
					
				});
				
				//click on delete btn
				$(document).on("click", ".delete-btn", function(e){
					let student_ID = $(this).data("id");   //console.log(e.target.attributes[1].value); same task can done by using event only
					
					$.ajax({
						url: "deleteData.php",
						type: "POST",
						data: {ID:student_ID},
						success: function(data){
							if(data == 1){
								$(this).closest("tr").fadeOut();
								$("#error-message").slideUp();
								$("#success-message").html("Deleted Successfully.").slideDown();
								loadData();
							}else{
								$("#error-message").html("Unable to Delete Record.").slideDown();
								$("#success-message").slideUp();
							}
						}
					});
					
				});
				
				//on click edit button
				$(document).on("click", ".edit-btn", function(e){
					$("#modal").show();
					let student_Id = $(this).data("id");
					
					$.ajax({
						url: "editData.php",
						type: "POST",
						data: {Id: student_Id},
						success: function(data){
							let name = data.split(" ");
							let fnameInput = $("#edit-fname-input");
							let lnameInput = $("#edit-lname-input");
							fnameInput.val(name[0]);
							lnameInput.val(name[1]);
							$("#student_Id").val(student_Id);
						}
					});
				});
				
				//on click of save changes as per modal
				$("#saveChange").on("click", function(){
					let fnameInput = $("#edit-fname-input");
					let lnameInput = $("#edit-lname-input");
					let fname = fnameInput.val();
					let lname = lnameInput.val();
					let student_Id = $("#student_Id").val();
					//console.log(student_Id);
					$.ajax({
						url: "updateData.php",
						type: "POST",
						data: {Id: student_Id, first_name: fname, last_name: lname},
						success: function(data){
							//close modal
							$("#modal").hide();
							if(data == 1){
								$("#error-message").slideUp();
								$("#success-message").html("Data Updated Successfully.").slideDown();
								loadData();
							}else{
								$("#error-message").html("Can't Update Data.").slideDown();
								$("#success-message").slideUp();
							}
						}
					});
				});
				
				//close modal
				$("#close").on("click", function(){
					$("#modal").hide();
				});
				
				//Live search
				let searchInputField = $("#search-input");
				searchInputField.on("keyup", function(){
					let searchedText = searchInputField.val();
					
					$.ajax({
						url: "searchData.php",
						type: "POST",
						data: {text : searchedText},
						success: function(data){
							$(".table-box").html(data);
						}
					});
				});
				
				
			});
		</script>
	</body>
</html>
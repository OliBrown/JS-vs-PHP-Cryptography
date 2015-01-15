<?php
  require 'php/AES.php';

if (isset($_GET['AESencryptPHP'])) {

  $AESpasswordPHP = $_POST['AESpasswordPHP'];
  $AESencryptPHP = $_POST['AESencryptPHP'];
  GibberishAES::size(256);
  $AESencryptedPHP = GibberishAES::enc($AESencryptPHP, $AESpasswordPHP);

echo $AESencryptedPHP;
return;
};

if (isset($_GET['AESdecryptPHP'])) {

  $AESpasswordPHP = $_POST['AESpasswordPHP'];
  $AESdecryptPHP = $_POST['AESdecryptPHP'];
  GibberishAES::size(256);
  $AESdecryptedPHP = GibberishAES::dec($AESdecryptPHP, $AESpasswordPHP);

echo $AESdecryptedPHP;
return;
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>JS vs PHP Cryptography</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body>
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">JS vs PHP Cryptography</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="AES">AES</a>
					</li>
					<li><a href="RSA">RSA</a>
					</li>
					<li><a href="Hashing">Hashing</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-body">
					<h1>JS vs PHP Cryptography</h1>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-xs-6">
						<div class="exhibit">
							<div class="form-group">
								<label for="AESpasswordJS">JS Password</label>
								<input type="text" class="form-control" id="AESpasswordJS" name="AESpasswordJS">
							</div>
							<div class="form-group">
								<label for="AESencryptJS">JS Encrypt</label>
								<textarea class="form-control" id="AESencryptJS" name="AESencryptJS" rows="1"></textarea>
								<button type="submit" class="btn btn-default" id="JSencryptAES">JS Encrypt</button>
							</div>
							<div class="form-group">
								<label for="AESencryptedJS">JS Encrypted</label>
								<textarea class="form-control rdonly" id="AESencryptedJS" name="AESencryptedJS" rows="3" readonly></textarea>
								<button type="submit" class="btn btn-default" id="AES-JStoJS">JS <span class="glyphicon glyphicon-arrow-down"></span>
								</button>
								<button type="submit" class="btn btn-default" id="AES-JStoPHP">PHP <span class="glyphicon glyphicon-arrow-right"></span>
								</button>
							</div>
							<div class="form-group">
								<label for="AESdecryptJS">JS Decrypt</label>
								<textarea class="form-control rdonly" id="AESdecryptJS" name="AESdecryptJS" rows="3" readonly></textarea>
								<button type="submit" class="btn btn-default" id="JSdecryptAES">JS Decrypt</button>
							</div>
							<div class="form-group">
								<label for="AESdecryptedJS">JS Decrypted</label>
								<textarea class="form-control rdonly" id="AESdecryptedJS" name="AESdecryptedJS" rows="1" readonly></textarea>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="exhibit">
							<div class="form-group">
								<label for="AESpasswordPHP">PHP Password</label>
								<input type="text" class="form-control" id="AESpasswordPHP" name="AESpasswordPHP">
							</div>
							<div class="form-group">
								<label for="AESencryptPHP">PHP Encrypt</label>
								<textarea class="form-control" id="AESencryptPHP" name="AESencryptPHP" rows="1"></textarea>
								<button type="submit" class="btn btn-default" id="PHPencryptAES">PHP Encrypt</button>
							</div>
							<div class="form-group">
								<label for="AESencryptedPHP">PHP Encrypted</label>
								<textarea class="form-control rdonly" id="AESencryptedPHP" name="AESencryptedPHP" rows="3" readonly></textarea>
								<button type="submit" class="btn btn-default" id="AES-PHPtoJS"><span class="glyphicon glyphicon-arrow-left"></span> JS</button>
								<button type="submit" class="btn btn-default" id="AES-PHPtoPHP"><span class="glyphicon glyphicon-arrow-down"></span> PHP</button>
							</div>
							<div class="form-group">
								<label for="AESdecryptPHP">PHP Decrypt</label>
								<textarea class="form-control rdonly" id="AESdecryptPHP" name="AESdecryptPHP" rows="3" readonly></textarea>
								<button type="submit" class="btn btn-default" id="PHPdecryptAES">PHP Decrypt</button>
							</div>
							<div class="form-group">
								<label for="AESdecryptedPHP">PHP Decrypted</label>
								<textarea class="form-control rdonly" id="AESdecryptedPHP" name="AESdecryptedPHP" rows="1" readonly></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
			<a class="freshGenius" href="http://FreshGenius.com" target="blank">Fresh Genius</a>
	</div>

	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/aes.min.js"></script>
	<script>
	$(function() {
		$("#JSencryptAES").click(function(e) {
			$("#AESencryptedJS").html(""), $("#JSencryptAES").blur();
			var t = $("#AESencryptJS").val(),
				r = $("#AESpasswordJS").val(),
				S = GibberishAES.enc(t, r);
			$("#AESencryptedJS").val(S), e.preventDefault()
		}), $("#JSdecryptAES").click(function(e) {
			$("#AESdecryptedJS").html(""), $("#JSdecryptAES").blur();
			var t = $("#AESdecryptJS").val(),
				r = $("#AESpasswordJS").val(),
				S = GibberishAES.dec(t, r);
			$("#AESdecryptedJS").val(S), e.preventDefault()
		}), $("#PHPencryptAES").click(function(e) {
			var t = $("#AESpasswordPHP").serialize(),
				r = $("#AESencryptPHP").serialize();
			$.ajax({
				url: "AES.php?AESencryptPHP",
				type: "post",
				data: t + "&" + r,
				success: function(e) {
					$("#AESencryptedPHP").val(e)
				},
				error: function() {
					$("#AESencryptedPHP").html("Error")
				}
			}), e.preventDefault(), $("#PHPencryptAES").blur()
		}), $("#PHPdecryptAES").click(function(e) {
			var t = $("#AESpasswordPHP").serialize(),
				r = $("#AESdecryptPHP").serialize();
			$.ajax({
				url: "AES.php?AESdecryptPHP",
				type: "post",
				data: t + "&" + r,
				success: function(e) {
					$("#AESdecryptedPHP").val(e)
				},
				error: function() {
					$("#AESdecryptedPHP").html("Error")
				}
			}), e.preventDefault(), $("#PHPdecryptAES").blur()
		}), $("#AES-JStoJS").click(function(e) {
			$("#AESdecryptJS").val($("#AESencryptedJS").val()), e.preventDefault(), $("#AES-JStoJS").blur()
		}), $("#AES-JStoPHP").click(function(e) {
			$("#AESdecryptPHP").val($("#AESencryptedJS").val()), e.preventDefault(), $("#AES-JStoPHP").blur()
		}), $("#AES-PHPtoPHP").click(function(e) {
			$("#AESdecryptPHP").val($("#AESencryptedPHP").val()), e.preventDefault(), $("#AES-PHPtoPHP").blur()
		}), $("#AES-PHPtoJS").click(function(e) {
			$("#AESdecryptJS").val($("#AESencryptedPHP").val()), e.preventDefault(), $("#AES-PHPtoJS").blur()
		})
	});
	</script>	
  </body>
</html>

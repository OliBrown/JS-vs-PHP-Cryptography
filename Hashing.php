<?php

if (isset($_GET['HashPHP'])) {

  require 'php/Hash.php';

  $tohash = $_POST['PHPhashText'];
  $hmacHashType = $_POST['PHPhmacHash'];
  $hmacHashKey = $_POST['PHPhmacKey'];
  $sha1hash = new Crypt_Hash('sha1');
  $sha256hash = new Crypt_Hash('sha256');
  $md5hash = new Crypt_Hash('md5');
  $hmachash = new Crypt_Hash($hmacHashType);
  $hmachash->setKey($hmacHashKey);
  
  $sha1 = bin2hex($sha1hash->hash($tohash));
  $sha256 = bin2hex($sha256hash->hash($tohash));
  $md5 = bin2hex($md5hash->hash($tohash));
  $hmac = bin2hex($hmachash->hash($tohash));

echo $sha1.'<<~~##~~>>'.$sha256.'<<~~##~~>>'.$md5.'<<~~##~~>>'.$hmac.'<<~~##~~>>';
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
								<label for="JShashText">JS Text To Hash</label>
								<textarea class="form-control" id="JShashText" name="JShashText" rows="1">This is my message.</textarea>
							</div>
							<div class="form-group">
								<label for="JShmacKey">HMAC Key + Hash</label>
								<div class="input-group">
									<input type="text" class="form-control" id="JShmacKey" value="My-API-Key-123">
									<div class="input-group-btn">
										<button class="btn btn-default dropdown-toggle" id="JShmacHash" type="button" data-value="sha1" data-toggle="dropdown">SHA1 <span class="caret"></span>
										</button>
										<ul class="dropdown-menu pull-right">
											<li><a class="change-JS-hmac-hash" data-value="sha1" href="#">SHA1</a>
											</li>
											<li><a class="change-JS-hmac-hash" data-value="sha256" href="#">SHA256</a>
											</li>
											<li><a class="change-JS-hmac-hash" data-value="md5" href="#">MD5</a>
											</li>
										</ul>
									</div>
								</div>
								<button type="submit" class="btn btn-default" id="JShash">JS Hash</button>
							</div>

							<div class="form-group">
								<label for="JS-SHA1">JS SHA1</label>
								<textarea class="form-control rdonly" id="JS-SHA1" name="JS-SHA1" rows="1" readonly></textarea>
							</div>
							<div class="form-group">
								<label for="JS-SHA256">JS SHA256</label>
								<textarea class="form-control rdonly" id="JS-SHA256" name="JS-SHA256" rows="1" readonly></textarea>
							</div>
							<div class="form-group">
								<label for="JS-MD5">JS MD5</label>
								<textarea class="form-control rdonly" id="JS-MD5" name="JS-MD5" rows="1" readonly></textarea>
							</div>
							<div class="form-group">
								<label for="JS-HMAC">JS HMAC</label>
								<textarea class="form-control rdonly" id="JS-HMAC" name="JS-HMAC" rows="1" readonly></textarea>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="exhibit">
							<div class="form-group">
								<label for="PHPhashText">PHP Text To Hash</label>
								<textarea class="form-control" id="PHPhashText" name="PHPhashText" rows="1">This is my message.</textarea>
							</div>
							<div class="form-group">
								<label for="PHPhmacKey">HMAC Key + Hash</label>
								<div class="input-group">
									<input type="text" class="form-control" id="PHPhmacKey" value="My-API-Key-123">
									<div class="input-group-btn">
										<button class="btn btn-default dropdown-toggle" id="PHPhmacHash" type="button" data-value="sha1" data-toggle="dropdown">SHA1 <span class="caret"></span>
										</button>
										<ul class="dropdown-menu pull-right">
											<li><a class="change-PHP-hmac-hash" data-value="sha1" href="#">SHA1</a>
											</li>
											<li><a class="change-PHP-hmac-hash" data-value="sha256" href="#">SHA256</a>
											</li>
											<li><a class="change-PHP-hmac-hash" data-value="md5" href="#">MD5</a>
											</li>
										</ul>
									</div>
								</div>
								<button type="submit" class="btn btn-default" id="PHPhash">PHP Hash</button>
							</div>

							<div class="form-group">
								<label for="PHP-SHA1">PHP SHA1</label>
								<textarea class="form-control rdonly" id="PHP-SHA1" name="PHP-SHA1" rows="1" readonly></textarea>
							</div>
							<div class="form-group">
								<label for="PHP-SHA256">PHP SHA256</label>
								<textarea class="form-control rdonly" id="PHP-SHA256" name="PHP-SHA256" rows="1" readonly></textarea>
							</div>
							<div class="form-group">
								<label for="PHP-MD5">PHP MD5</label>
								<textarea class="form-control rdonly" id="PHP-MD5" name="PHP-MD5" rows="1" readonly></textarea>
							</div>
							<div class="form-group">
								<label for="PHP-HMAC">PHP HMAC</label>
								<textarea class="form-control rdonly" id="PHP-HMAC" name="PHP-HMAC" rows="1" readonly></textarea>
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
	<script src="js/hash.min.js"></script>
	<script>
	$(function() {
		$(".change-JS-hmac-hash").each(function(a, t) {
			var e = $(t),
				c = e.attr("data-value");
			e.click(function(a) {
				var t = $("#JShmacHash");
				t.attr("data-value", c), t.html('<span class="uppercase-btn">' + c + ' </span><span class="caret"></span>'), a.preventDefault()
			})
		}), $(".change-PHP-hmac-hash").each(function(a, t) {
			var e = $(t),
				c = e.attr("data-value");
			e.click(function(a) {
				var t = $("#PHPhmacHash");
				t.attr("data-value", c), t.html('<span class="uppercase-btn">' + c + ' </span><span class="caret"></span>'), a.preventDefault()
			})
		}), $("#JShash").click(function(a) {
			var t = $("#JShashText").val(),
				e = $("#JShmacKey").val(),
				c = $("#JShmacHash").attr("data-value"),
				P = forge.md.sha1.create();
			P.update(t), $("#JS-SHA1").val(P.digest().toHex());
			var P = forge.md.sha256.create();
			P.update(t), $("#JS-SHA256").val(P.digest().toHex());
			var P = forge.md.md5.create();
			P.update(t), $("#JS-MD5").val(P.digest().toHex());
			var r = forge.hmac.create();
			r.start(c, e), r.update(t), $("#JS-HMAC").val(r.digest().toHex()), a.preventDefault(), $("#JShash").blur()
		}), $("#PHPhash").click(function(a) {
			var t = $("#PHPhashText").serialize(),
				e = $("#PHPhmacKey").val(),
				c = $("#PHPhmacHash").attr("data-value");
			$.ajax({
				url: "Hashing.php?HashPHP",
				type: "post",
				data: t + "&PHPhmacKey=" + e + "&PHPhmacHash=" + c,
				success: function(a) {
					PHPhash = a.split("<<~~##~~>>"), $("#PHP-SHA1").val(PHPhash[0]), $("#PHP-SHA256").val(PHPhash[1]), $("#PHP-MD5").val(PHPhash[2]), $("#PHP-HMAC").val(PHPhash[3])
				},
				error: function() {
					$("#PHP-SHA1").html("Error")
				}
			}), a.preventDefault(), $("#PHPhash").blur()
		}), $("#AES-JStoJS").click(function(a) {
			$("#AESdecryptJS").val($("#AESencryptedJS").val()), a.preventDefault(), $("#AES-JStoJS").blur()
		}), $("#AES-JStoPHP").click(function(a) {
			$("#AESdecryptPHP").val($("#AESencryptedJS").val()), a.preventDefault(), $("#AES-JStoPHP").blur()
		}), $("#AES-PHPtoPHP").click(function(a) {
			$("#AESdecryptPHP").val($("#AESencryptedPHP").val()), a.preventDefault(), $("#AES-PHPtoPHP").blur()
		}), $("#AES-PHPtoJS").click(function(a) {
			$("#AESdecryptJS").val($("#AESencryptedPHP").val()), a.preventDefault(), $("#AES-PHPtoJS").blur()
		})
	});
	</script>	
  </body>
</html>

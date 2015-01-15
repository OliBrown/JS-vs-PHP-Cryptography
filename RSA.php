<?php
  ini_set('max_execution_time', 300);
  require 'php/RSA.php';
  
if (isset($_GET['PHPkeypair'])) {

  $RSAkeysizePHP=$_GET['PHPkeypair'];
  $rsa = new Crypt_RSA();
  extract($rsa->createKey($RSAkeysizePHP));

echo $publickey.'<<~~##~~>>'.$privatekey;
return;
};

if (isset($_GET['RSAencryptPHP'])) {

  $rsa = new Crypt_RSA();
  $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
  $rsa->loadKey($_POST['pubkey']);
  $RSAencryptedPHP = $rsa->encrypt($_POST['RSAencryptPHP']);
  $RSAbase_encodedPHP = base64_encode($RSAencryptedPHP);

echo $RSAbase_encodedPHP;
return;
};

if (isset($_GET['RSAdecryptPHP'])) {

  $rsa = new Crypt_RSA();
  $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
  $rsa->loadKey($_POST['prikey']);
  $RSAbase_decodedPHP = base64_decode($_POST['RSAdecryptPHP']);
  $RSAdecryptedPHP = $rsa->decrypt($RSAbase_decodedPHP);

echo $RSAdecryptedPHP;
return;
};

if (isset($_GET['RSAsignPHP'])) {

  $rsa = new Crypt_RSA();
  $rsa->loadKey($_POST['pvtkey']);
  $RSAsignPHP = $_POST['RSAsignPHP'];
  $rsa->setSignatureMode(CRYPT_RSA_SIGNATURE_PKCS1);
  $RSAsignaturePHP = $rsa->sign($RSAsignPHP);
  $RSAbase_encodePHP = base64_encode($RSAsignaturePHP);

echo $RSAbase_encodePHP;
return;
};

if (isset($_GET['RSAverifyPHP'])) {

  $rsa = new Crypt_RSA();
  $RSAverifyPHP = $_POST['RSAverifyPHP'];
  $RSAsignedPHP = $_POST['RSAsignedPHP'];
  $rsa->setSignatureMode(CRYPT_RSA_SIGNATURE_PKCS1);
  $rsa->loadKey($_POST['pbckey']);
  $RSAbase_decodePHP = base64_decode($RSAverifyPHP);
  $RSAverifiedPHP = $rsa->verify($RSAsignedPHP, $RSAbase_decodePHP) ? 'true' : 'false';
  
echo $RSAverifiedPHP;
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
			<div class="panel-group" id="accordion">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
				  Key Pair Generation
				</a>
			  </h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse in">
						<div class="panel-body">
							<div class="col-xs-6">
								<div class="exhibit">
									<div class="btn-group bottom-pad">
										<button class="btn btn-default dropdown-toggle" id="RSAkeysizeJS" type="button" data-value="1024" data-toggle="dropdown">1024 bit <span class="caret"></span>
										</button>
										<ul class="dropdown-menu">
											<li><a class="change-JS-key-size" data-value="512" href="#">512 bit</a>
											</li>
											<li><a class="change-JS-key-size" data-value="1024" href="#">1024 bit</a>
											</li>
											<li><a class="change-JS-key-size" data-value="2048" href="#">2048 bit</a>
											</li>
											<li><a class="change-JS-key-size" data-value="4096" href="#">4096 bit</a>
											</li>
										</ul>
									</div>
									<div class="form-group">
										<label for="JSpublicRSA">JS Public Key</label>
										<textarea class="form-control rdonly" id="JSpublicRSA" rows="3" readonly></textarea>
									</div>
									<div class="form-group">
										<label for="JSprivateRSA">JS Private Key</label>
										<textarea class="form-control rdonly" id="JSprivateRSA" rows="3" readonly></textarea>
									</div>
									<button type="submit" class="btn btn-default" id="JSkeypairRSA">Generate Key Pair</button>
									<div id="JSloadingRSA" class="loading" style="display:none">Generating...</div>
									<button type="submit" class="btn btn-default fl-right" id="JSkeyuseRSA">Use <span class="glyphicon glyphicon-arrow-down"></span>
									</button>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="exhibit">
									<div class="btn-group bottom-pad">
										<button class="btn btn-default dropdown-toggle" id="RSAkeysizePHP" type="button" data-value="1024" data-toggle="dropdown">1024 bit <span class="caret"></span>
										</button>
										<ul class="dropdown-menu">
											<li><a class="change-PHP-key-size" data-value="512" href="#">512 bit</a>
											</li>
											<li><a class="change-PHP-key-size" data-value="1024" href="#">1024 bit</a>
											</li>
											<li><a class="change-PHP-key-size" data-value="2048" href="#">2048 bit</a>
											</li>
											<li><a class="change-PHP-key-size" data-value="4096" href="#">4096 bit</a>
											</li>
										</ul>
									</div>
									<div class="form-group">
										<label for="PHPpublicRSA">PHP Public Key</label>
										<textarea class="form-control rdonly" id="PHPpublicRSA" rows="3" readonly></textarea>
									</div>
									<div class="form-group">
										<label for="PHPprivateRSA">PHP Private Key</label>
										<textarea class="form-control rdonly" id="PHPprivateRSA" rows="3" readonly></textarea>
									</div>
									<button type="submit" class="btn btn-default" id="PHPkeypairRSA">Generate Key Pair</button>
									<div id="PHPloadingRSA" class="loading" style="display:none">Generating...</div>
									<button type="submit" class="btn btn-default fl-right" id="PHPkeyuseRSA">Use <span class="glyphicon glyphicon-arrow-down"></span>
									</button>
								</div>
							</div>

						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
				  Encryption / Decryption
				</a>
			  </h4>
					</div>
					<div id="collapseTwo" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="col-xs-12">
								<div class="exhibit">
									<div class="form-group">
										<label for="public">Public Key</label>
										<textarea class="form-control" id="pubkey" name="pubkey" rows="4"></textarea>
									</div>
									<div class="form-group">
										<label for="private">Private Key</label>
										<textarea class="form-control" id="prikey" name="prikey" rows="4"></textarea>
									</div>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="exhibit">
									<div class="form-group">
										<label for="RSAencryptJS">JS Encrypt</label>
										<textarea class="form-control" id="RSAencryptJS" name="RSAencryptJS" rows="1"></textarea>
										<button type="submit" class="btn btn-default" id="JSencryptRSA">JS Encrypt</button>
									</div>
									<div class="form-group">
										<label for="RSAencryptedJS">JS Encrypted</label>
										<textarea class="form-control rdonly" id="RSAencryptedJS" name="RSAencryptedJS" rows="3" readonly></textarea>
										<button type="submit" class="btn btn-default" id="RSA-JStoJS">JS <span class="glyphicon glyphicon-arrow-down"></span>
										</button>
										<button type="submit" class="btn btn-default" id="RSA-JStoPHP">PHP <span class="glyphicon glyphicon-arrow-right"></span>
										</button>
									</div>
									<div class="form-group">
										<label for="RSAdecryptJS">JS Decrypt</label>
										<textarea class="form-control" id="RSAdecryptJS" name="RSAdecryptJS" rows="3"></textarea>
										<button type="submit" class="btn btn-default" id="JSdecryptRSA">JS Decrypt</button>
									</div>
									<div class="form-group">
										<label for="RSAdecryptedJS">JS Decrypted</label>
										<textarea class="form-control rdonly" id="RSAdecryptedJS" name="RSAdecryptedJS" rows="1" readonly></textarea>
									</div>
								</div>
							</div>

							<div class="col-xs-6">
								<div class="exhibit">
									<div class="form-group">
										<label for="RSAencryptPHP">PHP Encrypt</label>
										<textarea class="form-control" id="RSAencryptPHP" name="RSAencryptPHP" rows="1"></textarea>
										<button type="submit" class="btn btn-default" id="PHPencryptRSA">PHP Encrypt</button>
									</div>
									<div class="form-group">
										<label for="RSAencryptedPHP">PHP Encrypted</label>
										<textarea class="form-control rdonly" id="RSAencryptedPHP" name="RSAencryptedPHP" rows="3" readonly></textarea>
										<button type="submit" class="btn btn-default" id="RSA-PHPtoJS"><span class="glyphicon glyphicon-arrow-left"></span> JS</button>
										<button type="submit" class="btn btn-default" id="RSA-PHPtoPHP"><span class="glyphicon glyphicon-arrow-down"></span> PHP</button>
									</div>
									<div class="form-group">
										<label for="RSAdecryptPHP">PHP Decrypt</label>
										<textarea class="form-control" id="RSAdecryptPHP" name="RSAdecryptPHP" rows="3"></textarea>
										<button type="submit" class="btn btn-default" id="PHPdecryptRSA">PHP Decrypt</button>
									</div>
									<div class="form-group">
										<label for="RSAdecryptedPHP">PHP Decrypted</label>
										<textarea class="form-control rdonly" id="RSAdecryptedPHP" name="RSAdecryptedPHP" rows="1" readonly></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
				  Sign / Verify
				</a>
			  </h4>
					</div>
					<div id="collapseThree" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="col-xs-12">
								<div class="exhibit">
									<div class="form-group">
										<label for="pbckey">Public Key</label>
										<textarea class="form-control" id="pbckey" name="pbckey" rows="4"></textarea>
									</div>
									<div class="form-group">
										<label for="pvtkey">Private Key</label>
										<textarea class="form-control" id="pvtkey" name="pvtkey" rows="4"></textarea>
									</div>
								</div>
							</div>

							<div class="col-xs-6">
								<div class="exhibit">
									<div class="form-group">
										<label for="RSAsignJS">JS Sign</label>
										<textarea class="form-control" id="RSAsignJS" name="RSAsignJS" rows="1"></textarea>
										<button type="submit" class="btn btn-default" id="JSsignRSA">JS Sign</button>
									</div>
									<div class="form-group">
										<label for="RSAsignatureJS">JS Generated Signature</label>
										<textarea class="form-control rdonly" id="RSAsignatureJS" name="RSAsignatureJS" rows="3" readonly></textarea>
										<button type="submit" class="btn btn-default" id="RSAs-JStoJS">JS <span class="glyphicon glyphicon-arrow-down"></span>
										</button>
										<button type="submit" class="btn btn-default" id="RSAs-JStoPHP">PHP <span class="glyphicon glyphicon-arrow-right"></span>
										</button>
									</div>
									<div class="form-group">
										<label for="RSAsignedJS">JS Signed</label>
										<textarea class="form-control" id="RSAsignedJS" name="RSAsignedJS" rows="1"></textarea>
									</div>
									<div class="form-group">
										<label for="RSAverifyJS">JS Verify Signature</label>
										<textarea class="form-control" id="RSAverifyJS" name="RSAverifyJS" rows="3"></textarea>
										<button type="submit" class="btn btn-default" id="JSverifyRSA">JS Verify</button>
									</div>
									<div class="alert alert-success" id="RSAvalidateJS">
									</div>
								</div>
							</div>

							<div class="col-xs-6">
								<div class="exhibit">
									<div class="form-group">
										<label for="RSAsignPHP">PHP Sign</label>
										<textarea class="form-control" id="RSAsignPHP" name="RSAsignPHP" rows="1"></textarea>
										<button type="submit" class="btn btn-default" id="PHPsignRSA">PHP Sign</button>
									</div>
									<div class="form-group">
										<label for="RSAsignaturePHP">PHP Generated Signature</label>
										<textarea class="form-control rdonly" id="RSAsignaturePHP" name="RSAsignaturePHP" rows="3" readonly></textarea>
										<button type="submit" class="btn btn-default" id="RSAs-PHPtoJS"><span class="glyphicon glyphicon-arrow-left"></span> JS</button>
										<button type="submit" class="btn btn-default" id="RSAs-PHPtoPHP"><span class="glyphicon glyphicon-arrow-down"></span> PHP</button>
									</div>
									<div class="form-group">
										<label for="RSAsignedPHP">PHP Signed</label>
										<textarea class="form-control" id="RSAsignedPHP" name="RSAsignedPHP" rows="1"></textarea>
									</div>
									<div class="form-group">
										<label for="RSAverifyPHP">PHP Verify Signature</label>
										<textarea class="form-control" id="RSAverifyPHP" name="RSAverifyPHP" rows="3"></textarea>
										<button type="submit" class="btn btn-default" id="PHPverifyRSA">PHP Verify</button>
									</div>
									<div class="alert alert-success" id="RSAvalidatePHP">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
			<a class="freshGenius footPad" href="http://FreshGenius.com" target="blank">Fresh Genius</a>
	</div>

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/rsa.min.js"></script>	
	
<script type="text/javascript">
$(function() {
	$(".change-JS-key-size").each(function(e, t) {
		var a = $(t),
			r = a.attr("data-value");
		a.click(function(e) {
			var t = $("#RSAkeysizeJS");
			t.attr("data-value", r), t.html(r + ' bit <span class="caret"></span>'), e.preventDefault()
		})
	}), $("#JSkeypairRSA").click(function(e) {
		$("#JSloadingRSA").show(function() {
			var e = $("#RSAkeysizeJS").attr("data-value"),
				t = parseInt(e),
				a = forge.pki.rsa.createKeyPairGenerationState(t, 65537),
				r = function() {
					forge.pki.rsa.stepKeyPairGenerationState(a, 1e3) ? ($("#JSpublicRSA").val(forge.pki.publicKeyToPem(a.keys.privateKey)), $("#JSprivateRSA").val(forge.pki.privateKeyToPem(a.keys.privateKey)), $("#JSloadingRSA").hide(), $("#JSkeypairRSA").blur()) : setTimeout(r, 1)
				};
			setTimeout(r, 0)
		}), e.preventDefault()
	}), $(".change-PHP-key-size").each(function(e, t) {
		var a = $(t),
			r = a.attr("data-value");
		a.click(function(e) {
			var t = $("#RSAkeysizePHP");
			t.attr("data-value", r), t.html(r + ' bit <span class="caret"></span>'), e.preventDefault()
		})
	}), $("#PHPkeypairRSA").click(function(e) {
		$("#PHPloadingRSA").show(function() {
			var e = $("#RSAkeysizePHP").attr("data-value"),
				t = parseInt(e);
			$.get("RSA.php?PHPkeypair=" + t, function(e) {
				$("#PHPloadingRSA").hide(), $("#PHPkeypairRSA").blur(), PHPkey = e.split("<<~~##~~>>"), $("#PHPpublicRSA").val(PHPkey[0]), $("#PHPprivateRSA").val(PHPkey[1])
			})
		}), e.preventDefault()
	}), $("#JSkeyuseRSA").click(function(e) {
		$("#JSprivateRSA").change(function() {
			$("#prikey").val($("#JSprivateRSA").val()), $("#pvtkey").val($("#JSprivateRSA").val())
		}).change(), $("#JSpublicRSA").change(function() {
			$("#pubkey").val($("#JSpublicRSA").val()), $("#pbckey").val($("#JSpublicRSA").val())
		}).change(), e.preventDefault(), $("#JSkeyuseRSA").blur()
	}), $("#PHPkeyuseRSA").click(function(e) {
		$("#PHPprivateRSA").change(function() {
			$("#prikey").val($("#PHPprivateRSA").val()), $("#pvtkey").val($("#PHPprivateRSA").val())
		}).change(), $("#PHPpublicRSA").change(function() {
			$("#pubkey").val($("#PHPpublicRSA").val()), $("#pbckey").val($("#PHPpublicRSA").val())
		}).change(), e.preventDefault(), $("#PHPkeyuseRSA").blur()
	}), $("#JSencryptRSA").click(function(e) {
		$("#RSAencryptedJS").val("");
		var t = $("#pubkey").val(),
			a = forge.pki.publicKeyFromPem(t),
			r = $("#RSAencryptJS").val(),
			i = a.encrypt(r),
			S = forge.util.encode64(i);
		$("#RSAencryptedJS").val(S), e.preventDefault(), $("#JSencryptRSA").blur()
	}), $("#JSdecryptRSA").click(function(e) {
		$("#RSAdecryptedJS").val("");
		var t = $("#prikey").val(),
			a = forge.pki.privateKeyFromPem(t),
			r = $("#RSAdecryptJS").val(),
			i = forge.util.decode64(r),
			S = a.decrypt(i);
		$("#RSAdecryptedJS").val(S), e.preventDefault(), $("#JSdecryptRSA").blur()
	}), $("#PHPencryptRSA").click(function(e) {
		var t = $("#pubkey").serialize(),
			a = $("#RSAencryptPHP").serialize();
		$.ajax({
			url: "RSA.php?RSAencryptPHP",
			type: "post",
			data: t + "&" + a,
			success: function(e) {
				$("#RSAencryptedPHP").val(e)
			},
			error: function() {
				$("#RSAencryptedPHP").val("Error")
			}
		}), e.preventDefault(), $("#PHPencryptRSA").blur()
	}), $("#PHPdecryptRSA").click(function(e) {
		var t = $("#prikey").serialize(),
			a = $("#RSAdecryptPHP").serialize();
		$.ajax({
			url: "RSA.php?RSAdecryptPHP",
			type: "post",
			data: t + "&" + a,
			success: function(e) {
				$("#RSAdecryptedPHP").val(e)
			},
			error: function() {
				$("#RSAdecryptedPHP").val("Error")
			}
		}), e.preventDefault(), $("#PHPdecryptRSA").blur()
	}), $("#JSsignRSA").click(function(e) {
		var t = $("#pvtkey").val(),
			a = forge.pki.privateKeyFromPem(t),
			r = $("#RSAsignJS").val(),
			i = forge.md.sha1.create();
		i.update(r, "utf8");
		var S = a.sign(i),
			l = forge.util.encode64(S);
		$("#RSAsignatureJS").val(l), e.preventDefault(), $("#JSsignRSA").blur()
	}), $("#JSverifyRSA").click(function(e) {
		var t = $("#pbckey").val(),
			a = forge.pki.publicKeyFromPem(t),
			r = $("#RSAsignedJS").val(),
			i = forge.md.sha1.create();
		i.update(r, "utf8");
		var S = $("#RSAverifyJS").val(),
			l = forge.util.decode64(S),
			n = a.verify(i.digest().bytes(), l);
		$("#RSAvalidateJS").text(n), e.preventDefault(), $("#JSverifyRSA").blur()
	}), $("#PHPsignRSA").click(function(e) {
		var t = $("#pvtkey").serialize(),
			a = $("#RSAsignPHP").serialize();
		$.ajax({
			url: "RSA.php?RSAsignPHP",
			type: "post",
			data: t + "&" + a,
			success: function(e) {
				$("#RSAsignaturePHP").val(e)
			},
			error: function() {
				$("#RSAsignaturePHP").val("Error")
			}
		}), e.preventDefault(), $("#PHPsignRSA").blur()
	}), $("#PHPverifyRSA").click(function(e) {
		var t = $("#pbckey").serialize(),
			a = $("#RSAsignedPHP").serialize(),
			r = $("#RSAverifyPHP").serialize();
		$.ajax({
			url: "RSA.php?RSAverifyPHP",
			type: "post",
			data: t + "&" + a + "&" + r,
			success: function(e) {
				$("#RSAvalidatePHP").text(e)
			},
			error: function() {
				$("#RSAvalidatePHP").val("Error")
			}
		}), e.preventDefault(), $("#PHPverifyRSA").blur()
	}), $("#RSAs-JStoJS").click(function(e) {
		$("#RSAsignedJS").val($("#RSAsignJS").val()), $("#RSAverifyJS").val($("#RSAsignatureJS").val()), e.preventDefault(), $("#RSAs-JStoJS").blur()
	}), $("#RSAs-JStoPHP").click(function(e) {
		$("#RSAsignedPHP").val($("#RSAsignJS").val()), $("#RSAverifyPHP").val($("#RSAsignatureJS").val()), e.preventDefault(), $("#RSAs-JStoPHP").blur()
	}), $("#RSAs-PHPtoPHP").click(function(e) {
		$("#RSAsignedPHP").val($("#RSAsignPHP").val()), $("#RSAverifyPHP").val($("#RSAsignaturePHP").val()), e.preventDefault(), $("#RSAs-PHPtoPHP").blur()
	}), $("#RSAs-PHPtoJS").click(function(e) {
		$("#RSAsignedJS").val($("#RSAsignPHP").val()), $("#RSAverifyJS").val($("#RSAsignaturePHP").val()), e.preventDefault(), $("#RSAs-PHPtoJS").blur()
	}), $("#RSA-JStoJS").click(function(e) {
		$("#RSAdecryptJS").val($("#RSAencryptedJS").val()), e.preventDefault(), $("#RSA-JStoJS").blur()
	}), $("#RSA-JStoPHP").click(function(e) {
		$("#RSAdecryptPHP").val($("#RSAencryptedJS").val()), e.preventDefault(), $("#RSA-JStoPHP").blur()
	}), $("#RSA-PHPtoPHP").click(function(e) {
		$("#RSAdecryptPHP").val($("#RSAencryptedPHP").val()), e.preventDefault(), $("#RSA-PHPtoPHP").blur()
	}), $("#RSA-PHPtoJS").click(function(e) {
		$("#RSAdecryptJS").val($("#RSAencryptedPHP").val()), e.preventDefault(), $("#RSA-PHPtoJS").blur()
	})
});
</script>	
  </body>
</html>

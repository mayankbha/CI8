<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8" />

  <title>LMSApp - Reset Password</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

</head>

<body>

<div>

	<div style="font-size: 26px;font-weight: 700;letter-spacing: -0.02em;line-height: 32px;color: #41637e;font-family: sans-serif;text-align: center" align="center" id="emb-email-header">
		<strong>LMS App</strong>
	</div>

	<p style="margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;margin-bottom: 25px">Hey <?php echo $user[0]['user_first_name'];?>,</p>

	<p style="margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;margin-bottom: 25px"> Reset your password, and we'll get you on your way. </p>

	<p>To change your LMSApp password, click <a href="<?php echo $reset_link; ?>">here</a> or paste the following link into your browser:</p><a href="<?php echo $reset_link; ?>"><?php echo $reset_link; ?></a>

	<p>Thank you for using LMSApp!<br>The LMSApp Team</p>

</div>

</body>

</html>
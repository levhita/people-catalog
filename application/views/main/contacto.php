<div class="row ">
	<div class="constrictor_contact">
		<h1 class="main-title first" id="contact_form">Queremos conocerte</h1>
		<hr/>
		<div class="intro contact">
			<em>Haz que todos los que están buscando tus servicios</em> te encuentren fácilmente. <em>Ponte en contacto con
			nosotros y juntos encontraremos la mejor manera de lograrlo.</em>
		</div>
	</div>
</div>

<hr/>

<form id="contact_form" name="contact_form" action="contacto#contact_form" method="post">
	<div class="row">
		<div class="constrictor_contact">
			<?php if($success == 'success'): ?>
				<div class="alert alert-success" role="alert">
					<a href="#" class="alert-link"><strong>Gracias por escribirnos</strong>, ya recibimos tu mail. Nos contactaremos contigo tan pronto nos sea posible.</a>
				</div>
			<?php endif; ?>
			<?php if($success == 'warning'): ?>
				<div class="alert alert-warning" role="alert">
					<a href="#" class="alert-link"><strong>Algunos de los campos requeridos están vacios</strong>, favor de completarlos.</a>
				</div>
			<?php endif; ?>
			<?php if($success == 'error'): ?>
				<div class="alert alert-danger" role="alert">
					<a href="#" class="alert-link">Nuestro sistema ha fallado y no pudimos recibir tu mail. <strong>Nos interesa mucho comunicarnos contigo ¿Podrías intentarlo más tarde nuevamente? ¡Muchas gracias!</strong></a>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="row">
		<div class="constrictor_contact">
			<div class="col-md-8">
				<div class="left form-group<?php echo (isset($name_error))?' has-warning':'';?>" id="name_group">
					<label for="name" id="name_group">Nombre: *</label>
					<input type="text" class="simplebox form-control" name="name" id="name"<?php if(isset($name))echo " value=\"".htmlspecialchars($name)."\"";?>>
				</div>
				<div class="left form-group<?php echo (isset($email_error))?" has-warning":'';?>" id="email_group">
					<label for="email">Email: *</label>
					<input type="email" class="simplebox form-control" name="email" id="email"<?php if(isset($email))echo " value=\"".htmlspecialchars($email)."\"";?>>
				</div>
			</div>

			<div class="col-md-4">
				<div class="right form-group" id="company_group" >
					<label for="name">Compañia:</label>
					<input type="text" class="simplebox form-control" name="company" id="company"<?php if(isset($company))echo " value=\"".htmlspecialchars($company)."\"";?>>
				</div>
				<div class="right form-group" id="phone_group">
					<label for="phone">Teléfono:</label>
					<input type="tel" class="simplebox form-control" name="phone" id="phone"<?php if(isset($phone))echo " value=\"".htmlspecialchars($phone)."\"";?>>
				</div>
				<div class="right form-group" id="interest_group">
					<label for="name">Dejar en blanco: </label>
					<input type="text" class="simplebox form-control" name="interest" id="interest">
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="constrictor_contact">
			<div class="form-group<?php echo (isset($message_error))?' has-warning':'';?>" id="message_group">
				<label class="full" for="message">Mensaje: *</label><br/>
				<textarea class="simplebox form-control" type="text" rows="3" name="message" id="message"><?php if(isset($message))echo htmlspecialchars($message);?></textarea>
			</div>
		</div>
		
	</div>
	<div class="row">
		<div class="constrictor_contact">
			<div class="col-md-6"><span class="required-label">* Campos Requeridos</span></div>
			<div class="col-md-6 contact_button"><button type="submit" class="btn btn-primary right">Enviar</button></div>
		</div>
	</div>
</form>

<hr/>
<div class="row row_contact">
	<div class="constrictor_contact">
		<div class="col-md-4 right-contact visible-xs-block visible-sm-block">
			<span class="phone accentuated">cel. <a href="tel:3339498793" class="phone">(33) 3949.8793</a></span><br/>
			<span class="accentuated">e-mail. <a href="mailto:neuronacreativaco@gmail.com" class="email">neuronacreativaco@gmail.com</a></span><br/>
			<em>Enrique Gomez Carrillo #5334, Col. Vallarta Universidad. Zapopan, Jalisco, México.</em>
		</div>
		<hr class="visible-xs-block visible-sm-block"/>
		<div class="col-md-8 left-contact">
			<span class="accentuated"><strong>Un poco más sobre nosotros.</strong></span><br/>
			<em>Te invitamos a que nos conozcas para platicar sobre tu proyecto. Ya sea
			que tengas un presupuesto chico o grande puedes tener la confianza de que</em>
			echaremos a andar la neurona para proponerte lo que te vaya a funcionar,
			<em>sin presiones ni complicaciones.</em><br/>
			<br/>
			<strong>Esperamos conocerte pronto.</strong>
		</div>
		<div class="col-md-4 right-contact hidden-xs hidden-sm">
			<span class="accentuated">cel. <a href="tel:3339498793" class="phone">(33) 3949.8793</a></span><br/>
			<span class="accentuated">e-mail. <a href="mailto:neuronacreativaco@gmail.com" class="email">neuronacreativaco@gmail.com</a></span><br/>
			<em>Enrique Gomez Carrillo #5334, Col. Vallarta Universidad. Zapopan, Jalisco, México.</em>
		</div>
	</div>
</div>
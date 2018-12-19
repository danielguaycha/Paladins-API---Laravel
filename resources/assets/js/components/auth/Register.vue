<template>
	<form>
		<fieldset class="form-group">
			<label for="user">Nombre</label>
			<input v-model="name" type="text" class="form-control" id="name" placeholder="Example input">
		</fieldset>
		<fieldset class="form-group">
			<label for="user">Usuario</label>
			<input v-model="user" type="text" class="form-control" id="user" placeholder="Example input">
		</fieldset>
		<fieldset class="form-group">
			<label for="password">Contraseña</label>
			<input v-model="password" type="password" class="form-control" id="password">
		</fieldset>
		<fieldset class="form-group">
			<label for="confirm_pw">Repite Contraseña</label>
			<input v-model="confirm_pw" type="confirm_pw" class="form-control" id="confirm_pw">
		</fieldset>
		<fieldset>
			<button type="button" class="btn btn-primary">Register</button>
		</fieldset>
		<pre>
		{{ $data }}
		</pre>
	</form>
</template>
<script>
	export default {
		data (){
			return{
				name: '',
				user: '',
				password: '',
				confirm_pw: '',
			}
		}
	}
</script>
<style></style>
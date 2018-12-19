<template>
	<form>
		<fieldset class="form-group">
			<label for="user">Usuario</label>
			<input v-model="user" type="text" class="form-control" id="user" placeholder="Example input">
		</fieldset>
		<fieldset class="form-group">
			<label for="password">Contraseña</label>
			<input v-model="password" type="password" class="form-control" id="password" placeholder="Example input">
		</fieldset>
		<fieldset>
			<button type="button" @click="test" class="btn btn-primary">Login</button>
		</fieldset>
		<pre>
		{{ $data }}
		</pre>
	</form>

</template>
<script>
	export default{
		data(){
			return {
				user: '',
				password: '', 
			}
		},
		methods: {
			test(){
				this.$http.get('/api/test')
				.then(function(response){
					console.log(response);
				})
			}
		}
	}
</script>
<style></style>
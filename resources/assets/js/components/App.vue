<template>
<div>
	<navbar></navbar>
	<div class="jumbotron" style="padding: 20px;">
		<transition name="fade">
			<router-view></router-view>
		</transition>
	</div>
</div>
</template>
<script>
	import Navbar from './partials/Navbar.vue'
	export default{
		components: {
			'navbar': Navbar,
		},
		name: 'app',
		data () {
			return {
			}
		}, 
	}
</script>
<style>
	.jumbotron{
		background-color:#fff;
		border: 1px solid #ccc;
	}
.fade-enter-active, .fade-leave-active {
  transition-property: opacity;
  transition-duration: .05s;
}

.fade-enter-active {
  transition-delay: .05s;
}

.fade-enter, .fade-leave-active {
  opacity: 0
}
</style>
<template>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Paladins</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <router-link to="/champions" class="nav-link">Campeones</router-link>
      </li>
      <li class="nav-item">
        <router-link to="/champions" class="nav-link">Barajas</router-link>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Administrar
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <router-link :to="{ name: 'admin.champion.index'}" class="dropdown-item">Campeones</router-link>
          <router-link :to="{ name: 'admin.item.view'}" class="dropdown-item">Items</router-link>
          <a class="dropdown-item" href="#">Habilidades</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Admin</a>
        </div>
      </li>
      <li class="nav-item">
        <router-link to="/login" class="nav-link">Login</router-link>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Jugador" aria-label="Jugador">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
    </form>
  </div>
</nav>	    
</template>
<script></script>
<style>
	
</style>
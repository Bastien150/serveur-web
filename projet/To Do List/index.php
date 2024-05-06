<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Kanban Board Demo in Vue.js</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'><link rel="stylesheet" href="./style.css">

</head>
<body>
<?php
session_start();
      $_SESSION['file'] = basename(__DIR__);
      include_once('../header.php');
  ?>
<div class="container-fluid">
  <div id="app">
    <nav-header></nav-header>
    <board></board>
  </div>
</div>



<script id="board-template" type="text/template">
  <div class="row board">
    <list v-for="(listItem, index) in lists" :key="index"
            :list_name = 'listItem.name'
            :list_description = 'listItem.description'
            :header_color="listItem.header_color"
            item_text = 'default item'
            :lists = 'lists'
            :list_items.sync = "items">
      </list>
  </div>
</script>

<script id="list-template" type="text/template">
  <div class="col">
    <div class="heading" :class="this.header_color"> 
      <h4 class="text-center">{{ list_description }}</h4>
    </div>
    <div class="cards cards-list" 
            :data-type="this.list_name" 
            v-sortable="this.sortableConfig">
            
      <card-edit v-for="item in filteredListItems"
            class="draggable-card"  
            :item="item" 
            :key="item.id" 
            :data-type="item.list"
            @item-edited="itemEdited"
            @item-cancelled="itemCancelled">
      </card-edit>
      
      <card-new  
            class="fixed-card"
            :item="defaultItem"
            v-show="showNewForm"
            @item-created="itemCreated"
            @item-cancelled="itemCancelled">
      </card-new>
    </div>
  </div>
</script>


<script id="card-new-template" type="text/template">
  <div class="card">
    <div class="card-block">
      <!-- New Item Link Markup Start -->
      <div class="text-center" v-show = "!isFormShowing">   
        <a href="#" @click.prevent = "handleNew">Ajouter</a>
      </div>
      <!-- Item Display Markup End -->
      <!-- Form Markup Start -->
      <div v-show = "isFormShowing" class="form">
        <div class="form-group">
          <textarea rows="3" class="form-control" v-model="form.text"></textarea>
        </div>
        <div class="form-group text-center">
          <button class="btn btn-outline-primary btn-sm" @click.prevent="save">Sauvegarder</button>
          <button class="btn btn-outline-secondary btn-sm" @click.prevent="cancel">Annuler</button>
        </div>
      </div>
      <!-- Form Markup End -->
    </div>
  </div>
</script>

<script id="card-edit-template" type="text/template">
  <div class="card" :id="item.id">
    <div class="card-block">
      <!-- Item Display Markup Start -->
      <div v-show = "!isEditing">   
        {{item.text}}
        <i  class="fa fa-pencil edit-icon" 
            aria-hidden="true"
            @click.prevent = "handleEdit">
        </i>
      </div>
      <!-- Item Display Markup End -->
      <!-- Form Markup Start -->
      <div v-show = "isEditing" class="form">
        <div class="form-group">
          <textarea rows="3" class="form-control" v-model="form.text"></textarea>
        </div>
        <div class="form-group text-center">
          <button class="btn btn-outline-primary btn-sm" @click.prevent="save">Sauvegarder</button>
          <button class="btn btn-outline-secondary btn-sm" @click.prevent="cancel">Annuler</button>
        </div>
      </div>
      <!-- Form Markup End -->
    </div>
  </div>
</script>
<!-- partial -->
  <script src='https://code.jquery.com/jquery-3.0.0.slim.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js'></script>
<script src='https://cdn.jsdelivr.net/sortable/latest/Sortable.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js'></script><script  src="./script.js"></script>

</body>
</html>

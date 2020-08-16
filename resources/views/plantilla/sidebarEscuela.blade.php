<nav class="menu" id="sidebar-wrapper">
  <div class="mb-3">
    <img src="{{ asset('/img/logoColegio.png') }}" class="logo-menu" @click="menu=0">
  </div>
  <div class="list-group">
    <div href="#" class="mb-3 ml-5 border-0">
        <h6>MENU</h6>
    </div>   
    <div>
      <a href="#" class="d-flex list-group-item list-group-item-action border-0 link-menu bg-link">
      <!-- <i class="fa fa-user fa-lg mx-3 my-2"></i> -->
        <i class="bx bx-building bx-sm mx-3"></i> 
          <span class="flex-grow-1">Registro</span>
        <i class="fa fa-chevron-right fa-md mx-1"></i>    
      </a>
      <ul class="ml-3">        
        <li>
          <a href="#" @click="menu=25" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="bx bxs-factory bx-sm mx-3"></i> <span>Alumno</span>
          </a>
        </li>
      </ul>
    </div>   
    <div>
      <a href="#" class="d-flex list-group-item list-group-item-action border-0 link-menu bg-link">
      <!-- <i class="fa fa-user fa-lg mx-3 my-2"></i> -->
        <i class="bx bx-building bx-sm mx-3"></i> 
          <span class="flex-grow-1">Matemáticas</span>
        <i class="fa fa-chevron-right fa-md mx-1"></i>    
      </a>
      <ul class="ml-3">        
        <li>
          <a href="#" @click="menu=20" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="bx bxs-factory bx-sm mx-3"></i> <span>Sumas</span>            
          </a>
        </li>
        <li>
          <a href="#" @click="menu=21" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="bx bxs-factory bx-sm mx-3"></i> <span>Restas</span>
          </a>
        </li>  
        <li>
          <a href="#" @click="menu=22" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="bx bxs-factory bx-sm mx-3"></i> <span>Multiplicaciónes</span>
          </a>
        </li>
        <li>
          <a href="#" @click="menu=23" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="bx bxs-factory bx-sm mx-3"></i> <span>Comparaciones</span>
          </a>
        </li>            
        <li>
          <a href="#" @click="menu=24" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="bx bxs-factory bx-sm mx-3"></i> <span>Series</span>
          </a>
        </li> 
      </ul>       
    </div>
  </div>  
</nav>
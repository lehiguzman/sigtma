<nav class="menu" id="sidebar-wrapper">
  <div class="mb-3">
    <img src="{{ asset('/img/samat.png') }}" class="logo-menu" @click="menu=0">
  </div>
  <div class="list-group">
    <div href="#" class="mb-3 ml-5 border-0">
        <h6>MENU</h6>
    </div> 
    <div class="vertical">
      <a href="#" @click="menu=1" class="list-group-item list-group-item-action border-0 link-menu bg-link">          
          <i class="bx bxs-user-circle bx-sm mx-3"></i>                    
          <span>Usuarios</span>                    
      </a>
    </div>    
    <div>
      <a href="#" class="d-flex list-group-item list-group-item-action border-0 link-menu bg-link">
          <!-- <i class="fa fa-user fa-lg mx-3 my-2"></i> -->
            <i class="bx bx-building bx-sm mx-3"></i> 
              <span class="flex-grow-1">Actividad Ecónomica</span>
            <i class="fa fa-chevron-right fa-md mx-1"></i>    
      </a>
      <ul class="ml-3">        
        <li>
          <a href="#" @click="menu=5" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="bx bxs-factory bx-sm mx-3"></i> <span>Contribuyente</span>            
          </a>
        </li>
         <li>
          <a href="#" @click="menu=8" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="bx bx-calculator bx-sm mx-3"></i> <span>Declaración</span>            
          </a>
        </li>
        <!--<li>
          <a href="#" @click="menu=11" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="bx bxl-paypal bx-sm mx-3"></i> <span>Registrar Pago</span>            
          </a>
        </li>-->
        <li>
          <a href="#" @click="menu=2" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="bx bx-list-plus bx-sm mx-3"></i> <span>Nuevo Código ISAE</span>            
          </a>
        </li>             
      </ul>       
    </div>
    <div>
      <a href="#" class="d-flex list-group-item list-group-item-action border-0 link-menu bg-link">
          <!-- <i class="fa fa-user fa-lg mx-3 my-2"></i> -->
            <i class="bx bx-home-alt bx-sm mx-3"></i> 
              <span class="flex-grow-1">Inmueble</span>
            <i class="fa fa-chevron-right fa-md mx-1"></i>    
      </a>
      <ul>              
        <li>
          <a href="#" @click="menu=6" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="bx bxs-building-house bx-sm mx-3"></i> <span>Contribuyente</span>            
          </a>
        </li>
        <li>
          <a href="#" @click="menu=9" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="bx bx-calculator bx-sm mx-3"></i> <span>Declaracion</span>            
          </a>
        </li>
        <!-- <li>
          <a href="#" @click="menu=12" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="bx bxl-paypal bx-sm mx-3"></i> <span>Registrar Pago</span>            
          </a>
        </li> -->
      </ul>       
    </div>
    <div>
      <a href="#" class="d-flex list-group-item list-group-item-action border-0 link-menu bg-link">          
            <i class="bx bxs-car bx-sm mx-3"></i> 
            <span class="flex-grow-1">Vehiculo</span>
            <i class="fa fa-chevron-right fa-md mx-1"></i>           
      </a>
      <ul>        
        <li>
          <a href="#" @click="menu=7" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="bx bxs-car-garage bx-sm mx-3"></i> <span>Contribuyente</span>            
          </a>
        </li>        
        <li>
          <a href="#" @click="menu=10" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="bx bx-calculator bx-sm mx-3"></i> <span>Declaración</span>            
          </a>
        </li> 
        <li>
          <a href="#" @click="menu=4" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="bx bx-list-plus bx-sm mx-3"></i> <span>Tipo</span>            
          </a>
        </li>
        <!-- <li>
          <a href="#" @click="menu=13" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="bx bxl-paypal bx-sm mx-3"></i> <span>Registrar Pago</span>  
          </a>
        </li> -->
      </ul> 
    </div>    
    <div class="vertical">
      <a href="#" class="d-flex list-group-item list-group-item-action border-0 link-menu bg-link">          
        <i class="bx bx-spreadsheet bx-sm mx-3"></i> 
          <span class="flex-grow-1">Reportes</span>
        <i class="fa fa-chevron-right fa-md mx-1"></i>           
      </a>
      <ul>
        <li>
          <a href="#" @click="menu=17" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="bx bxs-user-detail bx-sm mx-3"></i> <span>Pagos por usuario</span> 
          </a>
        </li>
        <li>
          <a href="#" @click="menu=19" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="bx bxs-user-detail bx-sm mx-3"></i> <span>Trámites</span> 
          </a>
        </li>                          
      </ul>
    </div>  
    
    <!-- <a href="#" class="list-group-item list-group-item-action bg-blue border-0">Events</a>
    <a href="#" class="list-group-item list-group-item-action bg-blue border-0">Profile</a>
    <a href="#" class="list-group-item list-group-item-action bg-blue border-0">Status</a>
    <a href="#" class="list-group-item list-group-item-action bg-blue border-0">close</a> -->
  </div>  
</nav>
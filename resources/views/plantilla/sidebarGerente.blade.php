<div class="menu" id="sidebar-wrapper">
  <div class="mb-5">
    <img src="{{ asset('/img/samat.png') }}" class="logo-menu" >
  </div>
  <div class="list-group">
    <div href="#" class="mb-4 ml-5 border-0">
        <h6>MENU</h6>
    </div> 
    <div>
      <a href="#" @click="menu=1" class="list-group-item list-group-item-action border-0 link-menu">          
          <i class="fa fa-user-circle fa-lg mx-3 vertical"></i>                    
          <span class="vertical">Usuarios</span>                    
      </a>
    </div>    
    <div>
      <a href="#" class="list-group-item list-group-item-action border-0 link-menu">
          <!-- <i class="fa fa-user fa-lg mx-3 my-2"></i> -->
            <i class="fa fa-address-book fa-lg mx-3 vertical"></i> 
              <span class="vertical">Actividad Ecónomica</span>
            <i class="fa fa-chevron-right fa-md mx-1 vertical"></i>    
      </a>
      <ul>
        <li>
          <a href="#" @click="menu=5" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="fa fa-building fa-lg mx-3 vertical"></i> <span class="vertical">Contribuyente</span>            
          </a>
        </li>
         <li>
          <a href="#" @click="menu=8" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="fa fa-building fa-lg mx-3 vertical"></i> <span class="vertical">Declaración</span>            
          </a>
        </li>
        <li>
          <a href="#" @click="menu=11" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="fa fa-building fa-lg mx-3 vertical"></i> <span class="vertical">Registrar Pago</span>            
          </a>
        </li>
        <li>
          <a href="#" @click="menu=2" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="fa fa-building fa-lg mx-3 vertical"></i> <span class="vertical">Nuevo Código ISAE</span>            
          </a>
        </li>       
      </ul>       
    </div>
    <div>
      <a href="#" class="list-group-item list-group-item-action border-0 link-menu">
          <!-- <i class="fa fa-user fa-lg mx-3 my-2"></i> -->
            <i class="fa fa-address-card fa-lg mx-3 vertical"></i> 
              <span class="vertical">Inmueble</span>
            <i class="fa fa-chevron-right fa-md mx-1 vertical"></i>    
      </a>
      <ul>  
        <li>
          <a href="#" @click="menu=3" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="bx bx-home bx-sm mx-3 vertical"></i> <span class="vertical">Tipo</span>            
          </a>
        </li>      
        <li>
          <a href="#" @click="menu=6" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="fa fa-home mx-3 fa-lg vertical"></i> <span class="vertical">Contribuyente</span>            
          </a>
        </li>
        <li>
          <a href="#" @click="menu=9" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="fa fa-home mx-3 fa-lg vertical"></i> <span class="vertical">Declaracion</span>            
          </a>
        </li>
         <li>
          <a href="#" @click="menu=12" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="fa fa-home mx-3 fa-lg vertical"></i> <span class="vertical">Registrar Pago</span>            
          </a>
        </li>             
      </ul>       
    </div>
    <div>
      <a href="#" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="fa fa-paypal fa-lg mx-3 vertical"></i> 
            <span class="vertical">Vehiculo</span>
            <i class="fa fa-chevron-right fa-md mx-1 vertical"></i>           
      </a>
      <ul>
        <li>
          <a href="#" @click="menu=4" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="fa fa-car mx-3 fa-lg vertical"></i> <span class="vertical">Tipo</span>            
          </a>
        </li>
        <li>
          <a href="#" @click="menu=7" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="fa fa-car mx-3 fa-lg vertical"></i> <span class="vertical">Contribuyente</span>            
          </a>
        </li>        
        <li>
          <a href="#" @click="menu=10" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="fa fa-car mx-3 fa-lg vertical"></i> <span class="vertical">Declaración</span>            
          </a>
        </li> 
         <li>
          <a href="#" @click="menu=13" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="fa fa-car mx-3 fa-lg vertical"></i> <span class="vertical">Registrar Pago</span>  
          </a>
        </li>        
      </ul> 
    </div>    
    <div>
      <a href="#" class="list-group-item list-group-item-action border-0 link-menu">          
        <i class="fa fa-paypal fa-lg mx-3 vertical"></i> 
          <span class="vertical">Configuraciones</span>
        <i class="fa fa-chevron-right fa-md mx-1 vertical"></i>           
      </a>
      <ul>
        <li>
          <a href="#" @click="menu=14" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="fa fa-building fa-lg mx-3 vertical"></i> <span class="vertical">Periodo</span> 
          </a>
        </li>
        <li>
          <a href="#" @click="menu=15" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="fa fa-building fa-lg mx-3 vertical"></i> <span class="vertical">Zonas</span> 
          </a>
        </li>
        <li>
          <a href="#" @click="menu=16" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="fa fa-building fa-lg mx-3 vertical"></i> <span class="vertical">Régimen inmuebles</span> 
          </a>
        </li>          
      </ul> 
    </div>
    <div>
      <a href="#" class="list-group-item list-group-item-action border-0 link-menu">          
        <i class="fa fa-paypal fa-lg mx-3 vertical"></i> 
          <span class="vertical">Reportes</span>
        <i class="fa fa-chevron-right fa-md mx-1 vertical"></i>           
      </a>
      <ul>
        <li>
          <a href="#" @click="menu=17" class="list-group-item list-group-item-action border-0 link-menu">          
            <i class="fa fa-building fa-lg mx-3 vertical"></i> <span class="vertical">Pagos por usuario</span> 
          </a>
        </li>                      
      </ul> 
    </div>  
    
    <!-- <a href="#" class="list-group-item list-group-item-action bg-blue border-0">Events</a>
    <a href="#" class="list-group-item list-group-item-action bg-blue border-0">Profile</a>
    <a href="#" class="list-group-item list-group-item-action bg-blue border-0">Status</a>
    <a href="#" class="list-group-item list-group-item-action bg-blue border-0">close</a> -->
  </div>  
</div>
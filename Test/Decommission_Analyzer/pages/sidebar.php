<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./index.php">
          <div class="sidebar-brand-icon">
               <img src="./img/logo3.png" alt="" style="width: auto; height: 70px;">
          </div>
          <!-- <div class="sidebar-brand-text mx-3">Cap360 Decommission Analyzer</div> -->
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     <li class="nav-item <?php if ($_SESSION['currentPage'] == 'dashboard') echo 'active'; ?>">
          <a class="nav-link" href="./index.php">
               <i class="fas fa-fw fa-tachometer-alt"></i>
               <span>Dashboard</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
          Interface
     </div>

     <!-- Not Started Yet -->
     <li class="nav-item <?php if ($_SESSION['currentPage'] == 'portabilityMetrics') echo 'active'; ?>">
          <a class="nav-link" href="./portabilityMetrics.php">
               <i class="fas fa-chart-bar"></i>
               <span>Portability Metrics</span>
          </a>
     </li>
     <li class="nav-item <?php if ($_SESSION['currentPage'] == 'riskAndCriticality') echo 'active'; ?>">
          <a class="nav-link" href="./riskAndCriticality.php">
               <i class="fas fa-chart-line"></i>
               <span>Risk and Criticality</span>
          </a>
     </li>
     <li class="nav-item <?php if ($_SESSION['currentPage'] == 'poaMap') echo 'active'; ?>">
          <a class="nav-link" href="./poaMap.php">
               <i class="fas fa-map-marked-alt"></i>
               <span>POA Map</span>
          </a>
     </li>
     <li class="nav-item <?php if ($_SESSION['currentPage'] == 'applications') echo 'active'; ?>">
          <a class="nav-link" href="./applications.php">
               <i class="fas fa-list-ul"></i>
               <span>Applications</span>
          </a>
     </li>
     <!--
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Job Card</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Demise Pattern</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Decommission Cluster</span>
        </a>
    </li> -->


     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
          Document
     </div>

     <li class="nav-item <?php if ($_SESSION['currentPage'] == 'jobCards') echo 'active'; ?>">
          <a class="nav-link" href="./jobCards.php">
               <i class="fas fa-clipboard"></i>
               <span>Job Cards</span>
          </a>
     </li>

     <li class="nav-item <?php if ($_SESSION['currentPage'] == 'carbonFootPrint') echo 'active'; ?>">
          <a class="nav-link" href="./d20.php">
               <i class="fas fa-hand-holding-usd"></i>
               <span>D20</span>
          </a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

</ul>
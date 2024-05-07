<html>
<head>
  <style>
    body{
        font-family: "Arial", sans-serif;
    }
    @page {
			size: legal landscape;
			margin: 0.5cm;
	} 

    footer {
      position: fixed;
      left: 0px;
      bottom: -30px;
      right: 0px;
      height: 50px; 
    }
    footer .page:after {
      content: counter(page);
    }
    footer table {
      width: 100%;
    }
    footer p {
        font-size: 10px;
        text-align: center;
    }  

		.logo-left img {
			max-height: 90px; 
		}

		.logo-right img {
			max-height: 70px; 
		}

        .my-table table, .my-table th, .my-table td {
            border: thin solid black;
            font-size: 10px; 
		}

        .my-table td {
        height: 20px
        }
 

  </style>
<body>
  <header>  
  <meta charset="utf-8">
  <title>FORMATO LECTURAS ZONA ORDEN PUBLICO {{$workRoute->route}} - {{ $workRoute->cycle_id}} - {{$workRoute->municipality->name}}</title>
  <table width="100%">
      <tr> 
        <td align="center" width="25%">
        <div class="logo-left">
			<!-- <img src="{{ base_path() }}/public/img/logo_sypelc_2.png" alt="Logo izquierdo"> -->
		</div> 
        </td>
        <td align="center">
        <h4 class="text-center">
            <b>SYPELC SAS</b> <br>
            <b>FORMATO LECTURAS ZONA ORDEN PUBLICO</b>
        </h4>
        <h5 style="margin-top: -10px;">RUTA: {{$workRoute->route}} CICLO: {{$workRoute->cycle_id}} MUNICIPIO: {{$workRoute->municipality->name}}</h5>
        </td>
        <td align="center" width="25%">
        <div class="logo-right">
			<!-- <img src="{{ base_path() }}/public/img/logo_emsa.png" alt="Logo derecho"> -->
		</div>
        </td>
      </tr>
    </table>
  </header>
  <footer>
    <table>
      <tr> 
        <td>
          <p class="page">
            Página
          </p>
        </td>
      </tr>
    </table>
  </footer>
  <div id="content" style="margin-left: 15px; margin-right: 15px;" >

  <table class="my-table" style="width:100%">
  <thead>
    <tr align="center">
      <th width="3%">ID</th>
      <th>CUENTA</th>
      <th>RUTA</th>
      <th  width="20%">CLIENTE</th>
      <th  width="30%">DIRECCION</th>
      <th  width="3%">DIG</th>
      <th>MED</th>
      <th>SERIE</th>
      <th>T.E</th>
      <th width="4%">LECT</th>
      <th  width="3%">ANOM</th>
      <th  width="17%">OBSERVACION</th>
    </tr>
  </thead>
  <tbody>
  @foreach  ($workRoute->pendingReadings as $cliente)
    <tr align="center">
      <td>{{$loop->iteration}}</td>
      <td>{{$cliente->cuenta}}</td> 
      <td>{{$cliente->ruta_completa}}</td> 
      <td>{{$cliente->nombre}}</td> 
      <td>{{$cliente->direccion}}</td> 
      <td>{{$cliente->digitos}}</td> 
      <td>{{$cliente->medidor}}</td> 
      <td>{{$cliente->serie}}</td> 
      <td>{{$cliente->tipo_energia}}</td> 
      <td></td> 
      <td></td> 
      <td></td>  
    </tr> 
    @endforeach
  </tbody>
</table>
   
  </div>
</body>
</html>
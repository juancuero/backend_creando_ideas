<!DOCTYPE html>
<html>
    <head>
        <title>COMPROBANTES {{$workRoute->route}}-{{$workRoute->cycle_id}}-{{$workRoute->municipality->name}}</title>
        <style>
            body {
                font-family: "Arial", sans-serif;
                margin: 0mm;
            }
            @page {
                size: legal; /* Tamaño de página en mm (216x333mm es el tamaño de oficio) */
                margin: 0cm;
            }

            .cell {
                width: 7.04cm;
                height: 4.3cm;
                border: 0.5px solid black;
                margin: 0px;
            }
            .logo-left img {
                max-height: 40px;
            }
            .header_encabezado {
                font-size: 10px;
            }
            .info_cliente {
                font-size: 8px;
            }
        </style>
    </head>
    <body>
        @php
            use Illuminate\Support\Str;
        @endphp
        @php($total = $workRoute->pendingReadings->count())
        @php($pages = round_up($total / 24))
        @for ($i = 1; $i <= $pages; $i++)
        <table>
            @for ($j = 1; $j <= 8; $j++)
              <tr>
                @for ($k = 1; $k <= 3; $k++)
                
                    @if($j == 1 && $k == 1)
                      @php ($num = $i) 
                    @else
                      @php ($num = $num + $pages) 
                    @endif

                  <td class="cell">
                    
                  @php ($cliente = $workRoute->pendingReadings->get($num - 1)) 
                      @if($cliente)
                      <table width="100%" style="margin: 0px;">
                          <tr>
                              <td style="text-align: center;">
                                  <div class="logo-left">
                                      <!-- <img src="{{ base_path() }}/public/img/logo_emsa_2.png" alt="Logo izquierdo" /> -->
                                  </div>
                              </td>
                              <td style="text-align: center;">
                                  <div class="header_encabezado">
                                      <p style="line-height: 0px;">SYPELC SAS</p>
                                      <p style="line-height: 0px;">Nit: 800.024.524-3</p>
                                      <p style="line-height: 0px;">COMPROBANTE DE LECTURA</p>
                                      <p style="line-height: 0px; font-size: 8px;">
                                          {{$num}}
                                      </p>
                                  </div>
                              </td>
                              <td style="text-align: center;">
                                  <div class="logo-left">
                                      <!-- <img src="{{ base_path() }}/public/img/logo_sypelc_1.png" alt="Logo izquierdo" /> -->
                                  </div>
                              </td>
                          </tr>
                      </table>
                        <div style="margin-top: 0px; margin-bottom: 0px; margin-right: 3px; margin-left: 3px;" class="info_cliente">
                            <p style="line-height: 3px;">Suscriptor: <span style="margin-left: 6px;">{{ Str::limit($cliente->nombre,40)}}</span></p>
                            <p style="line-height: 3px;">Dirección: <span style="margin-left: 8px;">{{Str::limit($cliente->direccion,40)}}</span></p>
                            <p style="line-height: 4px;">Medidor: <span style="margin-left: 12px;">{{$cliente->medidor}}-{{$cliente->serie}}</span> <span style="margin-left: 26px;">Cuenta:</span> <span style="margin-left: 6px;">{{$cliente->cuenta}}</span></p>
                            <p style="line-height: 4px;">Lectura: <span style="margin-left: 12px;">_______</span> <span style="margin-left: 18px;">Obser:</span> <span style="margin-left: 6px;">______________________</span></p>
                            <p style="line-height: 4px;">C. Lector: <span style="margin-left: 6px;">_______</span> <span style="margin-left: 22px;">Ruta:</span> <span style="margin-left: 6px;">{{$cliente->ruta_completa}}</span></p>
                            <p>Estimado usuario el día de hoy ____/____/____ visitamos su residencia, si su contador no fue leido comuníquese al Tel 6086724308 o al numero de whatsApp 3235741766.</p>
                        </div> 
                        @else
                         
                    @endif 
                  </td>
                @endfor
              </tr>  
            @endfor
        </table> 
      @endfor
    </body>
</html>

<?php 
@session_start();
require_once("verificar.php");
require_once("../conexao.php");

//verificar se ele tem a permissão de estar nessa página
if(@$home == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}

$data_hoje = date('Y-m-d');
$data_ontem = date('Y-m-d', strtotime("-1 days",strtotime($data_hoje)));

$mes_atual = Date('m');
$ano_atual = Date('Y');
$data_inicio_mes = $ano_atual."-".$mes_atual."-01";

if($mes_atual == '4' || $mes_atual == '6' || $mes_atual == '9' || $mes_atual == '11'){
    $dia_final_mes = '30';
}else if($mes_atual == '2'){
    $dia_final_mes = '28';
}else{
    $dia_final_mes = '31';
}

$data_final_mes = $ano_atual."-".$mes_atual."-".$dia_final_mes;

$query = $pdo->query("SELECT * FROM veiculos ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_veiculos = @count($res);

//totalizando ordem de serviços
$query = $pdo->query("SELECT * FROM ordem_servico where data = curDate() ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_ordem_servico_hoje = @count($res);

$query = $pdo->query("SELECT * FROM ordem_servico where data = curDate() and status = 'Concluído'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_ordem_servico_concluido_hoje = @count($res);

if($total_ordem_servico_concluido_hoje > 0 and $total_ordem_servico_hoje > 0){
    $porcentagemOS = ($total_ordem_servico_concluido_hoje / $total_ordem_servico_hoje) * 100;
}else{
    $porcentagemOS = 0;
}

//dados para o gráfico
$dados_meses_despesas =  '';
$dados_meses_servicos =  '';
$dados_meses_vendas =  '';
        //ALIMENTAR DADOS PARA O GRÁFICO
        for($i=1; $i <= 12; $i++){

            if($i < 10){
                $mes_atual = '0'.$i;
            }else{
                $mes_atual = $i;
            }
        }
        if($mes_atual == '4' || $mes_atual == '6' || $mes_atual == '9' || $mes_atual == '11'){
            $dia_final_mes = '30';
        }else if($mes_atual == '2'){
            $dia_final_mes = '28';
        }else{
            $dia_final_mes = '31';
        }

        $data_mes_inicio_grafico = $ano_atual."-".$mes_atual."-01";
        $data_mes_final_grafico = $ano_atual."-".$mes_atual."-".$dia_final_mes;

 ?>

    <input type="hidden" id="dados_grafico_servico">
<div class="main-page">

    <div class="col_3">

        <a href="index.php?pag=veiculos">
        <div class="col-md-3 widget widget1">
            <div class="r3_counter_box">
                <i class="pull-left fa fa-users icon-rounded"></i>
                <div class="stats">
                        <h5><strong><big><big><?php echo $total_veiculos ?></big></big></strong></h5>

                    </div>
                    <hr style="margin-top:10px">
                    <div align="center"><span>Total de Veiculos</span></div>
            </div>
        </div>
        </a>

        <div class="clearfix"> </div>
    </div>

    <div class="row" style="margin-top: 20px">

        <div class="col-md-4 stat stat2">

            <div class="content-top-1">
                <div class="col-md-7 top-content">
                    <h5>OS Dia</h5>
                    <label><?php echo $total_ordem_servico_hoje  ?>+</label>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>

    </div>

        <div class="row-one widgettable">

        <div class="clearfix"> </div>
    </div>
    
    <!-- for amcharts js -->
    <script src="js/amcharts.js"></script>
    <script src="js/serial.js"></script>
    <script src="js/export.min.js"></script>
    <link rel="stylesheet" href="css/export.css" type="text/css" media="all" />
    <script src="js/light.js"></script>
    <!-- for amcharts js -->

    <script  src="js/index1.js"></script>
    
</div>
<div class="clearfix"> </div>
</div>
<div class="clearfix"> </div>

</div>

</div>

<!-- for index page weekly sales java script -->
    <script src="js/SimpleChart.js"></script>
    <script>
        $('#dados_grafico_despesa').val('<?=$dados_meses_despesas?>'); 
        var dados = $('#dados_grafico_despesa').val();
        saldo_mes = dados.split('-'); 

         $('#dados_grafico_venda').val('<?=$dados_meses_vendas?>'); 
        var dados_venda = $('#dados_grafico_venda').val();
        saldo_mes_venda = dados_venda.split('-'); 


         $('#dados_grafico_servico').val('<?=$dados_meses_servicos?>'); 
        var dados_servico = $('#dados_grafico_servico').val();
        saldo_mes_servico = dados_servico.split('-'); 

        var graphdata1 = {
            linecolor: "#e32424",
            title: "Despesas",
            values: [
            { X: "Janeiro", Y: parseFloat(saldo_mes[0]) },
            { X: "Fevereiro", Y: parseFloat(saldo_mes[1]) },
            { X: "Março", Y: parseFloat(saldo_mes[2]) },
            { X: "Abril", Y: parseFloat(saldo_mes[3]) },
            { X: "Maio", Y: parseFloat(saldo_mes[4]) },
            { X: "Junho", Y: parseFloat(saldo_mes[5]) },
            { X: "Julho", Y: parseFloat(saldo_mes[6]) },
            { X: "Agosto", Y: parseFloat(saldo_mes[7]) },
            { X: "Setembro", Y: parseFloat(saldo_mes[8]) },
            { X: "Outubro", Y: parseFloat(saldo_mes[9]) },
            { X: "Novembro", Y: parseFloat(saldo_mes[10]) },
            { X: "Dezembro", Y: parseFloat(saldo_mes[11]) },
            
            ]
        };

        var graphdata2 = {
            linecolor: "#109447",
            title: "Vendas",
            values: [
            { X: "Janeiro", Y: parseFloat(saldo_mes_venda[0]) },
            { X: "Fevereiro", Y: parseFloat(saldo_mes_venda[1]) },
            { X: "Março", Y: parseFloat(saldo_mes_venda[2]) },
            { X: "Abril", Y: parseFloat(saldo_mes_venda[3]) },
            { X: "Maio", Y: parseFloat(saldo_mes_venda[4]) },
            { X: "Junho", Y: parseFloat(saldo_mes_venda[5]) },
            { X: "Julho", Y: parseFloat(saldo_mes_venda[6]) },
            { X: "Agosto", Y: parseFloat(saldo_mes_venda[7]) },
            { X: "Setembro", Y: parseFloat(saldo_mes_venda[8]) },
            { X: "Outubro", Y: parseFloat(saldo_mes_venda[9]) },
            { X: "Novembro", Y: parseFloat(saldo_mes_venda[10]) },
            { X: "Dezembro", Y: parseFloat(saldo_mes_venda[11]) },
            
            ]
        };

          var graphdata3 = {
            linecolor: "#0e248a",
            title: "Serviços",
            values: [
            { X: "Janeiro", Y: parseFloat(saldo_mes_servico[0]) },
            { X: "Fevereiro", Y: parseFloat(saldo_mes_servico[1]) },
            { X: "Março", Y: parseFloat(saldo_mes_servico[2]) },
            { X: "Abril", Y: parseFloat(saldo_mes_servico[3]) },
            { X: "Maio", Y: parseFloat(saldo_mes_servico[4]) },
            { X: "Junho", Y: parseFloat(saldo_mes_servico[5]) },
            { X: "Julho", Y: parseFloat(saldo_mes_servico[6]) },
            { X: "Agosto", Y: parseFloat(saldo_mes_servico[7]) },
            { X: "Setembro", Y: parseFloat(saldo_mes_servico[8]) },
            { X: "Outubro", Y: parseFloat(saldo_mes_servico[9]) },
            { X: "Novembro", Y: parseFloat(saldo_mes_servico[10]) },
            { X: "Dezembro", Y: parseFloat(saldo_mes_servico[11]) },
            
            ]
        };
              
        $(function () {          
                      
            $("#Linegraph").SimpleChart({
                ChartType: "Line",
                toolwidth: "50",
                toolheight: "25",
                axiscolor: "#E6E6E6",
                textcolor: "#6E6E6E",
                showlegends: true,
                data: [graphdata3, graphdata2, graphdata1],
                legendsize: "30",
                legendposition: 'bottom',
                xaxislabel: 'Meses',
                title: '',
                yaxislabel: 'Totais R$',

            });
           
        });

    </script>
    <!-- //for index page weekly sales java script -->
    
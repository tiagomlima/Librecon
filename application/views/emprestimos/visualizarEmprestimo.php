<?php 

/*  ___________________________________________________________
   |                                                           |    
   |   Autores: André Luis - email: andre.pedroso34@gmail.com  |
   |            Tiago Lima - email: tiago.m.lima@outlook.com   |
   |___________________________________________________________| 
*/

?>
<div class="row-fluid" style="margin-top: 0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-tags"></i>
                </span>
                <?php 
                	if($result->status == 'Emprestado'){
                		echo '<h5>Comprovante de Empréstimo</h5>';
                	}
					if($result->status == 'Devolvido'){
                		echo '<h5>Comprovante de Devolução</h5>';
                	}
                
                ?>
                
                <div class="buttons">
                    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'eEmprestimo')){
                        echo '<a title="Icon Title" class="btn btn-mini btn-info" href="'.base_url().'index.php/emprestimos/editar/'.$result->idEmprestimos.'"><i class="icon-pencil icon-white"></i> Editar</a>'; 
                    } ?>
                    
                    <a id="imprimir" title="Imprimir" class="btn btn-mini btn-inverse" href=""><i class="icon-print icon-white"></i> Imprimir</a>
                </div>
            </div>
            <div class="widget-content" id="printOs">
                <div class="invoice-content">
                    <div class="invoice-head">
                        <table class="table">
                            <tbody>

                                <?php if($emitente == null) {?>
                                            
                                <tr>
                                    <td colspan="3" class="alert">Você precisa configurar os dados do emitente. >>><a href="<?php echo base_url(); ?>index.php/librecon/emitente">Configurar</a><<<</td>
                                </tr>
                                <?php } else {?>

                                <tr>
                                    <td style="width: 25%"><img src=" <?php echo $emitente[0]->url_logo; ?> "></td>
                                    <td> <span style="font-size: 20px; "> <?php echo $emitente[0]->nome; ?></span> </br><span><?php echo $emitente[0]->cnpj; ?> </br> <?php echo $emitente[0]->rua.', nº:'.$emitente[0]->numero.', '.$emitente[0]->bairro.' - '.$emitente[0]->cidade.' - '.$emitente[0]->uf; ?> </span> </br> <span> Site: <?php echo $emitente[0]->site.' - Fone: '.$emitente[0]->telefone; ?></span></td>
                                    <td style="width: 18%; text-align: center">#Empréstimo: <span ><?php echo $result->idEmprestimos?></span></br> </br> <span>Emissão: <?php echo date('d/m/Y');?></span></td>
                                </tr>

                                <?php } ?>
                            </tbody>
                        </table>
   
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="width: 50%; padding-left: 0">
                                        <ul>
                                            <li>
                                                <span><h5>Leitor</h5>
                                                <span><?php echo $result->nome?></span><br/>
                                                <span><?php echo 'R.A '. $result->matricula?></span><br/>
                                                <span><?php echo $curso->nomeCurso?></span><br/>
                                                <span><?php echo $result->rua?>, <?php echo $result->numero?>, <?php echo $result->bairro?></span><br/>
                                                <span><?php echo $result->cidade?> - <?php echo $result->estado?></span>
                                            </li>
                                        </ul>
                                    </td>
                                    <td style="width: 50%; padding-left: 0">
                                        <ul>
                                            <li>
                                                <span><h5>Usuário</h5></span>
                                                <span><?php echo $usuario->nome?></span> <br/>
                                                <span>Telefone: <?php echo $usuario->telefone?></span><br/>
                                                <span>Email: <?php echo $usuario->email?></span>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table> 
      
                    </div>

                    <div style="margin-top: 0; padding-top: 0; margin-bottom: 0; padding-bottom: 0">
					<?php 
						$dataEmprestimo = date(('d/m/Y'),strtotime($result->dataEmprestimo));
						$dataVencimento = date(('d/m/Y'),strtotime($result->dataVencimento));
						$dataAtual = date(('d/m/Y'),strtotime(date('d/m/Y')));
										
					?>
					<b style="float: left">Data do empréstimo: <?php echo $dataEmprestimo ?> </b>
                    <b style="float: right">Data de vencimento: <?php echo $dataVencimento ?> </b>
                    <br>
                    <br>
                        <?php if($acervos != null){?>
              
                        <table class="table table-bordered table-condensed" id="tblAcervos">
                                    <thead>
                                        <tr>
                                            <th style="font-size: 15px">Tombo</th>
                                            <th style="font-size: 15px">Item</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        foreach ($acervos as $a) {
                                            
                                            echo '<tr>';
                                            echo '<td>'.$a->tombo.'</td>';
                                            echo '<td>'.$a->titulo.'</td>';                                                                                       
                                            echo '</tr>';
                                        }?>
                                         <tr>
                                            <td colspan="2" style="text-align: right"><strong>Quantidade total:</strong></td>
                                            <td><strong><?php echo $result->qtde_item ?></strong></td>
                                        </tr>
                                        <?php 
                                        	if($dataAtual > $dataVencimento){
                                        		echo '<tr>';
													echo '<td colspan="2" style="text-align: right"><strong>Multa:</strong></td>';
													echo '<td><strong>R$ '.$grupos->multa.'</strong></td>';
                                        	}
                                        
                                        ?>
                                    </tbody>
                                </table>
                               <?php } ?>                                     
                        <hr />                                       
                    </div>
            		
					<?php 
						if($result->status == 'Emprestado'){
							echo '<b style="float: left">Status: '.$result->status.' </b>';
							echo '<b style="float: right">Assinatura: ________________________________ </b>';
						}
						
						if($result->status == 'Devolvido'){
							echo '<b style="float: left">Status: '.$result->status.' </b><br><br>';
							echo '<b style="float: left">Data da Devolução: '.date('d/m/Y').' </b>';
							echo '<b style="float: right">Assinatura: ________________________________ </b>';
						}
						
						if($result->status == 'Renovado'){
							echo '<b style="float: left">Status: '.$result->status.' </b><br><br>';
							echo '<b style="float: left">Data da Renovação: '.date('d/m/Y').' </b>';
							echo '<b style="float: right">Assinatura: ________________________________ </b>';
						}
					
					?>
                    
              
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#imprimir").click(function(){         
            PrintElem('#printOs');
        })
        function PrintElem(elem)
        {
            Popup($(elem).html());
        }
        function Popup(data)
        {
            var mywindow = window.open('', 'mydiv', 'height=600,width=800');
            mywindow.document.open();
            mywindow.document.onreadystatechange=function(){
             if(this.readyState==='complete'){
              this.onreadystatechange=function(){};
              mywindow.focus();
              mywindow.print();
              mywindow.close();
             }
            }
            mywindow.document.write('<html><head><title>Map Os</title>');
            mywindow.document.write("<link rel='stylesheet' href='<?php echo base_url();?>assets/css/bootstrap.min.css' />");
            mywindow.document.write("<link rel='stylesheet' href='<?php echo base_url();?>assets/css/bootstrap-responsive.min.css' />");
            mywindow.document.write("<link rel='stylesheet' href='<?php echo base_url();?>assets/css/matrix-style.css' />");
            mywindow.document.write("<link rel='stylesheet' href='<?php echo base_url();?>assets/css/matrix-media.css' />");
            mywindow.document.write("</head><body >");
            mywindow.document.write(data);          
            mywindow.document.write("</body></html>");
            mywindow.document.close(); // necessary for IE >= 10
            return true;
        }
    });
</script>
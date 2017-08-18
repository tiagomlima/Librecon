<?php 
if(empty($tombo)){
	echo '<b>Nenhum acervo selecionado</b>';
}else{

?>
<style>
	#etiqueta{		
		width: 63.4mm;
		height: 25.4mm;
		text-align: center;
		border: 1px solid;
		border-radius: 5px;
	}
	
	#etiqueta b {
		margin: 0;
	}
</style>

<?php 
$i = 0;
$colunas = 3;
$resto = $colunas-(count($tombo)%$colunas);
?>
<span class="span12"><a id="imprimir" title="Imprimir" class="btn btn-mini btn-inverse" href=""><i class="icon-print icon-white"></i> Imprimir</a></span>
<div id="print">
<table>
	<tbody>
		<tr>
			<?php foreach($tombo as $t): ?>
				<?php if(! ($i%$colunas)) echo '<tr></tr>'?>
				
				
				<?php 
				
					$this->db->where('tombo',$t);
					$exemplar = $this->db->get('exemplares')->row();
				
					$this->db->where('idAcervos',$exemplar->acervos_id);
					$acervo = $this->db->get('acervos')->row();	
																		
				?>
				<td>
					<div id="etiqueta">
					<b><?php echo $acervo->classificacao; ?></b><br/>
					<?php 
						//primeiro, pegar a primeira letra do sobrenome
						
						$this->db->where('idAutor',$acervo->autor_id);
						$autor = $this->db->get('autor')->row();
						
						$nome_autor = $autor->autor;
						$palavras = explode(" ", $nome_autor);
						$ultimo_nome = $palavras[count($palavras) - 1];
						
						$letra_sobrenome = substr($ultimo_nome,0,1);
						
						//pegar o numero do sobrenome
						$numero_sobrenome = $autor->numero;
						
						//pegar a primeira letra do nome do livro
						
						$titulo_livro = $acervo->titulo;
						$p = explode(" ", $titulo_livro);
						$primeira_palavra = $p[0];
						
						$letra_titulo = substr($primeira_palavra,0,1);
						$primeira_letra = strtolower($letra_titulo);
						
					?>
					<b><?php echo $letra_sobrenome . $numero_sobrenome . $primeira_letra; ?></b><br/>
					<b><?php echo $acervo->edicao; ?>.ed.</b><br/>
					<b>ex.<?php echo '$x + 1'; ?></b><br/>
					<b><?php echo $t; ?></b>
				</div>
				</td>			
				<?php $i++; ?>
			<?php endforeach; ?>
			
			
		</tr>
	</tbody>
</table>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#imprimir").click(function(){         
            PrintElem('#print');
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
            mywindow.document.write('<html><head>');
            mywindow.document.write("<link rel='stylesheet' href='<?php echo base_url();?>assets/css/bootstrap.min.css' />");
            mywindow.document.write("<link rel='stylesheet' href='<?php echo base_url();?>assets/css/bootstrap-responsive.min.css' />");
            mywindow.document.write("<link rel='stylesheet' href='<?php echo base_url();?>assets/css/matrix-style.css' />");
            mywindow.document.write("<link rel='stylesheet' href='<?php echo base_url();?>assets/css/matrix-media.css' />");
            mywindow.document.write("<style>");
            mywindow.document.write('#etiqueta{width: 63.4mm;height: 25.4mm;text-align: center;border: 1px solid; border-radius: 5px;}');
            mywindow.document.write('#etiqueta b {margin: 0;}');
            mywindow.document.write('</style>');
            mywindow.document.write("</head><body >");
            mywindow.document.write('<br/>');
            mywindow.document.write(data);          
            mywindow.document.write("</body></html>");
            mywindow.document.close(); // necessary for IE >= 10
            return true;
        }
    });
</script>


<style>
	#etiqueta{		
		width: 63.4mm;
		height: 25.4mm;
		text-align: center;
		border: 1px solid;
		border-radius: 5px;
	}
	
	#etiqueta b {
		margin: 0;
	}
</style>


<?php 
 /*foreach($tombos as $t){
				$this->db->where('tombo',$t);
				$exemplar = $this->db->get('exemplares')->row();
				
				$this->db->where('idAcervos',$exemplar->acervos_id);
				$acervo = $this->db->get('acervos')->row();	
				
				
		   } */}?>
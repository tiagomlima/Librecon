<div class="accordion" id="collapse-group">
    <div class="accordion-group widget-box">
        <div class="accordion-heading">
            <div class="widget-title">
                <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse">
                    <span class="icon"><i class="icon-list"></i></span><h5>Dados do Acervo</h5>
                </a>
            </div>
        </div>
        <div class="collapse in accordion-body">
            <div class="widget-content">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="text-align: right; width: 30%"><strong>Titulo</strong></td>
                            <td><?php echo $result->titulo ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Tombo</strong></td>
                            <td><?php echo $result->tombo ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Quantidade</strong></td>
                            <td> <?php echo $result->quantidade; ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Idioma</strong></td>
                            <td><?php echo $result->idioma; ?></td>
                        </tr>
                        
                  
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


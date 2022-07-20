<?php

$cons_empresa = mysqli_query($conn,"SELECT * FROM dados_empresa WHERE id_empresa='1361'");
if(mysqli_num_rows($cons_empresa) > 0){
while ($resp_empresa = mysqli_fetch_assoc($cons_empresa)) {

$texto_rodape = $resp_empresa['texto_rodape'];
$texto_topo = $resp_empresa['texto_topo'];
$cor_sistema = $resp_empresa['cor_sistema'];
}}
?>
<footer class="page-footer" role="contentinfo" style="background-color:<?php echo $cor_sistema?>; color:#FFF;">
                        <div class="d-flex align-items-center flex-1">
                            <span class="hidden-md-down fw-700"><?php echo $texto_rodape?></span>
                        </div>
                        
                    </footer>
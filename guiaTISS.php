<?php
session_start();
require_once("config/connectMedic.php");
if(isset($_POST['nomeDoPaciente2'], $_POST['nomeConvenio2'], $_POST['imgConvenio'], $_POST['exames']) &&
!empty($_POST['nomeDoPaciente2']) && !empty($_POST['nomeConvenio2']) && !empty($_POST['imgConvenio']) && !empty($_POST['exames'])  ) {

	setlocale(LC_ALL, "pt_BR.utf-8", "pt_BR", "portuguese");
  $nome = strtoupper($_POST['nomeDoPaciente2']);
	$convenio = $_POST['nomeConvenio2'];
	$img = $_POST['imgConvenio'];
	$img = "imgMedic/".$img;
	$exames = $_POST['exames'];
	$arrayExames = explode("\n", $exames);
	$nomeClinica2 = justTheName($_POST['nomeClinica2']);
  $codigoConvenio2 = $_POST['codigoConvenio2'];
  $nome_medico = strtoupper($_SESSION['primeiro_nome']." ".$_SESSION['ultimo_nome']);
  $crm = $_SESSION['crm'];
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html 

xmlns="http://www.w3.org/1999/xhtml"><head><title>Guias SP/SADT</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script language="javascript" type="text/javascript" src="js/jquery-1.11.3.min.js"></script>


<style type="text/css" media="print">

@media print { 
  @page{
      size: A4 landscape; 
      margin-left:0.0cm;
      margin-right:0.0cm;
	  margin-top:0.0cm;
	  margin-bottom:0.0cm;
  }
}

/*body {

	MARGIN: 0px

}*/

#Tb_Geral {

	BORDER-RIGHT: #000000 1pt solid; PADDING-RIGHT: 3px; BORDER-TOP: #000000 1pt solid; PADDING-LEFT: 3px; PADDING-BOTTOM: 3px; BORDER-LEFT: #000000 1pt solid; PADDING-TOP: 3px; BORDER-BOTTOM: #000000 1pt solid;

	

}

.Titulo {

	FONT-WEIGHT: bold; FONT-SIZE: 8pt; COLOR: #000000; FONT-FAMILY: Arial; TEXT-ALIGN: center

}

.BordaBaseDir {

	BORDER-RIGHT: #000000 1px solid; BORDER-BOTTOM: #000000 1px solid

}

.BordaTopo {

	BORDER-TOP: #000000 1px solid

}

.BordaBase {

	BORDER-BOTTOM: #000000 1px solid

}

.BordaDir {

	

}

.BordaEsqBase {

	BORDER-LEFT: #000000 1px solid; BORDER-BOTTOM: #000000 1px solid

}

.BordaDir {

	BORDER-RIGHT: #000000 1px solid

}

.BordaEsq {

	BORDER-LEFT: #000000 1px solid

}

.Borda4 {

	BORDER-RIGHT: #000000 1px solid; BORDER-TOP: #000000 1px solid; BORDER-LEFT: #000000 1px solid; BORDER-BOTTOM: #000000 1px solid

}

.FundoE9E9E9 {

	BACKGROUND-COLOR: #cecece

}

.Arial6Topo {

	FONT-SIZE: 6pt; VERTICAL-ALIGN: top; COLOR: #000000; TEXT-INDENT: 1px; FONT-FAMILY: Arial, Helvetica, sans-serif

}

.Arial_12_N {

	FONT-WEIGHT: normal; FONT-SIZE: 9px; COLOR: #000000; FONT-FAMILY: Arial, Helvetica, sans-serif

}

.Numero {

	FONT-SIZE: 14px; COLOR: #000000; FONT-FAMILY: Arial, Helvetica, sans-serif

}

.NumeroANS {

	FONT-WEIGHT: bold; FONT-SIZE: 12px; COLOR: #000000; FONT-FAMILY: Arial, Helvetica, sans-serif

}

.Arial_12 {

	FONT-WEIGHT: normal; FONT-SIZE: 9px; COLOR: #000000; FONT-FAMILY: Arial, Helvetica, sans-serif

}

.Arial6Topo_Meio {

	FONT-SIZE: 8px; VERTICAL-ALIGN: middle; COLOR: #000000; TEXT-INDENT: 2px; FONT-FAMILY: Arial, Helvetica, sans-serif

}

.Arial4 {

	FONT-SIZE: 4pt; COLOR: #000000; FONT-FAMILY: Arial

}

.Arial6Normal {

	FONT-SIZE: 6pt; COLOR: #000000; TEXT-INDENT: 1px; FONT-FAMILY: Arial, Helvetica, sans-serif

}

.Arial6MeioNegrito {

	FONT-WEIGHT: bold; FONT-SIZE: 6pt; COLOR: #000000; TEXT-INDENT: 1px; FONT-FAMILY: Arial, Helvetica, sans-serif

}

.Titulo2 {

	FONT-WEIGHT: bold; FONT-SIZE: 8pt; COLOR: #000000; FONT-FAMILY: Arial; TEXT-ALIGN: center

}

.999999 {

	BACKGROUND-COLOR: #e9e9e9

}

.style3 {

	FONT-SIZE: 6pt

}

.style6 {

	FONT-SIZE: 7px

}

.style7 {

	FONT-SIZE: 5pt

}

.style8 {

	font-size: 8pt;
}

.style10 {

	font-size: 10pt;
}

</style>



<META content="MSHTML 6.00.2900.2722" name=GENERATOR></head>

<BODY>

<table width="100%" border="0" cellpadding="0" cellspacing="0">

  <tr>

    <td>

<TABLE id=Tb_000 cellSpacing=0 cellPadding=0 width="100%" border=0 >

  <TBODY>

  <TR>

    <TD vAlign=top rowSpan=2>

      <TABLE class=Borda4 id=Tb_Geral cellSpacing=0 cellPadding=0 width="100%" 

      border=0>

        <TBODY>

        <TR>

          <TD vAlign=top>

            <TABLE cellSpacing=1 cellPadding=0 width="100%" border=0>

              <TBODY>

              <TR>

                <TD width="10%" id='logoImg'><IMG height=35 width=105 src="<?php echo $img; ?>" /></TD>

                <TD width="69%">

                  <CENTER><SPAN class=Titulo>GUIA DE SERVIÇO PROFISSIONAL / 

                  SERVIÇO AUXILIAR DE DIAGNÓSTICO E TERAPIA - 

                  SP/SADT</SPAN>

                  </CENTER></TD>

                <TD vAlign=center width="21%"><SPAN class=Titulo><SPAN 

                  class=Arial6Topo_Meio>2-</SPAN> Nº 

              </SPAN></TD></TR></TBODY></TABLE>

            <TABLE height=31 cellSpacing=1 cellPadding=0 width="100%" 

              border=0>

              <TBODY>

              <TR>

                <TD class="Borda4 Arial6Topo" width="16%">1 - Registro ANS<BR>

                  <TABLE height=17 cellSpacing=0 cellPadding=0 width="100%" 

                  border=0>

                    <TBODY>

                    <TR>

                      <TD vAlign=bottom>

                        <CENTER>

                                                

                                                </CENTER></TD></TR></TBODY></TABLE></TD>

                <TD class="Borda4 Arial6Topo" width="18%">3 - Nº Guia 

                  Principal 

                  <TABLE height=17 cellSpacing=0 cellPadding=0 width="100%" 

                  border=0>

                    <TBODY>

                    <TR>

                      <TD vAlign=bottom>

                        <CENTER>

                        </CENTER></TD></TR></TBODY></TABLE></TD>

                <TD class="Borda4 Arial6Topo" width="11%" bgColor=#cecece>4 - 

                  Data da Autorização<BR>

                  <TABLE height=17 cellSpacing=0 cellPadding=0 width="100%" 

                  border=0>

                    <TBODY>

                    <TR>

                      <TD vAlign=bottom>

                        <CENTER>

                          <SPAN class=Arial6Normal>|__|__| / |__|__| / 

                        |__|__| </SPAN>

                        </CENTER></TD></TR></TBODY></TABLE></TD>

                <TD class="Borda4 Arial6Topo" width="28%">5 - Senha </TD>

                <TD class="Borda4 Arial6Topo" width="13%" bgColor=#cecece>6 - 

                  Data de Validade da Senha<BR>

                  <TABLE height=17 cellSpacing=0 cellPadding=0 width="100%" 

                  border=0>

                    <TBODY>

                    <TR>

                      <TD vAlign=bottom>

                        <CENTER>

                          <span 

                        class="Arial6Normal">&nbsp;&nbsp;|__|__| / |__|__| / |__|__| </span>

                        </CENTER></TD></TR></TBODY></TABLE></TD>

                <TD class="Borda4 Arial6Topo" width="14%">7 - Data de Emissão 

                  da Guia<BR>

                  <TABLE height=17 cellSpacing=0 cellPadding=0 width="100%" 

                  border=0>

                    <TBODY>

                    <TR>

                      <TD align="center" vAlign=bottom>

                        <SPAN 

                        class=Arial6Normal>&nbsp;&nbsp;|__|__| / |__|__| / 

                          |__|__| </SPAN></TD>

                    </TR></TBODY></TABLE></TD></TR></TBODY></TABLE>

            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>

              <TBODY>

              <TR>

                <TD class=Arial6MeioNegrito bgColor=#ebebeb height=10>DADOS DO 

                  BENEFICIÁRIO</TD></TR></TBODY></TABLE>

            <TABLE height=20 cellSpacing=1 cellPadding=0 width="100%" 

              border=0>

              <TBODY>

              <TR>

                <TD class="Borda4 Arial6Topo" width="19%">8 - Número da 

                  Carteira<BR>

                  <TABLE height=17 cellSpacing=0 cellPadding=0 width="102%" 

                  border=0>

                    <TBODY>

                    <TR>

                      <TD class=Arial6Normal vAlign=bottom>

                        <CENTER>

                        </CENTER></TD></TR></TBODY></TABLE></TD>

                <TD class="Borda4 Arial6Topo" width="12%">9 - Plano </TD>

                <TD class="Borda4 Arial6Topo" width="14%" bgColor=#cecece>10 - 

                  Validade da Carteira<BR>

                  <TABLE height=17 cellSpacing=0 cellPadding=0 width="100%" 

                  border=0>

                    <TBODY>

                    <TR>

                      <TD vAlign=bottom>

                        <CENTER>

                          <SPAN class=Arial6Normal>|___|___| / |___|___| / 

                        |___|___| </SPAN>

                        </CENTER></TD></TR></TBODY></TABLE></TD>

                <TD class="Borda4 Arial6Topo" width="36%">11 - Nome  <span class="style10"><?php echo $nome; ?></span></TD>

                <TD class="Borda4 Arial6Topo" width="19%" bgColor=#cecece>12 - 

                  Número do Cartão Nacional de Saúde<BR>

                  <TABLE height=17 cellSpacing=0 cellPadding=0 width="100%" 

                  border=0>

                    <TBODY>

                    <TR>

                      <TD vAlign=bottom>

                        <CENTER>

                        </CENTER></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>

            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>

              <TBODY>

              <TR>

                <TD class=Arial6MeioNegrito bgColor=#ebebeb height=10>DADOS DO 

                  CONTRATADO SOLICITANTE</TD></TR></TBODY></TABLE>

            <TABLE height=25 cellSpacing=1 cellPadding=0 width="100%" 

              border=0>

              <TBODY>

              <TR>

                <TD class="Borda4 Arial6Topo" width="22%">13 - Código na 

                  Operadora / CNPJ / CPF 

                  <TABLE height=15 cellSpacing=0 cellPadding=0 width="100%" 

                  border=0>

                    <TBODY>

                    <TR>

                      <TD vAlign=bottom>

                        <CENTER><span class="style10"><?php echo $codigoConvenio2 ?> </span>

                        </CENTER></TD></TR></TBODY></TABLE></TD>

                <TD class="Borda4 Arial6Topo" width="48%">14 - Nome do 

                  Contratado: <span class="style10"><?php echo $nomeClinica2 ?></span></TD>

                <TD class="Borda4 Arial6Topo" width="12%" bgColor=#cecece>15 - 

                  Código CNES</TD>

                </TR></TBODY></TABLE>

            <TABLE height=25 cellSpacing=1 cellPadding=0 width="100%" 

              border=0>

              <TBODY>

              <TR>

                <TD class="Borda4 Arial6Topo" width="43%">16 - Nome do 

                  Profissional Solicitante <span class="style8"><?php echo $nome_medico; ?></span></TD>

                <TD class="Borda4 Arial6Topo" width="12%">17 - Conselho 

                  Profissional <span class="style6">CRM</span></TD>

                <TD class="Borda4 Arial6Topo" width="15%">18 - Número no 

                  Conselho <span class="style10"><?php echo $crm; ?></span></TD>

                <TD class="Borda4 Arial6Topo" width="5%">19 - UF</TD>

                <TD class="Borda4 Arial6Topo" width="7%" bgColor=#cecece>20 - 

                  Código CBO S</TD>

                </TR></TBODY></TABLE>

            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>

              <TBODY>

              <TR>

                <TD class=Arial6MeioNegrito bgColor=#ebebeb height=10>DADOS DA 

                  SOLICITAÇÃO / PROCEDIMENTOS E EXAMES 

            SOLICITADOS</TD></TR></TBODY></TABLE>

            <TABLE height=25 cellSpacing=1 cellPadding=0 width="100%" 

              border=0>

              <TBODY>

              <TR>

                <TD class="Borda4 Arial6Topo" width="24%" bgColor=#cecece>21 - 

                  Data/Hora da Solicitação 

                  <TABLE height=15 cellSpacing=0 cellPadding=0 width="100%" 

                  border=0>

                    <TBODY>

                    <TR>

                      <TD vAlign=bottom>

                        <CENTER><SPAN class=Arial6Normal>|___|___| / |___|___| / 

                        |___|___| </SPAN>&nbsp;&nbsp; <SPAN 

                        class=Arial6Normal>|___|___| : |___|___| 

                      </SPAN></CENTER></TD></TR></TBODY></TABLE></TD>

                <TD class="Borda4 Arial6Topo" width="18%">22 - Caráter da 

                  Solicitação 

                  <TABLE height=15 cellSpacing=0 cellPadding=0 width="100%" 

                  border=0>

                    <TBODY>

                    <TR>

                      <TD vAlign=bottom width="19%">

                        <CENTER><SPAN class=Arial6Normal>|___|</SPAN> 

                      </CENTER></TD>

                      <TD vAlign=bottom width="81%"><STRONG>E</STRONG> - 

                        Eletiva <STRONG>&nbsp;U</STRONG> - Urgência / Emergência </TD>

                    </TR></TBODY></TABLE></TD>

                <TD class="Borda4 Arial6Topo" width="14%">23 - CID 10<BR>

                  <TABLE height=15 cellSpacing=0 cellPadding=0 width="100%" 

                  border=0>

                    <TBODY>

                    <TR>

                      <TD vAlign=bottom>

                        <DIV class="style10"

                    align=left>&nbsp;<?php $cid2 = (empty($_POST['cid2'])) ? 'N20.0' : $_POST['cid2']; echo $cid2;?></DIV></TD></TR></TBODY></TABLE></TD>

                <TD class="Borda4 Arial6Topo" width="44%">24 - Indicação 

                  Clínica</TD></TR></TBODY></TABLE>

            <TABLE cellSpacing=1 cellPadding=0 width="100%" border=0>

              <TBODY>

              <TR>

                <TD class="Borda4 Arial6Topo" width="34%" height=0>

                  <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>

                    <TBODY>

                    <TR>

                      <TD width="8%" bgColor=#cecece height=10>25 - Tabela</TD>

                      <TD width="25%">26 - Código do Procedimento</TD>

                      <TD width="55%">27 - Descrição</TD>

                      <TD width="6%">

                        <CENTER>28-Qtde.Solic. </CENTER></TD>

                      <TD width="6%">

                        <CENTER>29-Qtde.Autor. </CENTER></TD></TR>
                        
                        <?php for ($i=0; $i<sizeof($arrayExames); $i++) {?>
                        
                        <TR>
                        

                          <TD vAlign=center bgColor=#cecece height=16><?php echo $i+1; ?> - 
    
                          |___|___|</TD>
    
                          <TD vAlign=center>|___|___|___|___|___|___|___|___<SPAN 
    
                            class=FundoE9E9E9>|___|___| </SPAN></TD>
    
                          <TD>
    
                            <TABLE class=BordaBase cellSpacing=0 cellPadding=0 
    
                            width="99%" border=0>
    
                              <TBODY>
    
                              <TR>
    
                                <TD class="style8"><?php echo $arrayExames[$i];?></TD></TR></TBODY></TABLE></TD>
    
                          <TD vAlign=center>
    
                            <CENTER>|___|___| </CENTER></TD>
    
                          <TD vAlign=center>
    
                            <CENTER>|___|___| </CENTER></TD>
                            
                     	</TR>
                        <?php } ?>


                    </TBODY></TABLE></TD></TR></TBODY></TABLE>

            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>

              <TBODY>

              <TR>

                <TD class=Arial6MeioNegrito bgColor=#ebebeb height=10>DADOS DO 

                  CONTRATADO EXECUTANTE</TD></TR></TBODY></TABLE>

            <TABLE height=20 cellSpacing=1 cellPadding=0 width="100%" 

              border=0>

              <TBODY>

              <TR>

                <TD class="Borda4 Arial6Topo" width="23%">30 - Código na 

                  Operadora / CNPJ / CPF 

                  <TABLE height=17 cellSpacing=0 cellPadding=0 width="100%" 

                  border=0>

                    <TBODY>

                    <TR>

                      <TD vAlign=middle>

                        <CENTER>

                          |___|___|___|___|___|___|___|___|___|___|___|___|___|___| 

                        </CENTER></TD></TR></TBODY></TABLE></TD>

                <TD class="Borda4 Arial6Topo" width="12%">31 - Nome do 

                  Contratado</TD>

                <TD class="Borda4 Arial6Topo" width="10%" bgColor=#cecece>32 - 

                  T.Log.</TD>

                <TD class="Borda4 Arial6Topo" width="15%" 

                  bgColor=#cecece>33-34-35 - Logradouro - Número - 

Complemento</TD>

                <TD class="Borda4 Arial6Topo" width="11%" bgColor=#cecece>36 - 

                  Município</TD>

                <TD class="Borda4 Arial6Topo" width="5%" bgColor=#cecece>37 - 

                  UF</TD>

                <TD class="Borda4 Arial6Topo" width="8%" bgColor=#cecece>38 - 

                  Cód. IBGE</TD>

                <TD class="Borda4 Arial6Topo" width="6%" bgColor=#cecece>39 - 

                  CEP</TD>

                <TD class="Borda4 Arial6Topo" width="10%" bgColor=#ffffff>40 - 

                  Código CNES</TD></TR></TBODY></TABLE>

            <TABLE height=31 cellSpacing=1 cellPadding=0 width="100%" 

              border=0>

              <TBODY>

              <TR>

                <TD class="Borda4 Arial6Topo" width="23%"><SPAN 

                  class=style3><SPAN class=style7><SPAN class=style3>40a</SPAN> 

                  - Código na Operadora / CNPJ /</SPAN> CPF do Exec. 

                  Complementar </SPAN>

                  <TABLE height=17 cellSpacing=0 cellPadding=0 width="100%" 

                  border=0>

                    <TBODY>

                    <TR>

                      <TD vAlign=bottom>

                        <CENTER>

                          |___|___|___|___|___|___|___|___|___|___|___|___|___|___| 

                        </CENTER></TD></TR></TBODY></TABLE></TD>

                <TD class="Borda4 Arial6Topo" width="30%">41 - Nome do 

                  Profissional Executante / Complementar</TD>

                <TD class="Borda4 Arial6Topo" width="11%">42 - Conselho 

                  Profissional </TD>

                <TD class="Borda4 Arial6Topo" width="11%">43 - Número no 

                  Conselho</TD>

                <TD class="Borda4 Arial6Topo" width="4%">44 - UF</TD>

                <TD class="Borda4 Arial6Topo" width="9%" bgColor=#cecece>45 - 

                  Código CBO S</TD>

                <TD class="Borda4 Arial6Topo" width="12%">45a - Grau de 

                  Participação 

                  <TABLE height=17 cellSpacing=0 cellPadding=0 width="100%" 

                  border=0>

                    <TBODY>

                    <TR>

                      <TD vAlign=bottom>

                        <CENTER>|___|___| 

              </CENTER></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>

            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>

              <TBODY>

              <TR>

                <TD class=Arial6MeioNegrito bgColor=#ebebeb height=10>DADOS DO 

                  ATENDIMENTO</TD></TR></TBODY></TABLE>

            <TABLE height=31 cellSpacing=1 cellPadding=0 width="100%" 

              border=0>

              <TBODY>

              <TR>

                <TD class="Borda4 Arial6Topo" width="45%">46 - Tipo de 

                  Atendimento 

                  <TABLE height=17 cellSpacing=1 cellPadding=0 width="100%" 

                  border=0>

                    <TBODY>

                    <TR>

                      <TD vAlign=bottom width="9%"><SPAN 

                        class=Arial6Normal>|___|___|</SPAN> </TD>

                      <TD vAlign=bottom width="91%">

                        <DIV align=left><STRONG>01</STRONG> - Remoção &nbsp; 

                        <STRONG>02</STRONG> - Pequena Cirurgia &nbsp; 

                        <STRONG>03</STRONG> - Terapias &nbsp; 

                        <STRONG>04</STRONG> - Consulta &nbsp; 

                        <STRONG>05</STRONG> - Exame &nbsp; <STRONG>06</STRONG> - 

                        Atendimento Domiciliar<BR><STRONG>07</STRONG> - SADT 

                        Internado&nbsp;&nbsp;&nbsp;&nbsp; <STRONG>08</STRONG> - 

                        Quimioterapia &nbsp; 

                        <STRONG>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 09</STRONG> 

                        - Radioterapia &nbsp; <STRONG>&nbsp; &nbsp; 10</STRONG> 

                        - TRS-Terapia Renal 

                  Substitutiva</DIV></TD></TR></TBODY></TABLE></TD>

                <TD class="Borda4 Arial6Topo" width="24%">47 - Indicação de 

                  Acidente 

                  <TABLE height=17 cellSpacing=1 cellPadding=0 width="100%" 

                  border=0>

                    <TBODY>

                    <TR>

                      <TD vAlign=bottom width="94%"><STRONG>&nbsp; <span class="Arial6Normal">|___|</span> 0 

                        </STRONG>- Acidente ou doença relacionado ao trabalho 

                        &nbsp; <STRONG>1</STRONG> - Trânsito &nbsp;&nbsp; 

                        <STRONG>2</STRONG> - Outros </TD>

                    </TR></TBODY></TABLE></TD>

                <TD class="Borda4 Arial6Topo" vAlign=bottom width="31%">48 - 

                  Tipo de Saída<BR>

                  <TABLE height=19 cellSpacing=0 cellPadding=0 width="100%" 

                  border=0>

                    <TBODY>

                    <TR>

                      <TD vAlign=bottom>

                        <DIV align=left>&nbsp;|___| <STRONG>1</STRONG> - Retorno 

                        &nbsp;<STRONG> 2</STRONG> - Retorno SADT &nbsp; 

                        <STRONG>3</STRONG> - Referência &nbsp; 

                        <STRONG>4</STRONG> - Internação &nbsp; 

                        <STRONG>5</STRONG> - Alta &nbsp; <STRONG>6</STRONG> - 

                      Óbito </DIV></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>

            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>

              <TBODY>

              <TR>

                <TD class=Arial6MeioNegrito bgColor=#ebebeb height=10>CONSULTA 

                  REFERÊNCIA</TD></TR></TBODY></TABLE>

            <TABLE height=15 cellSpacing=0 cellPadding=0 width="100%" 

              border=0>

              <TBODY>

              <TR>

                <TD class="Borda4 Arial6Topo" width="16%" bgColor=#cecece 

                height=29>49 - Tipo de Doença 

                  <TABLE height=15 cellSpacing=0 cellPadding=0 width="100%" 

                  border=0>

                    <TBODY>

                    <TR>

                      <TD vAlign=bottom width="4%">

                        <DIV align=left><SPAN 

                        class=Arial6Normal>&nbsp;|___|</SPAN></DIV></TD>

                      <TD vAlign=bottom width="96%"><STRONG>&nbsp;A</STRONG> - 

                        Aguda &nbsp; <STRONG>C</STRONG> - 

                  Crônica</TD></TR></TBODY></TABLE></TD>

                <TD class="Borda4 Arial6Topo" width="28%" bgColor=#cecece>50 - 

                  Tempo de Doença 

                  <TABLE height=15 cellSpacing=0 cellPadding=0 width="100%" 

                  border=0>

                    <TBODY>

                    <TR>

                      <TD vAlign=bottom>

                        <DIV align=left>&nbsp;|___|___| - 

                        |___|&nbsp;<STRONG>A</STRONG> - Anos &nbsp; 

                        <STRONG>M</STRONG> - Meses &nbsp;<STRONG> D</STRONG> - 

                        Dias </DIV></TD></TR></TBODY></TABLE></TD>

                <TD width="56%">&nbsp;</TD></TR></TBODY></TABLE>

            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>

              <TBODY>

              <TR>

                <TD class=Arial6MeioNegrito bgColor=#ebebeb 

                  height=10>PROCEDIMENTOS E EXAMES 

REALIZADOS</TD></TR></TBODY></TABLE>

            <TABLE cellSpacing=1 cellPadding=0 width="100%" 

              border=0>

              <TBODY>

              <TR>

                <TD class="Borda4 Arial6Topo" width="34%">

                  <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>

                    <TBODY>

                    <TR>

                      <TD class=Arial6Topo width="14%" height=10>51 - Data</TD>

                      <TD class=Arial6Topo width="9%">52 - Hora Inicial</TD>

                      <TD class=Arial6Topo width="8%">53 - Hora Final</TD>

                      <TD class=Arial6Topo width="4%">54-Tab</TD>

                      <TD class=Arial6Topo width="18%">55 - Código do 

                        Procedimento </TD>

                      <TD class=Arial6Topo width="4%">57-Qde.</TD>

                      <TD class="Arial6Topo FundoE9E9E9" width="3%">58-Via</TD>

                      <TD class="Arial6Topo FundoE9E9E9" width="4%">59-Tec</TD>

                      <TD class="Arial6Topo FundoE9E9E9" width="10%">60-% Red. 

                        / Acréscimo</TD>

                      <TD class="Arial6Topo FundoE9E9E9" width="13%">61 - 

                        Valor Unitário - R$</TD>

                      <TD class=Arial6Topo width="13%">62 - Valor Total - 

                    R$</TD></TR>

                    <TR>

                      <TD vAlign=center height=15>1-|___|___|/|___|___|/|___|___|</TD>

                      <TD vAlign=center>|___|___|:|___|___| a<SPAN 

                        class=FundoE9E9E9></SPAN></TD>

                      <TD vAlign=center>|___|___|:|___|___|</TD>

                      <TD vAlign=center>

                        <CENTER>

                          |___|___| 

                        </CENTER></TD>

                      <TD vAlign=center>

                        <CENTER>

                          |___|___|___|___|___|___|___|___<SPAN 

                        class=FundoE9E9E9>|___|___|</SPAN> </CENTER></TD>

                      <TD align="center" vAlign=center>

                        |___|___|</TD>

                      <TD class=FundoE9E9E9 vAlign=center>

                        <CENTER>

                          |___| 

                        </CENTER></TD>

                      <TD class=FundoE9E9E9 vAlign=center>

                        <CENTER>

|___|

                        </CENTER></TD>

                      <TD class=FundoE9E9E9 

                        vAlign=center>|___|___|___|,|___|___|</TD>

                      <TD class=FundoE9E9E9 

                        vAlign=center>|___|___|___|___|___|,|___|___|</TD>

                      <TD class="" 

                        vAlign=center>|___|___|___|___|___|,|___|___|</TD>

                    </TR>

                    <TR>

                      <TD vAlign=center height=15>2-|___|___|/|___|___|/|___|___|</TD>

                      <TD vAlign=center>|___|___|:|___|___| a<span 

                        class="FundoE9E9E9"></span></TD>

                      <TD vAlign=center>|___|___|:|___|___|</TD>

                      <TD vAlign=center>

                        <CENTER>

|___|___|

                        </CENTER></TD>

                      <TD vAlign=center>

                        <CENTER>

|___|___|___|___|___|___|___|___<span 

                        class="FundoE9E9E9">|___|___|</span>

                        </CENTER></TD>

                      <TD align="center" vAlign=center> |___|___|</TD>

                      <TD class=FundoE9E9E9 vAlign=center>

                        <CENTER>

|___|

                        </CENTER></TD>

                      <TD class=FundoE9E9E9 vAlign=center>

                        <CENTER>

|___|

                        </CENTER></TD>

                      <TD class=FundoE9E9E9 

                        vAlign=center>|___|___|___|,|___|___|</TD>

                      <TD class=FundoE9E9E9 

                        vAlign=center>|___|___|___|___|___|,|___|___|</TD>

                      <TD class="" 

                        vAlign=center>|___|___|___|___|___|,|___|___|</TD>

                    </TR>

                    </TBODY></TABLE></TD></TR></TBODY></TABLE>

            <TABLE cellSpacing=1 cellPadding=0 width="100%" 

              border=0>

              <TBODY>

              <TR>

                <TD class="Borda4 Arial6Topo" width="56%">63 - Data e 

                  Assinatura de Procedimentos em Série<BR>

                  <TABLE width="100%" height="35" border=0 cellPadding=0 cellSpacing=0>

                    <TBODY>

                    <TR>

                      <TD height=15>1 - |___|___|/|___|___|/|___|___| 

                        ______________ 3 - 

                        |___|___|/|___|___|/|___|___| ______________ 5 

                        - |___|___|/|___|___|/_|___|___| _______________ 7 - 

                        |___|___|/|___|___|/|___|___| _____________ 9 

                        - |___|___|/|___|___|/|___|___| _____________</TD>

                    </TR>

                    <TR>

                      <TD height=15>2 - |___|___|/|___|___|/|___|___| ______________ 4 - |___|___|/|___|___|/|___|___| ______________ 6 - |___|___|/|___|___|/_|___|___| _______________ 8 - |___|___|/|___|___|/|___|___| _____________ 10 - |___|___|/|___|___|/|___|___| _____________</TD>

                    </TR></TBODY></TABLE></TD></TR></TBODY></TABLE>

            <TABLE height=25 cellSpacing=1 cellPadding=0 width="100%" 

              border=0>

              <TBODY>

              <TR>

                <TD class="Borda4 Arial6Topo" width="100%" bgColor=#cecece>64 

                  - Observação</TD></TR></TBODY></TABLE>

            <TABLE cellSpacing=1 cellPadding=0 width="100%" 

              border=0>

              <TBODY>

              <TR>

                <TD class="Borda4 Arial6Topo" width="14%">65 - Total 

                  Procedimentos - R$ 

                  <TABLE width="100%" height=15 

                  border=0 align="center" cellPadding=0 cellSpacing=0>

                    <TBODY>

                    <TR>

                      <TD  vAlign=bottom>

                        <div align="center"><span 

                        class="style6">|__|__|__|__|__|__|__|,|__|__|</span> </div></TD>

                    </TR></TBODY></TABLE></TD>

                <TD class="Borda4 Arial6Topo" width="15%">66 - Total Taxas e 

                  Aluguéis - R$ 

                  <TABLE width="100%" height=15 

                  border=0 align="center" cellPadding=0 cellSpacing=0>

                    <TBODY>

                    <TR>

                      <TD vAlign=bottom>                         <div align="center"><span 

                        class="style6">|__|__|__|__|__|__|__|,|__|__|</span></div></TD>

                    </TR></TBODY></TABLE></TD>

                <TD class="Borda4 Arial6Topo" width="13%">67- Total Materiais 

                  - R$ 

                  <TABLE width="100%" height=15 

                  border=0 align="center" cellPadding=0 cellSpacing=0>

                    <TBODY>

                    <TR>

                      <TD vAlign=bottom>                         <div align="center"><span 

                        class="style6">|__|__|__|__|__|__|__|,|__|__|</span></div></TD>

                    </TR></TBODY></TABLE></TD>

                <TD class="Borda4 Arial6Topo" width="16%">68 - Total 

                  Medicamentos - R$ 

                  <TABLE width="100%" height=15 

                  border=0 align="center" cellPadding=0 cellSpacing=0>

                    <TBODY>

                    <TR>

                      <TD vAlign=bottom>                         <div align="center"><span 

                        class="style6">|__|__|__|__|__|__|__|,|__|__|</span></div></TD>

                    </TR></TBODY></TABLE></TD>

                <TD class="Borda4 Arial6Topo" width="14%">69 - Total Diárias - 

                  R$ 

                  <TABLE width="100%" height=15 

                  border=0 align="center" cellPadding=0 cellSpacing=0>

                    <TBODY>

                    <TR>

                      <TD vAlign=bottom>                         <div align="center"><span 

                        class="style6">|__|__|__|__|__|__|__|,|__|__|</span></div></TD></TR></TBODY></TABLE></TD>

                <TD class="Borda4 Arial6Topo" width="13%">70 - Total Gases 

                  Medicinais - R$ 

                  <TABLE width="100%" height=15 

                  border=0 align="center" cellPadding=0 cellSpacing=0>

                    <TBODY>

                    <TR>

                      <TD vAlign=bottom>                         <div align="center"><span 

                        class="style6">|__|__|__|__|__|__|__|,|__|__|</span></div></TD>

                    </TR></TBODY></TABLE></TD>

                <TD class="Borda4 Arial6Topo" width="15%">71 - Total Geral da 

                  Guia - R$ 

                  <TABLE height=15 cellSpacing=0 cellPadding=0 width="100%" 

                  border=0>

                    <TBODY>

                    <TR>

                      <TD vAlign=bottom>                         <div align="center"><span 

                        class="style6">|__|__|__|__|__|__|__|,|__|__|</span></div></TD>

                    </TR></TBODY></TABLE></TD></TR></TBODY></TABLE>

            <TABLE cellSpacing=1 cellPadding=0 width="100%" border=0>

              <TBODY>

              <TR>

                <TD class="Borda4 Arial6Topo" width="25%" height=0>86 - Data e 

                  Assinatura do Solicitante<br /> 

                  <TABLE cellSpacing=1 cellPadding=0 width="100%" border=0>

                    <TBODY>

                    <TR>

                      <TD vAlign=bottom 

                      height=15>|___|___|/|___|___|/|___|___|</TD>

                    </TR></TBODY></TABLE></TD>

                <TD class="Borda4 Arial6Topo" width="25%" bgColor=#cecece>87 - 

                  Data e Assinatura do Responsável pela Autorização &nbsp; 

                  <TABLE height=14 cellSpacing=1 cellPadding=0 width="100%" 

                  border=0>

                    <TBODY>

                    <TR>

                      <TD vAlign=bottom 

                      height=15>|___|___|/|___|___|/|___|___|</TD>

                    </TR></TBODY></TABLE></TD>

                <TD class="Borda4 Arial6Topo" width="25%">88 - Data e 

                  Assinatura do Beneficiário ou Responsável (*) &nbsp; 

                  <TABLE height=14 cellSpacing=1 cellPadding=0 width="100%" 

                  border=0>

                    <TBODY>

                    <TR>

                      <TD vAlign=bottom 

                      height=15>|___|___|/|___|___|/|___|___|</TD>

                    </TR></TBODY></TABLE></TD>

                <TD class="Borda4 Arial6Topo" width="25%">89 - Data e 

                  Assinatura do Prestador Executante &nbsp; 

                  <TABLE height=14 cellSpacing=1 cellPadding=0 width="100%" 

                  border=0>

                    <TBODY>

                    <TR>

                      <TD vAlign=bottom 

                      height=15>|___|___|/|___|___|/|___|___|</TD>

                    </TR></TBODY></TABLE></TD></TR></TBODY></TABLE>

            </TD></TR></TBODY></TABLE>

      </TD>

    </TR>

  </TBODY></TABLE>

	<br style="PAGE-BREAK-BEFORE: always;">


<DIV align=right></DIV>
<!--<input action="action" type="button" value="Back" onclick="window.print();window.location.replace('SADT.php');" /> -->

<script>

	
	$(function() {
         
          $('body').click(function() {window.print(); window.location.replace('SADT.php');});

          $('body').on("keypress",function(e)  {
            if (e.keyCode == 13) {
                e.preventDefault(); window.print(); window.location.replace('SADT.php');
             }
           });

        
     
        }); 
    
	
</script>

</BODY></html>
<?php
} else die('corrupted data');

?>


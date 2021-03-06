<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/easyui/themes/gray/easyui-modified.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bro.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/easyui/themes/icon.css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/easyui/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/easyui/jquery.easyui.min.js"></script>
<style type="text/css">
body {
	font-size:14px;
	background:#F3F3F3;
}
#frmRegLetter {
	margin:0;
	padding:10px 10px;
	font-size:14px;
}
.frmRegLetterTitle {
	font-size:14px;
	font-weight:bold;
	color:#666;
	padding:5px 0;
	margin-bottom:20px;
	border-bottom:1px solid #ccc;
}
.frmRegLetterItem {
	margin-bottom:10px;
}
.frmRegLetterItem label {
	display:inline-block;
	text-align:left;
	width:100px;
}
.frmRegLetterItem quote {
	display:inline-block;
	text-align:left;
	width:5px;
}
</style>
</head>
<body>
<div class="easyui-layout" style="width:466px;height:350px; background-color:#FFF;">
    <div data-options="region:'center',border:false" style="height:315px;">
	<div style="padding:0px 15px;">
	<form name="frmRegLetter" id="frmRegLetter" method="post" novalidate>
	<div class="frmRegLetterTitle">Data Closing</div>
	<div class="frmRegLetterItem">
		<label>Insured&nbsp;&nbsp;</label>
        <quote>:</quote>
		<input name="fldInsured" id="fldInsured" class="easyui-validatebox" required="true" size="40">
	</div>
	<div class="frmRegLetterItem">
		<label>Date&nbsp;&nbsp;</label>
        <quote>:</quote>
		<input name="fldDate" id="fldDate" class="easyui-datebox" style="width:78px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dd/mm/yyyy
	</div>
	<div class="frmRegLetterItem">
		<label>Risk&nbsp;&nbsp;</label>
        <quote>:</quote>
		<input name="fldClassRisk" id="fldClassRisk" style="width:130px" required="true"></input>
		<input type="hidden" name="fldClassRisk2" id="fldClassRisk2">
	</div>
	<div class="frmRegLetterItem">
		<label>Segment&nbsp;&nbsp;</label>
        <quote>:</quote>
		<input name="fldSegment" id="fldSegment" style="width:130px" <?php if(!isset($vRegLetter)) { echo 'required="true"'; } ?>></input>
		<input type="hidden" name="fldSegment2" id="fldSegment2">
	</div>
	<div class="frmRegLetterItem">
		<label>Description&nbsp;&nbsp;</label>
        <quote>:</quote>
		<input name="fldDescription" id="fldDescription" class="easyui-validatebox" required="true" size="40">
	</div>
	<div class="frmRegLetterItem">
		<label>Approve By&nbsp;&nbsp;</label>
        <quote>:</quote>
		<input name="fldApprove" id="fldApprove" size="21">
	</div>
	</form>
    </div>
    </div>
    <div data-options="region:'south',border:false" style="height:35px; background-color:#F8F8F8;">
    	<div style="float:left; width:auto; margin:5px 0px 0px 5px;">
            <span style="background-color:#FF9; border:1px solid #666">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Harus Diisi.
        </div>
        <div id="btnRegLetter" align="right" style="padding:5px;">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="fnSave()">Save</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="fnCancel()">Cancel</a>
        </div>
    </div>
</div>
   
</body>
<script type="text/javascript">
$(document).ready(function() {
	window.parent.$('#divRegLetterWait').hide();
	window.parent.$('#fraRegLetter').show();
	$(".datebox").width(100);
});
<?php if(isset($vRegLetter)) {	?>
$('#frmRegLetter').form('clear').form('load','<?php echo base_url(); ?>index.php/md_reg_letter/fnRegLetterRow/<?php echo $vRegLetter ?>');
url = '<?php echo base_url(); ?>index.php/md_reg_letter/fnRegLetterUpdate/<?php echo $vRegLetter ?>';
<?php } else { ?>
$('#frmRegLetter').form('clear');
url = '<?php echo base_url(); ?>index.php/md_reg_letter/fnRegLetterCreate/';
<?php } ?>
$.fn.validatebox.defaults.missingMessage = 'Harus diisi.';
$.fn.combogrid.defaults.missingMessage = 'Harus diisi.';
$.fn.datebox.defaults.missingMessage = 'Harus diisi.';
$.fn.datebox.defaults.formatter = function(date){
	var y = date.getFullYear();
	var m = date.getMonth()+1;
	if(m < 10) {
		m = "0"+m;
	}
	var d = date.getDate();
	if(d < 10) {
		d = "0"+d;
	}
	return d+'/'+m+'/'+y;
}
$.fn.datebox.defaults.parser = function(s){
	sTemp = s.split('/');
	dTemp = sTemp[1]+'/'+sTemp[0]+'/'+sTemp[2];
	var t = Date.parse(dTemp);
	if (!isNaN(t)){
		return new Date(t);
	} else {
		return new Date();
	}
}
$(function() {
	$('#fldClassRisk').combogrid({
		idField:'ClassRisk',
		textField:'ClassRisk',
		mode:'remote',
		url:'<?php echo base_url(); ?>index.php/md_reg_letter/fnClassRiskData',
		panelWidth:375,
		panelHeight:130,
		columns:[[
			{field:'ClassRisk',title:'Class Risk',width:90},
			{field:'ClassRisk_Name',title:'Class Risk Name',width:255}
		]]
	});
	$('#fldSegment').combogrid({
		idField:'Code',
		textField:'Code',
		mode:'remote',
		url:'<?php echo base_url(); ?>index.php/md_reg_letter/fnSegmentData',
		panelWidth:250,
		panelHeight:130,
		columns:[[
			{field:'Code',title:'Segment',width:800}
		]],
		fitColumns:true
	});
});

function fnSave() {
	$.ajax({
		type: "POST",
		url: '<?php echo base_url()?>index.php/md_reg_letter/fnCekRiskSegment/'+$('#fldClassRisk').combogrid('getText')+'/'+$('#fldSegment').combogrid('getText'),
		dataType:"json",
		data: {},
		success: function(data){
			if(data.ClassRisk=='') {
				alert('Data Risk tidak dapat ditemukan.');
				return false;
			} <?php if(isset($vRegLetter)) { ?>else if($('#fldSegment').combogrid('getText') !='' && data.Segment=='')<?php } else if(!isset($vRegLetter)) { ?>else if(data.Segment=='')<?php } ?> {
				alert('Data Segment tidak dapat ditemukan.');
				return false;
			} else {
				fnSaveData();
			}
		},
		error: function(){
			alert('Data Risk tidak dapat diakses.');
		}
	});
}
function fnSaveData() {
	$('#frmRegLetter').form('submit',{
		url: url,
		onSubmit: function() {
			return $(this).form('validate');
		},
		success: function(result) {
			var result = eval('('+result+')');
			if (result.success) {
				window.parent.$('#dtgRegLetter').datagrid('reload');
				window.parent.$('#dlgRegLetter').dialog('close');
			} else {
				var msg = result.msg;
				alert(msg);
			}
		}
	});
}
function fnCancel() {
	window.parent.$('#dlgRegLetter').dialog('close');
}
</script>
</html>
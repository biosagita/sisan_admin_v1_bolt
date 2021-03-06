<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href='<?php echo base_url(); ?>assets/easyui/themes/gray/easyui-modified.css'>
<link rel="stylesheet" type="text/css" href='<?php echo base_url(); ?>assets/bens.css'>
<link rel="stylesheet" type="text/css" href='<?php echo base_url(); ?>assets/easyui/themes/icon.css'>
<script type="text/javascript" src='<?php echo base_url(); ?>assets/easyui/jquery.min.js'></script>
<script type="text/javascript" src='<?php echo base_url(); ?>assets/easyui/jquery.easyui.min.js'></script>
</head>
<body>
<div class="easyui-layout" style="width:495px; height:350px; background-color:#FFF;">
	<div data-options="region:'center',border:false">
		<div style="padding:0px 15px;">
			<form name="frmprioritas_layanan" id="frmprioritas_layanan" method="post" novalidate>
			<div class="frmTitle">Data prioritas_layanan</div>
			
         
			<div class="frmItem">
				<label>ID%20Prioritas</label>
				<input name='id_prioritas' id='id_prioritas' class="easyui-validatebox" size="20" data-options="required:true">
			</div>
       
			<div class="frmItem">
				<label>ID%20Group%20Loket</label>
				<input name='id_group_loket' id='id_group_loket' class="easyui-validatebox" size="20" data-options="required:true">
			</div>
       
			<div class="frmItem">
				<label>ID%20Group%20Layanan</label>
				<input name='id_group_layanan' id='id_group_layanan' class="easyui-validatebox" size="20" data-options="required:true">
			</div>
       
			<div class="frmItem">
				<label>Prioritas</label>
				<input name='Prioritas' id='Prioritas' class="easyui-validatebox" size="20" data-options="required:true">
			</div>
       
			<div class="frmItem">
				<label>Kolom%205</label>
				<input name='Kolom%205' id='Kolom%205' class="easyui-validatebox" size="20" data-options="required:true">
			</div>
       
			<div class="frmItem">
				<label>ID%20Prioritas</label>
				<input name='id_prioritas' id='id_prioritas' class="easyui-validatebox" size="20" data-options="required:true">
			</div>
       
			<div class="frmItem">
				<label>ID%20Group%20Loket</label>
				<input name='id_group_loket' id='id_group_loket' class="easyui-validatebox" size="20" data-options="required:true">
			</div>
       
			<div class="frmItem">
				<label>ID%20Group%20Layanan</label>
				<input name='id_group_layanan' id='id_group_layanan' class="easyui-validatebox" size="20" data-options="required:true">
			</div>
       
			<div class="frmItem">
				<label>Prioritas</label>
				<input name='Prioritas' id='Prioritas' class="easyui-validatebox" size="20" data-options="required:true">
			</div>
       
			<div class="frmItem">
				<label>Kolom%205</label>
				<input name='Kolom%205' id='Kolom%205' class="easyui-validatebox" size="20" data-options="required:true">
			</div>
       			
	   
			</form>
		</div>
	</div>
	<div data-options="region:'south',border:false" style="height:35px; background-color:#F8F8F8;">
		<div id="btnprioritas_layanan" align="right" style="padding:5px;">
			<div id="footBarLeft" style="float:left; width:auto; margin:5px 0px 0px 5px;">
				<span style="background-color:#FF9; border:1px solid #666">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Must be filled.
			</div>
			<div id="footBarRight" style="float:right; width:auto; clear:right;">
				<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="fnSave()">Save</a>
				<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="fnCancel()">Cancel</a>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<script type="text/javascript">
$(document).ready(function() {
	window.parent.$('#94_divWait').hide();
	window.parent.$('#94_fraprioritas_layanan').show();
});
<?php if(isset($vprioritas_layananId)) { ?>
$('#frmprioritas_layanan').form('load','<?php echo base_url()?>index.php/md_prioritas_layanan/fnprioritas_layananRow/<?php echo $vprioritas_layananId; ?>');
url = '<?php echo base_url(); ?>index.php/md_prioritas_layanan/fnprioritas_layananUpdate/<?php echo $vprioritas_layananId; ?>';
<?php } else { ?>
$('#frmprioritas_layanan').form('clear');
url = '<?php echo base_url(); ?>index.php/md_prioritas_layanan/fnprioritas_layananCreate/';
<?php } ?>
$.fn.validatebox.defaults.missingMessage = 'Must be filled.';
$(function() {
	$('#fldType').combobox({
		valueField:'f_prioritas_layanan_type_id',
		textField:'f_prioritas_layanan_type_name',
		mode:'remote',
		panelWidth:100,
		panelHeight:'auto',
		url:'<?php echo base_url(); ?>index.php/md_prioritas_layanan/fnprioritas_layananTypeData/'
	});

	<?php if(isset($vprioritas_layananId)) { ?>
	$('#fldLogin').attr('disabled','disabled');
	<?php } ?>
});
function fnSave() {
	fnSaveData();
}
function fnSaveData() {
	$('#frmprioritas_layanan').form('submit',{
		url: url,
		onSubmit: function() {
			return $(this).form('validate');
		},
		success: function(result) {
			var result = eval('('+result+')');
			if (result.success) {
				window.parent.$('#94_dtgprioritas_layanan').datagrid('reload');
				window.parent.$('#94_dlgprioritas_layanan').dialog('close');
			} else {
				var msg = result.msg;
				alert(msg);
			}
		}
	});
}
function fnCancel() {
	window.parent.$('#94_dlgprioritas_layanan').dialog('close');
}
</script>
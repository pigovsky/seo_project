<h1>Login</h1>
<div id="body">
<form 
action="<? echo site_url('admin/logining') ?>"
 method='post'>
<table>
<tr><td>Login</td>
<td><input type='text' name='user'></td></tr>
<tr><td>
Password</td>
<td><input type='password' name='pass'></td></tr>
<tr><td colspan="2" align="right">
<input type='submit' value='login'>
</td></tr>
</table>
</form>